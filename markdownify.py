from collections.abc import Iterable
from datetime import datetime
from bs4 import BeautifulSoup, Comment, NavigableString, Tag
from glob import iglob
from pathlib import Path
from typing import Optional, TypeVar
from urllib.parse import unquote, urljoin, urlparse
import asyncio
import pypandoc
import subprocess
import sys
import re

ABBR_REGEX = re.compile(r'<span class="abbreviation" title="(?P<title>[^"]+)">(?P<body>[^<]+)</span>')
TR_REGEX = re.compile(r'<tr class="(even|odd|header)">')
POST_NOTE_REGEX = re.compile(r'^Posted by (?P<author>.+?) at (?P<time>[0-9]{1,2}:[0-9]{2} [ap]m)\.\s*')
ARCHIVE_ORG_REGEX = re.compile(r'^(https://web\.archive\.org)?/web/\d+/')

T = TypeVar('T')

# https://stackoverflow.com/a/59385935/160386
def background(f):
	def wrapped(*args, **kwargs):
		return asyncio.get_event_loop().run_in_executor(None, f, *args, **kwargs)

	return wrapped

def get_only_non_whitespace_child(tag: Tag) -> Optional[Tag]:
	out_child = None
	for child in tag.children:
		if isinstance(child, Comment):
			pass
		elif isinstance(child, NavigableString) and str(child).strip() == '':
			pass
		elif isinstance(child, Tag) and out_child is None:
			out_child = child
		else:
			return None
	return out_child

def get_one(iterable: Iterable[T]) -> Optional[T]:
	# Sentinel until we have it natively:
	# https://peps.python.org/pep-0661/
	not_given = object()
	return_result = not_given
	for result in iterable:
		if return_result is not not_given:
			return None
		return_result = result

	if return_result is not_given:
		return None

	return return_result


@background
def markdownify(html_path: Path):
	md_path = html_path.with_suffix('.md')
	if md_path.name == 'index.md':
		# Zola requirement.
		md_path = md_path.with_name('_index.md')

	print(f'Converting {html_path}', file=sys.stderr)

	with open(html_path, encoding='utf-8') as html:
		content = html.read()

	soup = BeautifulSoup(content, 'html.parser')

	title = soup.find('title').text.removeprefix('SimplePie: ').removeprefix('Weblog »').removeprefix('SimplePie Documentation:').strip()
	content = soup.find(id='content')
	extra = []
	date = None

	# Clean up.

	# Remove footer.
	# Some pages have messed up html so the footer ends up outside the content block.
	footer = content.find(id='footer')
	if footer is not None:
		footer.decompose()

	# Remove scripts.
	for script in content.find_all('script'):
		script.decompose()

	for a in content.find_all('a', href=True):
		if ARCHIVE_ORG_REGEX.match(a['href']):
			a['href'] = ARCHIVE_ORG_REGEX.sub('', a['href'])
		# Drop URLs not relativized by curl.
		if a['href'] != 'http://simplepie.org':
			a['href'] = a['href'].removeprefix('http://simplepie.org')

		# Use root-relative URLs
		a['href'] = urljoin('/' + str(md_path.relative_to('docs/content')), a['href'])

		if a['href'].startswith('/wiki/_detail/'):
			a.unwrap()
		elif a['href'].startswith('/mint/pepper/orderedlist/downloads/download.php?file='):
			a['href'] = unquote(a['href'].removeprefix('/mint/pepper/orderedlist/downloads/download.php?file='))
			a['href'] = a['href'].removeprefix('http://simplepie.org')
			del a['title']
		elif a['href'].startswith('/wiki/'):
			url = urlparse(a['href'])
			path = url.path
			# Use Zola URLs
			if path.endswith('/start') or path.endswith('/'):
				path = path.removesuffix('start') + '_index'
				del a['title']
			elif path == '/wiki/plugins/wordpress/simplepie_plugin_for_wordpress':
				path += '/_index'
				del a['title']

			if f'docs/content{path}' == str(md_path):
				url = url._replace(path='')
				a['href'] = url.geturl()
			else:
				url = url._replace(path=path + '.md')
				a['href'] = '@' + url.geturl()

	for img in content.find_all('img', src=True):
		img['src'] = img['src'].removeprefix('http://simplepie.org')
		img['src'] = urljoin('/' + str(md_path.relative_to('docs/content')), img['src'])

	# Pandoc would strip abbreviations, let’s turn them into a spans
	# and restore them in post-processing.
	# Acronym tag is deprecated.
	for abbr in content.find_all(['acronym', 'abbr']):
		abbr.name = 'span'
		abbr['class'] = 'abbreviation'

	if html_path.is_relative_to('docs/content/wiki') or html_path.is_relative_to('docs/content/blog'):
		for chunk in content.find_all('div', class_='chunk'):
			child = get_only_non_whitespace_child(chunk)
			if child is not None and child.name == 'h2':
				# Remove the banner on the top.
				chunk.decompose()

	# Clean up specific sections.
	if html_path.is_relative_to('docs/content/blog'):
		if (story_title := get_one(content.find_all('h4', class_='storytitle'))) is not None:
			story_title.decompose()
		if (story_content := get_one(content.find_all('div', class_='storycontent'))) is not None:
			fn = story_content.find_next_sibling('p', class_='footnote')
			if (first := next(fn.strings)) is not None:
				m = POST_NOTE_REGEX.match(first)
				if m is not None:
					extra.append(f'author = "{m["author"]}"')
					date_str = str(html_path).removeprefix('docs/content/blog/')[:len('yyyy-mm-dd')]
					date = datetime.strptime(f'{date_str} {m["time"]}'.upper(), '%Y-%m-%d %I:%M %p').isoformat() + 'Z'
			fn.decompose()
			story_content.unwrap()

		if (comments_title := get_one(content.find_all('h3', id='comments'))) is not None:
			comments_title.decompose()
		for comment in content.find_all('div', class_=['comment', 'pingback', 'comment-respond']):
			comment.decompose()

		if (blogimage := get_one(content.find_all('div', class_='blogimage'))) is not None:
			img = blogimage.find('img')
			cover_image_alt = img['alt']
			cover_image = img['src']
			extra.append(f'cover_image = "{cover_image}"')
			extra.append(f'cover_image_alt = "{cover_image_alt}"')
			blogimage.decompose()
	elif html_path.is_relative_to('docs/content/wiki'):
		for footnote in content.find_all(class_='footnote'):
			if footnote.find(class_='bchead') is not None:
				# Remove breadcrumbs.
				footnote.decompose()

		# Remove buttons at top.
		controls = content.find(id='controls')
		controls.decompose()

		# Remove table of contents.
		if (toc := content.find('div', class_='toc')) is not None:
			toc.decompose()

		# Remove h1 since it is just duplicating the title.
		h1 = list(content.find_all('h1'))
		if (head := get_one(content.find_all('h1'))) is not None and head.get_text().strip() == title.strip():
			head.decompose()

		for level in range(6, 0, -1):
			# Preserve anchors using markdown
			for heading in content.find_all(f'h{level}'):
				if (anchor := get_only_non_whitespace_child(heading)) is not None and anchor.name == 'a':
					anchor_id = anchor['id']
					anchor.unwrap()
					heading.append(f' {{#{anchor_id}}}')

			# Do not wrap sections under each heading.
			for level_block in content.find_all('div', class_=f'level{level}'):
				level_block.unwrap()

		# Do not wrap <li> contents or tables.
		for block in content.find_all('div', class_=['li', 'table']):
			block.unwrap()

		for p in content.find_all('p'):
			if (img := p.img) is not None and img['src'] == '/wiki/lib/images/smileys/icon_exclaim.gif':
				img.decompose()
				p.name = 'div'
				p['class'] = 'warning'

		# We are not styling them.
		for table_elem in content.find_all(['td', 'th', 'tr'], class_=True):
			del table_elem['class']

		# Remove extra link classes since they would prevent markdownification.
		for a in content.find_all(class_=['wikilink1', 'urlextern']):
			del a['class']

		# No need to nofollow, the content is part of the repo so the links will be vetted.
		for a in content.find_all(rel='nofollow'):
			del a['rel']

		# Remove pointless link titles.
		for a in content.find_all('a', title=True, href=True):
			wiki_title = a['title']
			wiki_href = a['href'].removeprefix('@/wiki/').removesuffix('.md').replace('/', ':')
			if a['href'] == a['title'] or wiki_href == wiki_title:
				del a['title']

		# Remove modification
		for clear in content.find_all('div', class_='clearRight'):
			clear.decompose()
		for modified in content.find_all('div', align='right'):
			for child in modified.strings:
				if 'Last modified' in child:
					modified.decompose()
					break

	# Remove .code class from code blocks, to allow the second class to be picked up by pandoc as a syntax.
	for pre in content.find_all('pre'):
		pre['class'] = [class_ for class_ in pre.get('class', []) if class_ != 'code' and class_ != 'html4strict']
		if pre['class'] == []:
			pre_content = pre.get_text()
			if 'bin/bash' in pre_content:
				pre['class'] = ['bash']
			elif '<?php' in pre_content or 'class ' in pre_content or '$' in pre_content:
				pre['class'] = ['php']
			elif '<' in pre_content:
				pre['class'] = ['html']
			elif 'var ' in pre_content:
				pre['class'] = ['javascript']
			else:
				pre['class'] = ['text']
		for c in pre.children:
			if isinstance(c, NavigableString):
				c.replace_with(str(c).replace('\n\xa0', '\n').replace('\t', '    '))

	if (chunk := get_only_non_whitespace_child(content)) is not None and chunk['class'] == ['chunk']:
		content = chunk
	else:
		extra.append('chunky = true')

	html = content.decode_contents().strip()

	# Convert to Markdown.
	md = pypandoc.convert_text(
		html,
		format='html',
		to='commonmark',
		extra_args= [
			'--standalone',
			'--tab-stop=4',
			'--wrap=none',
		],
	)

	# Restore abbr tags.
	md = ABBR_REGEX.sub(lambda match: f'<abbr title="{match["title"]}">{match["body"]}</abbr>', md)
	# Pandoc inserts pointless class attributes.
	md = TR_REGEX.sub('<tr>', md)

	# Add front matter.
	title_escaped = title.replace('"', '\\"')
	front_matter =[
		'+++',
		f'title = "{title_escaped}"',
		*([f'date = {date}'] if date is not None else []),
		*(['', '[extra]'] + extra if len(extra) > 0 else []),
		'+++',
	]
	md = '\n'.join(front_matter) + '\n' + md

	# Pretty print.
	md = subprocess.check_output(
		[
			'prettier',
			'--embedded-language-formatting=off',
			'--prose-wrap=never',
			'--tab-width=2',
			'--print-width=9999',
			f'--stdin-filepath={md_path}',
		],
		encoding='utf-8',
		input=md,
	)

	# html_path.unlink()
	md_path.write_text(md)

	print(f'Done {md_path}', file=sys.stderr)


async def main():
	pages = iglob('docs/content/**/*.html', recursive=True)
	# pages = [
	# 	'docs/content/index.html',
	# 	'docs/content/blog/2008-01-31-welcome-steve-minutillo.html',
	# ]
	await asyncio.gather(*(markdownify(Path(page)) for page in pages))

if __name__ == '__main__':
	asyncio.run(main())

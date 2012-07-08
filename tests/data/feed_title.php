<?php
/**
 * SimplePie 1.2 PHPUnit Testsuite
 *
 * PHP Version 5.2
 *
 * @license <http://www.spdx.org/licenses/LGPL-2.1+> GNU Lesser General Public License v2.1 or later
 * @copyright Copyright © 2007, Geoffrey Sneddon
 * @copyright Copyright © 2012, hakre <http://hakre.wordpress.com/>
 */

return array(
	// feed_title/...
	array('<rss version="2.0">
	<channel>
		<title>AT&#x26;T</title>
	</channel>
</rss>', 'AT&amp;T'), // rss-profile\1.php
	array('<rss version="2.0">
	<channel>
		<title>Bill &#x26; Ted\'s Excellent Adventure</title>
	</channel>
</rss>', 'Bill &amp; Ted\'s Excellent Adventure'), // rss-profile\2.php
	array('<rss version="2.0">
	<channel>
		<title>The &#x26;amp; entity</title>
	</channel>
</rss>', 'The &amp;amp; entity'), // rss-profile\3.php
	array('<rss version="2.0">
	<channel>
		<title>I &#x3C;3 Phil Ringnalda</title>
	</channel>
</rss>', 'I &lt;3 Phil Ringnalda'), // rss-profile\4.php
	array('<rss version="2.0">
	<channel>
		<title>A &#x3C; B</title>
	</channel>
</rss>', 'A &lt; B'), // rss-profile\5.php
	array('<rss version="2.0">
	<channel>
		<title>A&#x3C;B</title>
	</channel>
</rss>', 'A&lt;B'), // rss-profile\6.php
	array('<rss version="2.0">
	<channel>
		<title>Nice &#x3C;gorilla&#x3E; what\'s he weigh?</title>
	</channel>
</rss>', 'Nice &lt;gorilla&gt; what\'s he weigh?'), // rss-profile\7.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:title>Feed Title</dc:title>
</feed>', 'Feed Title'), // SPtests\atom\0.3\dc\1.0\title.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:title>Feed Title</dc:title>
</feed>', 'Feed Title'), // SPtests\atom\0.3\dc\1.1\title.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<title>Feed Title</title>
</feed>', 'Feed Title'), // SPtests\atom\0.3\title.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:title>Feed Title</dc:title>
</feed>', 'Feed Title'), // SPtests\atom\1.0\dc\1.0\title.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:title>Feed Title</dc:title>
</feed>', 'Feed Title'), // SPtests\atom\1.0\dc\1.1\title.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Feed Title</title>
</feed>', 'Feed Title'), // SPtests\atom\1.0\title.php
	array('<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN"
"http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<title>Feed with DOCTYPE</title>
	</channel>
</rss>', 'Feed with DOCTYPE'), // SPtests\bugs\16.0.php
	array('<?xml version = "1.0" encoding = "UTF-8" ?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Spaces in prolog</title>
</feed>', 'Spaces in prolog'), // SPtests\bugs\174.0.php
	array('<rss version="2.0">
	<channel>
		<title>Channel title</title>
		<image>
			<title>Image title</title>
		</image>
	</channel>
</rss>', 'Channel title'), // SPtests\bugs\18.0.php
	array('<rss version="2.0">
	<channel>
		<image>
			<title>Image title</title>
		</image>
		<title>Channel title</title>
	</channel>
</rss>', 'Channel title'), // SPtests\bugs\18.1.php
	array('<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title>Non-default namespace</a:title>
</a:feed>', 'Non-default namespace'), // SPtests\bugs\20.0.php
	array('<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title type="xhtml"><div>Non-default namespace</div></a:title>
</a:feed>', 'Non-default namespace'), // SPtests\bugs\20.1.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:h="http://www.w3.org/1999/xhtml">
	<title type="xhtml"><h:div>Non-default namespace</h:div></title>
</feed>', 'Non-default namespace'), // SPtests\bugs\20.2.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Ampersand: <![CDATA[&]]></title>
</feed>', 'Ampersand: &amp;'), // SPtests\bugs\272.0.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<title><![CDATA[&]]>: Ampersand</title>
</feed>', '&amp;: Ampersand'), // SPtests\bugs\272.1.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\0.90\atom\0.3\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\0.90\atom\1.0\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\0.90\dc\1.0\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\0.90\dc\1.1\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<title>Feed Title</title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\0.90\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-netscape\atom\0.3\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-netscape\atom\1.0\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-netscape\dc\1.0\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-netscape\dc\1.1\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-netscape\title.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-userland\atom\0.3\title.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-userland\atom\1.0\title.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-userland\dc\1.0\title.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-userland\dc\1.1\title.php
	array('<rss version="0.91">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.91-userland\title.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.92\atom\0.3\title.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.92\atom\1.0\title.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.92\dc\1.0\title.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.92\dc\1.1\title.php
	array('<rss version="0.92">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\0.92\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\1.0\atom\0.3\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\1.0\atom\1.0\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\1.0\dc\1.0\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\1.0\dc\1.1\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<title>Feed Title</title>
	</channel>
</rdf:RDF>', 'Feed Title'), // SPtests\rss\1.0\title.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\2.0\atom\0.3\title.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\2.0\atom\1.0\title.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\2.0\dc\1.0\title.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\2.0\dc\1.1\title.php
	array('<rss version="2.0">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>', 'Feed Title'), // SPtests\rss\2.0\title.php
);

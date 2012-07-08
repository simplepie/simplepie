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
	// first_item_category_label/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>', 'Item Category'), // SPtests\atom\0.3\dc\1.0\subject.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>', 'Item Category'), // SPtests\atom\0.3\dc\1.1\subject.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>', 'Item Category'), // SPtests\atom\1.0\dc\1.0\subject.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>', 'Item Category'), // SPtests\atom\1.0\dc\1.1\subject.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<category label="Item Category"/>
	</entry>
</feed>', 'Item Category'), // SPtests\atom\1.0\label.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<category term="Item Category"/>
	</entry>
</feed>', 'Item Category'), // SPtests\atom\1.0\term.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<category term="Example category"/>
	</entry>
</feed>', 'Example category'), // SPtests\bugs\21.0.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category label="Item Category"/>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\0.90\atom\1.0\label.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category term="Item Category"/>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\0.90\atom\1.0\term.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\0.90\dc\1.0\subject.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\0.90\dc\1.1\subject.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-netscape\atom\1.0\label.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-netscape\atom\1.0\term.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-netscape\dc\1.0\subject.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-netscape\dc\1.1\subject.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-userland\atom\1.0\label.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-userland\atom\1.0\term.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-userland\dc\1.0\subject.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.91-userland\dc\1.1\subject.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.92\atom\1.0\label.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.92\atom\1.0\term.php
	array('<rss version="0.92">
	<channel>
		<item>
			<category>Item Category</category>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.92\category.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.92\dc\1.0\subject.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\0.92\dc\1.1\subject.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category label="Item Category"/>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\1.0\atom\1.0\label.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category term="Item Category"/>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\1.0\atom\1.0\term.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\1.0\dc\1.0\subject.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>', 'Item Category'), // SPtests\rss\1.0\dc\1.1\subject.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\2.0\atom\1.0\label.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\2.0\atom\1.0\term.php
	array('<rss version="2.0">
	<channel>
		<item>
			<category>Item Category</category>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\2.0\category.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\2.0\dc\1.0\subject.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>', 'Item Category'), // SPtests\rss\2.0\dc\1.1\subject.php
);

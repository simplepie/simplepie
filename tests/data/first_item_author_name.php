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
	// first_item_author_name/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\0.3\dc\1.0\creator.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\0.3\dc\1.1\creator.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\0.3\feed.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<author>
			<name>Item Author</name>
		</author>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\0.3\name.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\1.0\dc\1.0\creator.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\1.0\dc\1.1\creator.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\1.0\feed.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<author>
			<name>Item Author</name>
		</author>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\1.0\name.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<source>
			<author>
				<name>Item Author</name>
			</author>
		</source>
	</entry>
</feed>', 'Item Author'), // SPtests\atom\1.0\source.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\0.90\atom\0.3\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\0.90\atom\1.0\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\0.90\dc\1.0\creator.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\0.90\dc\1.1\creator.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-netscape\atom\0.3\name.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-netscape\atom\1.0\name.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-netscape\dc\1.0\creator.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-netscape\dc\1.1\creator.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-userland\atom\0.3\name.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-userland\atom\1.0\name.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-userland\dc\1.0\creator.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.91-userland\dc\1.1\creator.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.92\atom\0.3\name.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.92\atom\1.0\name.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.92\dc\1.0\creator.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\0.92\dc\1.1\creator.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\1.0\atom\0.3\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\1.0\atom\1.0\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\1.0\dc\1.0\creator.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>', 'Item Author'), // SPtests\rss\1.0\dc\1.1\creator.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\2.0\atom\0.3\name.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\2.0\atom\1.0\name.php
	array('<rss version="2.0">
	<channel>
		<item>
			<author>example@example.com (Item Author)</author>
		</item>
	</channel>
</rss>', NULL), // SPtests\rss\2.0\author.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\2.0\dc\1.0\creator.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>', 'Item Author'), // SPtests\rss\2.0\dc\1.1\creator.php
);

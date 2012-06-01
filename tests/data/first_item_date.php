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
	// first_item_date/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<created>2007-01-11T16:00:00Z</created>
	</entry>
</feed>', 1168531200), // SPtests\atom\0.3\created.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</entry>
</feed>', 1168531200), // SPtests\atom\0.3\dc\1.0\date.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</entry>
</feed>', 1168531200), // SPtests\atom\0.3\dc\1.1\date.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<issued>2007-01-11T16:00:00Z</issued>
	</entry>
</feed>', 1168531200), // SPtests\atom\0.3\issued.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<modified>2007-01-11T16:00:00Z</modified>
	</entry>
</feed>', 1168531200), // SPtests\atom\0.3\modified.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</entry>
</feed>', 1168531200), // SPtests\atom\1.0\dc\1.0\date.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</entry>
</feed>', 1168531200), // SPtests\atom\1.0\dc\1.1\date.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<published>2007-01-11T16:00:00Z</published>
	</entry>
</feed>', 1168531200), // SPtests\atom\1.0\published.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<updated>2007-01-11T16:00:00Z</updated>
	</entry>
</feed>', 1168531200), // SPtests\atom\1.0\updated.php
	array('<rss version="2.0">
	<channel>
		<item>
			<pubDate></pubDate>
		</item>
	</channel>
</rss>', NULL), // SPtests\bugs\876.0.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:created>2007-01-11T16:00:00Z</a:created>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\atom\0.3\created.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:issued>2007-01-11T16:00:00Z</a:issued>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\atom\0.3\issued.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:modified>2007-01-11T16:00:00Z</a:modified>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\atom\0.3\modified.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:published>2007-01-11T16:00:00Z</a:published>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\atom\1.0\published.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:updated>2007-01-11T16:00:00Z</a:updated>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\atom\1.0\updated.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\dc\1.0\date.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\0.90\dc\1.1\date.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:created>2007-01-11T16:00:00Z</a:created>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\atom\0.3\created.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:issued>2007-01-11T16:00:00Z</a:issued>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\atom\0.3\issued.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:modified>2007-01-11T16:00:00Z</a:modified>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\atom\0.3\modified.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:published>2007-01-11T16:00:00Z</a:published>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\atom\1.0\published.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:updated>2007-01-11T16:00:00Z</a:updated>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\atom\1.0\updated.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\dc\1.0\date.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-netscape\dc\1.1\date.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:created>2007-01-11T16:00:00Z</a:created>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\atom\0.3\created.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:issued>2007-01-11T16:00:00Z</a:issued>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\atom\0.3\issued.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:modified>2007-01-11T16:00:00Z</a:modified>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\atom\0.3\modified.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:published>2007-01-11T16:00:00Z</a:published>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\atom\1.0\published.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:updated>2007-01-11T16:00:00Z</a:updated>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\atom\1.0\updated.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\dc\1.0\date.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.91-userland\dc\1.1\date.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:created>2007-01-11T16:00:00Z</a:created>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\atom\0.3\created.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:issued>2007-01-11T16:00:00Z</a:issued>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\atom\0.3\issued.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:modified>2007-01-11T16:00:00Z</a:modified>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\atom\0.3\modified.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:published>2007-01-11T16:00:00Z</a:published>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\atom\1.0\published.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:updated>2007-01-11T16:00:00Z</a:updated>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\atom\1.0\updated.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\dc\1.0\date.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\0.92\dc\1.1\date.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:created>2007-01-11T16:00:00Z</a:created>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\atom\0.3\created.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:issued>2007-01-11T16:00:00Z</a:issued>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\atom\0.3\issued.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:modified>2007-01-11T16:00:00Z</a:modified>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\atom\0.3\modified.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:published>2007-01-11T16:00:00Z</a:published>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\atom\1.0\published.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:updated>2007-01-11T16:00:00Z</a:updated>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\atom\1.0\updated.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\dc\1.0\date.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:date>2007-01-11T16:00:00Z</dc:date>
	</item>
</rdf:RDF>', 1168531200), // SPtests\rss\1.0\dc\1.1\date.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:created>2007-01-11T16:00:00Z</a:created>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\atom\0.3\created.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:issued>2007-01-11T16:00:00Z</a:issued>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\atom\0.3\issued.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:modified>2007-01-11T16:00:00Z</a:modified>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\atom\0.3\modified.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:published>2007-01-11T16:00:00Z</a:published>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\atom\1.0\published.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:updated>2007-01-11T16:00:00Z</a:updated>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\atom\1.0\updated.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\dc\1.0\date.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:date>2007-01-11T16:00:00Z</dc:date>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\dc\1.1\date.php
	array('<rss version="2.0">
	<channel>
		<item>
			<pubDate>2007-01-11T16:00:00Z</pubDate>
		</item>
	</channel>
</rss>', 1168531200), // SPtests\rss\2.0\pubdate.php
);

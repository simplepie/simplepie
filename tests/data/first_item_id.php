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
	// first_item_id/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:identifier>http://example.com/</dc:identifier>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\dc\1.0\identifier.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:identifier>http://example.com/</dc:identifier>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\dc\1.1\identifier.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<id>http://example.com/</id>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\id.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:identifier>http://example.com/</dc:identifier>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\dc\1.0\identifier.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:identifier>http://example.com/</dc:identifier>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\dc\1.1\identifier.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<id>http://example.com/</id>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\id.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:id>http://example.com/</a:id>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\0.3\id.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:id>http://example.com/</a:id>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\1.0\id.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:identifier>http://example.com/</dc:identifier>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\dc\1.0\identifier.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:identifier>http://example.com/</dc:identifier>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\dc\1.1\identifier.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\0.3\id.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\1.0\id.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\dc\1.0\identifier.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\dc\1.1\identifier.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom\0.3\id.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom\1.0\id.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\dc\1.0\identifier.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\dc\1.1\identifier.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\0.3\id.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\1.0\id.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\dc\1.0\identifier.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\dc\1.1\identifier.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:id>http://example.com/</a:id>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\0.3\id.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:id>http://example.com/</a:id>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\1.0\id.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:identifier>http://example.com/</dc:identifier>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\dc\1.0\identifier.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:identifier>http://example.com/</dc:identifier>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\dc\1.1\identifier.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\0.3\id.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\1.0\id.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\dc\1.0\identifier.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:identifier>http://example.com/</dc:identifier>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\dc\1.1\identifier.php
	array('<rss version="2.0">
	<channel>
		<item>
			<guid>http://example.com/</guid>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\guid.php
);

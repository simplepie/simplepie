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
	// first_item_permalink/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<link href="http://example.com/" rel="enclosure"/>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\enclosure.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<link href="http://example.com/"/>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\link.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<link href="http://example.com/" rel="enclosure"/>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\enclosure.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<link href="http://example.com/"/>
	</entry>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\link.php
	array('<rss version="2.0">
	<channel>
		<item>
			<guid>http://example.com/</guid>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\bugs\10.0.php
	array('<rss version="2.0">
	<channel>
		<item>
			<guid isPermaLink="true">http://example.com/</guid>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\bugs\10.1.php
	array('<rss version="2.0">
	<channel>
		<item>
			<guid isPermaLink="meep">http://example.com/</guid>
		</item>
	</channel>
</rss>', NULL), // SPtests\bugs\10.2.php
	array('<rss version="2.0">
	<channel>
		<item>
			<guid isPermaLink="false">http://example.com/</guid>
		</item>
	</channel>
</rss>', NULL), // SPtests\bugs\10.3.php
	array('<rss version="2.0">
	<channel>
		<item>
			<enclosure url="http://example.com/" length="1" type="audio/mpeg"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\bugs\156.0.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<link rel="related" href="http://example.com/related"/>
		<link rel="via" href="http://example.com/via"/>
		<link rel="alternate" href="http://example.com/alternate"/>
	</entry>
</feed>', 'http://example.com/alternate'), // SPtests\bugs\176.0.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<link rel="alternate" href="http://example.com/alternate"/>
		<link rel="related" href="http://example.com/related"/>
		<link rel="via" href="http://example.com/via"/>
	</entry>
</feed>', 'http://example.com/alternate'), // SPtests\bugs\176.1.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<link rel="related" href="http://example.com/related"/>
		<link rel="alternate" href="http://example.com/alternate"/>
		<link rel="via" href="http://example.com/via"/>
	</entry>
</feed>', 'http://example.com/alternate'), // SPtests\bugs\176.2.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xml:base="http://example.com/" >
	<entry>
		<link href=""/>
	</entry>
</feed>', 'http://example.com/'), // SPtests\bugs\640.0.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:link href="http://example.com/"/>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\0.3\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:link href="http://example.com/"/>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\1.0\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<item>
		<link>http://example.com/</link>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\0.3\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\1.0\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\link.php
	array('<rss version="0.91">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\0.91-userland.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/" rel="enclosure"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom0.3-enclosure.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom0.3.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:link href="http://example.com/" rel="enclosure"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom1.0-enclosure.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom1.0.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\0.3\link.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\1.0\link.php
	array('<rss version="0.92">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:link href="http://example.com/"/>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\0.3\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:link href="http://example.com/"/>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\1.0\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<item>
		<link>http://example.com/</link>
	</item>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\link.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\0.3\link.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\1.0\link.php
	array('<rss version="2.0">
	<channel>
		<item>
			<enclosure url="http://example.com/" length="1" type="text/html"/>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\enclosure.php
	array('<rss version="2.0">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\link.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xml:base="http://example.com/">
	<entry>
		<link rel="alternate" href="/alternate"/>
	</entry>
</feed>', 'http://example.com/alternate'), // SPtests\xmlbase\1.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry xml:base="http://example.com/">
		<link rel="alternate" href="/alternate"/>
	</entry>
</feed>', 'http://example.com/alternate'), // SPtests\xmlbase\2.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xml:base="http://example.org/">
	<entry>
		<link rel="alternate" href="//example.com/alternate"/>
	</entry>
</feed>', 'http://example.com/alternate'), // SPtests\xmlbase\3.php
);

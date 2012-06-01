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
	// feed_link/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<link href="http://example.com/"/>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\link.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<link href="http://example.com/" rel="alternate"/>
</feed>', 'http://example.com/'), // SPtests\atom\0.3\link_@rel_alternate.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/"/>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\link.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/" rel="http://www.iana.org/assignments/relation/alternate"/>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\link_@rel_absolute_iri.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/" rel="alternate"/>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\link_@rel_alternate.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\0.3\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\1.0\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\0.3\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\1.0\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\link.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom\0.3\link.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom\1.0\link.php
	array('<rss version="0.91">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\link.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\0.3\link.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\1.0\link.php
	array('<rss version="0.92">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\0.3\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\1.0\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\link.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\0.3\link.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\1.0\link.php
	array('<rss version="2.0">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\link.php
);

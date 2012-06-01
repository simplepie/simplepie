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
	// first_item_latitude/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<entry>
		<geo:lat>55.701</geo:lat>
		<geo:long>12.552</geo:long>
	</entry>
</feed>', 55.701), // SPtests\atom\0.3\geo\lat.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:georss="http://www.georss.org/georss">
	<entry>
		<georss:point>55.701 12.552</georss:point>
	</entry>
</feed>', 55.701), // SPtests\atom\0.3\georss\point.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<entry>
		<geo:lat>55.701</geo:lat>
		<geo:long>12.552</geo:long>
	</entry>
</feed>', 55.701), // SPtests\atom\1.0\geo\lat.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss">
	<entry>
		<georss:point>55.701 12.552</georss:point>
	</entry>
</feed>', 55.701), // SPtests\atom\1.0\georss\point.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<item>
		<geo:lat>55.701</geo:lat>
		<geo:long>12.552</geo:long>
	</item>
</rdf:RDF>', 55.701), // SPtests\rss\0.90\geo\lat.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:georss="http://www.georss.org/georss">
	<item>
		<georss:point>55.701 12.552</georss:point>
	</item>
</rdf:RDF>', 55.701), // SPtests\rss\0.90\georss\point.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<channel>
		<item>
			<geo:lat>55.701</geo:lat>
			<geo:long>12.552</geo:long>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\0.91-netscape\geo\lat.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:georss="http://www.georss.org/georss">
	<channel>
		<item>
			<georss:point>55.701 12.552</georss:point>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\0.91-netscape\georss\point.php
	array('<rss version="0.91" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<channel>
		<item>
			<geo:lat>55.701</geo:lat>
			<geo:long>12.552</geo:long>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\0.91-userland\geo\lat.php
	array('<rss version="0.91" xmlns:georss="http://www.georss.org/georss">
	<channel>
		<item>
			<georss:point>55.701 12.552</georss:point>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\0.91-userland\georss\point.php
	array('<rss version="0.92" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<channel>
		<item>
			<geo:lat>55.701</geo:lat>
			<geo:long>12.552</geo:long>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\0.92\geo\lat.php
	array('<rss version="0.92" xmlns:georss="http://www.georss.org/georss">
	<channel>
		<item>
			<georss:point>55.701 12.552</georss:point>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\0.92\georss\point.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<item>
		<geo:lat>55.701</geo:lat>
		<geo:long>12.552</geo:long>
	</item>
</rdf:RDF>', 55.701), // SPtests\rss\1.0\geo\lat.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:georss="http://www.georss.org/georss">
	<item>
		<georss:point>55.701 12.552</georss:point>
	</item>
</rdf:RDF>', 55.701), // SPtests\rss\1.0\georss\point.php
	array('<rss version="2.0" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
	<channel>
		<item>
			<geo:lat>55.701</geo:lat>
			<geo:long>12.552</geo:long>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\2.0\geo\lat.php
	array('<rss version="2.0" xmlns:georss="http://www.georss.org/georss">
	<channel>
		<item>
			<georss:point>55.701 12.552</georss:point>
		</item>
	</channel>
</rss>', 55.701), // SPtests\rss\2.0\georss\point.php
);

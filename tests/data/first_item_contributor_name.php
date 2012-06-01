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
	// first_item_contributor_name/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<contributor>
			<name>Item Contributor</name>
		</contributor>
	</entry>
</feed>', 'Item Contributor'), // SPtests\atom\0.3\name.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<contributor>
			<name>Item Contributor</name>
		</contributor>
	</entry>
</feed>', 'Item Contributor'), // SPtests\atom\1.0\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>', 'Item Contributor'), // SPtests\rss\0.90\atom\0.3\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>', 'Item Contributor'), // SPtests\rss\0.90\atom\1.0\name.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\0.91-netscape\atom\0.3\name.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\0.91-netscape\atom\1.0\name.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\0.91-userland\atom\0.3\name.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\0.91-userland\atom\1.0\name.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\0.92\atom\0.3\name.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\0.92\atom\1.0\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>', 'Item Contributor'), // SPtests\rss\1.0\atom\0.3\name.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>', 'Item Contributor'), // SPtests\rss\1.0\atom\1.0\name.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\2.0\atom\0.3\name.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>', 'Item Contributor'), // SPtests\rss\2.0\atom\1.0\name.php
);

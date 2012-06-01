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
	// feed_image_link/...
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<link>http://example.com/</link>
	</image>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\link.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\link.php
	array('<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\link.php
	array('<rss version="0.92">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\link.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<link>http://example.com/</link>
	</image>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\link.php
	array('<rss version="2.0">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\link.php
);

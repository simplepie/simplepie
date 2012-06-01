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
	// feed_image_url/...
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\icon.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>', 'http://example.com/'), // SPtests\atom\1.0\logo.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\1.0\icon.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\atom\1.0\logo.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\0.90\url.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\1.0\icon.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\atom\1.0\logo.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-netscape\url.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom\1.0\icon.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\atom\1.0\logo.php
	array('<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.91-userland\url.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\1.0\icon.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\atom\1.0\logo.php
	array('<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\0.92\url.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\1.0\icon.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\atom\1.0\logo.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>', 'http://example.com/'), // SPtests\rss\1.0\url.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\1.0\icon.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\atom\1.0\logo.php
	array('<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>', 'http://example.com/'), // SPtests\rss\2.0\url.php
);

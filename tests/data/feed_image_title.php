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
	// feed_image_title/...
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>', 'Image Title'), // SPtests\rss\0.90\dc\1.0\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>', 'Image Title'), // SPtests\rss\0.90\dc\1.1\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<title>Image Title</title>
	</image>
</rdf:RDF>', 'Image Title'), // SPtests\rss\0.90\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.91-netscape\dc\1.0\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.91-netscape\dc\1.1\title.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.91-netscape\title.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.91-userland\dc\1.0\title.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.91-userland\dc\1.1\title.php
	array('<rss version="0.91">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.91-userland\title.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.92\dc\1.0\title.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.92\dc\1.1\title.php
	array('<rss version="0.92">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\0.92\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>', 'Image Title'), // SPtests\rss\1.0\dc\1.0\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>', 'Image Title'), // SPtests\rss\1.0\dc\1.1\title.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<title>Image Title</title>
	</image>
</rdf:RDF>', 'Image Title'), // SPtests\rss\1.0\title.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\2.0\dc\1.0\title.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\2.0\dc\1.1\title.php
	array('<rss version="2.0">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>', 'Image Title'), // SPtests\rss\2.0\title.php
);

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
	// feed_description/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:description>Feed Description</dc:description>
</feed>', 'Feed Description'), // SPtests\atom\0.3\dc\1.0\description.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:description>Feed Description</dc:description>
</feed>', 'Feed Description'), // SPtests\atom\0.3\dc\1.1\description.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<tagline>Feed Description</tagline>
</feed>', 'Feed Description'), // SPtests\atom\0.3\tagline.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:description>Feed Description</dc:description>
</feed>', 'Feed Description'), // SPtests\atom\1.0\dc\1.0\description.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:description>Feed Description</dc:description>
</feed>', 'Feed Description'), // SPtests\atom\1.0\dc\1.1\description.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<subtitle>Feed Description</subtitle>
</feed>', 'Feed Description'), // SPtests\atom\1.0\subtitle.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\0.90\atom\0.3\tagline.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\0.90\atom\1.0\subtitle.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\0.90\dc\1.0\description.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\0.90\dc\1.1\description.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<description>Feed Description</description>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\0.90\description.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-netscape\atom\0.3\tagline.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-netscape\atom\1.0\subtitle.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-netscape\dc\1.0\description.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-netscape\dc\1.1\description.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-netscape\description.php
	array('<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-userland\atom\0.3\tagline.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-userland\atom\1.0\subtitle.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-userland\dc\1.0\description.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-userland\dc\1.1\description.php
	array('<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.91-userland\description.php
	array('<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.92\atom\0.3\tagline.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.92\atom\1.0\subtitle.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.92\dc\1.0\description.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.92\dc\1.1\description.php
	array('<rss version="0.92">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\0.92\description.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\1.0\atom\0.3\tagline.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\1.0\atom\1.0\subtitle.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\1.0\dc\1.0\description.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\1.0\dc\1.1\description.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<description>Feed Description</description>
	</channel>
</rdf:RDF>', 'Feed Description'), // SPtests\rss\1.0\description.php
	array('<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\2.0\atom\0.3\tagline.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\2.0\atom\1.0\subtitle.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\2.0\dc\1.0\description.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\2.0\dc\1.1\description.php
	array('<rss version="2.0">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>', 'Feed Description'), // SPtests\rss\2.0\description.php
);
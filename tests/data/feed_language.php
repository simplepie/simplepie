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
	// feed_language/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:language>en-GB</dc:language>
</feed>', 'en-GB'), // SPtests\atom\0.3\dc\1.0\language.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:language>en-GB</dc:language>
</feed>', 'en-GB'), // SPtests\atom\0.3\dc\1.1\language.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xml:lang="en-GB">
	<title>Feed Title</title>
</feed>', 'en-GB'), // SPtests\atom\0.3\xml_lang.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:language>en-GB</dc:language>
</feed>', 'en-GB'), // SPtests\atom\1.0\dc\1.0\language.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:language>en-GB</dc:language>
</feed>', 'en-GB'), // SPtests\atom\1.0\dc\1.1\language.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-GB">
	<title>Feed Title</title>
</feed>', 'en-GB'), // SPtests\atom\1.0\xml_lang.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>', 'en-GB'), // SPtests\rss\0.90\dc\1.0\language.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>', 'en-GB'), // SPtests\rss\0.90\dc\1.1\language.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.91-netscape\dc\1.0\language.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.91-netscape\dc\1.1\language.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.91-netscape\language.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.91-userland\dc\1.0\language.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.91-userland\dc\1.1\language.php
	array('<rss version="0.91">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.91-userland\language.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.92\dc\1.0\language.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.92\dc\1.1\language.php
	array('<rss version="0.92">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\0.92\language.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>', 'en-GB'), // SPtests\rss\1.0\dc\1.0\language.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>', 'en-GB'), // SPtests\rss\1.0\dc\1.1\language.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\2.0\dc\1.0\language.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\2.0\dc\1.1\language.php
	array('<rss version="2.0">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>', 'en-GB'), // SPtests\rss\2.0\language.php
);

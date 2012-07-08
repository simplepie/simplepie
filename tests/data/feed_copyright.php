<?php
	/**
	 * SimplePie 1.2 PHPUnit Testsuite
	 *
	 * PHP Version 5.2
	 */

return array(
	// feed_copyright/...
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>', 'Example Copyright Information'), // SPtests\atom\0.3\dc\1.0\rights.php
	array('<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>', 'Example Copyright Information'), // SPtests\atom\0.3\dc\1.1\rights.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>', 'Example Copyright Information'), // SPtests\atom\1.0\dc\1.0\rights.php
	array('<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>', 'Example Copyright Information'), // SPtests\atom\1.0\dc\1.1\rights.php
	array('<feed xmlns="http://www.w3.org/2005/Atom">
	<rights>Example Copyright Information</rights>
</feed>', 'Example Copyright Information'), // SPtests\atom\1.0\rights.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rdf:RDF>', 'Example Copyright Information'), // SPtests\rss\0.90\atom\1.0\rights.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>', 'Example Copyright Information'), // SPtests\rss\0.90\dc\1.0\rights.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>', 'Example Copyright Information'), // SPtests\rss\0.90\dc\1.1\rights.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-netscape\atom\1.0\rights.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-netscape\copyright.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-netscape\dc\1.0\rights.php
	array('<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-netscape\dc\1.1\rights.php
	array('<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-userland\atom\1.0\rights.php
	array('<rss version="0.91">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-userland\copyright.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-userland\dc\1.0\rights.php
	array('<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.91-userland\dc\1.1\rights.php
	array('<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.92\atom\1.0\rights.php
	array('<rss version="0.92">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.92\copyright.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.92\dc\1.0\rights.php
	array('<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\0.92\dc\1.1\rights.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rdf:RDF>', 'Example Copyright Information'), // SPtests\rss\1.0\atom\1.0\rights.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>', 'Example Copyright Information'), // SPtests\rss\1.0\dc\1.0\rights.php
	array('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>', 'Example Copyright Information'), // SPtests\rss\1.0\dc\1.1\rights.php
	array('<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\2.0\atom\1.0\rights.php
	array('<rss version="2.0">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\2.0\copyright.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\2.0\dc\1.0\rights.php
	array('<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>', 'Example Copyright Information'), // SPtests\rss\2.0\dc\1.1\rights.php
);
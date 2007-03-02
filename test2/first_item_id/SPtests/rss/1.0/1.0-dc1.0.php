<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:identifier>http://example.com/</dc:identifier>
	</item>
</rdf:RDF>
EOD;

$expected = 'http://example.com/';

?>
<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:link href="http://example.com/"/>
	</item>
</rdf:RDF>
EOD;

$expected = 'http://example.com/';

?>
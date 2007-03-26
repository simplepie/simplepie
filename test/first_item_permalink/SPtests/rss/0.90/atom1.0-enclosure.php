<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:link href="http://example.com/" rel="enclosure"/>
	</item>
</rdf:RDF>
EOD;

$expected = 'http://example.com/';

?>
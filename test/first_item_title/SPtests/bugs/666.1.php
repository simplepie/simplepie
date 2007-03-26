<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<title>Feed Title</title>
	</channel>
	<item>
		<title>Item Title</title>
	</item>
</rdf:RDF>
EOD;

$expected = 'Item Title';

?>
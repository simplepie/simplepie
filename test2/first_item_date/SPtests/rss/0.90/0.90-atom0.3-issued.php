<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:issued>2007-01-11T16:00:00Z</a:issued>
	</item>
</rdf:RDF>
EOD;

$expected = 1168531200;

?>
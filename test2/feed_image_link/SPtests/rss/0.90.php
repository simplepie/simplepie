<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rdf:RDF>
EOD;

$expected = 'http://example.com/';

?>
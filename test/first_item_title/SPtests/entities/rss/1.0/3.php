<?php

$data = <<<EOD
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<item>
		<title>This <![CDATA[&amp;]]>amp; this</title>
	</item>
</rdf:RDF>
EOD;

$expected = 'This &amp;amp;amp; this';

?>
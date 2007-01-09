<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:identifier>http://example.com/</dc:identifier>
	</entry>
</feed>
EOD;

$expected = 'http://example.com/';

?>
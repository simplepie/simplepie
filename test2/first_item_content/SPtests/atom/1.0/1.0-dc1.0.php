<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:description>Item Description</dc:description>
	</entry>
</feed>
EOD;

$expected = 'Item Description';

?>
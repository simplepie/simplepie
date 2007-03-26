<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:description>Item Description</dc:description>
	</entry>
</feed>
EOD;

$expected = 'Item Description';

?>
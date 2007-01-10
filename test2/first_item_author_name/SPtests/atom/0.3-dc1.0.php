<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
EOD;

$expected = 'Item Author';

?>
<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:identifier>http://example.com/</dc:identifier>
	</entry>
</feed>
EOD;

$expected = 'http://example.com/';

?>
<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<link href="http://example.com/"/>
	</entry>
</feed>
EOD;

$expected = 'http://example.com/';

?>
<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>
EOD;

$expected = 'Item Author';

?>
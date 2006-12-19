<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title>Item Title</title>
		<source>
			<title>Source Title</title>
		</source>
	</entry>
</feed>
EOD;

$expected = 'Item Title';

?>
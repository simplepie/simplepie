<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<x:foo xmlns:x="urn:foo">
			<title>Extension Title</title>
		</x>
		<title>Item Title</title>
	</entry>
</feed>
EOD;

$expected = 'Item Title';

?>
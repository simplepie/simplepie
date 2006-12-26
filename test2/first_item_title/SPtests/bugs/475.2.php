<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title>Item Title</title>
		<x:foo xmlns:x="urn:foo">
			<title>Extension Title</title>
		</x:foo>
	</entry>
</feed>
EOD;

$expected = 'Item Title';

?>
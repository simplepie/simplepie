<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<x:foo xmlns:x="urn:foo">
		<entry>
			<title>Extension title</title>
		</entry>
	</x:foo>
	<entry>
		<title>Item title</title>
	</entry>
</feed>
EOD;

$expected = 'Item title';

?>
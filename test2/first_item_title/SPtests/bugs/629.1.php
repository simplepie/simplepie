<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title>Item title</title>
	</entry>
	<x:foo xmlns:x="urn:foo">
		<entry>
			<title>Extension title</title>
		</entry>
	</x:foo>
</feed>
EOD;

$expected = 'Item title';

?>
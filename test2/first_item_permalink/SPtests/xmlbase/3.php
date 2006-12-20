<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom" xml:base="http://example.org/">
	<entry>
		<link rel="alternate" href="//example.com/alternate" />
	</entry>
</feed>
EOD;

$expected = 'http://example.com/alternate';

?>
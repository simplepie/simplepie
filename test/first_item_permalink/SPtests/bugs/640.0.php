<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom" xml:base="http://example.com/" >
	<entry>
		<link href=""/>
	</entry>
</feed>
EOD;

$expected = 'http://example.com/';

?>
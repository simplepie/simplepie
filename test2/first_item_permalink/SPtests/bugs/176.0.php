<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<link rel="related" href="http://example.com/related" />
		<link rel="via" href="http://example.com/via" />
		<link rel="alternate" href="http://example.com/alternate" />
	</entry>
</feed>
EOD;

$expected = 'http://example.com/alternate';

?>
<?php

$data = <<<EOD
<html xmlns="http://www.w3.org/1999/xhtml" xml:base="http://example.com/">
	<head>
		<title>Test</title>
	</head>
	<body>
		<a:feed xmlns:a="http://www.w3.org/2005/Atom">
			<a:entry>
				<a:link href="/alternate" />
			</a:entry>
		</a:feed>
	</body>
</html>
EOD;

$expected = 'http://example.com/alternate';

?>
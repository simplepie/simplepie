<?php

$data = <<<EOD
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
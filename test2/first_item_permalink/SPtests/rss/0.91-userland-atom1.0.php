<?php

$data = <<<EOD
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
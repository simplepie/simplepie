<?php

$data = <<<EOD
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
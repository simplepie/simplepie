<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
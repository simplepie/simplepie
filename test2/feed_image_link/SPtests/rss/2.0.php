<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
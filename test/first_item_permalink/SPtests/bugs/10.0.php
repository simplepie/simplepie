<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<guid>http://example.com/</guid>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
<?php

$data = <<<EOD
<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
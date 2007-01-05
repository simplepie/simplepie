<?php

$data = <<<EOD
<rss version="0.91">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
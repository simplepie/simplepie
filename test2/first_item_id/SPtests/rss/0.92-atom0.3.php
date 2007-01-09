<?php

$data = <<<EOD
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
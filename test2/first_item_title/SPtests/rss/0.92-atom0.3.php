<?php

$data = <<<EOD
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:title>Item Title</a:title>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Title';

?>
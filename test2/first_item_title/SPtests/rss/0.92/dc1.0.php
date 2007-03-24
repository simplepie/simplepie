<?php

$data = <<<EOD
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:title>Item Title</dc:title>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Title';

?>
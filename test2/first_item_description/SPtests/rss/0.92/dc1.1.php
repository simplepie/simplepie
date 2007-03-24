<?php

$data = <<<EOD
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:description>Item Description</dc:description>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Description';

?>
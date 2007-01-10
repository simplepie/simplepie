<?php

$data = <<<EOD
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:description>Item Description</dc:description>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Description';

?>
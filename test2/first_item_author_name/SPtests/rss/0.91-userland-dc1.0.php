<?php

$data = <<<EOD
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Author';

?>
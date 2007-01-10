<?php

$data = <<<EOD
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Author';

?>
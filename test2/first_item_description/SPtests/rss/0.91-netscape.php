<?php

$data = <<<EOD
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<item>
			<description>Item Description</description>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Description';

?>
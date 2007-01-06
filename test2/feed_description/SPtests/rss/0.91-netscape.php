<?php

$data = <<<EOD
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
EOD;

$expected = 'Feed Description';

?>
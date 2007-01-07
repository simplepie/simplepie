<?php

$data = <<<EOD
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOD;

$expected = 'en-GB';

?>
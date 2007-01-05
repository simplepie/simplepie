<?php

$data = <<<EOD
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<item>
			<link>http://example.com/</link>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
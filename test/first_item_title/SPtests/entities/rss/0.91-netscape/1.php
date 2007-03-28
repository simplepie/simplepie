<?php

$data = <<<EOD
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<item>
			<title>This &amp;amp; this</title>
		</item>
	</channel>
</rss>
EOD;

$expected = 'This &amp;amp; this';

?>
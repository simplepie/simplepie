<?php

$data = <<<EOD
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:summary>Item Description</a:summary>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Description';

?>
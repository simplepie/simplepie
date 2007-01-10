<?php

$data = <<<EOD
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:summary>Item Description</a:summary>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Description';

?>
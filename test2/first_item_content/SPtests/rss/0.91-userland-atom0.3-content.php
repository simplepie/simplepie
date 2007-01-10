<?php

$data = <<<EOD
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:content>Item Description</a:content>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Description';

?>
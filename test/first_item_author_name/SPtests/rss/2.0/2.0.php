<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<author>example@example.com (Item Author)</author>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Author';

?>
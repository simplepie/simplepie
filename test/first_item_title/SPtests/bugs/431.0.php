<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<title>Item title</title>
			<image>
				<title>Image title</title>
			</image>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item title';

?>
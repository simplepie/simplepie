<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<image>
				<title>Image title</title>
			</image>
			<title>Item title</title>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item title';

?>
<?php

$data = <<<EOD
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>
EOD;

$expected = 'Item Category';

?>
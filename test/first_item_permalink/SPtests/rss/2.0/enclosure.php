<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<enclosure url="http://example.com/" length="1" type="text/html"/>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
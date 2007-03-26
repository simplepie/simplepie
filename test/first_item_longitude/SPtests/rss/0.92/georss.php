<?php

$data = <<<EOD
<rss version="0.92" xmlns:georss="http://www.georss.org/georss">
	<channel>
		<item>
			<georss:point>55.701 12.552</georss:point>
		</item>
	</channel>
</rss>
EOD;

$expected = 12.552;

?>
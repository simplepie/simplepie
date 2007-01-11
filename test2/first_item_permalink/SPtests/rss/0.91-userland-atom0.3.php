<?php

$data = <<<EOD
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/"/>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
<?php

$data = <<<EOD
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:link href="http://example.com/" rel="enclosure"/>
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
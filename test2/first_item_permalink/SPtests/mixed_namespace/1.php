<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<item>
			<a:link href="http://example.com/" xmlns:a="http://www.w3.org/2005/Atom" />
		</item>
	</channel>
</rss>
EOD;

$expected = 'http://example.com/';

?>
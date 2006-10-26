<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<title>The &#x26;amp; entity</title>
	</channel>
</rss>
EOD;

$expected = 'The &amp;amp; entity';

?>
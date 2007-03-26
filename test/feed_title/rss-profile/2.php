<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<title>Bill &#x26; Ted's Excellent Adventure</title>
	</channel>
</rss>
EOD;

$expected = 'Bill &amp; Ted\'s Excellent Adventure';

?>
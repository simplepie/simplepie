<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<title>A&#x3C;B</title>
	</channel>
</rss>
EOD;

$expected = 'A&lt;B';

?>
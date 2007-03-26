<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<title>I &#x3C;3 Phil Ringnalda</title>
	</channel>
</rss>
EOD;

$expected = 'I &lt;3 Phil Ringnalda';

?>
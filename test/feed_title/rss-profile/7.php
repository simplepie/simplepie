<?php

$data = <<<EOD
<rss version="2.0">
	<channel>
		<title>Nice &#x3C;gorilla&#x3E; what's he weigh?</title>
	</channel>
</rss>
EOD;

$expected = 'Nice &lt;gorilla&gt; what\'s he weigh?';

?>
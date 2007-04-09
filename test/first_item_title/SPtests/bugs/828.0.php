<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title>Item &lt;!-- Title</title>
	</entry>
</feed>
EOD;

$expected = 'Item &lt;!-- Title';

?>
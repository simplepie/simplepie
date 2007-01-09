<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title type="html">This &amp;amp; this</title>
	</entry>
</feed>
EOD;

$expected = 'This &amp; this';

?>
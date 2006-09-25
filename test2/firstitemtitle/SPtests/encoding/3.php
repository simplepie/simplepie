<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title type="xhtml"><div xmlns="http://www.w3.org/1999/xhtml">This &amp;amp; this</div></title>
	</entry>
</feed>
EOD;

$expected = 'This &amp;amp; this';

?>
<?php

$data = '
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title type="application/octet-stream">' . base64_encode('This &amp;amp; this') . '</title>
	</entry>
</feed>
';

$expected = 'This &amp;amp;amp; this';

?>
<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<content type="xhtml"><div xmlns="http://www.w3.org/1999/xhtml"><![CDATA[<title>]]></div></content>
		<title>The title</title>
	</entry>
</feed>
EOD;

$expected = 'The title';

?>
<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title type="html"><![CDATA[<blink>A<blink>B</blink>C</blink>]]></title>
	</entry>
</feed>
EOD;

$expected = 'ABC';

?>
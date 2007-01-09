<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<title type="text/plain"><![CDATA[This &amp;amp; this]]></title>
	</entry>
</feed>
EOD;

$expected = 'This &amp;amp;amp; this';

?>
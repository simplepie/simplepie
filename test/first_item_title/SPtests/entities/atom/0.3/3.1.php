<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<title type="text/html" mode="escaped">This <![CDATA[&amp;]]>amp; this</title>
	</entry>
</feed>
EOD;

$expected = 'This &amp;amp; this';

?>
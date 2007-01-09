<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<title type="application/xhtml+xml" mode="xml"><div xmlns="http://www.w3.org/1999/xhtml">This <![CDATA[&amp;]]>amp; this</div></title>
	</entry>
</feed>
EOD;

$expected = 'This &amp;amp;amp; this';

?>
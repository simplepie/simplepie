<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<title><![CDATA[&]]>: Ampersand</title>
</feed>
EOD;

$expected = '&amp;: Ampersand';

?>
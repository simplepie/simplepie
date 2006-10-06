<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Ampersand: <![CDATA[&]]></title>
</feed>
EOD;

$expected = 'Ampersand: &amp;';

?>
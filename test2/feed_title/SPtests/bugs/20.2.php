<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:h="http://www.w3.org/1999/xhtml">
	<title type="xhtml"><h:div>Non-default namespace</h:div></title>
</feed>
EOD;

$expected = 'Non-default namespace';

?>
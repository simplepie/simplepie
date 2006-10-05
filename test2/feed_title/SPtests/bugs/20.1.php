<?php

$data = <<<EOD
<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title type="xhtml"><div>Non-default namespace</div></a:title>
</a:feed>
EOD;

$expected = 'Non-default namespace';

?>
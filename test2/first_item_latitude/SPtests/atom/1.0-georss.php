<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss">
	<entry>
		<georss:point>55.701 12.552</georss:point>
	</entry>
</feed>
EOD;

$expected = 55.701;

?>
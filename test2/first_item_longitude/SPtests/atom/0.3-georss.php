<?php

$data = <<<EOD
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:georss="http://www.georss.org/georss">
	<entry>
		<georss:point>55.701 12.552</georss:point>
	</entry>
</feed>
EOD;

$expected = 12.552;

?>
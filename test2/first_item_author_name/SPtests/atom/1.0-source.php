<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<source>
			<author>
				<name>Item Author</name>
			</author>
		</source>
	</entry>
</feed>
EOD;

$expected = 'Item Author';

?>
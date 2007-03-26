<?php

$data = '
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title>Item <!--' . str_pad('', 100000, 'a') . '--><!--' . str_pad('', 100000, 'a') . '--> Title</title>
	</entry>
</feed>
';

$expected = 'Item  Title';

?>
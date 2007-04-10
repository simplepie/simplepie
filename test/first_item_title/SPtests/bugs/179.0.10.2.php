<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title>Title 2</title>
		<updated>2003-12-14T18:30:02Z</updated>
	</entry>
	<entry>
		<title>Title 1</title>
		<updated>2003-12-15T18:30:02Z</updated>
	</entry>
	<entry>
		<title>Title 3</title>
		<updated>2003-12-13T18:30:02Z</updated>
	</entry>
</feed>
EOD;

$expected = 'Title 1';

?>
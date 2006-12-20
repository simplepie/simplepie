<?php

$data = <<<EOD
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<title type="xhtml" xml:base="http://example.com/"><div xmlns="http://www.w3.org/1999/xhtml"><p xml:base="/test/"><a href="bleh">Link</a></p></div></title>
	</entry>
</feed>
EOD;

$expected = '<p><a href="http://example.com/test/bleh">Link</a></p>';

?>
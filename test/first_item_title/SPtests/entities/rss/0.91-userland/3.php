<?php

$data = <<<EOD
<rss version="0.91">
	<channel>
		<item>
			<title>This <![CDATA[&amp;]]>amp; this</title>
		</item>
	</channel>
</rss>
EOD;

$expected = 'This &amp;amp;amp; this';

?>
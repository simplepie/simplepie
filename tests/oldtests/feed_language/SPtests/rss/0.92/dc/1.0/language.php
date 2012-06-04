<?php

class SimplePie_Feed_Language_Test_RSS_092_DC_10_Language extends SimplePie_Feed_Language_Test
{
	function data()
	{
		$this->data =
'<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>';
	}

	function expected()
	{
		$this->expected = 'en-GB';
	}
}

?>
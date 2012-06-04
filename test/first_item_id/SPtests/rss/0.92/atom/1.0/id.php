<?php

class SimplePie_First_Item_ID_Test_RSS_092_Atom_10_ID extends SimplePie_First_Item_ID_Test
{
	function data()
	{
		$this->data =
'<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:id>http://example.com/</a:id>
		</item>
	</channel>
</rss>';
	}

	function expected()
	{
		$this->expected = 'http://example.com/';
	}
}

?>
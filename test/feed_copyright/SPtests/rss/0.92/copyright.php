<?php

class SimplePie_Feed_Copyright_Test_RSS_092_Copyright extends SimplePie_Feed_Copyright_Test
{
	function data()
	{
		$this->data = 
'<rss version="0.92">
	<channel>
		<copyright>LGPL</copyright>
	</channel>
</rss>';
	}
	
	function expected()
	{
		$this->expected = 'LGPL';
	}
}

?>
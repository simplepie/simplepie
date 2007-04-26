<?php

class SimplePie_Feed_Copyright_Test_Atom_10_Rights extends SimplePie_Feed_Copyright_Test
{
	function data()
	{
		$this->data = 
'<feed xmlns="http://www.w3.org/2005/Atom">
	<rights>LGPL</rights>
</feed>';
	}
	
	function expected()
	{
		$this->expected = 'LGPL';
	}
}

?>
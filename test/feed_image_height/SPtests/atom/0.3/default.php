<?php

class SimplePie_Feed_Image_Height_Test_Atom_03 extends SimplePie_Feed_Image_Height_Test
{
	function data()
	{
		$this->data = 
'<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<logo>http://example.com/</logo>
</feed>';
	}
	
	function expected()
	{
		$this->expected = NULL;
	}
}

?>
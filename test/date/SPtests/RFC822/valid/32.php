<?php

class SimplePie_Date_Test_RFC822_32 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 20:15:30 T';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
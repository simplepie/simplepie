<?php

class SimplePie_Date_Test_RFC822_18 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 08:15:30 E';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
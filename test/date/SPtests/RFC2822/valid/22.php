<?php

class SimplePie_Date_Test_RFC822_22 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 04:15:30 I';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
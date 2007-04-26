<?php

class SimplePie_Date_Test_RFC822_21 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 05:15:30 H';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
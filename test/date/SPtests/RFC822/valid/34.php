<?php

class SimplePie_Date_Test_RFC822_34 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 22:15:30 V';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
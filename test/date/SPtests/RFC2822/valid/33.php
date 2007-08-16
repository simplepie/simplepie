<?php

class SimplePie_Date_Test_RFC822_33 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 21:15:30 U';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
<?php

class SimplePie_Date_Test_RFC822_26 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 14:15:30 N';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
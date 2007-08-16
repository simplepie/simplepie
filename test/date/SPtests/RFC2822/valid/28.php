<?php

class SimplePie_Date_Test_RFC822_28 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 16:15:30 P';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
<?php

class SimplePie_Date_Test_RFC822_17 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 09:15:30 D';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
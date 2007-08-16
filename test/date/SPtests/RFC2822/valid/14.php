<?php

class SimplePie_Date_Test_RFC822_14 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 12:15:30 A';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
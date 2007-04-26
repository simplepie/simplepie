<?php

class SimplePie_Date_Test_RFC822_31 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 19:15:30 S';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
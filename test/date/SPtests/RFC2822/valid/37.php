<?php

class SimplePie_Date_Test_RFC822_37 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 06 Nov 94 01:15:30 Y';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
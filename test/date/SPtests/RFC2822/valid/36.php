<?php

class SimplePie_Date_Test_RFC822_36 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 06 Nov 94 00:15:30 X';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
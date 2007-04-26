<?php

class SimplePie_Date_Test_RFC822_27 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 15:15:30 O';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
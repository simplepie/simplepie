<?php

class SimplePie_Date_Test_RFC822_24 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 02:15:30 L';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
<?php

class SimplePie_Date_Test_RFC822_Decimal_Second extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = 'Fri, 05 Nov 94 13:15:30.25 GMT';
	}
	
	function expected()
	{
		$this->expected = 784041330;
	}
}

?>
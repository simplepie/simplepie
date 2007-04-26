<?php

class SimplePie_Date_Test_ISO8601_3 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985102T235030Z';
	}
	
	function expected()
	{
		$this->expected = 482197830;
	}
}

?>
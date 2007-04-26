<?php

class SimplePie_Date_Test_ISO8601_4 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985-102T23:50:30Z';
	}
	
	function expected()
	{
		$this->expected = 482197830;
	}
}

?>
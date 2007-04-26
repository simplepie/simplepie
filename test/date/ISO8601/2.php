<?php

class SimplePie_Date_Test_ISO8601_2 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985-04-12T10:15:30';
	}
	
	function expected()
	{
		$this->expected = mktime(10, 15, 30, 4, 12, 1985);
	}
}

?>
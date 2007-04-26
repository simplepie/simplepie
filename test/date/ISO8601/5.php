<?php

class SimplePie_Date_Test_ISO8601_5 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985W155T235030';
	}
	
	function expected()
	{
		$this->expected = mktime(23, 50, 30, 4, 12, 1985);
	}
}

?>
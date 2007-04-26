<?php

class SimplePie_Date_Test_ISO8601_15 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985-04';
	}
	
	function expected()
	{
		$this->expected = mktime(0, 0, 0, 4, 1, 1985);
	}
}

?>
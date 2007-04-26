<?php

class SimplePie_Date_Test_ISO8601_10 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985-102';
	}
	
	function expected()
	{
		$this->expected = mktime(0, 0, 0, 4, 12, 1985);
	}
}

?>
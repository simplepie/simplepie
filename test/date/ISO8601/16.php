<?php

class SimplePie_Date_Test_ISO8601_16 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985';
	}
	
	function expected()
	{
		$this->expected = mktime(0, 0, 0, 1, 1, 1985);
	}
}

?>
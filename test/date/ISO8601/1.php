<?php

class SimplePie_Date_Test_ISO8601_1 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '19850412T101530';
	}
	
	function expected()
	{
		$this->expected = mktime(10, 15, 30, 4, 12, 1985);
	}
}

?>
<?php

class SimplePie_Date_Test_ISO8601_13 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985W15';
	}
	
	function expected()
	{
		$this->expected = mktime(0, 0, 0, 4, 8, 1985);
	}
}

?>
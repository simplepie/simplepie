<?php

class SimplePie_Date_Test_ISO8601_12 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985-W15-5';
	}
	
	function expected()
	{
		$this->expected = mktime(0, 0, 0, 4, 12, 1985);
	}
}

?>
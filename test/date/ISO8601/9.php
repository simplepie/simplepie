<?php

class SimplePie_Date_Test_ISO8601_9 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985102';
	}
	
	function expected()
	{
		$this->expected = mktime(0, 0, 0, 4, 12, 1985);
	}
}

?>
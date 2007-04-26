<?php

$date = '1985-W15-5T23:50:30';
$expected = mktime(23, 50, 30, 4, 12, 1985);

?><?php

class SimplePie_Date_Test_ISO8601_6 extends SimplePie_Date_Test
{
	function data()
	{
		$this->data = '1985-W15-5T23:50:30';
	}
	
	function expected()
	{
		$this->expected = mktime(23, 50, 30, 4, 12, 1985);
	}
}

?>
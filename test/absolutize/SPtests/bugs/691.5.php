<?php

class SimplePie_Absolutize_Test_Bug_691_Test_5 extends SimplePie_Absolutize_Test
{
	function data()
	{
		$this->data['base'] = '0://a/b/c';
		$this->data['relative'] = 'd';
	}
	
	function expected()
	{
		$this->expected = '0://a/b/d';
	}
}

?>
<?php

class SimplePie_Absolutize_Test_Bug_691_Test_0 extends SimplePie_Absolutize_Test
{
	function data()
	{
		$this->data['base'] = 'http://a/b/c';
		$this->data['relative'] = '0://a/b/c';
	}
	
	function expected()
	{
		$this->expected = '0://a/b/c';
	}
}

?>
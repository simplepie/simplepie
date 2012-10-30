<?php

class SimplePie_Absolutize_Test_Bug_Invalid_Relative extends SimplePie_Absolutize_Test
{
	function data()
	{
		$this->data['base'] = 'http://a/b/c/d';
		$this->data['relative'] = 'http://http://a/b';
	}
	
	function expected()
	{
		$this->expected = 'http://http://a/b';
	}
}

?>

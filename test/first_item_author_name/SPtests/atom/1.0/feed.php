<?php

class SimplePie_First_Item_Author_Name_Atom_10_Inheritance_Feed_Name extends SimplePie_First_Item_Author_Name_Test
{
	function data()
	{
		$this->data =
'<feed xmlns="http://www.w3.org/2005/Atom">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>';
	}

	function expected()
	{
		$this->expected = 'Item Author';
	}
}

?>
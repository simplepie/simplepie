<?php

for ($i = 1; $i <= 64; $i++)
{
	if ($i < 10)
		$i = "0$i";
	preg_match('/u\'(.*)\'/iU', file_get_contents("tests/wellformed/amp/amp$i.xml"), $match);
	$match = $match[1];
	echo "do_title_test('tests/wellformed/amp/amp$i.xml', '$match');\n";
}
?>
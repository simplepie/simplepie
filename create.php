<?php

$lines = file('http://www.iana.org/assignments/character-sets');
$names = array();
$preferred = '';
$encodings = array();

foreach ($lines as $line)
{
	if (strpos($line, 'Name:') === 0)
	{
		if (!empty($names))
		{
			$encodings[$preferred] = $names;
			$names = array();
			$preferred = '';
		}
		if (preg_match('/^Name:\s*(\S+)/i', $line, $match))
		{
			$names[] = strtoupper($match[1]);
			$preferred = $match[1];
		}
	}
	else if (strpos($line, 'Alias:') === 0)
	{
		if (preg_match('/^Alias:\s*(\S+)\s*(\(preferred MIME name\))?/i', $line, $match))
		{
			if ($match[1] != 'None')
			{
				$names[] = $match[1];
				if (isset($match[2]))
				{
					$preferred = $match[1];
				}
			}
		}
	}
}

if (!empty($encodings))
{
	$encodings['windows-1252'] = array_merge($encodings['windows-1252'], $encodings['ISO-8859-1']);
	unset($encodings['ISO-8859-1']);
	ksort($encodings);
?>
function encoding($encoding)
{
	// Character sets are case-insensitive (though we'll return them in the form given in their registration)
	switch (strtoupper($encoding))
	{
<?php
	foreach ($encodings as $preferred => $encoding)
	{
		natcasesort($encoding);
		
		foreach ($encoding as $name)
		{
			echo "\t\tcase " . var_export(strtoupper($name), true) . ":\n";
		}
		
		echo "\t\t\treturn " . var_export($preferred, true) . ";\n\n";
	}
?>
	}
}
<?php
}
?>
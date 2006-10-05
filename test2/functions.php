<?php

class SimplePie_List
{
	function get($dir)
	{
		SimplePie_List::list_files($dir, $array);
		SimplePie_List::recursive_uasort($array, array('SimplePie_List', 'do_uasort'));
		return $array;
	}
	
	function list_files($dir, &$array)
	{
		if ($dh = opendir($dir))
		{
			while (($file = readdir($dh)) !== false)
			{
				if (substr($file, 0, 1) != '.')
				{
					if (is_dir("$dir/$file"))
					{
						SimplePie_List::list_files("$dir/$file", $array[$file]);
					}
					else
					{
						$array[] = "$dir/$file";
					}
				}
			}
		}
	}
	
	function recursive_uasort(&$array, $callback)
	{
		if (is_array($array))
		{
			uasort($array, $callback);
			foreach ($array as $key => $value)
			{
				if (is_array($array[$key]))
				{
					SimplePie_List::recursive_uasort($array[$key], $callback);
				}
			}
		}
	}
	
	function do_uasort(&$a, &$b)
	{
		if (is_array($a))
		{
			return 1;
		}
		else if (is_array($b))
		{
			return 0;
		}
		else
		{
			return strnatcmp($a, $b);
		}
	}
}

function run_test($file, $success)
{
	global $passed, $failed;
	if ($success)
	{
		$passed++;
		echo "<tr class='pass'><td>✔</td><td>$file</td></tr>";
	}
	else
	{
		$failed++;
		echo "<tr class='fail'><td>✘</td><td>$file</td></tr>";
	}
}

function absolutize_test($file)
{
	global $base;
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				absolutize_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					run_test($value, SimplePie_Misc::absolutize_url($relative, $base) == $expected);
				}
			}

		}
	}
}

function date_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				date_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					run_test($value, SimplePie_Sanitize::parse_date($date) == $expected);
				}
			}

		}
	}
}

function feed_title_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				feed_title_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_caching(false);
					$feed->init();
					run_test($value, $feed->get_feed_title() == $expected);
				}
			}

		}
	}
}

function first_item_title_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				first_item_title_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_caching(false);
					$feed->init();
					$item = $feed->get_item(0);
					if ($item)
					{
						run_test($value, $item->get_title() == $expected);
					}
					else
					{
						trigger_error($feed->error, E_USER_WARNING);
						run_test($value, false);
					}
				}
			}

		}
	}
}

function first_item_permalink_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				first_item_permalink_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_caching(false);
					$feed->init();
					$item = $feed->get_item(0);
					if ($item)
					{
						run_test($value, $item->get_permalink() == $expected);
					}
					else
					{
						trigger_error($feed->error, E_USER_WARNING);
						run_test($value, false);
					}
				}
			}
		}
	}
}

function first_item_category_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				first_item_category_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_caching(false);
					$feed->init();
					$item = $feed->get_item(0);
					if ($item)
					{
						run_test($value, $item->get_category() == $expected);
					}
					else
					{
						trigger_error($feed->error, E_USER_WARNING);
						run_test($value, false);
					}
				}
			}
		}
	}
}

?>
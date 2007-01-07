<?php

class SimplePie_List
{
	function get($dir)
	{
		SimplePie_List::list_files($dir, $array);
		usort($array, array('SimplePie_List', 'do_usort'));
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
						SimplePie_List::list_files("$dir/$file", $array);
					}
					else
					{
						$array[] = "$dir/$file";
					}
				}
			}
		}
	}
	
	function do_usort(&$a, &$b)
	{
		if (substr_count($a, '/') > substr_count($b, '/'))
		{
			return 1;
		}
		else if (substr_count($a, '/') < substr_count($b, '/'))
		{
			return -1;
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
					run_test($value, SimplePie_Misc::parse_date($date) == $expected);
				}
			}

		}
	}
}

function feed_copyright_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				feed_copyright_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_cache(false);
					$feed->init();
					run_test($value, $feed->get_feed_copyright() == $expected);
				}
			}

		}
	}
}

function feed_description_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				feed_description_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_cache(false);
					$feed->init();
					run_test($value, $feed->get_feed_description() == $expected);
				}
			}

		}
	}
}

function feed_language_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				feed_language_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_cache(false);
					$feed->init();
					run_test($value, $feed->get_feed_language() == $expected);
				}
			}

		}
	}
}

function feed_link_test($file)
{
	if (is_array($file))
	{
		foreach ($file as $key => $value)
		{
			$istest = true;
			if (is_array($value))
			{
				feed_link_test($file[$key]);
			}
			else if (pathinfo($value, PATHINFO_EXTENSION) == pathinfo(__FILE__, PATHINFO_EXTENSION))
			{
				require $value;
				if ($istest)
				{
					$feed = new SimplePie();
					$feed->set_raw_data($data);
					$feed->enable_cache(false);
					$feed->init();
					run_test($value, $feed->get_feed_link() == $expected);
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
					$feed->enable_cache(false);
					$feed->init();
					run_test($value, $feed->get_feed_title() == $expected);
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
					$feed->enable_cache(false);
					$feed->init();
					$item = $feed->get_item(0);
					if ($item)
					{
						run_test($value, $item->get_category() == $expected);
					}
					else
					{
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
					$feed->enable_cache(false);
					$feed->init();
					$item = $feed->get_item(0);
					if ($item)
					{
						run_test($value, $item->get_permalink() == $expected);
					}
					else
					{
						run_test($value, false);
					}
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
					$feed->enable_cache(false);
					$feed->init();
					$item = $feed->get_item(0);
					if ($item)
					{
						run_test($value, $item->get_title() == $expected);
					}
					else
					{
						run_test($value, false);
					}
				}
			}

		}
	}
}

function dive_into_mark_atom_autodiscovery()
{
	$next = 'http://diveintomark.org/tests/client/autodiscovery/';
	$done = array();
	$cached_entities = array();
	for ($i = 0; $next; $i++)
	{
		usleep(1000);
		$current = $next;
		$file = new SimplePie_File($current, 10, 5, null, SIMPLEPIE_USERAGENT);
		if ($file->success)
		{
			$next = false;
			$links = SimplePie_Misc::get_element('link', $file->body());
			foreach ($links as $link)
			{
				if (!empty($link['attribs']['HREF']['data']) && !empty($link['attribs']['REL']['data']))
				{
					$rel = preg_split('/\s+/', strtolower(trim($link['attribs']['REL']['data'])));
					$href = SimplePie_Misc::absolutize_url(trim($link['attribs']['HREF']['data']), $file->url);
					if (!in_array($href, $done) && in_array('next', $rel))
					{
						$next = $href;
					}
					$done[] = $href;
				}
			}
			if ($i > 0)
			{
				$feed = new SimplePie();
				$feed->set_file($file);
				$feed->enable_cache(false);
				$feed->init();
				run_test($current, $feed->get_feed_link() == $current);
			}
		}
		else
		{
			run_test($next, false);
		}
	}
}

?>
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

function do_test($callback, $files, $vars = 'data')
{
	$extension = pathinfo(__FILE__, PATHINFO_EXTENSION);
	$files = SimplePie_List::get($files);
	foreach ($files as $file)
	{
		$istest = true;
		$debug = false;
		if (pathinfo($file, PATHINFO_EXTENSION) == $extension)
		{
			include $file;
			if ($istest)
			{
				$args = compact($vars);
				$result = call_user_func_array($callback, $args);
				run_test($file, $result == $expected);
				if ($debug)
				{
					var_dump($file, $args, $result, $expected);
				}
			}
		}
	}
}

function absolutize_test($relative, $base)
{
	return SimplePie_Misc::absolutize_url($relative, $base);
}

function date_test($date)
{
	return SimplePie_Misc::parse_date($date);
}

function feed_copyright_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_feed_copyright();
}

function feed_description_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_feed_description();
}

function feed_image_height_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_image_height();
}

function feed_image_link_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_image_link();
}

function feed_image_title_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_image_title();
}

function feed_image_url_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_image_url();
}

function feed_image_width_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_image_width();
}

function feed_language_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_feed_language();
}

function feed_link_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_feed_link();
}

function feed_title_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	return $feed->get_feed_title();
}

function first_item_author_name_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		$author = $item->get_author();
		if ($author)
		{
			return $author->get_name();
		}
	}
	return false;
}

function first_item_category_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_category();
	}
	return false;
}

function first_item_content_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_content();
	}
	return false;
}

function first_item_date_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_date('U');
	}
	return false;
}

function first_item_description_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_description();
	}
	return false;
}

function first_item_id_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_id();
	}
	return false;
}

function first_item_latitude_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_latitude();
	}
	return false;
}

function first_item_longitude_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_longitude();
	}
	return false;
}

function first_item_permalink_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_permalink();
	}
	return false;
}

function first_item_title_test($data)
{
	$feed = new SimplePie();
	$feed->set_raw_data($data);
	$feed->enable_cache(false);
	$feed->init();
	$item = $feed->get_item(0);
	if ($item)
	{
		return $item->get_title();
	}
	return false;
}

function dive_into_mark_atom_autodiscovery()
{
	$next = 'http://diveintomark.org/tests/client/autodiscovery/';
	$done = array();
	$cached_entities = array();
	for ($i = 0; $next; $i++)
	{
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
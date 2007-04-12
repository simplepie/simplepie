<?php

require_once 'unit_test/unit_test.php';

function on_success($file)
{
	echo "<tr class='pass'><td>✔</td><td>$file</td></tr>";
}

function on_fail($file)
{
	echo "<tr class='fail'><td>✘</td><td>$file</td></tr>";
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

function dive_into_mark_atom_autodiscovery($tests)
{
	$url = 'http://diveintomark.org/tests/client/autodiscovery/';
	$done = array();
	for ($i = 0; $url; $i++)
	{
		$file = new SimplePie_File($url, 10, 5, null, SIMPLEPIE_USERAGENT);
		$url = false;
		if ($file->success)
		{
			if ($i > 0)
			{
				$feed = new SimplePie();
				$feed->set_file($file);
				$feed->enable_cache(false);
				$feed->init();
				$tests->run_test($file->url, $feed->get_feed_link() == $file->url);
			}
			$links = SimplePie_Misc::get_element('link', $file->body);
			foreach ($links as $link)
			{
				if (!empty($link['attribs']['href']['data']) && !empty($link['attribs']['rel']['data']))
				{
					$rel = array_unique(SimplePie_Misc::space_seperated_tokens(strtolower($link['attribs']['rel']['data'])));
					$href = SimplePie_Misc::absolutize_url(trim($link['attribs']['href']['data']), $file->url);
					if (!in_array($href, $done) && in_array('next', $rel))
					{
						$done[] = $url = $href;
						break;
					}
				}
			}
		}
		else
		{
			$tests->run_test($file->url, false);
		}
	}
}

?>
<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (C) 2004-2007 Ryan Parman, Geoffrey Sneddon
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package SimplePie
 * @version "Razzleberry"
 * @copyright 2004-2007 Ryan Parman, Geoffrey Sneddon
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 * @link http://simplepie.org/ SimplePie
 * @link http://simplepie.org/support/ Please submit all bug reports and feature requests to the SimplePie forums
 * @license http://opensource.org/licenses/lgpl-license.php GNU Lesser General Public License
 */

/**
 * SimplePie Name
 * @see SimplePie::name
 */
define('SIMPLEPIE_NAME', 'SimplePie');

/**
 * SimplePie Version
 * @see SimplePie::version
 */
define('SIMPLEPIE_VERSION', 'Razzleberry++');

/**
 * SimplePie Build
 * @see SimplePie::build
 */
define('SIMPLEPIE_BUILD', gmdate('YmdHis', SimplePie_Misc::parse_date('$Date$')));

/**
 * SimplePie Website URL
 * @see SimplePie::url
 */
define('SIMPLEPIE_URL', 'http://simplepie.org/');

/**
 * SimplePie Useragent
 * @see SimplePie::useragent
 * @see SimplePie::set_useragent()
 */
define('SIMPLEPIE_USERAGENT', SIMPLEPIE_NAME . '/' . SIMPLEPIE_VERSION . ' (Feed Parser; ' . SIMPLEPIE_URL . '; Allow like Gecko) Build/' . SIMPLEPIE_BUILD);

/**
 * SimplePie Linkback
 * @see SimplePie::linkback
 */
define('SIMPLEPIE_LINKBACK', '<a href="' . SIMPLEPIE_URL . '" title="' . SIMPLEPIE_NAME . ' ' . SIMPLEPIE_VERSION . '">' . SIMPLEPIE_NAME . '</a>');

/**
 * No Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_NONE', 0);

/**
 * Feed Link Element Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_AUTODISCOVERY', 1);

/**
 * Local Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_EXTENSION', 2);

/**
 * Local Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_BODY', 4);

/**
 * Remote Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_EXTENSION', 8);

/**
 * Remote Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_BODY', 16);

/**
 * All Feed Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_ALL', 31);

/**
 * PCRE for HTML attributes
 */
define('SIMPLEPIE_PCRE_HTML_ATTRIBUTE', '((?:\s+(?:(?:[^\s:]+:)?[^\s:]+)(?:\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'|(?:[a-z0-9\-._:]*)))?)*)\s*');

/**
 * PCRE for XML attributes
 */
define('SIMPLEPIE_PCRE_XML_ATTRIBUTE', '((?:\s+(?:(?:[^\s:]+:)?[^\s:]+)\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'))*)\s*');

if (version_compare(phpversion(), '5.0.0', '>='))
{
	/**
	 * We're running on PHP5
	 */
	define('SIMPLEPIE_PHP5', true);
}
else
{
	/**
	 * We're not running on PHP5
	 */
	define('SIMPLEPIE_PHP5', false);
}

/**
 * SimplePie
 *
 * @package SimplePie
 * @version "Razzleberry"
 * @copyright 2004-2007 Ryan Parman, Geoffrey Sneddon
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 */
class SimplePie
{
	/**
	 * @var array Raw data
	 * @access private
	 */
	var $data = array();

	/**
	 * @var mixed Error string
	 * @access private
	 */
	var $error;

	/**
	 * @var object Instance of SimplePie_Sanitize (or other class)
	 * @see SimplePie::set_sanitize_class()
	 * @access private
	 */
	var $sanitize;

	/**
	 * @var string SimplePie Useragent
	 * @see SimplePie::set_useragent()
	 * @access private
	 */
	var $useragent = SIMPLEPIE_USERAGENT;

	/**
	 * @var string Feed URL
	 * @see SimplePie::set_feed_url()
	 * @access private
	 */
	var $feed_url;

	/**
	 * @var object Instance of SimplePie_File to use as a feed
	 * @see SimplePie::set_file()
	 * @access private
	 */
	var $file;

	/**
	 * @var string Raw feed data
	 * @see SimplePie::set_raw_data()
	 * @access private
	 */
	var $raw_data;

	/**
	 * @var int Timeout for fetching remote files
	 * @see SimplePie::set_timeout()
	 * @access private
	 */
	var $timeout = 10;

	/**
	 * @var bool Forces fsockopen() to be used for remote files instead
	 * of cURL, even if a new enough version is installed
	 * @see SimplePie::force_fsockopen()
	 * @access private
	 */
	var $force_fsockopen = false;

	/**
	 * @var bool Enable/Disable XML dump
	 * @see SimplePie::enable_xml_dump()
	 * @access private
	 */
	var $xml_dump = false;

	/**
	 * @var bool Enable/Disable Caching
	 * @see SimplePie::enable_cache()
	 * @access private
	 */
	var $cache = true;

	/**
	 * @var int Cache duration (in seconds)
	 * @see SimplePie::set_cache_duration()
	 * @access private
	 */
	var $cache_duration = 3600;

	/**
	 * @var string Cache location (relative to executing script)
	 * @see SimplePie::set_cache_location()
	 * @access private
	 */
	var $cache_location = './cache';

	/**
	 * @var string Function that creates the cache filename
	 * @see SimplePie::set_cache_name_function()
	 * @access private
	 */
	var $cache_name_function = 'sha1';

	/**
	 * @var bool Reorder feed by date descending
	 * @see SimplePie::enable_order_by_date()
	 * @access private
	 */
	var $order_by_date = true;

	/**
	 * @var mixed Force input encoding to be set to the follow value
	 * (false, or anything type-cast to false, disables this feature)
	 * @see SimplePie::set_input_encoding()
	 * @access private
	 */
	var $input_encoding = false;

	/**
	 * @var int Feed Autodiscovery Level
	 * @see SimplePie::set_autodiscovery_level()
	 * @access private
	 */
	var $autodiscovery = SIMPLEPIE_LOCATOR_ALL;

	/**
	 * @var string Class used for caching feeds
	 * @see SimplePie::set_cache_class()
	 * @access private
	 */
	var $cache_class = 'SimplePie_Cache';

	/**
	 * @var string Class used for locating feeds
	 * @see SimplePie::set_locator_class()
	 * @access private
	 */
	var $locator_class = 'SimplePie_Locator';

	/**
	 * @var string Class used for parsing feeds
	 * @see SimplePie::set_parser_class()
	 * @access private
	 */
	var $parser_class = 'SimplePie_Parser';

	/**
	 * @var string Class used for fetching feeds
	 * @see SimplePie::set_file_class()
	 * @access private
	 */
	var $file_class = 'SimplePie_File';

	/**
	 * @var string Class used for items
	 * @see SimplePie::set_item_class()
	 * @access private
	 */
	var $item_class = 'SimplePie_Item';

	/**
	 * @var string Class used for authors
	 * @see SimplePie::set_author_class()
	 * @access private
	 */
	var $author_class = 'SimplePie_Author';

	/**
	 * @var string Class used for enclosures
	 * @see SimplePie::set_enclosures_class()
	 * @access private
	 */
	var $enclosure_class = 'SimplePie_Enclosure';

	/**
	 * @var mixed Set javascript query string parameter (false, or
	 * anything type-cast to false, disables this feature)
	 * @see SimplePie::set_javascript()
	 * @access private
	 */
	var $javascript = 'js';

	/**
	 * @var int Maximum number of feeds to check with autodiscovery
	 * @see SimplePie::set_max_checked_feeds()
	 * @access private
	 */
	var $max_checked_feeds = 10;

	/**
	 * Creates useragent, linkback and sanitize members, and runs
	 * init if a feed URL is passed (as the first parameter)
	 *
	 * @access public
	 * @param mixed $feed_url Feed URL, defaults to null, sets the
	 * feed URL and runs init() if not
	 * @param mixed $cache_location Cache Location, defaults to null,
	 * sets the cache location if not
	 * @param mixed $cache_duration Cache Duration, defaults to null,
	 * sets the cache duration (in seconds) if not
	 */
	function SimplePie($feed_url = null, $cache_location = null, $cache_duration = null)
	{
		// Other objects, instances created here so we can set options on them
		$this->sanitize =& new SimplePie_Sanitize;

		// Set options if they're passed to the constructor
		if (!is_null($cache_location))
		{
			$this->set_cache_location($cache_location);
		}

		if (!is_null($cache_duration))
		{
			$this->set_cache_duration($cache_duration);
		}

		// Only init the script if we're passed a feed URL
		if (!is_null($feed_url))
		{
			$this->set_feed_url($feed_url);
			$this->init();
		}
	}

	/**
	 * Sets the feed URL
	 *
	 * This takes priority over any set raw data
	 *
	 * @access public
	 * @param string $url Feed URL
	 * @see SimplePie::set_raw_data()
	 */
	function set_feed_url($url)
	{
		$this->feed_url = SimplePie_Misc::fix_protocol($url, 1);
	}

	/**
	 * Provides an instance of SimplePie_File to use as a feed
	 *
	 * @access public
	 * @param object &$file Instance of SimplePie_File (or subclass)
	 * @return bool True on success, false on failure
	 */
	function set_file(&$file)
	{
		if (is_a($file, 'SimplePie_File'))
		{
			$this->feed_url = $file->url;
			$this->file =& $file;
			return true;
		}
		return false;
	}

	/**
	 * Sets the raw feed data
	 *
	 * Any set feed URL takes priority over this
	 *
	 * @access public
	 * @param string $data Raw feed data
	 * @see SimplePie::set_feed_url()
	 */
	function set_raw_data($data)
	{
		$this->raw_data = trim($data);
	}

	/**
	 * Sets the timeout for fetching remote files
	 *
	 * @access public
	 * @param int $timeout Timeout (in seconds)
	 */
	function set_timeout($timeout = 10)
	{
		$this->timeout = (int) $timeout;
	}

	/**
	 * Forces fsockopen() to be used for remote files instead of cURL,
	 * even if a new enough version is installed
	 *
	 * @access public
	 * @param bool $enable Force fsockopen() to be used
	 */
	function force_fsockopen($enable = false)
	{
		$this->force_fsockopen = (bool) $enable;
	}

	function enable_xml_dump($enable = false)
	{
		$this->xml_dump = (bool) $enable;
	}

	function enable_cache($enable = true)
	{
		$this->cache = (bool) $enable;
	}

	function set_cache_duration($seconds = 3600)
	{
		$this->cache_duration = (int) $seconds;
	}

	function set_cache_location($location = './cache')
	{
		$this->cache_location = (string) $location;
	}

	function enable_order_by_date($enable = true)
	{
		$this->order_by_date = (bool) $enable;
	}

	function set_input_encoding($encoding = false)
	{
		if ($encoding)
		{
			$this->input_encoding = (string) $encoding;
		}
		else
		{
			$this->input_encoding = false;
		}
	}

	/**
	 * Set how much feed autodiscovery to do
	 *
	 * @access public
	 * @see SIMPLEPIE_LOCATOR_NONE
	 * @see SIMPLEPIE_LOCATOR_AUTODISCOVERY
	 * @see SIMPLEPIE_LOCATOR_LOCAL_EXTENSION
	 * @see SIMPLEPIE_LOCATOR_LOCAL_BODY
	 * @see SIMPLEPIE_LOCATOR_REMOTE_EXTENSION
	 * @see SIMPLEPIE_LOCATOR_REMOTE_BODY
	 * @see SIMPLEPIE_LOCATOR_ALL
	 * @param int $level Feed Autodiscovery Level (level can be a
	 * combination of the above constants, see bitwise OR operator)
	 */
	function set_autodiscovery_level($level = SIMPLEPIE_LOCATOR_ALL)
	{
		$this->autodiscovery = (int) $level;
	}

	function set_cache_class($class = 'SimplePie_Cache')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Cache'))
		{
			$this->cache_class = $class;
			return true;
		}
		return false;
	}

	function set_locator_class($class = 'SimplePie_Locator')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Locator'))
		{
			$this->locator_class = $class;
			return true;
		}
		return false;
	}

	function set_parser_class($class = 'SimplePie_Parser')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Parser'))
		{
			$this->parser_class = $class;
			return true;
		}
		return false;
	}

	function set_file_class($class = 'SimplePie_File')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_File'))
		{
			$this->file_class = $class;
			return true;
		}
		return false;
	}

	function set_sanitize_class($class = 'SimplePie_Sanitize')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Sanitize'))
		{
			$this->sanitize =& new $class;
			return true;
		}
		return false;
	}

	function set_item_class($class = 'SimplePie_Item')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Item'))
		{
			$this->item_class = $class;
			return true;
		}
		return false;
	}

	function set_author_class($class = 'SimplePie_Author')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Author'))
		{
			$this->author_class = $class;
			return true;
		}
		return false;
	}

	function set_enclosure_class($class = 'SimplePie_Enclosure')
	{
		if (SimplePie_Misc::is_a_class($class, 'SimplePie_Enclosure'))
		{
			$this->enclosure_class = $class;
			return true;
		}
		return false;
	}

	function set_useragent($ua = SIMPLEPIE_USERAGENT)
	{
		$this->useragent = (string) $ua;
	}

	/**
	 * Set callback function to create cache filename with
	 *
	 * @access public
	 * @param mixed $function Callback function
	 */
	function set_cache_name_function($function = 'sha1')
	{
		if (is_callable($function))
		{
			$this->cache_name_function = $function;
		}
	}

	/**
	 * Set javascript query string parameter
	 *
	 * @access public
	 * @param mixed $get Javascript query string parameter
	 */
	function set_javascript($get = 'js')
	{
		if ($get)
		{
			$this->javascript = (string) $get;
		}
		else
		{
			$this->javascript = false;
		}
	}

	/**
	 * Set maximum number of feeds to check with autodiscovery
	 *
	 * @access public
	 * @param int $max Maximum number of feeds to check
	 */
	function set_max_checked_feeds($max = 10)
	{
		$this->max_checked_feeds = (int) $max;
	}

	function bypass_image_hotlink($get = false)
	{
		$this->sanitize->bypass_image_hotlink($get);
	}

	function bypass_image_hotlink_page($page = false)
	{
		$this->sanitize->bypass_image_hotlink_page($page);
	}

	function replace_headers($enable = false)
	{
		$this->sanitize->replace_headers($enable);
	}

	function remove_div($enable = true)
	{
		$this->sanitize->remove_div($enable);
	}

	function strip_htmltags($tags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'), $encode = null)
	{
		$this->sanitize->strip_htmltags($tags);
		if (!is_null($encode))
		{
			$this->sanitize->encode_instead_of_strip($tags);
		}
	}

	function encode_instead_of_strip($enable = true)
	{
		$this->sanitize->encode_instead_of_strip($enable);
	}

	function strip_attributes($attribs = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur'))
	{
		$this->sanitize->strip_attributes($attribs);
	}

	function set_output_encoding($encoding = 'UTF-8')
	{
		$this->sanitize->set_output_encoding($encoding);
	}

	function init()
	{
		if ((function_exists('version_compare') && version_compare(phpversion(), '4.3.2', '<')) || !extension_loaded('xml') || !extension_loaded('pcre'))
		{
			return false;
		}
		if ($this->sanitize->bypass_image_hotlink && !empty($_GET[$this->sanitize->bypass_image_hotlink]))
		{
			if (get_magic_quotes_gpc())
			{
				$_GET[$this->sanitize->bypass_image_hotlink] = stripslashes($_GET[$this->sanitize->bypass_image_hotlink]);
			}
			SimplePie_Misc::display_file($_GET[$this->sanitize->bypass_image_hotlink], 10, $this->useragent);
		}

		if (isset($_GET[$this->javascript]))
		{
			if (function_exists('ob_gzhandler'))
			{
				ob_start('ob_gzhandler');
			}
			header('Content-type: text/javascript; charset: UTF-8');
			header('Cache-Control: must-revalidate');
			header('Expires: ' .  gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
			?>
function embed_odeo(link) {
	document.writeln('<embed src="http://odeo.com/flash/audio_player_fullsize.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" quality="high" width="440" height="80" wmode="transparent" allowScriptAccess="any" flashvars="valid_sample_rate=true&external_url='+link+'"></embed>');
}

function embed_quicktime(type, bgcolor, width, height, link, placeholder, loop) {
	if (placeholder != '') {
		document.writeln('<embed type="'+type+'" style="cursor:hand; cursor:pointer;" href="'+link+'" src="'+placeholder+'" width="'+width+'" height="'+height+'" autoplay="false" target="myself" controller="false" loop="'+loop+'" scale="aspect" bgcolor="'+bgcolor+'" pluginspage="http://www.apple.com/quicktime/download/"></embed>');
	}
	else {
		document.writeln('<embed type="'+type+'" style="cursor:hand; cursor:pointer;" src="'+link+'" width="'+width+'" height="'+height+'" autoplay="false" target="myself" controller="true" loop="'+loop+'" scale="aspect" bgcolor="'+bgcolor+'" pluginspage="http://www.apple.com/quicktime/download/"></embed>');
	}
}

function embed_flash(bgcolor, width, height, link, loop, type) {
	document.writeln('<embed src="'+link+'" pluginspage="http://www.macromedia.com/go/getflashplayer" type="'+type+'" quality="high" width="'+width+'" height="'+height+'" bgcolor="'+bgcolor+'" loop="'+loop+'"></embed>');
}

function embed_flv(width, height, link, placeholder, loop, player) {
	document.writeln('<embed src="'+player+'" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" quality="high" width="'+width+'" height="'+height+'" wmode="transparent" flashvars="file='+link+'&autostart=false&repeat='+loop+'&showdigits=true&showfsbutton=false"></embed>');
}

function embed_wmedia(width, height, link) {
	document.writeln('<embed type="application/x-mplayer2" src="'+link+'" autosize="1" width="'+width+'" height="'+height+'" showcontrols="1" showstatusbar="0" showdisplay="0" autostart="0"></embed>');
}
			<?php
			exit;
		}

		if (!empty($this->feed_url) || !empty($this->raw_data))
		{
			$this->data = array();
			$cache = false;

			if (!empty($this->feed_url))
			{
				$parsed_feed_url = parse_url($this->feed_url);
				// Decide whether to enable caching
				if ($this->cache && !empty($parsed_feed_url['scheme']))
				{
					$cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $this->feed_url), 'spc');
				}
				// If it's enabled and we don't want an XML dump, use the cache
				if ($cache && !$this->xml_dump)
				{
					// Load the Cache
					$this->data = $cache->load();
					if (!empty($this->data))
					{
						// If the cache is for an outdated build of SimplePie
						if (!isset($this->data['build']) || $this->data['build'] != SIMPLEPIE_BUILD)
						{
							$cache->unlink();
							$this->data = array();
						}
						// If we've hit a collision just rerun it with caching disabled
						else if (isset($this->data['url']) && $this->data['url'] != $this->feed_url)
						{
							$cache = false;
							$this->data = array();
						}
						// If we've got a feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL
						else if (!empty($this->data['feed_url']))
						{
							if ($this->data['feed_url'] == $this->data['url'])
							{
								$cache->unlink();
								$this->data = array();
							}
							else
							{
								$this->set_feed_url($this->data['feed_url']);
								return $this->init();
							}
						}
						// Check if the cache has been updated
						else if ($cache->mtime() + $this->cache_duration < time())
						{
							// If we have last-modified and/or etag set
							if (!empty($this->data['last-modified']) || !empty($this->data['etag']))
							{
								$headers = array();
								if (!empty($this->data['last-modified']))
								{
									$headers['if-modified-since'] = $this->data['last-modified'];
								}
								if (!empty($this->data['etag']))
								{
									$headers['if-none-match'] = $this->data['etag'];
								}
								$file =& new $this->file_class($this->feed_url, $this->timeout/10, 5, $headers, $this->useragent, $this->force_fsockopen);
								if ($file->success)
								{
									$headers = $file->headers();
									if ($headers['status']['code'] == 304)
									{
										$cache->touch();
										return true;
									}
								}
								else
								{
									unset($file);
								}
							}
						}
						// If the cache is still valid, just return true
						else
						{
							return true;
						}
					}
					// If the cache is empty, delete it
					else
					{
						$cache->unlink();
						$this->data = array();
					}
				}
				// If we don't already have the file (it'll only exist if we've opened it to check if the cache has been modified), open it.
				if (!isset($file))
				{
					if (is_a($this->file, 'SimplePie_File') && $this->file->url == $this->feed_url)
					{
						$file =& $this->file;
					}
					else
					{
						$file =& new $this->file_class($this->feed_url, $this->timeout, 5, null, $this->useragent, $this->force_fsockopen);
					}
				}
				// If the file connection has an error, set SimplePie::error to that and quit
				if (!$file->success)
				{
					$this->error = $file->error;
					if (!empty($this->data))
					{
						return true;
					}
					else
					{
						return false;
					}
				}

				// Check if the supplied URL is a feed, if it isn't, look for it.
				$locate =& new $this->locator_class($file, $this->timeout, $this->useragent, $this->file_class, $this->max_checked_feeds);
				if (!$locate->is_feed($file))
				{
					$file = $locate->find($this->autodiscovery);
					if ($file)
					{
						if ($cache)
						{
							if (!$cache->save(array('url' => $this->feed_url, 'feed_url' => $file->url)))
							{
								$this->error = "$cache->name is not writeable";
								SimplePie_Misc::error($this->error, E_USER_WARNING, __FILE__, __LINE__);
							}
							$cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $this->feed_url), 'spc');
						}
						$this->feed_url = $file->url;
					}
					else
					{
						$this->error = "A feed could not be found at $this->feed_url";
						SimplePie_Misc::error($this->error, E_USER_NOTICE, __FILE__, __LINE__);
						return false;
					}
				}
				$locate = null;

				$headers = $file->headers();
				$data = trim($file->body());
				unset($file);
			}
			else
			{
				$data = $this->raw_data;
			}

			// First check to see if input has been overridden.
			if (!empty($this->input_encoding))
			{
				$encoding = $this->input_encoding;
			}
			// Second try HTTP headers
			else if (!empty($headers['content-type']) && preg_match('/;charset=([^;]*)/i', $headers['content-type'], $charset))
			{
				$encoding = $charset[1];
			}
			// Then prolog, if at the very start of the document
			else if (preg_match("/^<\?xml[\x20\x9\xD\xA]+version([\x20\x9\xD\xA]+)?=([\x20\x9\xD\xA]+)?(\"1.0\"|'1.0'|\"1.1\"|'1.1')[\x20\x9\xD\xA]+encoding([\x20\x9\xD\xA]+)?=([\x20\x9\xD\xA]+)?(\"[A-Za-z][A-Za-z0-9._\-]*\"|'[A-Za-z][A-Za-z0-9._\-]*')([\x20\x9\xD\xA]+standalone([\x20\x9\xD\xA]+)?=([\x20\x9\xD\xA]+)?(\"(yes|no)\"|'(yes|no)'))?([\x20\x9\xD\xA]+)?\?>/", $data, $prolog))
			{
				$encoding = substr($prolog[6], 1, -1);
			}
			// UTF-32 Big Endian BOM
			else if (strpos($data, "\x0\x0\xFE\xFF") === 0)
			{
				$encoding = 'UTF-32be';
			}
			// UTF-32 Little Endian BOM
			else if (strpos($data, "\xFF\xFE\x0\x0") === 0)
			{
				$encoding = 'UTF-32';
			}
			// UTF-16 Big Endian BOM
			else if (strpos($data, "\xFE\xFF") === 0)
			{
				$encoding = 'UTF-16be';
			}
			// UTF-16 Little Endian BOM
			else if (strpos($data, "\xFF\xFE") === 0)
			{
				$encoding = 'UTF-16le';
			}
			// UTF-8 BOM
			else if (strpos($data, "\xEF\xBB\xBF") === 0)
			{
				$encoding = 'UTF-8';
			}
			// Fallback to the default (US-ASCII for text/xml, ISO-8859-1 for text/* MIME types, UTF-8 otherwise)
			else if (!empty($headers['content-type']) && strtolower(SimplePie_Misc::parse_mime($headers['content-type'])) == 'text/xml')
			{
				$encoding = 'US-ASCII';
			}
			else if (!empty($headers['content-type']) && preg_match('/^text\//i', SimplePie_Misc::parse_mime($headers['content-type'])))
			{
				$encoding = 'ISO-8859-1';
			}
			else
			{
				$encoding = 'UTF-8';
			}

			// Change the encoding to UTF-8 (as we always use UTF-8 internally)
			if ($encoding != 'UTF-8')
			{
				$data = SimplePie_Misc::change_encoding($data, $encoding, 'UTF-8');
			}

			// Strip illegal characters (if on less than PHP5, as on PHP5's XML extension can manage fine, thereby breaking the XML spec)
			if (!SIMPLEPIE_PHP5)
			{
				$data = SimplePie_Misc::utf8_bad_replace($data);
			}

			$parser =& new $this->parser_class();
			$parser->pre_process($data, 'UTF-8');
			// If we want the XML, just output that and quit
			if ($this->xml_dump)
			{
				header('Content-type: text/xml; charset=UTF-8');
				echo $data;
				exit;
			}
			// If it's parsed fine
			else if ($parser->parse($data))
			{
				unset($data);
				$this->data = $parser->get_data();
				$this->do_prepare($this->data, $this->get_feed_link(), $this->subscribe_url());

				// Store the headers that we need
				if (!empty($headers['last-modified']))
				{
					$this->data['last-modified'] = $headers['last-modified'];
				}
				if (!empty($headers['etag']))
				{
					$this->data['etag'] = $headers['etag'];
				}
				$this->data['build'] = SIMPLEPIE_BUILD;

				// Cache the file if caching is enabled
				if ($cache && !$cache->save($this->data))
				{
					$this->error = "$cache->name is not writeable";
					SimplePie_Misc::error($this->error, E_USER_WARNING, __FILE__, __LINE__);
				}
				return true;
			}
			// If we have an error, just set SimplePie::error to it and quit
			else
			{
				$this->error = sprintf('XML error: %s at line %d, column %d', $parser->get_error_string(), $parser->get_current_line(), $parser->get_current_column());
				SimplePie_Misc::error($this->error, E_USER_NOTICE, __FILE__, __LINE__);
				return false;
			}
		}
	}

	function do_prepare(&$array, $link, $url)
	{
		if (SIMPLEPIE_PHP5)
		{
			foreach ($array['child'] as &$subarray1)
			{
				foreach ($subarray1 as &$subarray2)
				{
					foreach ($subarray2 as &$subarray3)
					{
						$this->sanitize->sanitize($subarray3, $link, $url);
						if (isset($subarray3['child']))
						{
							$this->do_prepare($subarray3, $link, $url);
						}
					}
				}
			}
		}
		else
		{
			$keys1 = array_keys($array['child']);
			foreach ($keys1 as $key1)
			{
				$keys2 = array_keys($array['child'][$key1]);
				foreach ($keys2 as $key2)
				{
					$keys3 = array_keys($array['child'][$key1][$key2]);
					foreach ($keys3 as $key3)
					{
						$this->sanitize->sanitize($array['child'][$key1][$key2][$key3], $link, $url);
						if (isset($array['child'][$key1][$key2][$key3]['child']))
						{
							$this->do_prepare($array['child'][$key1][$key2][$key3], $link, $url);
						}
					}
				}
			}
		}
	}

	/**
	 * Return the error message for the occured error
	 *
	 * @access public
	 * @return string Error message
	 */
	function error()
	{
		return $this->error;
	}

	/**
	 * Return the raw data array
	 *
	 * Warning: The structure of this array may change from release to
	 * release without any warning
	 *
	 * @access public
	 * @return array Raw Data
	 */
	function get_data()
	{
		return $this->data;
	}

	/**
	 * @todo Need to re-add this functionality...
	 */
	function get_encoding()
	{
		if (!empty($this->data['feedinfo']['encoding']))
		{
			return $this->data['feedinfo']['encoding'];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Need to re-add this functionality...
	 */
	function handle_content_type($mime = 'text/html')
	{
		if (!headers_sent())
		{
			$header = "Content-type: $mime;";
			if ($this->get_encoding())
			{
				$header .= ' charset=' . $this->get_encoding();
			}
			else
			{
				$header .= ' charset=UTF-8';
			}
			header($header);
		}
	}

	/**
	 * @todo Need to re-add this functionality...
	 */
	function get_type()
	{
		if (!empty($this->data['feedinfo']['type']))
		{
			return $this->data['feedinfo']['type'];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Need to re-add this functionality...
	 */
	function get_version()
	{
		if (!empty($this->data['feedinfo']['version']))
		{
			return $this->data['feedinfo']['version'];
		}
		else
		{
			return false;
		}
	}

	function get_favicon($check = false)
	{
		if ($this->get_feed_link())
		{
			$favicon = SimplePie_Misc::absolutize_url('/favicon.ico', $this->get_feed_link());

			if ($check)
			{
				$file =& new $this->file_class($favicon, $this->timeout/10, 5, null, $this->useragent, $this->force_fsockopen);
				$headers = $file->headers();

				if ($file->success && ($headers['status']['code'] == 200 || ($headers['status']['code'] > 206 && $headers['status']['code'] < 300)))
				{
					return $favicon;
				}
			}
			else
			{
				return $favicon;
			}
		}
		return false;
	}

	function subscribe_url()
	{
		if (!empty($this->feed_url))
		{
			return $this->feed_url;
		}
		else
		{
			return false;
		}
	}

	function subscribe_feed()
	{
		if (!empty($this->feed_url))
		{
			return SimplePie_Misc::fix_protocol($this->feed_url, 2);
		}
		else
		{
			return false;
		}
	}

	function subscribe_outlook()
	{
		if (!empty($this->feed_url))
		{
			return 'outlook' . SimplePie_Misc::fix_protocol($this->feed_url, 2);
		}
		else
		{
			return false;
		}
	}

	function subscribe_podcast()
	{
		if (!empty($this->feed_url))
		{
			return SimplePie_Misc::fix_protocol($this->feed_url, 3);
		}
		else
		{
			return false;
		}
	}

	/**
	 * Creates the subscribe_* methods' return data
	 *
	 * @access private
	 * @param string $feed_url String to prefix to the feed URL
	 * @param string $site_url String to prefix to the site URL (and
	 * suffix to the feed URL)
	 * @return mixed URL if feed exists, false otherwise
	 */
	function subscribe_service($feed_url, $site_url = '')
	{
		if ($this->subscribe_url())
		{
			$return = $feed_url . rawurlencode($this->subscribe_url());
			if (!empty($site_url) && $this->get_feed_link())
			{
				$return .= $site_url . rawurlencode($this->get_feed_link());
			}
			return $return;
		}
		else
		{
			return false;
		}
	}

	function subscribe_aol()
	{
		return $this->subscribe_service('http://feeds.my.aol.com/add.jsp?url=');
	}

	function subscribe_bloglines()
	{
		return $this->subscribe_service('http://www.bloglines.com/sub/');
	}

	function subscribe_eskobo()
	{
		return $this->subscribe_service('http://www.eskobo.com/?AddToMyPage=');
	}

	function subscribe_feedfeeds()
	{
		return $this->subscribe_service('http://www.feedfeeds.com/add?feed=');
	}

	function subscribe_feedlounge()
	{
		return $this->subscribe_service('http://my.feedlounge.com/external/subscribe?url=');
	}

	function subscribe_feedster()
	{
		return $this->subscribe_service('http://www.feedster.com/myfeedster.php?action=addrss&amp;confirm=no&amp;rssurl=');
	}

	function subscribe_google()
	{
		return $this->subscribe_service('http://fusion.google.com/add?feedurl=');
	}

	function subscribe_gritwire()
	{
		return $this->subscribe_service('http://my.gritwire.com/feeds/addExternalFeed.aspx?FeedUrl=');
	}

	function subscribe_msn()
	{
		return $this->subscribe_service('http://my.msn.com/addtomymsn.armx?id=rss&amp;ut=', '&amp;ru=');
	}

	function subscribe_netvibes()
	{
		return $this->subscribe_service('http://www.netvibes.com/subscribe.php?url=');
	}

	function subscribe_newsburst()
	{
		return $this->subscribe_service('http://www.newsburst.com/Source/?add=');
	}

	function subscribe_newsgator()
	{
		return $this->subscribe_service('http://www.newsgator.com/ngs/subscriber/subext.aspx?url=');
	}

	function subscribe_odeo()
	{
		return $this->subscribe_service('http://www.odeo.com/listen/subscribe?feed=');
	}

	function subscribe_podnova()
	{
		return $this->subscribe_service('http://www.podnova.com/index_your_podcasts.srf?action=add&amp;url=');
	}

	function subscribe_rojo()
	{
		return $this->subscribe_service('http://www.rojo.com/add-subscription?resource=');
	}

	function subscribe_yahoo()
	{
		return $this->subscribe_service('http://add.my.yahoo.com/rss?url=');
	}

	function get_tags($namespace, $tag, $channel = true)
	{
		if (isset($this->data['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['CHANNEL'][0]))
		{
			if (isset($this->data['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['CHANNEL'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['CHANNEL'][0]['child'][$namespace][$tag];
			}
		}
		else if (isset($this->data['child']['rss092']['CHANNEL'][0]))
		{
			if (isset($this->data['child']['rss092']['CHANNEL'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['rss092']['CHANNEL'][0]['child'][$namespace][$tag];
			}
		}
		else if (isset($this->data['child']['rss091']['CHANNEL'][0]))
		{
			if (isset($this->data['child']['rss091']['CHANNEL'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['rss091']['CHANNEL'][0]['child'][$namespace][$tag];
			}
		}
		else if ($channel && isset($this->data['child']['HTTP://PURL.ORG/RSS/1.0/']['CHANNEL'][0]))
		{
			if (isset($this->data['child']['HTTP://PURL.ORG/RSS/1.0/']['CHANNEL'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['HTTP://PURL.ORG/RSS/1.0/']['CHANNEL'][0]['child'][$namespace][$tag];
			}
		}
		else if ($channel && isset($this->data['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['CHANNEL'][0]))
		{
			if (isset($this->data['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['CHANNEL'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['CHANNEL'][0]['child'][$namespace][$tag];
			}
		}
		else if (isset($this->data['child']['rss_unknown']['CHANNEL'][0]))
		{
			if (isset($this->data['child']['rss_unknown']['CHANNEL'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['rss_unknown']['CHANNEL'][0]['child'][$namespace][$tag];
			}
		}
		else if (isset($this->data['child'][$namespace][$tag]))
		{
			return $this->data['child'][$namespace][$tag];
		}
		else
		{
			return null;
		}
	}

	function get_feed_title()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_link($key = 0, $rel = 'alternate')
	{
		$links = $this->get_feed_links($rel);
		if (isset($links[$key]))
		{
			return $links[$key];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Properly deal with the output encoding (attributes are in their original UTF-8 form)
	 */
	function get_feed_links($rel = 'alternate')
	{
		if (empty($this->data['links']))
		{
			$base = $this->subscribe_url();
			if ($links = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LINK'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF']))
					{
						$link_rel = (isset($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['REL'])) ? $link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['REL'] : 'alternate';
						if ($link['xml_base_explicit'])
						{
							$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF'], $link['xml_base']);
						}
						else
						{
							$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF'], $base);
						}
					}
				}
			}
			if ($links = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'LINK'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF']))
					{
						$link_rel = (isset($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['REL'])) ? $link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['REL'] : 'alternate';
						if ($link['xml_base_explicit'])
						{
							$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF'], $link['xml_base']);
						}
						else
						{
							$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF'], $base);
						}
					}
				}
			}
			if ($links = $this->get_tags('atom_unknown', 'LINK'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['atom_unknown']['HREF']))
					{
						$link_rel = (isset($link['attribs']['atom_unknown']['REL'])) ? $link['attribs']['atom_unknown']['REL'] : 'alternate';
						if ($link['xml_base_explicit'])
						{
							$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['atom_unknown']['HREF'], $link['xml_base']);
						}
						else
						{
							$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['atom_unknown']['HREF'], $base);
						}
					}
				}
			}
			if ($links = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('rss092', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('rss091', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('rss_unknown', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
		}
		if (isset($this->data['links'][$rel]))
		{
			return $this->data['links'][$rel];
		}
		else
		{
			return false;
		}
	}

	function get_feed_description()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'SUBTITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'TAGLINE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'SUBTITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'TAGLINE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_copyright()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'RIGHTS'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'RIGHTS'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'COPYRIGHT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'COPYRIGHT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'COPYRIGHT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'COPYRIGHT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'RIGHTS'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'RIGHTS'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_language()
	{
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'LANGUAGE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'LANGUAGE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'LANGUAGE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'LANGUAGE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'LANGUAGE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'LANGUAGE'))
		{
			return $return[0]['data'];
		}
		else if (!empty($this->data['xml_lang']))
		{
			return $this->data['xml_lang'];
		}
		else
		{
			return false;
		}
	}

	function get_image_title()
	{
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'IMAGE'))
		{
			if (isset($return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss092', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss092']['TITLE'][0]['data']))
			{
				return $return[0]['child']['rss092']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss091', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss091']['TITLE'][0]['data']))
			{
				return $return[0]['child']['rss091']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data'];
			}
		}
		if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'IMAGE', false))
		{
			if (isset($return[0]['child']['HTTP://PURL.ORG/RSS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/RSS/1.0/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data'];
			}
		}
		if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'IMAGE', false))
		{
			if (isset($return[0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss_unknown', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss_unknown']['TITLE'][0]['data']))
			{
				return $return[0]['child']['rss_unknown']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.1/']['TITLE'][0]['data'];
			}
			else if (isset($return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/DC/ELEMENTS/1.0/']['TITLE'][0]['data'];
			}
		}
		return true;
	}

	function get_image_url()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LOGO'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ICON'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'LOGO'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'ICON'))
		{
			return $return[0]['data'];
		}
		else
		{
			if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'IMAGE'))
			{
				if (isset($return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL'][0]['data']))
				{
					return $return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL'][0]['data'];
				}
			}
			if ($return = $this->get_tags('rss092', 'IMAGE'))
			{
				if (isset($return[0]['child']['rss092']['URL'][0]['data']))
				{
					return $return[0]['child']['rss092']['URL'][0]['data'];
				}
			}
			if ($return = $this->get_tags('rss091', 'IMAGE'))
			{
				if (isset($return[0]['child']['rss091']['URL'][0]['data']))
				{
					return $return[0]['child']['rss091']['URL'][0]['data'];
				}
			}
			if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'IMAGE', false))
			{
				if (isset($return[0]['child']['HTTP://PURL.ORG/RSS/1.0/']['URL'][0]['data']))
				{
					return $return[0]['child']['HTTP://PURL.ORG/RSS/1.0/']['URL'][0]['data'];
				}
			}
			if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'IMAGE', false))
			{
				if (isset($return[0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['URL'][0]['data']))
				{
					return $return[0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['URL'][0]['data'];
				}
			}
			if ($return = $this->get_tags('rss_unknown', 'IMAGE'))
			{
				if (isset($return[0]['child']['rss_unknown']['URL'][0]['data']))
				{
					return $return[0]['child']['rss_unknown']['URL'][0]['data'];
				}
			}
			return false;
		}
	}

	function get_image_link()
	{
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'IMAGE'))
		{
			if (isset($return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['LINK'][0]['data']))
			{
				return $return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['LINK'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss092', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss092']['LINK'][0]['data']))
			{
				return $return[0]['child']['rss092']['LINK'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss091', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss091']['LINK'][0]['data']))
			{
				return $return[0]['child']['rss091']['LINK'][0]['data'];
			}
		}
		if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'IMAGE', false))
		{
			if (isset($return[0]['child']['HTTP://PURL.ORG/RSS/1.0/']['LINK'][0]['data']))
			{
				return $return[0]['child']['HTTP://PURL.ORG/RSS/1.0/']['LINK'][0]['data'];
			}
		}
		if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'IMAGE', false))
		{
			if (isset($return[0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['LINK'][0]['data']))
			{
				return $return[0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['LINK'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss_unknown', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss_unknown']['LINK'][0]['data']))
			{
				return $return[0]['child']['rss_unknown']['LINK'][0]['data'];
			}
		}
		return false;
	}

	function get_image_width()
	{
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'IMAGE'))
		{
			if (isset($return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['WIDTH'][0]['data']))
			{
				return $return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['WIDTH'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss092', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss092']['WIDTH'][0]['data']))
			{
				return $return[0]['child']['rss092']['WIDTH'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss091', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss091']['WIDTH'][0]['data']))
			{
				return $return[0]['child']['rss091']['WIDTH'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss_unknown', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss_unknown']['WIDTH'][0]['data']))
			{
				return $return[0]['child']['rss_unknown']['WIDTH'][0]['data'];
			}
		}
		if (isset($this->data['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['CHANNEL'][0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['IMAGE'][0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL'][0]['data']) || isset($this->data['child']['rss092']['CHANNEL'][0]['child']['rss092']['IMAGE'][0]['child']['rss092']['URL'][0]['data']) || isset($this->data['child']['rss091']['CHANNEL'][0]['child']['rss091']['IMAGE'][0]['child']['rss091']['URL'][0]['data']) || isset($this->data['child']['rss_unknown']['CHANNEL'][0]['child']['rss_unknown']['IMAGE'][0]['child']['rss_unknown']['URL'][0]['data']))
		{
			return 88;
		}
		else
		{
			return false;
		}
	}

	function get_image_height()
	{
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'IMAGE'))
		{
			if (isset($return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['HEIGHT'][0]['data']))
			{
				return $return[0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['HEIGHT'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss092', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss092']['HEIGHT'][0]['data']))
			{
				return $return[0]['child']['rss092']['HEIGHT'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss091', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss091']['HEIGHT'][0]['data']))
			{
				return $return[0]['child']['rss091']['HEIGHT'][0]['data'];
			}
		}
		if ($return = $this->get_tags('rss_unknown', 'IMAGE'))
		{
			if (isset($return[0]['child']['rss_unknown']['HEIGHT'][0]['data']))
			{
				return $return[0]['child']['rss_unknown']['HEIGHT'][0]['data'];
			}
		}
		if (isset($this->data['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['CHANNEL'][0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['IMAGE'][0]['child']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL'][0]['data']) || isset($this->data['child']['rss092']['CHANNEL'][0]['child']['rss092']['IMAGE'][0]['child']['rss092']['URL'][0]['data']) || isset($this->data['child']['rss091']['CHANNEL'][0]['child']['rss091']['IMAGE'][0]['child']['rss091']['URL'][0]['data']) || isset($this->data['child']['rss_unknown']['CHANNEL'][0]['child']['rss_unknown']['IMAGE'][0]['child']['rss_unknown']['URL'][0]['data']))
		{
			return 31;
		}
		else
		{
			return false;
		}
	}

	function get_item_quantity($max = 0)
	{
		$qty = count($this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ENTRY')) + count($this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'ENTRY')) + count($this->get_tags('atom_unknown', 'ENTRY')) + count($this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'ITEM')) + count($this->get_tags('rss092', 'ITEM')) + count($this->get_tags('rss091', 'ITEM')) + count($this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'ITEM')) + count($this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'ITEM')) + count($this->get_tags('rss_unknown', 'ITEM'));
		if ($max == 0)
		{
			return $qty;
		}
		else
		{
			return ($qty > $max) ? $max : $qty;
		}
	}

	function get_item($key = 0)
	{
		$items = $this->get_items();
		if (isset($items[$key]))
		{
			return $items[$key];
		}
		else
		{
			return false;
		}
	}

	function get_items($start = 0, $end = 0)
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ENTRY'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'ENTRY'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('atom_unknown', 'ENTRY'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'ITEM'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('rss092', 'ITEM'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('rss091', 'ITEM'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'ITEM', false))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'ITEM', false))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('rss_unknown', 'ITEM'))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}
		if ($return = $this->get_tags('rss_unknown', 'ITEM', false))
		{
			$keys = array_keys($return);
			foreach ($keys as $key)
			{
				$items[] = new $this->item_class($this, $return[$key], $this->author_class, $this->enclosure_class, $this->javascript);
			}
		}

		if (!empty($items))
		{
			// If we want to order it by date, check if all items have a date, and then sort it
			if ($this->order_by_date)
			{
				$do_sort = true;
				foreach ($items as $item)
				{
					if (!$item->get_date('U'))
					{
						$do_sort = false;
						break;
					}
				}
				$item = null;
				if ($do_sort)
				{
					usort($items, create_function('$a, $b', 'if ($a->get_date(\'U\') == $b->get_date(\'U\')) return 1; return ($a->get_date(\'U\') < $b->get_date(\'U\')) ? 1 : -1;'));
				}
			}

			// Slice the data as desired
			if ($end == 0)
			{
				return array_slice($items, $start);
			}
			else
			{
				return array_slice($items, $start, $end);
			}
		}
		else
		{
			return array();
		}
	}
}

class SimplePie_Item
{
	var $feed;
	var $feed_link;
	var $feed_url;
	var $author_class = 'SimplePie_Author';
	var $enclosure_class = 'SimplePie_Enclosure';
	var $javascript = 'js';
	var $data = array();

	function SimplePie_Item($feed, $data, $author_class, $enclosure_class, $javascript)
	{
		$this->feed = $feed;
		$this->data = $data;
		$this->feed_link = $feed->get_feed_link();
		$this->feed_url = $feed->subscribe_url();
		$this->author_class = $author_class;
		$this->enclosure_class = $enclosure_class;
		$this->javascript = $javascript;
	}

	function get_tags($namespace, $tag)
	{
		if (isset($this->data['child'][$namespace][$tag]))
		{
			return $this->data['child'][$namespace][$tag];
		}
		else
		{
			return null;
		}
	}

	function get_id()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ID'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'ID'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'ID'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'GUID'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'GUID'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'IDENTIFIER'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'IDENTIFIER'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_title()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'TITLE'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_description()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'SUMMARY'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'SUMMARY'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'SUMMARY'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'CONTENT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'CONTENT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'CONTENT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/MODULES/CONTENT/', 'ENCODED'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_content()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'CONTENT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'CONTENT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'CONTENT'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/MODULES/CONTENT/', 'ENCODED'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'SUMMARY'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'SUMMARY'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'SUMMARY'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss092', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss091', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DESCRIPTION'))
		{
			return $return[0]['data'];
		}
		else
		{
			return false;
		}
	}

	function get_category($key = 0)
	{
		$categories = $this->get_categories();
		if (!empty($categories[$key]))
		{
			return $categories[$key];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Properly deal with the output encoding (attributes are in their original UTF-8 form)
	 */
	function get_categories()
	{
		$categories = array();
		foreach ((array) $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'CATEGORY') as $category)
		{
			if (isset($category['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['LABEL']))
			{
				$categories[] = htmlspecialchars($category['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['LABEL'], ENT_COMPAT, 'UTF-8');
			}
			else if (isset($category['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['TERM']))
			{
				$categories[] = htmlspecialchars($category['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['TERM'], ENT_COMPAT, 'UTF-8');
			}
		}
		if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'CATEGORY'))
		{
			$categories[] = $return[0]['data'];
		}
		if ($return = $this->get_tags('rss092', 'CATEGORY'))
		{
			$categories[] = $return[0]['data'];
		}
		if ($return = $this->get_tags('rss_unknown', 'CATEGORY'))
		{
			$categories[] = $return[0]['data'];
		}
		foreach ((array) $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'SUBJECT') as $category)
		{
			$categories[] = $category['data'];
		}
		foreach ((array) $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'SUBJECT') as $category)
		{
			$categories[] = $category['data'];
		}
		if (!empty($categories))
		{
			return array_unique($categories);
		}
		else
		{
			return false;
		}
	}

	function get_author($key = 0)
	{
		$authors = $this->get_authors();
		if (!empty($authors[$key]))
		{
			return $authors[$key];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Atom inheritance (item author, source author, feed author)
	 */
	function get_authors()
	{
		$authors = array();
		foreach ((array) $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'AUTHOR') as $author)
		{
			$name = null;
			$uri = null;
			$email = null;
			if (isset($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['NAME'][0]['data']))
			{
				$name = $author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['NAME'][0]['data'];
			}
			if (isset($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['URI'][0]['data']))
			{
				$uri = $author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['URI'][0]['data'];
			}
			if (isset($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['EMAIL'][0]['data']))
			{
				$email = $author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['EMAIL'][0]['data'];
			}
			if (!is_null($name) || !is_null($email) || !is_null($uri))
			{
				$authors[] = new $this->author_class($name, $uri, $email);
			}
		}
		if ($author = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'AUTHOR'))
		{
			$name = null;
			$url = null;
			$email = null;
			if (isset($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['NAME'][0]['data']))
			{
				$name = $author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['NAME'][0]['data'];
			}
			if (isset($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['URL'][0]['data']))
			{
				$url = $author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['URL'][0]['data'];
			}
			if (isset($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['EMAIL'][0]['data']))
			{
				$email = $author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['EMAIL'][0]['data'];
			}
			if (!is_null($name) || !is_null($email) || !is_null($url))
			{
				$authors[] = new $this->author_class($name, $url, $email);
			}
		}
		foreach ((array) $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'CREATOR') as $author)
		{
			$authors[] = new $this->author_class($author['data'], null, null);
		}
		foreach ((array) $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'CREATOR') as $author)
		{
			$authors[] = new $this->author_class($author['data'], null, null);
		}
		if (!empty($authors))
		{
			return array_unique($authors);
		}
		else
		{
			return false;
		}
	}

	function get_date($date_format = 'j F Y, g:i a')
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'PUBLISHED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'UPDATED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'ISSUED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'CREATED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'MODIFIED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'PUBLISHED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'UPDATED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'ISSUED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'CREATED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('atom_unknown', 'MODIFIED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'PUBDATE'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('rss_unknown', 'PUBDATE'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DATE'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DATE'))
		{
			$date = $return[0]['data'];
		}
		else
		{
			return false;
		}
		if (!$date_format)
		{
			return $date;
		}
		else
		{
			$date = SimplePie_Misc::parse_date($date);
			if ($date_format == 'U')
			{
				return $date;
			}
			else
			{
				return date($date_format, $date);
			}
		}
	}

	function get_permalink()
	{
		$link = $this->get_link(0);
		$enclosure = $this->get_enclosure(0);
		if (!empty($link))
		{
			return $link;
		}
		else if (!empty($enclosure))
		{
			return $enclosure->get_link();
		}
		else
		{
			return false;
		}
	}

	function get_link($key = 0, $rel = 'alternate')
	{
		$links = $this->get_links($rel);
		if (!empty($links[$key]))
		{
			return $links[$key];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Properly deal with the output encoding (attributes are in their original UTF-8 form)
	 */
	function get_links($rel = 'alternate')
	{
		if (empty($this->data['links']))
		{
			$this->data['links'] = array();
			if (!($base = $this->feed_link))
			{
				$base = $this->feed_url;
			}
			foreach ((array) $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LINK') as $link)
			{
				if (isset($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF']))
				{
					$link_rel = (isset($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['REL'])) ? $link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['REL'] : 'alternate';
					if ($link['xml_base_explicit'])
					{
						$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF'], $link['xml_base']);
					}
					else
					{
						$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF'], $base);
					}
				}
			}
			foreach ((array) $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'LINK') as $link)
			{
				if (isset($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF']))
				{
					$link_rel = (isset($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['REL'])) ? $link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['REL'] : 'alternate';
					if ($link['xml_base_explicit'])
					{
						$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF'], $link['xml_base']);
					}
					else
					{
						$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF'], $base);
					}
				}
			}
			foreach ((array) $this->get_tags('atom_unknown', 'LINK') as $link)
			{
				if (isset($link['attribs']['atom_unknown']['HREF']))
				{
					$link_rel = (isset($link['attribs']['atom_unknown']['REL'])) ? $link['attribs']['atom_unknown']['REL'] : 'alternate';
					if ($link['xml_base_explicit'])
					{
						$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['atom_unknown']['HREF'], $link['xml_base']);
					}
					else
					{
						$this->data['links'][$link_rel][] = SimplePie_Misc::absolutize_url($link['attribs']['atom_unknown']['HREF'], $base);
					}
				}
			}
			if ($links = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('rss092', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('rss091', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('HTTP://PURL.ORG/RSS/1.0/', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('rss_unknown', 'LINK'))
			{
				if ($links[0]['xml_base_explicit'])
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
				}
				else
				{
					$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
				}
			}
			if ($links = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'GUID'))
			{
				if (!isset($links[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['ISPERMALINK']) || strtolower($links[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['ISPERMALINK'] == 'true'))
				{
					if ($links[0]['xml_base_explicit'])
					{
						$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
					}
					else
					{
						$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
					}
				}
			}
			if ($links = $this->get_tags('rss_unknown', 'GUID'))
			{
				if (!isset($links[0]['attribs']['rss_unknown']['ISPERMALINK']) || strtolower($links[0]['attribs']['rss_unknown']['ISPERMALINK'] == 'true'))
				{
					if ($links[0]['xml_base_explicit'])
					{
						$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $links[0]['xml_base']);
					}
					else
					{
						$this->data['links']['alternate'][] = SimplePie_Misc::absolutize_url(SimplePie_Misc::htmlspecialchars_decode($links[0]['data'], ENT_QUOTES), $base);
					}
				}
			}
			$keys = array_keys($this->data['links']);
			foreach ($keys as $key)
			{
				$this->data['links'][$key] = array_unique($this->data['links'][$key]);
			}
		}
		if (!empty($this->data['links'][$rel]))
		{
			return $this->data['links'][$rel];
		}
		else
		{
			return false;
		}
	}

	function get_enclosure($key = 0)
	{
		$enclosures = $this->get_enclosures();
		if (!empty($enclosures[$key]))
		{
			return $enclosures[$key];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Properly deal with the output encoding (attributes are in their original UTF-8 form)
	 */
	function get_enclosures()
	{
		if (empty($this->data['enclosures']))
		{
			$this->data['enclosures'] = array();
			if (!($base = $this->feed_link))
			{
				$base = $this->feed_url;
			}
			foreach ((array) $this->get_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LINK') as $link)
			{
				if (!empty($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF']) && !empty($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['REL']) && $link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['REL'] == 'enclosure')
				{
					$url = null;
					$type = null;
					$length = null;
					if ($link['xml_base_explicit'])
					{
						$url = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF'], $link['xml_base']);
					}
					else
					{
						$url = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['HREF'], $base);
					}
					if (!empty($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['TYPE']))
					{
						$type = $link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['TYPE'];
					}
					if (!empty($link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['LENGTH']))
					{
						$length = $link['attribs']['HTTP://WWW.W3.ORG/2005/ATOM']['LENGTH'];
					}
					$this->data['enclosures'][] = new $this->enclosure_class($url, $type, $length, $this->javascript);
				}
			}
			foreach ((array) $this->get_tags('HTTP://PURL.ORG/ATOM/NS#', 'LINK') as $link)
			{
				if (!empty($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF']) && !empty($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['REL']) && $link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['REL'] == 'enclosure')
				{
					$url = null;
					$type = null;
					$length = null;
					if ($link['xml_base_explicit'])
					{
						$url = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF'], $link['xml_base']);
					}
					else
					{
						$url = SimplePie_Misc::absolutize_url($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['HREF'], $base);
					}
					if (!empty($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['TYPE']))
					{
						$type = $link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['TYPE'];
					}
					if (!empty($link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['LENGTH']))
					{
						$length = $link['attribs']['HTTP://PURL.ORG/ATOM/NS#']['LENGTH'];
					}
					$this->data['enclosures'][] = new $this->enclosure_class($url, $type, $length, $this->javascript);
				}
			}
			foreach ((array) $this->get_tags('atom_unknown', 'LINK') as $link)
			{
				if (!empty($link['attribs']['atom_unknown']['HREF']) && !empty($link['attribs']['atom_unknown']['REL']) && $link['attribs']['atom_unknown']['REL'] == 'enclosure')
				{
					$url = null;
					$type = null;
					$length = null;
					if ($link['xml_base_explicit'])
					{
						$url = SimplePie_Misc::absolutize_url($link['attribs']['atom_unknown']['HREF'], $link['xml_base']);
					}
					else
					{
						$url = SimplePie_Misc::absolutize_url($link['attribs']['atom_unknown']['HREF'], $base);
					}
					if (!empty($link['attribs']['atom_unknown']['TYPE']))
					{
						$type = $link['attribs']['atom_unknown']['TYPE'];
					}
					if (!empty($link['attribs']['atom_unknown']['LENGTH']))
					{
						$length = $link['attribs']['atom_unknown']['LENGTH'];
					}
					$this->data['enclosures'][] = new $this->enclosure_class($url, $type, $length, $this->javascript);
				}
			}
			if ($enclosure = $this->get_tags('HTTP://BACKEND.USERLAND.COM/RSS2', 'ENCLOSURE'))
			{
				if (isset($enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL']))
				{
					$url = null;
					$type = null;
					$length = null;
					if ($enclosure[0]['xml_base_explicit'])
					{
						$url = SimplePie_Misc::absolutize_url($enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL'], $enclosure[0]['xml_base']);
					}
					else
					{
						$url = SimplePie_Misc::absolutize_url($enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['URL'], $base);
					}
					if (!empty($enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['TYPE']))
					{
						$type = $enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['TYPE'];
					}
					if (!empty($enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['LENGTH']))
					{
						$length = $enclosure[0]['attribs']['HTTP://BACKEND.USERLAND.COM/RSS2']['LENGTH'];
					}
					$this->data['enclosures'][] = new $this->enclosure_class($url, $type, $length, $this->javascript);
				}
			}
			if ($enclosure = $this->get_tags('rss_unknown', 'ENCLOSURE'))
			{
				if (isset($enclosure[0]['attribs']['rss_unknown']['URL']))
				{
					$url = null;
					$type = null;
					$length = null;
					if ($enclosure[0]['xml_base_explicit'])
					{
						$url = SimplePie_Misc::absolutize_url($enclosure[0]['attribs']['rss_unknown']['URL'], $enclosure[0]['xml_base']);
					}
					else
					{
						$url = SimplePie_Misc::absolutize_url($enclosure[0]['attribs']['rss_unknown']['URL'], $base);
					}
					if (!empty($enclosure[0]['attribs']['rss_unknown']['TYPE']))
					{
						$type = $enclosure[0]['attribs']['rss_unknown']['TYPE'];
					}
					if (!empty($enclosure[0]['attribs']['rss_unknown']['LENGTH']))
					{
						$length = $enclosure[0]['attribs']['rss_unknown']['LENGTH'];
					}
					$this->data['enclosures'][] = new $this->enclosure_class($url, $type, $length, $this->javascript);
				}
			}
			$this->data['enclosures'] = array_unique($this->data['enclosures']);
		}
		if (!empty($this->data['enclosures']))
		{
			return $this->data['enclosures'];
		}
		else
		{
			return false;
		}
	}

	function get_latitude()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2003/01/GEO/WGS84_POS#', 'LAT'))
		{
			return (float) $return[0]['data'];
		}
		else if (($return = $this->get_tags('HTTP://WWW.GEORSS.ORG/GEORSS', 'POINT')) && preg_match('/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/', $return[0]['data'], $match))
		{
			return (float) $match[1];
		}
		else
		{
			return false;
		}
    }

    function get_longitude()
	{
		if ($return = $this->get_tags('HTTP://WWW.W3.ORG/2003/01/GEO/WGS84_POS#', 'LONG'))
		{
			return (float) $return[0]['data'];
		}
		else if (($return = $this->get_tags('HTTP://WWW.GEORSS.ORG/GEORSS', 'POINT')) && preg_match('/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/', $return[0]['data'], $match))
		{
			return (float) $match[2];
		}
		else
		{
			return false;
		}
    }

	/**
	 * Creates the add_to_* methods' return data
	 *
	 * @access private
	 * @param string $feed_url String to prefix to the item permalink
	 * @param string $title_url String to prefix to the item title
	 * (and suffix to the item permalink)
	 * @return mixed URL if feed exists, false otherwise
	 */
	function add_to_service($feed_url, $title_url = '')
	{
		if ($this->get_permalink())
		{
			$return = $feed_url . rawurlencode($this->get_permalink());
			if (!empty($title_url) && $this->get_title())
			{
				$return .= $title_url . rawurlencode($this->get_title());
			}
			return $return;
		}
		else
		{
			return false;
		}
	}

	function add_to_blinklist()
	{
		return $this->add_to_service('http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Description=&amp;Url=', '&amp;Title=');
	}

	function add_to_blogmarks()
	{
		return $this->add_to_service('http://blogmarks.net/my/new.php?mini=1&amp;simple=1&amp;url=', '&amp;title=');
	}

	function add_to_delicious()
	{
		return $this->add_to_service('http://del.icio.us/post/?v=3&amp;url=', '&amp;title=');
	}

	function add_to_digg()
	{
		return $this->add_to_service('http://digg.com/submit?phase=2&amp;URL=');
	}

	function add_to_furl()
	{
		return $this->add_to_service('http://www.furl.net/storeIt.jsp?u=', '&amp;t=');
	}

	function add_to_magnolia()
	{
		return $this->add_to_service('http://ma.gnolia.com/bookmarklet/add?url=', '&amp;title=');
	}

	function add_to_myweb20()
	{
		return $this->add_to_service('http://myweb2.search.yahoo.com/myresults/bookmarklet?u=', '&amp;t=');
	}

	function add_to_newsvine()
	{
		return $this->add_to_service('http://www.newsvine.com/_wine/save?u=', '&amp;h=');
	}

	function add_to_reddit()
	{
		return $this->add_to_service('http://reddit.com/submit?url=', '&amp;title=');
	}

	function add_to_segnalo()
	{
		return $this->add_to_service('http://segnalo.com/post.html.php?url=', '&amp;title=');
	}

	function add_to_simpy()
	{
		return $this->add_to_service('http://www.simpy.com/simpy/LinkAdd.do?href=', '&amp;title=');
	}

	function add_to_smarking()
	{
		return $this->add_to_service('http://smarking.com/editbookmark/?url=');
	}

	function add_to_spurl()
	{
		return $this->add_to_service('http://www.spurl.net/spurl.php?v=3&amp;url=', '&amp;title=');
	}

	function add_to_wists()
	{
		return $this->add_to_service('http://wists.com/r.php?c=&amp;r=', '&amp;title=');
	}

	function search_technorati()
	{
		return $this->add_to_service('http://www.technorati.com/search/');
	}
}

class SimplePie_Author
{
	var $name;
	var $link;
	var $email;

	// Constructor, used to input the data
	function SimplePie_Author($name, $link, $email)
	{
		$this->name = $name;
		$this->link = $link;
		$this->email = $email;
	}

	function __toString()
	{
		return serialize(compact($this->name, $this->link, $this->email));
	}

	function get_name()
	{
		if (!empty($this->name))
		{
			return $this->name;
		}
		else
		{
			return false;
		}
	}

	function get_link()
	{
		if (!empty($this->link))
		{
			return $this->link;
		}
		else
		{
			return false;
		}
	}

	function get_email()
	{
		if (!empty($this->email))
		{
			return $this->email;
		}
		else
		{
			return false;
		}
	}
}

class SimplePie_Enclosure
{
	var $link;
	var $type;
	var $length;
	var $javascript;

	// Constructor, used to input the data
	function SimplePie_Enclosure($link, $type, $length, $javascript)
	{
		$this->link = $link;
		$this->type = $type;
		$this->length = $length;
		$this->javascript = $javascript;
		if (class_exists('idna_convert'))
		{
			$idn =& new idna_convert;
			$parsed = SimplePie_Misc::parse_url($link);
			$this->link = SimplePie_Misc::compress_parse_url($parsed['scheme'], $idn->encode($parsed['authority']), $parsed['path'], $parsed['query'], $parsed['fragment']);
		}
	}

	function __toString()
	{
		return serialize(compact($this->link, $this->type, $this->length));
	}

	function get_link()
	{
		if (!empty($this->link))
		{
			return $this->link;
		}
		else
		{
			return false;
		}
	}

	function get_extension()
	{
		if (!empty($this->link))
		{
			$url = parse_url($this->link);
			if (!empty($url['path']))
			{
				return pathinfo($url['path'], PATHINFO_EXTENSION);
			}
		}
		return false;
	}

	function get_type()
	{
		if (!empty($this->type))
		{
			return $this->type;
		}
		else
		{
			return false;
		}
	}

	function get_length()
	{
		if (!empty($this->length))
		{
			return $this->length;
		}
		else
		{
			return false;
		}
	}

	function get_size()
	{
		$length = $this->get_length();
		if (!empty($length))
		{
			return round($length/1048576, 2);
		}
		else
		{
			return false;
		}
	}

	function native_embed($options='')
	{
		return $this->embed($options, true);
	}

	function embed($options = '', $native = false)
	{
		// Set up defaults
		$audio = '';
		$video = '';
		$alt = '';
		$altclass = '';
		$loop = 'false';
		$width = 'auto';
		$height = 'auto';
		$bgcolor = '#ffffff';
		$mediaplayer = '';

		// Process options and reassign values as necessary
		if (is_array($options))
		{
			extract($options);
		}
		else
		{
			$options = explode(',', $options);
			foreach($options as $option)
			{
				$opt = explode(':', $option, 2);
				if (isset($opt[0], $opt[1]))
				{
					$opt[0] = trim($opt[0]);
					$opt[1] = trim($opt[1]);
					switch ($opt[0])
					{
						case 'audio':
							$audio = $opt[1];
							break;

						case 'video':
							$video = $opt[1];
							break;

						case 'alt':
							$alt = $opt[1];
							break;

						case 'altclass':
							$altclass = $opt[1];
							break;

						case 'loop':
							$loop = $opt[1];
							break;

						case 'width':
							$width = $opt[1];
							break;

						case 'height':
							$height = $opt[1];
							break;

						case 'bgcolor':
							$bgcolor = $opt[1];
							break;

						case 'mediaplayer':
							$mediaplayer = $opt[1];
							break;
					}
				}
			}
		}

		$type = strtolower($this->get_type());

		// If we encounter an unsupported mime-type, check the file extension and guess intelligently.
		if (!in_array($type, array('audio/3gpp', 'audio/3gpp2', 'audio/aac', 'audio/x-aac', 'audio/aiff', 'audio/x-aiff', 'audio/mid', 'audio/midi', 'audio/x-midi', 'audio/mpeg', 'audio/x-mpeg', 'audio/mp3', 'audio/x-mp3', 'audio/mp4', 'audio/m4a', 'audio/x-m4a', 'audio/wav', 'audio/x-wav', 'video/3gpp', 'video/3gpp2', 'video/flv', 'video/x-flv', 'video/m4v', 'video/x-m4v', 'video/mp4', 'video/mpeg', 'video/x-mpeg', 'video/quicktime', 'video/sd-video', 'application/x-shockwave-flash', 'application/futuresplash', 'application/asx', 'application/x-mplayer2', 'audio/x-ms-wma', 'audio/x-ms-wax', 'video/x-ms-asf-plugin', 'video/x-ms-asf', 'video/x-ms-wm', 'video/x-ms-wmv', 'video/x-ms-wvx')))
		{
			switch (strtolower($this->get_extension()))
			{
				// Audio mime-types
				case 'aac':
				case 'adts':
					$type = 'audio/acc';
					break;

				case 'aif':
				case 'aifc':
				case 'aiff':
				case 'cdda':
					$type = 'audio/aiff';
					break;

				case 'bwf':
					$type = 'audio/wav';
					break;

				case 'kar':
				case 'mid':
				case 'midi':
				case 'smf':
					$type = 'audio/midi';
					break;

				case 'm4a':
					$type = 'audio/x-m4a';
					break;

				case 'mp3':
				case 'swa':
					$type = 'audio/mp3';
					break;

				case 'wav':
					$type = 'audio/wav';
					break;

				case 'wax':
					$type = 'audio/x-ms-wax';
					break;

				case 'wma':
					$type = 'audio/x-ms-wma';
					break;

				// Video mime-types
				case '3gp':
				case '3gpp':
					$type = 'video/3gpp';
					break;

				case '3g2':
				case '3gp2':
					$type = 'video/3gpp2';
					break;

				case 'asf':
					$type = 'video/x-ms-asf';
					break;

				case 'flv':
					$type = 'video/x-flv';
					break;

				case 'm1a':
				case 'm1s':
				case 'm1v':
				case 'm15':
				case 'm75':
				case 'mp2':
				case 'mpa':
				case 'mpeg':
				case 'mpg':
				case 'mpm':
				case 'mpv':
					$type = 'video/mpeg';
					break;

				case 'm4v':
					$type = 'video/x-m4v';
					break;

				case 'mov':
				case 'qt':
					$type = 'video/quicktime';
					break;

				case 'mp4':
				case 'mpg4':
					$type = 'video/mp4';
					break;

				case 'sdv':
					$type = 'video/sd-video';
					break;

				case 'wm':
					$type = 'video/x-ms-wm';
					break;

				case 'wmv':
					$type = 'video/x-ms-wmv';
					break;

				case 'wvx':
					$type = 'video/x-ms-wvx';
					break;

				// Flash mime-types
				case 'spl':
					$type = 'application/futuresplash';
					break;

				case 'swf':
					$type = 'application/x-shockwave-flash';
					break;
			}
		}

		$mime = explode('/', $type, 2);
		$mime = $mime[0];

		// Process values for 'auto'
		if ($width == 'auto')
		{
			if ($mime == 'video')
			{
				$width = '320';
			}
			else
			{
				$width = '100%';
			}
		}

		if ($height == 'auto')
		{
			if ($mime == 'audio')
			{
				$height = 0;
			}
			else if ($mime == 'video')
			{
				$height = 240;
			}
			else
			{
				$height = 256;
			}
		}
		else
		{
			if ($mime == 'audio')
			{
				$height = 0;
			}
		}

		// Set proper placeholder value
		if ($mime == 'audio')
		{
			$placeholder = $audio;
		}
		else if ($mime == 'video')
		{
			$placeholder = $video;
		}

		$embed = '';

		// Make sure the JS library is included
		if (!$native)
		{
			static $javascript_outputted = null;
			if (!$javascript_outputted && $this->javascript)
			{
				$embed .= '<script type="text/javascript" src="?' . htmlspecialchars($this->javascript) . '"></script>';
				$javascript_outputted = true;
			}
		}

		// Odeo Feed MP3's
		if (substr(strtolower($this->get_link()), 0, 15) == 'http://odeo.com')
		{
			if ($native)
			{
				$embed .= '<embed src="http://odeo.com/flash/audio_player_fullsize.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" quality="high" width="440" height="80" wmode="transparent" allowScriptAccess="any" flashvars="valid_sample_rate=true&external_url=' . $this->get_link() . '"></embed>';
			}
			else
			{
				$embed .= '<script type="text/javascript">embed_odeo("' . $this->get_link() . '");</script>';
			}
		}

		// QuickTime 7 file types.  Need to test with QuickTime 6.
		// Only handle MP3's if the Flash Media Player is not present.
		else if (in_array($type, array('audio/3gpp', 'audio/3gpp2', 'audio/aac', 'audio/x-aac', 'audio/aiff', 'audio/x-aiff', 'audio/mid', 'audio/midi', 'audio/x-midi', 'audio/mpeg', 'audio/x-mpeg', 'audio/mp4', 'audio/m4a', 'audio/x-m4a', 'audio/wav', 'audio/x-wav', 'video/3gpp', 'video/3gpp2', 'video/m4v', 'video/x-m4v', 'video/mp4', 'video/mpeg', 'video/x-mpeg', 'video/quicktime', 'video/sd-video')) || (in_array($type, array('audio/mp3', 'audio/x-mp3')) && $mediaplayer == ''))
		{
			$height += 16;
			if ($native)
			{
				if ($placeholder != ""){
					$embed .= "<embed type=\"$type\" style=\"cursor:hand; cursor:pointer;\" href=\"" . $this->get_link() . "\" src=\"$placeholder\" width=\"$width\" height=\"$height\" autoplay=\"false\" target=\"myself\" controller=\"false\" loop=\"$loop\" scale=\"aspect\" bgcolor=\"$bgcolor\" pluginspage=\"http://www.apple.com/quicktime/download/\"></embed>";
				}
				else {
					$embed .= "<embed type=\"$type\" style=\"cursor:hand; cursor:pointer;\" src=\"" . $this->get_link() . "\" width=\"$width+\" height=\"$height\" autoplay=\"false\" target=\"myself\" controller=\"true\" loop=\"$loop\" scale=\"aspect\" bgcolor=\"$bgcolor\" pluginspage=\"http://www.apple.com/quicktime/download/\"></embed>";
				}
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_quicktime('$type', '$bgcolor', '$width', '$height', '" . $this->get_link() . "', '$placeholder', '$loop');</script>";
			}
		}

		// Flash
		else if (in_array($type, array('application/x-shockwave-flash', 'application/futuresplash')))
		{
			if ($native)
			{
				$embed .= "<embed src=\"" . $this->get_link() . "\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"$type\" quality=\"high\" width=\"$width\" height=\"$height\" bgcolor=\"$bgcolor\" loop=\"$loop\"></embed>";
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_flash('$bgcolor', '$width', '$height', '" . $this->get_link() . "', '$loop', '$type');</script>";
			}
		}

		// Flash Media Player file types.
		// Preferred handler for MP3 file types.
		else if (in_array($type, array('audio/mp3', 'audio/x-mp3', 'video/flv', 'video/x-flv')) && ($mediaplayer != ''))
		{
			$height += 20;
			if ($native)
			{
				$embed .= "<embed src=\"$mediaplayer\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" quality=\"high\" width=\"$width\" height=\"$height\" wmode=\"transparent\" flashvars=\"file=" . rawurlencode($this->get_link()) . "&autostart=false&repeat=$loop&showdigits=true&showfsbutton=false\"></embed>";
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_flv('$width', '$height', '" . rawurlencode($this->get_link()) . "', '$placeholder', '$loop', '$mediaplayer');</script>";
			}
		}

		// Windows Media
		else if (in_array($type, array('application/asx', 'application/x-mplayer2', 'audio/x-ms-wma', 'audio/x-ms-wax', 'video/x-ms-asf-plugin', 'video/x-ms-asf', 'video/x-ms-wm', 'video/x-ms-wmv', 'video/x-ms-wvx')))
		{
			$height += 45;
			if ($native)
			{
				$embed .= "<embed type=\"application/x-mplayer2\" src=\"" . $this->get_link() . "\" autosize=\"1\" width=\"$width\" height=\"$height\" showcontrols=\"1\" showstatusbar=\"0\" showdisplay=\"0\" autostart=\"0\"></embed>";
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_wmedia('$width', '$height', '" . $this->get_link() . "');</script>";
			}
		}

		// Everything else
		else $embed .= '<a href="' . $this->get_link() . '" class="' . $altclass . '">' . $alt . '</a>';

		return $embed;
	}
}

class SimplePie_File
{
	var $url;
	var $useragent;
	var $success = true;
	var $headers = array();
	var $body;
	var $fp;
	var $redirects = 0;
	var $error;
	var $method;

	function SimplePie_File($url, $timeout = 10, $redirects = 5, $headers = null, $useragent = null, $force_fsockopen = false)
	{
		if (class_exists('idna_convert'))
		{
			$idn =& new idna_convert;
			$parsed = SimplePie_Misc::parse_url($url);
			$url = SimplePie_Misc::compress_parse_url($parsed['scheme'], $idn->encode($parsed['authority']), $parsed['path'], $parsed['query'], $parsed['fragment']);
		}
		$this->url = $url;
		$this->useragent = $useragent;
		if (preg_match('/^http(s)?:\/\//i', $url))
		{
			if (empty($useragent))
			{
				$useragent = ini_get('user_agent');
				$this->useragent = $useragent;
			}
			if (!is_array($headers))
			{
				$headers = array();
			}
			if (extension_loaded('curl') && version_compare(SimplePie_Misc::get_curl_version(), '7.10.5', '>=') && !$force_fsockopen)
			{
				$this->method = 'curl';
				$fp = curl_init();
				$headers2 = array();
				foreach ($headers as $key => $value)
				{
					$headers2[] = "$key: $value";
				}
				curl_setopt($fp, CURLOPT_ENCODING, '');
				curl_setopt($fp, CURLOPT_URL, $url);
				curl_setopt($fp, CURLOPT_HEADER, 1);
				curl_setopt($fp, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($fp, CURLOPT_TIMEOUT, $timeout);
				curl_setopt($fp, CURLOPT_REFERER, $url);
				curl_setopt($fp, CURLOPT_USERAGENT, $useragent);
				curl_setopt($fp, CURLOPT_HTTPHEADER, $headers2);
				if (!ini_get('open_basedir') && !ini_get('safe_mode'))
				{
					curl_setopt($fp, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($fp, CURLOPT_MAXREDIRS, $redirects);
				}

				$this->headers = trim(curl_exec($fp));
				if (curl_errno($fp) == 23 || curl_errno($fp) == 61)
				{
					curl_setopt($fp, CURLOPT_ENCODING, 'none');
					$this->headers = trim(curl_exec($fp));
				}
				if (curl_errno($fp))
				{
					$this->error = 'cURL error ' . curl_errno($fp) . ': ' . curl_error($fp);
					$this->success = false;
				}
				else
				{
					$info = curl_getinfo($fp);
					curl_close($fp);
					$this->headers = explode("\r\n\r\n", $this->headers, $info['redirect_count'] + 2);
					if (count($this->headers) == $info['redirect_count'] + 1)
					{
						$this->headers = array_pop($this->headers);
						$this->body = '';
					}
					else
					{
						$this->body = array_pop($this->headers);
						$this->headers = array_pop($this->headers);
					}
					$this->headers = $this->parse_headers($this->headers);
					if (($this->headers['status']['code'] == 300 || $this->headers['status']['code'] == 301 || $this->headers['status']['code'] == 302 || $this->headers['status']['code'] == 303 || $this->headers['status']['code'] == 307 || $this->headers['status']['code'] > 307 && $this->headers['status']['code'] < 400) && !empty($this->headers['location']) && $this->redirects < $redirects)
					{
						$this->redirects++;
						return $this->SimplePie_File($this->headers['location'], $timeout, $redirects, $headers, $useragent, $force_fsockopen);
					}
				}
			}
			else
			{
				$this->method = 'fsockopen';
				$url_parts = parse_url($url);
				if (isset($url_parts['scheme']) && strtolower($url_parts['scheme']) == 'https')
				{
					$url_parts['host'] = "ssl://$url_parts[host]";
					$url_parts['port'] = 443;
				}
				if (!isset($url_parts['port']))
				{
					$url_parts['port'] = 80;
				}
				$this->fp = fsockopen($url_parts['host'], $url_parts['port'], $errno, $errstr, $timeout);
				if (!$this->fp)
				{
					$this->error = 'fsockopen error: ' . $errstr;
					$this->success = false;
				}
				else
				{
					stream_set_timeout($this->fp, $timeout);
					$get = (isset($url_parts['query'])) ? "$url_parts[path]?$url_parts[query]" : $url_parts['path'];
					$out = "GET $get HTTP/1.0\r\n";
					$out .= "Host: $url_parts[host]\r\n";
					$out .= "User-Agent: $useragent\r\n";
					if (function_exists('gzinflate'))
					{
						$out .= "Accept-Encoding: gzip,deflate\r\n";
					}

					if (!empty($url_parts['user']) && !empty($url_parts['pass']))
					{
						$out .= "Authorization: Basic " . base64_encode("$url_parts[user]:$url_parts[pass]") . "\r\n";
					}
					foreach ($headers as $key => $value)
					{
						$out .= "$key: $value\r\n";
					}
					$out .= "Connection: Close\r\n\r\n";
					fwrite($this->fp, $out);

					$info = stream_get_meta_data($this->fp);
					$data = '';
					while (strpos($data, "\r\n\r\n") === false && !$info['timed_out'])
					{
						$data .= fgets($this->fp, 1160);
						$info = stream_get_meta_data($this->fp);
					}
					if (!$info['timed_out'])
					{
						$this->headers = $this->parse_headers($data);
						if (($this->headers['status']['code'] == 300 || $this->headers['status']['code'] == 301 || $this->headers['status']['code'] == 302 || $this->headers['status']['code'] == 303 || $this->headers['status']['code'] == 307 || $this->headers['status']['code'] > 307 && $this->headers['status']['code'] < 400) && !empty($this->headers['location']) && $this->redirects < $redirects)
						{
							$this->redirects++;
							return $this->SimplePie_File($this->headers['location'], $timeout, $redirects, $headers, $useragent, $force_fsockopen);
						}
						$this->body = '';
						while (!$info['eof'] && !$info['timed_out'])
						{
							$this->body .= fread($this->fp, 1160);
							$info = stream_get_meta_data($this->fp);
						}
						if (!$info['timed_out'])
						{
							$this->body = trim($this->body);
							if (!empty($this->headers['content-encoding']) && ($this->headers['content-encoding'] == 'gzip' || $this->headers['content-encoding'] == 'deflate'))
							{
								if (substr($this->body, 0, 8) == "\x1f\x8b\x08\x00\x00\x00\x00\x00")
								{
									$this->body = substr($this->body, 10);
								}
								$this->body = gzinflate($this->body);
							}
						}
						else
						{
							$this->body = null;
						}
					}
					else
					{
						$this->error = 'fsocket timed out';
						$this->success = false;
					}
					fclose($fp);
				}
			}
		}
		else
		{
			$this->method = 'file_get_contents';
			if (!$this->body = file_get_contents($url))
			{
				$this->error = 'file_get_contents could not read the file';
				$this->success = false;
			}
		}
	}

	function headers()
	{
		if (!is_null($this->headers))
		{
			return $this->headers;
		}
		else
		{
			return false;
		}
	}

	function body()
	{
		if (!is_null($this->body))
		{
			return $this->body;
		}
		else
		{
			return false;
		}
	}

	function parse_headers($headers)
	{
		$headers = explode("\r\n", trim($headers));
		$status = array_shift($headers);
		foreach ($headers as $header)
		{
			$data = explode(':', $header, 2);
			$head[strtolower(trim($data[0]))] = preg_replace("/(\r\n)?[\x09\x20]+/", '', $data[1]);
		}
		if (preg_match('/HTTP\/[0-9\.]+ ([0-9]+)(.*)$/i', $status, $matches))
		{
			if (isset($head['status']))
			{
				unset($head['status']);
			}
			$head['status']['code'] = $matches[1];
			$head['status']['name'] = trim($matches[2]);
		}
		return $head;
	}
}

class SimplePie_Cache
{
	var $location;
	var $filename;
	var $extension;
	var $name;

	function SimplePie_Cache($location, $filename, $extension)
	{
		$this->location = $location;
		$this->filename = rawurlencode($filename);
		$this->extension = rawurlencode($extension);
		$this->name = "$location/$this->filename.$this->extension";
	}

	function save($data)
	{
		if (file_exists($this->name) && is_writeable($this->name) || file_exists($this->location) && is_writeable($this->location))
		{
			$fp = fopen($this->name, 'w');
			if ($fp)
			{
				fwrite($fp, serialize($data));
				fclose($fp);
				return true;
			}
		}
		return false;
	}

	function load()
	{
		if (file_exists($this->name) && is_readable($this->name))
		{
			return unserialize(file_get_contents($this->name));
		}
		return false;
	}

	function mtime()
	{
		if (file_exists($this->name))
		{
			return filemtime($this->name);
		}
		return false;
	}

	function touch()
	{
		if (file_exists($this->name))
		{
			return touch($this->name);
		}
		return false;
	}

	function unlink()
	{
		if (file_exists($this->name))
		{
			return unlink($this->name);
		}
		return false;
	}
}

class SimplePie_Misc
{
	function absolutize_url($relative, $base)
	{
		if (!empty($relative))
		{
			$relative = SimplePie_Misc::parse_url($relative);
			if (!empty($relative['scheme']))
			{
				$target = $relative;
			}
			else if (!empty($base))
			{
				$base = SimplePie_Misc::parse_url($base);
				$target = SimplePie_Misc::parse_url('');
				if (!empty($relative['authority']))
				{
					$target = $relative;
					$target['scheme'] = $base['scheme'];
				}
				else
				{
					$target['scheme'] = $base['scheme'];
					$target['authority'] = $base['authority'];
					if (!empty($relative['path']))
					{
						if (strpos($relative['path'], '/') === 0)
						{
							$target['path'] = $relative['path'];
						}
						else
						{
							if (($target['path'] = dirname("$base[path].")) == '/')
							{
								$target['path'] .= $relative['path'];
							}
							else
							{
								$target['path'] .= '/' . $relative['path'];
							}
						}
						if (!empty($relative['query']))
						{
							$target['query'] = $relative['query'];
						}
					}
					else
					{
						if (!empty($base['path']))
						{
							$target['path'] = $base['path'];
						}
						else
						{
							$target['path'] = '/';
						}
						if (!empty($relative['query']))
						{
							$target['query'] = $relative['query'];
						}
						else if (!empty($base['query']))
						{
							$target['query'] = $base['query'];
						}
					}
				}
				if (!empty($relative['fragment']))
				{
					$target['fragment'] = $relative['fragment'];
				}
			}
			else
			{
				// No base URL, just return the relative URL
				$target = $relative;
			}
			$return = SimplePie_Misc::compress_parse_url($target['scheme'], $target['authority'], $target['path'], $target['query'], $target['fragment']);
		}
		else
		{
			$return = $base;
		}
		$return = SimplePie_Misc::normalize_url($return);
		return $return;
	}

	function remove_dot_segments($input)
	{
		if (strpos($input, '.') !== false)
		{
			$output = '';
			while (!empty($input))
			{
				// A: If the input buffer begins with a prefix of "../" or "./", then remove that prefix from the input buffer; otherwise,
				if (strpos($input, '../') === 0)
				{
					$input = substr($input, 3);
				}
				else if (strpos($input, './') === 0)
				{
					$input = substr($input, 2);
				}
				// B: if the input buffer begins with a prefix of "/./" or "/.", where "." is a complete path segment, then replace that prefix with "/" in the input buffer; otherwise,
				else if (strpos($input, '/./') === 0)
				{
					$input = substr_replace($input, '/', 0, 3);
				}
				else if ($input == '/.')
				{
					$input = '/';
				}
				// C: if the input buffer begins with a prefix of "/../" or "/..", where ".." is a complete path segment, then replace that prefix with "/" in the input buffer and remove the last segment and its preceding "/" (if any) from the output buffer; otherwise,
				else if (strpos($input, '/../') === 0)
				{
					$input = substr_replace($input, '/', 0, 4);
					$output = preg_replace('/(\/)?([^\/]+)$/U', '', $output);
				}
				else if ($input == '/..')
				{
					$input = '/';
					$output = preg_replace('/(\/)?([^\/]+)$/U', '', $output);
				}
				// D: if the input buffer consists only of "." or "..", then remove that from the input buffer; otherwise,
				else if ($input == '.' || $input == '..')
				{
					$input = '';
				}
				// E: move the first path segment in the input buffer to the end of the output buffer, including the initial "/" character (if any) and any subsequent characters up to, but not including, the next "/" character or the end of the input buffer
				else
				{
					if (preg_match('/^([^\/]+|(\/)[^\/]*)(\/|$)/', $input, $match))
					{
						$output .= $match[1];
						$input = substr_replace($input, '', 0, strlen($match[1]));
					}
					else
					{
						// We've ended up in a recursive loop, so do what we otherwise never will: return false.
						return false;
					}
				}
			}
			return $output;
		}
		else
		{
			return $input;
		}
	}

	function get_element($realname, $string)
	{
		$return = array();
		$name = preg_quote($realname, '/');
		if (preg_match_all("/<($name)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(>(.*)<\/$name>|(\/)?>)/siU", $string, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE))
		{
			$total_matches = count($matches);
			for ($i = 0; $i < $total_matches; $i++)
			{
				$return[$i]['tag'] = $realname;
				$return[$i]['full'] = $matches[$i][0][0];
				$return[$i]['offset'] = $matches[$i][0][1];
				if (strlen($matches[$i][3][0]) <= 2)
				{
					$return[$i]['self_closing'] = true;
				}
				else
				{
					$return[$i]['self_closing'] = false;
					$return[$i]['content'] = $matches[$i][4][0];
				}
				$return[$i]['attribs'] = array();
				if (!empty($matches[$i][2][0]) && preg_match_all('/((?:[^\s:]+:)?[^\s:]+)(?:\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([a-z0-9\-._:]*)))?\s/U', ' ' . $matches[$i][2][0] . ' ', $attribs, PREG_SET_ORDER))
				{
					$total_attribs = count($attribs);
					for ($j = 0; $j < $total_attribs;  $j++)
					{
						if (count($attribs[$j]) == 2)
						{
							$attribs[$j][2] = $attribs[$j][1];
						}
						$return[$i]['attribs'][strtoupper($attribs[$j][1])]['data'] = SimplePie_Misc::entities_decode($attribs[$j][count($attribs[$j])-1], 'UTF-8');
					}
				}
			}
		}
		return $return;
	}

	function element_implode($element)
	{
		$full = "<$element[tag]";
		foreach ($element['attribs'] as $key => $value)
		{
			$key = strtolower($key);
			$full .= " $key=\"" . htmlspecialchars($value['data']) . '"';
		}
		if ($element['self_closing'])
		{
			$full .= ' />';
		}
		else
		{
			$full .= ">$element[content]</$element[tag]>";
		}
		return $full;
	}

	function error($message, $level, $file, $line)
	{
		switch ($level)
		{
			case E_USER_ERROR:
				$note = 'PHP Error';
				break;
			case E_USER_WARNING:
				$note = 'PHP Warning';
				break;
			case E_USER_NOTICE:
				$note = 'PHP Notice';
				break;
			default:
				$note = 'Unknown Error';
				break;
		}
		error_log("$note: $message in $file on line $line", 0);
		return $message;
	}

	function display_file($url, $timeout = 10, $useragent = null)
	{
		$file =& new SimplePie_File($url, $timeout, 5, array('X-FORWARDED-FOR' => $_SERVER['REMOTE_ADDR']), $useragent);
		$headers = $file->headers();
		if ($file->body() !== false)
		{
			header('Content-type: ' . $headers['content-type']);
			echo $file->body();
			exit;
		}
	}

	function fix_protocol($url, $http = 1)
	{
		$url = SimplePie_Misc::normalize_url($url);
		$parsed = SimplePie_Misc::parse_url($url);
		if (!empty($parsed['scheme']) && !preg_match('/^http(s)?$/i', $parsed['scheme']))
		{
			return SimplePie_Misc::fix_protocol(SimplePie_Misc::compress_parse_url('http', $parsed['authority'], $parsed['path'], $parsed['query'], $parsed['fragment']), $http);
		}
		if (!file_exists($url) && empty($parsed['scheme']))
		{
			return SimplePie_Misc::fix_protocol("http://$url", $http);
		}

		if ($http == 2 && !empty($parsed['scheme']))
		{
			return "feed:$url";
		}
		else if ($http == 3 && strtolower($parsed['scheme']) == 'http')
		{
			return substr_replace($url, 'podcast', 0, 4);
		}
		else
		{
			return $url;
		}
	}

	function parse_url($url)
	{
		if (preg_match('/^(([^:\/?#]+):)?(\/\/([^\/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?$/', $url, $match))
		{
			for ($i = count($match); $i <= 9; $i++)
			{
				if (!isset($match[$i]))
				{
					$match[$i] = '';
				}
			}
			return array('scheme' => $match[2], 'authority' => $match[4], 'path' => $match[5], 'query' => $match[7], 'fragment' => $match[9]);
		}
		else
		{
			return array('scheme' => '', 'authority' => '', 'path' => '', 'query' => '', 'fragment' => '');
		}
	}

	function compress_parse_url($scheme = '', $authority = '', $path = '', $query = '', $fragment = '')
	{
		$return = '';
		if (!empty($scheme))
		{
			$return .= "$scheme:";
		}
		if (!empty($authority))
		{
			$return .= "//$authority";
		}
		if (!empty($path))
		{
			$return .= $path;
		}
		if (!empty($query))
		{
			$return .= "?$query";
		}
		if (!empty($fragment))
		{
			$return .= "#$fragment";
		}
		return $return;
	}

	function normalize_url($url)
	{
		$url = preg_replace_callback('/%([0-9a-f]{2})/i', array('SimplePie_Misc', 'percent_encoding_normalization'), $url);
		$url = SimplePie_Misc::parse_url($url);
		$url['scheme'] = strtolower($url['scheme']);
		if (!empty($url['authority']))
		{
			$url['authority'] = strtolower($url['authority']);
			$url['path'] = SimplePie_Misc::remove_dot_segments($url['path']);
		}
		return SimplePie_Misc::compress_parse_url($url['scheme'], $url['authority'], $url['path'], $url['query'], $url['fragment']);
	}

	function percent_encoding_normalization($match)
	{
		$integer = hexdec($match[1]);
		if ($integer >= 0x41 && $integer <= 0x5A || $integer >= 0x61 && $integer <= 0x7A || $integer >= 0x30 && $integer <= 0x39 || $integer == 0x2D || $integer == 0x2E || $integer == 0x5F || $integer == 0x7E)
		{
			return chr($integer);
		}
		else
		{
			return strtoupper($match[0]);
		}
	}

	/**
	 * Remove bad UTF-8 bytes
	 *
	 * PCRE Pattern to locate bad bytes in a UTF-8 string comes from W3C
	 * FAQ: Multilingual Forms (modified to include full ASCII range)
	 *
	 * @author Geoffrey Sneddon
	 * @see http://www.w3.org/International/questions/qa-forms-utf-8
	 * @param string $str String to remove bad UTF-8 bytes from
	 * @return string UTF-8 string
	 */
	function utf8_bad_replace($str)
	{
		if (function_exists('iconv'))
		{
			return iconv('UTF-8', 'UTF-8//IGNORE', $str);
		}
		else if (function_exists('mb_convert_encoding'))
		{
			return mb_convert_encoding($str, 'UTF-8', 'UTF-8');
		}
		else
		{
			if (preg_match_all('/([\x00-\x7F]|[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF]|\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})/', $str, $matches))
			{
				return implode('', $matches[0]);
			}
			else
			{
				return '';
			}
		}
	}

	/**
	 * Converting a string to UTF-7 (RFC 2152)
	 *
	 * @author Tomas V.V.Cox <cox@idecnet.com>
	 * @author Pierre-Alain Joye <pajoye@php.net>
	 * @author Amir Mohammad Saied <amir@php.net>
	 * @copyright 1997-2006 Pierre-Alain Joye,Tomas V.V.Cox,Amir Mohammad Saied
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version CVS: $Id: Validate.php,v 1.104 2006/11/17 16:32:06 amir Exp $
	 * @link http://pear.php.net/package/Validate
	 * @access public
	 * @param $string string to be converted
	 * @return string converted string
	 */
	function string_to_utf7($string)
	{
		$return = '';
		$utf7 = array(
						'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
						'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
						'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g',
						'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r',
						's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2',
						'3', '4', '5', '6', '7', '8', '9', '+', ','
					);

		$state = 0;
		if (!empty($string))
		{
			$i = 0;
			while ($i <= strlen($string))
			{
				$char = substr($string, $i, 1);
				if ($state == 0)
				{
					if ((ord($char) >= 0x7F) || (ord($char) <= 0x1F))
					{
						if ($char)
						{
							$return .= '&';
						}
						$state = 1;
					}
					else if ($char == '&')
					{
						$return .= '&-';
					}
					else
					{
						$return .= $char;
					}
				}
				else if (($i == strlen($string) || !((ord($char) >= 0x7F)) || (ord($char) <= 0x1F)))
				{
					if ($state != 1)
					{
						if (ord($char) > 64)
						{
							$return .= '';
						}
						else
						{
							$return .= $utf7[ord($char)];
						}
					}
					$return .= '-';
					$state = 0;
				}
				else
				{
					switch($state)
					{
						case 1:
							$return .= $utf7[ord($char) >> 2];
							$residue = (ord($char) & 0x03) << 4;
							$state = 2;
							break;

						case 2:
							$return .= $utf7[$residue | (ord($char) >> 4)];
							$residue = (ord($char) & 0x0F) << 2;
							$state = 3;
							break;

						case 3:
							$return .= $utf7[$residue | (ord($char) >> 6)];
							$return .= $utf7[ord($char) & 0x3F];
							$state = 1;
							break;
					}
				}
				$i++;
			}
			return $return;
		}
		return '';
	}

	function change_encoding($data, $input, $output)
	{
		$input = SimplePie_Misc::encoding($input);
		$output = SimplePie_Misc::encoding($output);

		if (function_exists('iconv') && ($data = @iconv($input, $output, $data)))
		{
			return $data;
		}
		else if (function_exists('mb_convert_encoding') && ($data = @mb_convert_encoding($data, $output, $input)))
		{
			return $data;
		}
		else if ($input == 'ISO-8859-1' && $output == 'UTF-8')
		{
			return utf8_encode($data);
		}
		else if ($input == 'UTF-8' && $output == 'ISO-8859-1')
		{
			return utf8_decode($data);
		}
		else if ($output == 'UTF-7')
		{
			return SimplePie_Misc::string_to_utf7($data);
		}
		return $data;
	}

	function encoding($encoding)
	{
		switch (strtolower($encoding))
		{
			// 7bit
			case '7bit':
			case '7-bit':
				return '7bit';
				break;

			// 8bit
			case '8bit':
			case '8-bit':
				return '8bit';
				break;

			// ARMSCII-8
			case 'armscii-8':
			case 'armscii':
				return 'ARMSCII-8';
				break;

			// ASCII
			case 'us-ascii':
			case 'ascii':
				return 'US-ASCII';
				break;

			// BASE64
			case 'base64':
			case 'base-64':
				return 'BASE64';
				break;

			// Big5 - Traditional Chinese, mainly used in Taiwan
			case 'big5':
			case '950':
				return 'BIG5';
				break;

			// Big5 with Hong Kong extensions, Traditional Chinese
			case 'big5-hkscs':
				return 'BIG5-HKSCS';
				break;

			// byte2be
			case 'byte2be':
				return 'byte2be';
				break;

			// byte2le
			case 'byte2le':
				return 'byte2le';
				break;

			// byte4be
			case 'byte4be':
				return 'byte4be';
				break;

			// byte4le
			case 'byte4le':
				return 'byte4le';
				break;

			// EUC-CN
			case 'euc-cn':
			case 'euccn':
				return 'EUC-CN';
				break;

			// EUC-JISX0213
			case 'euc-jisx0213':
			case 'eucjisx0213':
				return 'EUC-JISX0213';
				break;

			// EUC-JP
			case 'euc-jp':
			case 'eucjp':
				return 'EUC-JP';
				break;

			// EUCJP-win
			case 'euc-jp-win':
			case 'eucjp-win':
			case 'eucjpwin':
				return 'EUCJP-win';
				break;

			// EUC-KR
			case 'euc-kr':
			case 'euckr':
				return 'EUC-KR';
				break;

			// EUC-TW
			case 'euc-tw':
			case 'euctw':
				return 'EUC-TW';
				break;

			// GB18030 - Simplified Chinese, national standard character set
			case 'gb18030-2000':
			case 'gb18030':
				return 'GB18030';
				break;

			// GB2312 - Simplified Chinese, national standard character set
			case 'gb2312':
			case '936':
				return 'GB2312';
				break;

			// GBK
			case 'gbk':
				return 'GBK';
				break;

			// Georgian-Academy
			case 'georgian-academy':
				return 'Georgian-Academy';
				break;

			// Georgian-PS
			case 'georgian-ps':
				return 'Georgian-PS';
				break;

			// HTML-ENTITIES
			case 'html-entities':
			case 'htmlentities':
				return 'HTML-ENTITIES';
				break;

			// HZ
			case 'hz':
				return 'HZ';
				break;

			// ISO-2022-CN
			case 'iso-2022-cn':
			case 'iso2022-cn':
			case 'iso2022cn':
				return 'ISO-2022-CN';
				break;

			// ISO-2022-CN-EXT
			case 'iso-2022-cn-ext':
			case 'iso2022-cn-ext':
			case 'iso2022cn-ext':
			case 'iso2022cnext':
				return 'ISO-2022-CN';
				break;

			// ISO-2022-JP
			case 'iso-2022-jp':
			case 'iso2022-jp':
			case 'iso2022jp':
				return 'ISO-2022-JP';
				break;

			// ISO-2022-JP-1
			case 'iso-2022-jp-1':
			case 'iso2022-jp-1':
			case 'iso2022jp-1':
			case 'iso2022jp1':
				return 'ISO-2022-JP-1';
				break;

			// ISO-2022-JP-2
			case 'iso-2022-jp-2':
			case 'iso2022-jp-2':
			case 'iso2022jp-2':
			case 'iso2022jp2':
				return 'ISO-2022-JP-2';
				break;

			// ISO-2022-JP-3
			case 'iso-2022-jp-3':
			case 'iso2022-jp-3':
			case 'iso2022jp-3':
			case 'iso2022jp3':
				return 'ISO-2022-JP-3';
				break;

			// ISO-2022-KR
			case 'iso-2022-kr':
			case 'iso2022-kr':
			case 'iso2022kr':
				return 'ISO-2022-KR';
				break;

			// ISO-8859-1
			case 'iso-8859-1':
			case 'iso8859-1':
				return 'ISO-8859-1';
				break;

			// ISO-8859-2
			case 'iso-8859-2':
			case 'iso8859-2':
				return 'ISO-8859-2';
				break;

			// ISO-8859-3
			case 'iso-8859-3':
			case 'iso8859-3':
				return 'ISO-8859-3';
				break;

			// ISO-8859-4
			case 'iso-8859-4':
			case 'iso8859-4':
				return 'ISO-8859-4';
				break;

			// ISO-8859-5
			case 'iso-8859-5':
			case 'iso8859-5':
				return 'ISO-8859-5';
				break;

			// ISO-8859-6
			case 'iso-8859-6':
			case 'iso8859-6':
				return 'ISO-8859-6';
				break;

			// ISO-8859-7
			case 'iso-8859-7':
			case 'iso8859-7':
				return 'ISO-8859-7';
				break;

			// ISO-8859-8
			case 'iso-8859-8':
			case 'iso8859-8':
				return 'ISO-8859-8';
				break;

			// ISO-8859-9
			case 'iso-8859-9':
			case 'iso8859-9':
				return 'ISO-8859-9';
				break;

			// ISO-8859-10
			case 'iso-8859-10':
			case 'iso8859-10':
				return 'ISO-8859-10';
				break;

			// mbstring/iconv functions don't appear to support 11 & 12

			// ISO-8859-13
			case 'iso-8859-13':
			case 'iso8859-13':
				return 'ISO-8859-13';
				break;

			// ISO-8859-14
			case 'iso-8859-14':
			case 'iso8859-14':
				return 'ISO-8859-14';
				break;

			// ISO-8859-15
			case 'iso-8859-15':
			case 'iso8859-15':
				return 'ISO-8859-15';
				break;

			// ISO-8859-16
			case 'iso-8859-16':
			case 'iso8859-16':
				return 'ISO-8859-16';
				break;

			// JIS
			case 'jis':
				return 'JIS';
				break;

			// JOHAB - Korean
			case 'johab':
				return 'JOHAB';
				break;

			// Russian
			case 'koi8-r':
			case 'koi8r':
				return 'KOI8-R';
				break;

			// Turkish
			case 'koi8-t':
			case 'koi8t':
				return 'KOI8-T';
				break;

			// Ukrainian
			case 'koi8-u':
			case 'koi8u':
				return 'KOI8-U';
				break;

			// Russian+Ukrainian
			case 'koi8-ru':
			case 'koi8ru':
				return 'KOI8-RU';
				break;

			// Macintosh (Mac OS Classic)
			case 'macintosh':
				return 'Macintosh';
				break;

			// MacArabic (Mac OS Classic)
			case 'macarabic':
				return 'MacArabic';
				break;

			// MacCentralEurope (Mac OS Classic)
			case 'maccentraleurope':
				return 'MacCentralEurope';
				break;

			// MacCroatian (Mac OS Classic)
			case 'maccroatian':
				return 'MacCroatian';
				break;

			// MacCyrillic (Mac OS Classic)
			case 'maccyrillic':
				return 'MacCyrillic';
				break;

			// MacGreek (Mac OS Classic)
			case 'macgreek':
				return 'MacGreek';
				break;

			// MacHebrew (Mac OS Classic)
			case 'machebrew':
				return 'MacHebrew';
				break;

			// MacIceland (Mac OS Classic)
			case 'maciceland':
				return 'MacIceland';
				break;

			// MacRoman (Mac OS Classic)
			case 'macroman':
				return 'MacRoman';
				break;

			// MacRomania (Mac OS Classic)
			case 'macromania':
				return 'MacRomania';
				break;

			// MacThai (Mac OS Classic)
			case 'macthai':
				return 'MacThai';
				break;

			// MacTurkish (Mac OS Classic)
			case 'macturkish':
				return 'MacTurkish';
				break;

			// MacUkraine (Mac OS Classic)
			case 'macukraine':
				return 'MacUkraine';
				break;

			// MuleLao-1
			case 'mulelao-1':
			case 'mulelao1':
				return 'MuleLao-1';
				break;

			// Shift_JIS
			case 'shift_jis':
			case 'sjis':
			case '932':
				return 'Shift_JIS';
				break;

			// Shift_JISX0213
			case 'shift-jisx0213':
			case 'shiftjisx0213':
				return 'Shift_JISX0213';
				break;

			// SJIS-win
			case 'sjis-win':
			case 'sjiswin':
			case 'shift_jis-win':
				return 'SJIS-win';
				break;

			// TCVN - Vietnamese
			case 'tcvn':
				return 'TCVN';
				break;

			// TDS565 - Turkish
			case 'tds565':
				return 'TDS565';
				break;

			// TIS-620 Thai
			case 'tis-620':
			case 'tis620':
				return 'TIS-620';
				break;

			// UCS-2
			case 'ucs-2':
			case 'ucs2':
			case 'utf-16':
			case 'utf16':
				return 'UCS-2';
				break;

			// UCS-2BE
			case 'ucs-2be':
			case 'ucs2be':
			case 'utf-16be':
			case 'utf16be':
				return 'UCS-2BE';
				break;

			// UCS-2LE
			case 'ucs-2le':
			case 'ucs2le':
			case 'utf-16le':
			case 'utf16le':
				return 'UCS-2LE';
				break;

			// UCS-2-INTERNAL
			case 'ucs-2-internal':
			case 'ucs2internal':
				return 'UCS-2-INTERNAL';
				break;

			// UCS-4
			case 'ucs-4':
			case 'ucs4':
			case 'utf-32':
			case 'utf32':
				return 'UCS-4';
				break;

			// UCS-4BE
			case 'ucs-4be':
			case 'ucs4be':
			case 'utf-32be':
			case 'utf32be':
				return 'UCS-4BE';
				break;

			// UCS-4LE
			case 'ucs-4le':
			case 'ucs4le':
			case 'utf-32le':
			case 'utf32le':
				return 'UCS-4LE';
				break;

			// UCS-4-INTERNAL
			case 'ucs-4-internal':
			case 'ucs4internal':
				return 'UCS-4-INTERNAL';
				break;

			// UCS-16
			case 'ucs-16':
			case 'ucs16':
				return 'UCS-16';
				break;

			// UCS-16BE
			case 'ucs-16be':
			case 'ucs16be':
				return 'UCS-16BE';
				break;

			// UCS-16LE
			case 'ucs-16le':
			case 'ucs16le':
				return 'UCS-16LE';
				break;

			// UCS-32
			case 'ucs-32':
			case 'ucs32':
				return 'UCS-32';
				break;

			// UCS-32BE
			case 'ucs-32be':
			case 'ucs32be':
				return 'UCS-32BE';
				break;

			// UCS-32LE
			case 'ucs-32le':
			case 'ucs32le':
				return 'UCS-32LE';
				break;

			// UTF-7
			case 'utf-7':
			case 'utf7':
				return 'UTF-7';
				break;

			// UTF7-IMAP
			case 'utf-7-imap':
			case 'utf7-imap':
			case 'utf7imap':
				return 'UTF7-IMAP';
				break;

			// VISCII - Vietnamese ASCII
			case 'viscii':
				return 'VISCII';
				break;

			// Windows-specific Central & Eastern Europe
			case 'cp1250':
			case 'windows-1250':
			case 'win-1250':
			case '1250':
				return 'Windows-1250';
				break;

			// Windows-specific Cyrillic
			case 'cp1251':
			case 'windows-1251':
			case 'win-1251':
			case '1251':
				return 'Windows-1251';
				break;

			// Windows-specific Western Europe
			case 'cp1252':
			case 'windows-1252':
			case '1252':
				return 'Windows-1252';
				break;

			// Windows-specific Greek
			case 'cp1253':
			case 'windows-1253':
			case '1253':
				return 'Windows-1253';
				break;

			// Windows-specific Turkish
			case 'cp1254':
			case 'windows-1254':
			case '1254':
				return 'Windows-1254';
				break;

			// Windows-specific Hebrew
			case 'cp1255':
			case 'windows-1255':
			case '1255':
				return 'Windows-1255';
				break;

			// Windows-specific Arabic
			case 'cp1256':
			case 'windows-1256':
			case '1256':
				return 'Windows-1256';
				break;

			// Windows-specific Baltic
			case 'cp1257':
			case 'windows-1257':
			case '1257':
				return 'Windows-1257';
				break;

			// Windows-specific Vietnamese
			case 'cp1258':
			case 'windows-1258':
			case '1258':
				return 'Windows-1258';
				break;

			// Default to UTF-8
			default:
				return 'UTF-8';
				break;
		}
	}

	function get_curl_version()
	{
		if (is_array($curl = curl_version()))
		{
			$curl = $curl['version'];
		}
		else if (preg_match('/curl\/(\S+)(\s|$)/', $curl, $match))
		{
			$curl = $match[1];
		}
		else
		{
			$curl = 0;
		}
		return $curl;
	}

	function is_a_class($class1, $class2)
	{
		if (class_exists($class1))
		{
			$classes = array(strtolower($class1));
			while ($class1 = get_parent_class($class1))
			{
				$classes[] = strtolower($class1);
			}
			return in_array(strtolower($class2), $classes);
		}
		else
		{
			return false;
		}
	}

	function replace_num_entity($code)
	{
		$code = preg_replace('/^&#(.*);$/s', '\\1', $code);
		if (preg_match('/^x([0-9a-f]+)$/i', $code, $match))
		{
			$code = hexdec($match[1]);
		}
		else
		{
			$code = (int) $code;
		}

		if ($code < 128)
		{
			return chr($code);
		}
		else if ($code < 2048)
		{
			return chr(($code >> 6) + 192) . chr(($code & 63) + 128);
		}
		else if ($code < 65536)
		{
			return chr(($code >> 12) + 224) . chr((($code >> 6) & 63) + 128) . chr(($code & 63) + 128);
		}
		else if ($code < 2097152)
		{
			return chr($code >> 18 + 240) . chr((($code >> 12) & 63) + 128) . chr(($code >> 6) & 63 + 128) . chr($code & 63 + 128);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Strip HTML comments
	 *
	 * @access public
	 * @param string $data Data to strip comments from
	 * @param string $output Current output buffer
	 * @return string Comment stripped string
	 */
	function strip_comments($data, $output = '')
	{
		$strpos = strpos($data, '<!--');
		if ($strpos !== false)
		{
			$output .= substr($data, 0, $strpos);
			$data = substr_replace($data, '', 0, $strpos);
			$strpos = strpos($data, '-->');
			if ($strpos !== false)
			{
				$data = substr_replace($data, '', 0, $strpos + 3);
			}
			else
			{
				$data = '';
			}
			if (strlen($data) > 0)
			{
				return SimplePie_Misc::strip_comments($data, $output);
			}
			else
			{
				return $output;
			}
		}
		else
		{
			return $output . $data;
		}
	}

	function parse_date($dt, $rfc822_tz = true)
	{
		$dt = SimplePie_Misc::uncomment_rfc822($dt);
		/*
		Capturing subpatterns:
		1: RFC 822 date
		2: RFC 822 day
		3: RFC 822 month
		4: RFC 822 year
		5: ISO 8601 date
		6: ISO 8601 century
		7: ISO 8601 year
		8: ISO 8601 month
		9: ISO 8601 day
		10: ISO 8601 ordinal day
		11: ISO 8601 month
		12: ISO 8601 day
		13: ISO 8601 week
		14: ISO 8601 day of week
		15: Time
		16: Hour
		17: Hour Decimal
		18: Minute
		19: Minute Decimal
		20: Second
		21: Second Decimal
		22: Timezone
		23: Diff ±
		24: Hour
		25: Hour Decimal
		26: Minute
		27: Minute Decimal
		28: Alphabetic Timezone
		*/
		if (preg_match('/(?:(([0-9]{1,2})\s*(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s*([0-9]{4}|[0-9]{2}))|(([0-9]{2})(?:([0-9]{2})(?:(?:-|\s)*(?:([0-9]{2})([0-9]{2})|([0-9]{3})|([0-9]{2})(?:(?:-|\s)*([0-9]{2}))?|W([0-9]{2})(?:(?:-|\s)*([0-9]))?))?)?))((?:T|\s)*([0-9]{2})(?:(?:,|\.)([0-9]*)|(?:\:|\s)*([0-9]{2})(?:(?:,|\.)([0-9]*)|(?:\:|\s)*([0-9]{2})(?:(?:,|\.)([0-9]*))?)?)?(?:\s)*((?:(\+|-)([0-9]{2})(?:(?:,|\.)([0-9]*)|(?:\:|\s)*(?:([0-9]{2})(?:(?:,|\.)([0-9]*))?))?)|(UTC|GMT|EST|CST|MST|PST|EDT|CDT|MDT|PDT|UT|[A-IK-Z]))?)?/i', $dt, $match))
		{
			// Set blank vars
			$year = 1970;
			$month = 1;
			$day = 1;
			$hour = 0;
			$minute = 0;
			$second = 0;
			$timezone = false;

			// RFC 822
			if (!empty($match[1]))
			{
				if (strlen($match[4]) == 2)
				{
					$year = ($match[4] < 70) ? "20$match[4]" : "19$match[4]";
				}
				else
				{
					$year = $match[4];
				}
				switch (strtolower($match[3]))
				{
					case 'jan':
						$month = 1;
						break;

					case 'feb':
						$month = 2;
						break;

					case 'mar':
						$month = 3;
						break;

					case 'apr':
						$month = 4;
						break;

					case 'may':
						$month = 5;
						break;

					case 'jun':
						$month = 6;
						break;

					case 'jul':
						$month = 7;
						break;

					case 'aug':
						$month = 8;
						break;

					case 'sep':
						$month = 9;
						break;

					case 'oct':
						$month = 10;
						break;

					case 'nov':
						$month = 11;
						break;

					case 'dec':
						$month = 12;
						break;
				}
				$day = $match[2];
			}
			// ISO 8601
			else
			{
				// Year
				if (!empty($match[7]))
				{
					$year = "$match[6]$match[7]";

					// Two Digit Month/Day
					if (!empty($match[11]))
					{
						$month = $match[11];
						if (!empty($match[12]))
						{
							$day = $match[12];
						}
					}

					// Four Digit Month/Day
					else if (!empty($match[8]))
					{
						$month = $match[8];
						$day = $match[9];
					}

					// Ordinal Day
					else if (!empty($match[10]))
					{
						$day = $match[10];
					}

					//  Week Date
					else if (!empty($match[13]))
					{
						// Week Day
						if (!empty($match[14]))
						{
							$day = $match[14];
						}

						$first_day_of_year = date('w', mktime(0, 0, 0, 1, 1, $year));
						if ($first_day_of_year == 0)
						{
							$first_day_of_year = 7;
						}

						$day = 7 * ($match[13] - 1) + $day - ($first_day_of_year - 1);
					}
				}
				else
				{
					$year = "$match[6]00";
				}
			}
			// Time
			if (!empty($match[15]))
			{
				for ($i = count($match); $i <= 21; $i++)
				{
					if (!isset($match[$i]))
					{
						$match[$i] = '';
					}
				}

				$time = 0;
				$time += ($match[16] + ('.' . $match[17])) * 3600;
				$time += ($match[18] + ('.' . $match[19])) * 60;
				$time += $match[20] + ('.' . $match[21]);
				$hour = floor($time / 3600);
				$time -= $hour * 3600;
				$minute = floor($time / 60);
				$time -= $minute * 60;
				$second = round($time);

				// Timezone
				if (!empty($match[22]))
				{
					// Alphabetic Timezone
					if (!empty($match[28]))
					{
						// Military
						if (strlen($match[28]) == 1)
						{
							if ($match[28] == 'Z' || $match[28] == 'z' || !$rfc822_tz)
							{
								$timezone = 0;
							}
							else
							{
								$timezone = ord(strtoupper($match[28]));

								if ($timezone > 74)
								{
									$timezone--;
								}

								if ($timezone <= 76)
								{
									$timezone = -($timezone - 64);
								}
								else
								{
									$timezone -= 76;
								}

								$timezone *= 3600;
							}
						}
						// Code
						else
						{
							switch (strtoupper($match[28]))
							{
								case 'UT':
								case 'UTC':
								case 'GMT':
									$timezone = 0;
									break;

								case 'EST':
									$timezone = -18000;
									break;

								case 'CST':
									$timezone = -21600;
									break;

								case 'MST':
									$timezone = -25200;
									break;

								case 'PST':
									$timezone = -28800;
									break;

								case 'EDT':
									$timezone = -14400;
									break;

								case 'CDT':
									$timezone = -18000;
									break;

								case 'MDT':
									$timezone = -21600;
									break;

								case 'PDT':
									$timezone = -25200;
									break;
							}
						}
					}
					// Timezone difference from UTC
					else
					{
						for ($i = count($match); $i <= 27; $i++)
						{
							if (!isset($match[$i]))
							{
								$match[$i] = '';
							}
						}

						$timezone = 0;
						$timezone += ($match[24] + ('.' . $match[25])) * 3600;
						$timezone += ($match[26] + ('.' . $match[27])) * 60;
						$timezone = round($timezone);

						if ($match[23] == '-')
						{
							$timezone = -$timezone;
						}
					}
				}
			}
			if ($timezone === false)
			{
				return mktime($hour, $minute, $second, $month, $day, $year);
			}
			else
			{
				return gmmktime($hour, $minute, $second, $month, $day, $year) - $timezone;
			}
		}
		else if (($time = strtotime($dt)) > 0)
		{
			return $time;
		}
		else
		{
			return false;
		}
	}

	function entities_decode($data, $encoding)
	{
		return preg_replace('/&(#(x[0-9a-fA-F]+|[0-9]+)|[0-9a-zA-Z]+);/e', 'SimplePie_Misc::do_entities_decode(\'\\0\', $encoding)', $data);
	}

	function do_entities_decode($data, $encoding)
	{
		static $cache = array();
		if (isset($cache[$encoding][$data]))
		{
			return $cache[$encoding][$data];
		}
		else
		{
			$return = SimplePie_Misc::change_encoding(html_entity_decode($data, ENT_QUOTES), 'ISO-8859-1', $encoding);
			if ($return == $data)
			{
				$return = SimplePie_Misc::change_encoding(SimplePie_Misc::replace_num_entity($data), 'UTF-8', $encoding);
			}
			$cache[$encoding][$data] = $return;
			return $return;
		}
	}

	/**
	 * Remove RFC822 comments
	 *
	 * @author Tomas V.V.Cox <cox@idecnet.com>
	 * @author Pierre-Alain Joye <pajoye@php.net>
	 * @author Amir Mohammad Saied <amir@php.net>
	 * @copyright 1997-2006 Pierre-Alain Joye,Tomas V.V.Cox,Amir Mohammad Saied
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version CVS: $Id: Validate.php,v 1.104 2006/11/17 16:32:06 amir Exp $
	 * @link http://pear.php.net/package/Validate
	 * @access public
	 * @param string $data Data to strip comments from
	 * @return string Comment stripped string
	 */
	function uncomment_rfc822($data)
	{
		return preg_replace('/((?:(?:\\\\"|[^("])*(?:"(?:[^"\\\\\r]|\\\\.)*"\s*)?)*)((?<!\\\\)\((?:(?2)|.)*?(?<!\\\\)\))/', '$1', $data);
	}

	/**
	 * Validate an email according to full RFC822 (inclusive human
	 * readable part)
	 *
	 * @author Tomas V.V.Cox <cox@idecnet.com>
	 * @author Pierre-Alain Joye <pajoye@php.net>
	 * @author Amir Mohammad Saied <amir@php.net>
	 * @copyright 1997-2006 Pierre-Alain Joye,Tomas V.V.Cox,Amir Mohammad Saied
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version CVS: $Id: Validate.php,v 1.104 2006/11/17 16:32:06 amir Exp $
	 * @link http://pear.php.net/package/Validate
	 * @access public
	 * @param string $email email to validate
	 * @return boolean true if valid email, false if not
	 */
	function validate_rfc822_email(&$email)
	{
		if (SimplePie_Misc::change_encoding($email, 'UTF-7', 'UTF-7') != $email)
		{
			return false;
		}
		static $address = null;
		if (!$address)
		{
			// atom		   =  1*<any CHAR except specials, SPACE and CTLs>
			$atom = '[^][()<>@,;:\\".\s\000-\037\177-\377]+\s*';
			// qtext	   =  <any CHAR excepting <">,	   ; => may be folded
			//		   "\" & CR, and including linear-white-space>
			$qtext = '[^"\\\\\r]';
			// quoted-pair =  "\" CHAR					   ; may quote any char
			$quoted_pair = '\\\\.';
			// quoted-string = <"> *(qtext/quoted-pair) <">; Regular qtext or
			//											   ;   quoted chars.
			$quoted_string = '"(?:' . $qtext . '|' . $quoted_pair . ')*"\s*';
			// word		   =  atom / quoted-string
			$word = '(?:' . $atom . '|' . $quoted_string . ')';
			// local-part  =  word *("." word)			   ; uninterpreted
			//											   ; case-preserved
			$local_part = $word . '(?:\.\s*' . $word . ')*';
			// dtext	   =  <any CHAR excluding "[",	   ; => may be folded
			//		   "]", "\" & CR, & including linear-white-space>
			$dtext = '[^][\\\\\r]';
			// domain-literal =	 "[" *(dtext / quoted-pair) "]"
			$domain_literal = '\[(?:' . $dtext . '|' . $quoted_pair . ')*\]\s*';
			// sub-domain  =  domain-ref / domain-literal
			// domain-ref  =  atom						   ; symbolic reference
			$sub_domain = '(?:' . $atom . '|' . $domain_literal . ')';
			// domain	   =  sub-domain *("." sub-domain)
			$domain = $sub_domain . '(?:\.\s*' . $sub_domain . ')*';
			// addr-spec   =  local-part "@" domain		   ; global address
			$addr_spec = $local_part . '@\s*' . $domain;
			// route	   =  1#("@" domain) ":"		   ; path-relative
			$route = '@' . $domain . '(?:,@\s*' . $domain . ')*:\s*';
			// route-addr  =  "<" [route] addr-spec ">"
			$route_addr = '<\s*(?:' . $route . ')?' . $addr_spec . '>\s*';
			// phrase	   =  1*word					   ; Sequence of words
			$phrase = $word	 . '+';
			// mailbox	   =  addr-spec					   ; simple address
			//			   /  phrase route-addr			   ; name & addr-spec
			$mailbox = '(?:' . $addr_spec . '|' . $phrase . $route_addr . ')';
			// group	   =  phrase ":" [#mailbox] ";"
			$group = $phrase . ':\s*(?:' . $mailbox . '(?:,\s*' . $mailbox . ')*)?;\s*';
			//	   address	   =  mailbox					   ; one addressee
			//				   /  group						   ; named list
			$address = '/^\s*(?:' . $mailbox . '|' . $group . ')$/';
		}
		// strip comments
		$email = SimplePie_Misc::uncomment_rfc822($email);
		return (bool) preg_match($address, $email);
	}

	function parse_mime($mime)
	{
		if (($pos = strpos($mime, ';')) === false)
		{
			return trim($mime);
		}
		else
		{
			return trim(substr($mime, 0, $pos));
		}
	}

	function htmlspecialchars_decode($string, $quote_style)
	{
		if (function_exists('htmlspecialchars_decode'))
		{
			return htmlspecialchars_decode($string, $quote_style);
		}
		else
		{
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}
}

class SimplePie_Locator
{
	var $useragent;
	var $timeout;
	var $file;
	var $local = array();
	var $elsewhere = array();
	var $file_class = 'SimplePie_File';
	var $cached_entities = array();
	var $base;
	var $base_location = 0;
	var $checked_feeds = 0;
	var $max_checked_feeds = 10;

	function SimplePie_Locator(&$file, $timeout = 10, $useragent = null, $file_class = 'SimplePie_File', $max_checked_feeds = 10)
	{
		$this->file =& $file;
		$this->file_class = $file_class;
		$this->useragent = $useragent;
		$this->timeout = $timeout;
		$this->max_checked_feeds = $max_checked_feeds;
	}

	function find($type = SIMPLEPIE_LOCATOR_ALL)
	{
		if ($this->is_feed($this->file))
		{
			return $this->file;
		}

		if ($type & ~SIMPLEPIE_LOCATOR_NONE)
		{
			$this->get_base();
		}

		if ($type & SIMPLEPIE_LOCATOR_AUTODISCOVERY && $working = $this->autodiscovery())
		{
			return $working;
		}

		if ($type & (SIMPLEPIE_LOCATOR_LOCAL_EXTENSION | SIMPLEPIE_LOCATOR_LOCAL_BODY | SIMPLEPIE_LOCATOR_REMOTE_EXTENSION | SIMPLEPIE_LOCATOR_REMOTE_BODY) && $this->get_links())
		{
			if ($type & SIMPLEPIE_LOCATOR_LOCAL_EXTENSION && $working = $this->extension($this->local))
			{
				return $working;
			}

			if ($type & SIMPLEPIE_LOCATOR_LOCAL_BODY && $working = $this->body($this->local))
			{
				return $working;
			}

			if ($type & SIMPLEPIE_LOCATOR_REMOTE_EXTENSION && $working = $this->extension($this->elsewhere))
			{
				return $working;
			}

			if ($type & SIMPLEPIE_LOCATOR_REMOTE_BODY && $working = $this->body($this->elsewhere))
			{
				return $working;
			}
		}
		return false;
	}

	function is_feed(&$file)
	{
		$body = SimplePie_Misc::strip_comments($file->body());
		if (preg_match('/<([^\s:]+:)?(rss|RDF|feed)' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/i', $body))
		{
			return true;
		}
		return false;
	}

	function get_base()
	{
		$this->base = $this->file->url;
		$elements = SimplePie_Misc::get_element('base', $this->file->body());
		foreach ($elements as $element)
		{
			if (!empty($element['attribs']['HREF']['data']))
			{
				$this->base = SimplePie_Misc::absolutize_url(trim($element['attribs']['HREF']['data']), $this->file->url);
				$this->base_location = $element['offset'];
				break;
			}
		}
	}

	function autodiscovery()
	{
		$links = array_merge(SimplePie_Misc::get_element('link', $this->file->body()), SimplePie_Misc::get_element('a', $this->file->body()));
		$done = array();
		foreach ($links as $link)
		{
			if ($this->checked_feeds == $this->max_checked_feeds)
			{
				break;
			}
			if (!empty($link['attribs']['HREF']['data']) && !empty($link['attribs']['REL']['data']))
			{
				$rel = preg_split('/\s+/', strtolower(trim($link['attribs']['REL']['data'])));

				if ($this->base_location < $link['offset'])
				{
					$href = SimplePie_Misc::absolutize_url(trim($link['attribs']['HREF']['data']), $this->base);
				}
				else
				{
					$href = SimplePie_Misc::absolutize_url(trim($link['attribs']['HREF']['data']), $this->file->url);
				}

				if (!in_array($href, $done) && in_array('feed', $rel) || (in_array('alternate', $rel) && !empty($link['attribs']['TYPE']['data']) && in_array(strtolower(SimplePie_Misc::parse_mime($link['attribs']['TYPE']['data'])), array('application/rss+xml', 'application/atom+xml'))))
				{
					$this->checked_feeds++;
					$feed =& new $this->file_class($href, $this->timeout, 5, null, $this->useragent);
					if ($this->is_feed($feed))
					{
						return $feed;
					}
				}
				$done[] = $href;
			}
		}
		return false;
	}

	function get_links()
	{
		$links = SimplePie_Misc::get_element('a', $this->file->body());
		foreach ($links as $link)
		{
			if (!empty($link['attribs']['HREF']['data']))
			{
				$href = trim($link['attribs']['HREF']['data']);
				$parsed = SimplePie_Misc::parse_url($href);
				if (empty($parsed['scheme']) || preg_match('/^(http(s)|feed)?$/i', $parsed['scheme']))
				{
					if ($this->base_location < $link['offset'])
					{
						$href = SimplePie_Misc::absolutize_url(trim($link['attribs']['HREF']['data']), $this->base);
					}
					else
					{
						$href = SimplePie_Misc::absolutize_url(trim($link['attribs']['HREF']['data']), $this->file->url);
					}

					$current = SimplePie_Misc::parse_url($this->file->url);

					if (empty($parsed['authority']) || $parsed['authority'] == $current['authority'])
					{
						$this->local[] = $href;
					}
					else
					{
						$this->elsewhere[] = $href;
					}
				}
			}
		}
		$this->local = array_unique($this->local);
		$this->elsewhere = array_unique($this->elsewhere);
		if (!empty($this->local) || !empty($this->elsewhere))
		{
			return true;
		}
		return false;
	}

	function extension(&$array)
	{
		foreach ($array as $key => $value)
		{
			if ($this->checked_feeds == $this->max_checked_feeds)
			{
				break;
			}
			if (in_array(strtolower(strrchr($value, '.')), array('.rss', '.rdf', '.atom', '.xml')))
			{
				$this->checked_feeds++;
				$feed =& new $this->file_class($value, $this->timeout, 5, null, $this->useragent);
				if ($this->is_feed($feed))
				{
					return $feed;
				}
				else
				{
					unset($array[$key]);
				}
			}
		}
		return false;
	}

	function body(&$array)
	{
		foreach ($array as $key => $value)
		{
			if ($this->checked_feeds == $this->max_checked_feeds)
			{
				break;
			}
			if (preg_match('/(rss|rdf|atom|xml)/i', $value))
			{
				$this->checked_feeds++;
				$feed =& new $this->file_class($value, $this->timeout, 5, null, $this->useragent);
				if ($this->is_feed($feed))
				{
					return $feed;
				}
				else
				{
					unset($array[$key]);
				}
			}
		}
		return false;
	}
}

class SimplePie_Parser
{
	var $xml;
	var $error_code;
	var $error_string;
	var $current_line;
	var $current_column;
	var $current_byte;
	var $atom03 = false;
	var $atom10 = false;
	var $atom_unknown = false;
	var $rss090 = false;
	var $rss091 = false;
	var $rss092 = false;
	var $rss10 = false;
	var $rss20 = false;
	var $rss_unknown = false;
	var $atom03_feed = 0;
	var $atom10_feed = 0;
	var $atom_unknown_feed = 0;
	var $rss091_feed = 0;
	var $rss092_feed = 0;
	var $rss10_feed = 0;
	var $rss20_feed = 0;
	var $rss_unknown_feed = 0;
	var $inside = array('atom10_feed', 'atom03_feed', 'atom_unknown_feed', 'rss091_feed', 'rss092_feed', 'rss10_feed', 'rss20_feed', 'rss_unknown_feed');
	var $assume_namespace = '';
	var $namespace = '';
	var $namespaces = array('');
	var $element = '';
	var $elements = array('');
	var $xml_base = '';
	var $xml_bases = array('');
	var $xml_base_explicit = false;
	var $xml_base_explicits = array(false);
	var $xml_lang = '';
	var $xml_langs = array('');
	var $data = array();
	var $datas = array(array());
	var $current_xhtml_construct = null;
	var $encoding;

	function pre_process(&$data, $encoding)
	{
		// Use UTF-8 if we get passed US-ASCII, as every US-ASCII character is a UTF-8 character
		if (strtoupper($encoding) == 'US-ASCII')
		{
			$this->encoding = 'UTF-8';
		}
		else
		{
			$this->encoding = $encoding;
		}

		// Strip BOM:
		// UTF-32 Big Endian BOM
		if (strpos($data, "\x0\x0\xFE\xFF") === 0)
		{
			$data = substr($data, 4);
		}
		// UTF-32 Little Endian BOM
		else if (strpos($data, "\xFF\xFE\x0\x0") === 0)
		{
			$data = substr($data, 4);
		}
		// UTF-16 Big Endian BOM
		else if (strpos($data, "\xFE\xFF") === 0)
		{
			$data = substr($data, 2);
		}
		// UTF-16 Little Endian BOM
		else if (strpos($data, "\xFF\xFE") === 0)
		{
			$data = substr($data, 2);
		}
		// UTF-8 BOM
		else if (strpos($data, "\xEF\xBB\xBF") === 0)
		{
			$data = substr($data, 3);
		}

		// Make sure the XML prolog is sane and has the correct encoding
		$data = preg_replace("/^<\?xml[\x20\x9\xD\xA]+version([\x20\x9\xD\xA]+)?=([\x20\x9\xD\xA]+)?(\"1.0\"|'1.0'|\"1.1\"|'1.1')([\x20\x9\xD\xA]+encoding([\x20\x9\xD\xA]+)?=([\x20\x9\xD\xA]+)?(\"[A-Za-z][A-Za-z0-9._\-]*\"|'[A-Za-z][A-Za-z0-9._\-]*'))?([\x20\x9\xD\xA]+standalone([\x20\x9\xD\xA]+)?=([\x20\x9\xD\xA]+)?(\"(yes|no)\"|'(yes|no)'))?([\x20\x9\xD\xA]+)?\?>/", '', $data);
		$data = "<?xml version='1.0' encoding='$encoding'?>\n" . $data;
	}

	function parse(&$data)
	{
		$return = true;

		// Create the parser
		$this->xml = xml_parser_create_ns($this->encoding);
		xml_parser_set_option($this->xml, XML_OPTION_SKIP_WHITE, 1);
		xml_set_object($this->xml, $this);
		xml_set_character_data_handler($this->xml, 'cdata');
		xml_set_element_handler($this->xml, 'tag_open', 'tag_close');
		xml_set_external_entity_ref_handler($this->xml, 'external_entity_reference');

		// Parse!
		if (!xml_parse($this->xml, $data, true))
		{
			$this->data = null;
			$this->error_code = xml_get_error_code($this->xml);
			$this->error_string = xml_error_string($this->error_code);
			$return = false;
		}
		$this->current_line = xml_get_current_line_number($this->xml);
		$this->current_column = xml_get_current_column_number($this->xml);
		$this->current_byte = xml_get_current_byte_index($this->xml);
		xml_parser_free($this->xml);
		return $return;
	}

	function get_error_code()
	{
		return $this->error_code;
	}

	function get_error_string()
	{
		return $this->error_string;
	}

	function get_current_line()
	{
		return $this->current_line;
	}

	function get_current_column()
	{
		return $this->current_column;
	}

	function get_current_byte()
	{
		return $this->current_byte;
	}

	function get_data()
	{
		return $this->data;
	}

	/**
	 * @todo finish method
	 */
	function get_type()
	{
		if ($this->atom03)
		{
			return array('Atom', '0.3');
		}
		else if ($this->atom10)
		{
			return array('Atom', '1.0');
		}
		else if ($this->atom_unknown)
		{
			return array('Atom', false);
		}
	}

	function tag_open($parser, $tag, $attributes)
	{
		$this->update_inside(1);

		switch ($tag)
		{
			case 'HTTP://WWW.W3.ORG/2005/ATOM:FEED':
				$this->atom10 = true;
				$this->atom10_feed = 1;
				break;

			case 'HTTP://PURL.ORG/ATOM/NS#:FEED':
				$this->atom03 = true;
				$this->atom03_feed = 1;
				break;

			case 'FEED':
				if (!empty($attributes['VERSION']))
				{
					switch ($attributes['VERSION'])
					{
						case '0.3':
							$this->atom03 = true;
							$this->atom03_feed = 1;
							$this->assume_namespace = 'HTTP://PURL.ORG/ATOM/NS#';
							break 2;

						case '1.0':
							$this->atom10 = true;
							$this->atom10_feed = 1;
							$this->assume_namespace = 'HTTP://WWW.W3.ORG/2005/ATOM';
							break 2;
					}
				}
				$this->atom_unknown_feed = 1;
				$this->atom_unknown = true;
				$this->assume_namespace = 'atom_unknown';
				break;

			case 'HTTP://BACKEND.USERLAND.COM/RSS2:RSS':
				$this->rss20 = true;
				$this->rss20_feed = 1;
				break;

			case 'RSS':
				if (!empty($attributes['VERSION']))
				{
					switch ($attributes['VERSION'])
					{
						case '0.91':
							$this->rss091 = true;
							$this->rss091_feed = 1;
							$this->assume_namespace = 'rss091';
							break 2;

						case '0.92':
							$this->rss092 = true;
							$this->rss092_feed = 1;
							$this->assume_namespace = 'rss092';
							break 2;

						case '2.0':
							$this->rss20 = true;
							$this->rss20_feed = 1;
							$this->assume_namespace = 'HTTP://BACKEND.USERLAND.COM/RSS2';
							break 2;
					}
				}
				$this->rss_unknown_feed = 1;
				$this->rss_unknown = true;
				$this->assume_namespace = 'rss_unknown';
				break;

			case 'HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#:RDF':
				$this->rss10_feed = 1;
				break;

			case 'HTTP://PURL.ORG/RSS/1.0/:CHANNEL':
				$this->rss10 = true;
				break;

			case 'HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/:CHANNEL':
				$this->rss090 = true;
				break;
		}

		list($this->namespace, $this->element) = $this->split_ns($tag);
		if (empty($this->namespace) && !empty($this->assume_namespace))
		{
			$this->namespace = $this->assume_namespace;
		}
		$this->namespaces[] = $this->namespace;
		$this->elements[] = $this->element;

		$attribs = array();
		foreach ($attributes as $name => $value)
		{
			list($attrib_namespace, $attribute) = $this->split_ns($name);

			if (!empty($attrib_namespace))
			{
				$attribs[$attrib_namespace][$attribute] = $value;
			}
			else if (!empty($this->namespace))
			{
				$attribs[$this->namespace][$attribute] = $value;
			}
			else
			{
				$attribs[$this->assume_namespace][$attribute] = $value;
			}
		}

		if (!empty($attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['BASE']))
		{
			$this->xml_base = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['BASE'], $this->xml_base);
			$this->xml_bases[] = $this->xml_base;
			$this->xml_base_explicit = true;
			$this->xml_base_explicits[] = true;
		}
		else
		{
			$this->xml_bases[] = $this->xml_base;
			$this->xml_base_explicits[] = $this->xml_base_explicit;
		}

		if (!empty($attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['LANG']))
		{
			$this->xml_lang = $attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['LANG'];
			$this->xml_langs[] = $this->xml_lang;
		}
		else
		{
			$this->xml_langs[] = $this->xml_lang;
		}

		if (!is_null($this->current_xhtml_construct) && $this->namespace == 'HTTP://WWW.W3.ORG/1999/XHTML')
		{
			// We need to deal with xml:base now, as if we have an xml:base within the XHTML it will otherwise be lost
			if ($this->xml_base_explicit)
			{
				switch ($this->element)
				{
					case 'BLOCKQUOTE':
					case 'INS':
					case 'DEL':
					case 'Q':
						if (isset($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['CITE']))
						{
							$attribs['HTTP://WWW.W3.ORG/1999/XHTML']['CITE'] = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['CITE'], $this->xml_base);
						}
						break;

					case 'A':
					case 'AREA':
						if (isset($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['HREF']))
						{
							$attribs['HTTP://WWW.W3.ORG/1999/XHTML']['HREF'] = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['HREF'], $this->xml_base);
						}
						break;

					case 'IMG':
						if (isset($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['LONGDESC']))
						{
							$attribs['HTTP://WWW.W3.ORG/1999/XHTML']['LONGDESC'] = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['LONGDESC'], $this->xml_base);
						}
						// No break here, as <img> can have a src attribute

					case 'INPUT':
						if (isset($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['SRC']))
						{
							$attribs['HTTP://WWW.W3.ORG/1999/XHTML']['SRC'] = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['SRC'], $this->xml_base);
						}
						break;

					case 'FORM':
						if (isset($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['ACTION']))
						{
							$attribs['HTTP://WWW.W3.ORG/1999/XHTML']['ACTION'] = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/1999/XHTML']['ACTION'], $this->xml_base);
						}
						break;
				}
			}
			$this->current_xhtml_construct .= '<' . strtolower($this->element);
			if (isset($attribs['HTTP://WWW.W3.ORG/1999/XHTML']))
			{
				foreach ($attribs['HTTP://WWW.W3.ORG/1999/XHTML'] as $name => $value)
				{
					$this->current_xhtml_construct .= ' ' . strtolower($name) . '="' . htmlspecialchars($value, ENT_COMPAT, $this->encoding) . '"';
				}
			}
			$this->current_xhtml_construct .= '>';
		}
		else if ($this->atom10_feed > 1 || $this->atom03_feed > 1 || $this->atom_unknown_feed > 1 || $this->rss091_feed > 1 || $this->rss092_feed > 1 || $this->rss10_feed > 1 || $this->rss20_feed > 1 || $this->rss_unknown_feed > 1)
		{
			$this->datas[] =& $this->data;
			$this->data =& $this->data['child'][$this->namespace][$this->element][];
			$this->data = array('data' => '', 'attribs' => $attribs, 'xml_base' => $this->xml_base, 'xml_base_explicit' => $this->xml_base_explicit, 'xml_lang' => $this->xml_lang, 'type' => $this->get_data_type($attribs));
			if ($this->data['type'] == 'xhtml')
			{
				$this->current_xhtml_construct =& $this->data['data'];
			}
		}
		else if ($this->atom10_feed == 1 || $this->atom03_feed == 1 || $this->atom_unknown_feed == 1 || $this->rss091_feed == 1 || $this->rss092_feed == 1 || $this->rss10_feed == 1 || $this->rss20_feed == 1 || $this->rss_unknown_feed == 1)
		{
			$this->data['attibs'] = $attribs;
			$this->data['xml_lang'] = $this->xml_lang;
		}
	}

	function cdata($parser, $cdata)
	{
		if (!is_null($this->current_xhtml_construct))
		{
			$this->current_xhtml_construct .= htmlspecialchars($cdata, ENT_QUOTES, $this->encoding);
		}
		else if ($this->atom10_feed > 1 || $this->atom03_feed > 1 || $this->atom_unknown_feed > 1 || $this->rss091_feed > 1 || $this->rss092_feed > 1 || $this->rss10_feed > 1 || $this->rss20_feed > 1 || $this->rss_unknown_feed > 1)
		{
			$this->data['data'] .= $cdata;
		}
	}

	function tag_close($parser, $tag)
	{
		if (!is_null($this->current_xhtml_construct) && $this->namespace == 'HTTP://WWW.W3.ORG/1999/XHTML')
		{
			$this->current_xhtml_construct .= '</' . strtolower($this->element) . '>';
		}
		else if ($this->atom10_feed > 1 || $this->atom03_feed > 1 || $this->atom_unknown_feed > 1 || $this->rss091_feed > 1 || $this->rss092_feed > 1 || $this->rss10_feed > 1 || $this->rss20_feed > 1 || $this->rss_unknown_feed > 1)
		{
			if ($this->data['type'] == 'xhtml')
			{
				unset($this->current_xhtml_construct);
				$this->current_xhtml_construct = null;
			}
			$this->data =& $this->datas[count($this->datas)-1];
			array_pop($this->datas);
		}

		switch ($tag)
		{
			case 'FEED':
			case 'RSS':
				$this->assume_namespace = '';
				break;
		}

		array_pop($this->elements);
		$this->element = end($this->elements);
		array_pop($this->namespaces);
		$this->namespace = end($this->namespaces);
		array_pop($this->xml_bases);
		$this->xml_base = end($this->xml_bases);
		array_pop($this->xml_base_explicits);
		$this->xml_base_explicit = end($this->xml_base_explicits);
		array_pop($this->xml_langs);
		$this->xml_lang = end($this->xml_langs);
		$this->update_inside(-1);
	}

	function split_ns($string)
	{
		static $cache = array();
		if (!isset($cache[$string]))
		{
			if (preg_match('/^(.+)\:([^:]+)$/', $string, $match))
			{
				$cache[$string] = array($match[1], $match[2]);
			}
			else
			{
				$cache[$string] = array('', $string);
			}
		}
		return $cache[$string];
	}

	function external_entity_reference($parser, $open_entity_names, $base, $system_id, $public_id)
	{
		var_dump($parser, $open_entity_names, $base, $system_id, $public_id);
	}

	function update_inside($change)
	{
		foreach ($this->inside as $inside)
		{
			if ($this->$inside > 0)
			{
				$this->$inside += $change;
			}
		}
	}

	function get_data_type($attribs)
	{
		switch ("$this->namespace:$this->element")
		{
			// Atom 1.0
			case 'HTTP://WWW.W3.ORG/2005/ATOM:RIGHTS':
			case 'HTTP://WWW.W3.ORG/2005/ATOM:SUBTITLE':
			case 'HTTP://WWW.W3.ORG/2005/ATOM:SUMMARY':
			case 'HTTP://WWW.W3.ORG/2005/ATOM:TITLE':
				if (!empty($attribs['HTTP://WWW.W3.ORG/2005/ATOM']['TYPE']))
				{
					switch (strtolower($attribs['HTTP://WWW.W3.ORG/2005/ATOM']['TYPE']))
					{
						case 'html':
							return 'html';

						case 'xhtml':
							return 'xhtml';
					}
				}
				return 'text';

			case 'HTTP://WWW.W3.ORG/2005/ATOM:CONTENT':
				if (!empty($attribs['HTTP://WWW.W3.ORG/2005/ATOM']['TYPE']))
				{
					switch (strtolower(SimplePie_Misc::parse_mime($attribs['HTTP://WWW.W3.ORG/2005/ATOM']['TYPE'])))
					{
						case 'html':
						case 'text/html':
							return 'html';

						case 'xhtml':
						case 'application/xhtml+xml':
							return 'xhtml';

						case 'text':
						case 'text/plain':
							return 'text';

						default:
							return false;
					}
				}
				else
				{
					return 'text';
				}

			// Atom 0.3
			case 'HTTP://PURL.ORG/ATOM/NS#:TITLE':
			case 'HTTP://PURL.ORG/ATOM/NS#:TAGLINE':
			case 'HTTP://PURL.ORG/ATOM/NS#:COPYRIGHT':
			case 'HTTP://PURL.ORG/ATOM/NS#:INFO':
			case 'HTTP://PURL.ORG/ATOM/NS#:SUMMARY':
			case 'HTTP://PURL.ORG/ATOM/NS#:CONTENT':
				if (!empty($attribs['HTTP://PURL.ORG/ATOM/NS#']['TYPE']))
				{
					switch (strtolower(SimplePie_Misc::parse_mime($attribs['HTTP://PURL.ORG/ATOM/NS#']['TYPE'])))
					{
						case 'html':
						case 'text/html':
							return 'html';

						case 'xhtml':
						case 'application/xhtml+xml':
							return 'xhtml';

						case 'text':
						case 'text/plain':
							return 'text';

						default:
							return false;
					}
				}
				if (!empty($attribs['HTTP://PURL.ORG/ATOM/NS#']['MODE']))
				{
					switch (strtolower($attribs['HTTP://PURL.ORG/ATOM/NS#']['MODE']))
					{
						case 'xml':
							return 'xhtml';

						case 'escaped':
							return 'html';
					}
				}
				return 'text';

			// Unknown Atom (assume 1.0 rules)
			case 'atom_unknown:RIGHTS':
			case 'atom_unknown:SUBTITLE':
			case 'atom_unknown:SUMMARY':
			case 'atom_unknown:TITLE':
				if (!empty($attribs['atom_unknown']['TYPE']))
				{
					switch (strtolower($attribs['atom_unknown']['TYPE']))
					{
						case 'html':
							return 'html';

						case 'xhtml':
							return 'xhtml';
					}
				}
				return 'text';

			case 'atom_unknown:CONTENT':
				if (!empty($attribs['atom_unknown']['TYPE']))
				{
					switch (strtolower(SimplePie_Misc::parse_mime($attribs['atom_unknown']['TYPE'])))
					{
						case 'html':
						case 'text/html':
							return 'html';

						case 'xhtml':
						case 'application/xhtml+xml':
							return 'xhtml';

						case 'text':
						case 'text/plain':
							return 'text';

						default:
							return false;
					}
				}
				else
				{
					return 'text';
				}

			// RSS 0.92 and RSS 2.0 (assuming feeds with unknown RSS version follow the 2.0 rules) allow HTML within the <description> element. RSS 0.91 feeds commonly break the specification.
			case 'HTTP://PURL.ORG/RSS/1.0/:DESCRIPTION':
			case 'HTTP://BACKEND.USERLAND.COM/RSS2:DESCRIPTION':
			case 'rss092:DESCRIPTION':
			case 'rss091:DESCRIPTION':
			case 'rss_unknown:DESCRIPTION':
				return 'html';

			case 'HTTP://PURL.ORG/RSS/1.0/MODULES/CONTENT/:ENCODED':
				return 'html';

			default:
				return 'text';
		}
	}
}

class SimplePie_Sanitize
{
	// Private vars
	var $feed_link;
	var $feed_url;

	// Options
	var $remove_div = true;
	var $replace_headers = false;
	var $bypass_image_hotlink = false;
	var $bypass_image_hotlink_page = false;
	var $strip_htmltags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style');
	var $encode_instead_of_strip = false;
	var $strip_attributes = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur');
	var $output_encoding = 'UTF-8';

	function remove_div($enable = true)
	{
		$this->remove_div = (bool) $enable;
	}

	function replace_headers($enable = false)
	{
		$this->enable_headers = (bool) $enable;
	}

	function bypass_image_hotlink($get = false)
	{
		if ($get)
		{
			$this->bypass_image_hotlink = (string) $get;
		}
		else
		{
			$this->bypass_image_hotlink = false;
		}
	}

	function bypass_image_hotlink_page($page = false)
	{
		if ($page)
		{
			$this->bypass_image_hotlink_page = (string) $page;
		}
		else
		{
			$this->bypass_image_hotlink_page = false;
		}
	}

	function strip_htmltags($tags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'))
	{
		if ($tags)
		{
			if (is_array($tags))
			{
				$this->strip_htmltags = $tags;
			}
			else
			{
				$this->strip_htmltags = explode(',', $tags);
			}
		}
		else
		{
			$this->strip_htmltags = false;
		}
	}

	function encode_instead_of_strip($encode = false)
	{
		$this->encode_instead_of_strip = (bool) $encode;
	}

	function strip_attributes($attribs = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur'))
	{
		if ($attribs)
		{
			if (is_array($attribs))
			{
				$this->strip_attributes = $attribs;
			}
			else
			{
				$this->strip_attributes = explode(',', $attribs);
			}
		}
		else
		{
			$this->strip_attributes = false;
		}
	}

	function set_output_encoding($encoding = 'UTF-8')
	{
		$this->output_encoding = (string) $encoding;
	}

	function sanitize(&$array, $feed_link, $feed_url)
	{
		$array['data'] = trim($array['data']);
		if (!empty($array['data']))
		{
			if (!empty($array['attribs']['HTTP://PURL.ORG/ATOM/NS#']['MODE']) && $array['attribs']['HTTP://PURL.ORG/ATOM/NS#']['MODE'] == 'base64')
			{
				$array['data'] = base64_decode($array['data']);
			}

			switch ($array['type'])
			{
				case 'xhtml':
					if ($this->remove_div)
					{
						$array['data'] = preg_replace('/^<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '', $array['data']);
						$array['data'] = preg_replace('/<\/div>$/', '', $array['data']);
					}
					else
					{
						$array['data'] = preg_replace('/^<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '<div>', $array['data']);
					}
					// Yup, no break, as we want the generic HTML rules to be run anyway

				case 'html':
					// Strip comments
					$array['data'] = SimplePie_Misc::strip_comments($array['data']);

					// Replace H1, H2, and H3 tags with the less important H4 tags.
					// This is because on a site, the more important headers might make sense,
					// but it most likely doesn't fit in the context of RSS-in-a-webpage.
					if ($this->replace_headers)
					{
						$array['data'] = preg_replace('/<h[1-3]' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>/i', '<h4\\1>', $array['data']);
						$array['data'] = preg_replace('/<\/h[1-3]' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>/i', '</h4>', $array['data']);
					}

					// Strip out HTML tags and attributes that might cause various security problems.
					// Based on recommendations by Mark Pilgrim at:
					// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
					if ($this->strip_htmltags)
					{
						foreach ($this->strip_htmltags as $tag)
						{
							$pcre = "/<($tag)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(>(.*)<\/$tag" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>|(\/)?>)/siU';
							while (preg_match($pcre, $array['data']))
							{
								$array['data'] = preg_replace_callback($pcre, array(&$this, 'do_strip_htmltags'), $array['data']);
							}
						}
					}

					if ($this->strip_attributes)
					{
						foreach ($this->strip_attributes as $attrib)
						{
							$array['data'] = preg_replace('/ '. trim($attrib) .'=("|&quot;)(\w|\s|=|-|:|;|\/|\.|\?|&|,|#|!|\(|\)|\'|&apos;|<|>|\+|{|})*("|&quot;)/i', '', $array['data']);
							$array['data'] = preg_replace('/ '. trim($attrib) .'=(\'|&apos;)(\w|\s|=|-|:|;|\/|\.|\?|&|,|#|!|\(|\)|"|&quot;|<|>|\+|{|})*(\'|&apos;)/i', '', $array['data']);
							$array['data'] = preg_replace('/ '. trim($attrib) .'=(\w|\s|=|-|:|;|\/|\.|\?|&|,|#|!|\(|\)|\+|{|})*/i', '', $array['data']);
						}
					}

					// HTML content still needs xml:base URLs replaced
					if ($array['xml_base_explicit'] && $array['type'] == 'html' || !$array['xml_base_explicit'])
					{
						$this->feed_link = $feed_link;
						$this->feed_url = $feed_url;
						$this->replace_urls($array, 'blockquote', 'CITE');
						$this->replace_urls($array, 'ins', 'CITE');
						$this->replace_urls($array, 'del', 'CITE');
						$this->replace_urls($array, 'a', 'HREF');
						$this->replace_urls($array, 'q', 'CITE');
						$this->replace_urls($array, 'img', 'SRC');
						$this->replace_urls($array, 'img', 'LONGDESC');
						$this->replace_urls($array, 'area', 'HREF');
						$this->replace_urls($array, 'form', 'ACTION');
						$this->replace_urls($array, 'input', 'SRC');
					}

					// If Bypass Image Hotlink is enabled, rewrite all the image tags.
					if ($this->bypass_image_hotlink)
					{
						$images = SimplePie_Misc::get_element('img', $array['data']);
						foreach ($images as $img)
						{
							if (!empty($img['attribs']['SRC']['data']))
							{
								$pre = '';
								if ($this->bypass_image_hotlink_page)
								{
									$pre = $this->bypass_image_hotlink_page;
								}
								$pre .= "?$this->bypass_image_hotlink=";
								$img['attribs']['SRC']['data'] = $pre . rawurlencode($img['attribs']['SRC']['data']);
								$data = str_replace($img['full'], SimplePie_Misc::element_implode($img), $array['data']);
							}
						}
					}

					// Having (possibly) taken stuff out, there may now be whitespace at the beginning/end of the data
					$array['data'] = trim($array['data']);
					break;

				case 'text':
					$array['data'] = htmlspecialchars($array['data'], ENT_COMPAT, 'UTF-8');
					break;
			}
			if ($this->output_encoding != 'UTF-8')
			{
				$array['data'] = SimplePie_Misc::change_encoding($array['data'], 'UTF-8', $this->output_encoding);
			}
		}
	}

	function replace_urls(&$array, $tag, $attribute)
	{
		if ($array['xml_base_explicit'])
		{
			$base = $array['xml_base'];
		}
		else if (!empty($this->feed_link))
		{
			$base = $this->feed_link;
		}
		else if (!empty($this->feed_url))
		{
			$base = $this->feed_url;
		}
		else
		{
			$base = false;
		}
		$elements = SimplePie_Misc::get_element($tag, $array['data']);
		foreach ($elements as $element)
		{
			if (!empty($element['attribs'][$attribute]['data']))
			{
				$element['attribs'][$attribute]['data'] = SimplePie_Misc::absolutize_url($element['attribs'][$attribute]['data'], $base);
				$array['data'] = str_replace($element['full'], SimplePie_Misc::element_implode($element), $array['data']);
			}
		}
	}

	function do_strip_htmltags($match)
	{
		if ($this->encode_instead_of_strip)
		{
			if (isset($match[4]) && !in_array(strtolower($match[1]), array('script', 'style')))
			{
				$match[1] = htmlspecialchars($match[1], ENT_COMPAT, 'UTF-8');
				$match[2] = htmlspecialchars($match[2], ENT_COMPAT, 'UTF-8');
				return "&lt;$match[1]$match[2]&gt;$match[3]&lt;/$match[1]&gt;";
			}
			else
			{
				return htmlspecialchars($match[0], ENT_COMPAT, 'UTF-8');
			}
		}
		else
		{
			if (isset($match[4]) && !in_array(strtolower($match[1]), array('script', 'style')))
			{
				return $match[4];
			}
			else
			{
				return '';
			}
		}
	}
}

?>
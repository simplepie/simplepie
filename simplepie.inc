<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (C) 2004-2006 Ryan Parman, Geoffrey Sneddon
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
 * @copyright 2004-2006 Ryan Parman, Geoffrey Sneddon
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
define('SIMPLEPIE_VERSION', 'Razzleberry');

/**
 * SimplePie Build
 * @see SimplePie::build
 */
define('SIMPLEPIE_BUILD', gmdate('Ymd', SimplePie_Misc::parse_date('$Date$')));

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
define('SIMPLEPIE_PCRE_HTML_ATTRIBUTE', '((?:\s*(?:(?:[^\s:]+:)?[^\s:]+)(?:\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'|(?:[a-z0-9\-._:]*)))?)*)\s*');

/**
 * PCRE for XML attributes
 */
define('SIMPLEPIE_PCRE_XML_ATTRIBUTE', '((?:\s*(?:(?:[^\s:]+:)?[^\s:]+)\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'))*)\s*');

/**
 * SimplePie
 *
 * @package SimplePie
 * @version "Razzleberry"
 * @copyright 2004-2006 Ryan Parman, Geoffrey Sneddon
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
	 * @var object SimplePie_File of feed
	 * @see SimplePie::set_file()
	 * @access private
	 */
	var $file;

	/**
	 * @var int Timeout (used for fetching external files)
	 * @see SimplePie::set_timeout()
	 * @access private
	 */
	var $timeout = 10;

	/**
	 * @var bool Force fsockopen() (instead of cURL for fetching
	 * external files)
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

		// If we've passed an xmldump variable in the URL, snap into XML dump mode
		if (isset($_GET['xmldump']))
		{
			$this->enable_xml_dump(true);
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
	 * @access public
	 * @param string $url Feed URL
	 */
	function set_feed_url($url)
	{
		$this->feed_url = SimplePie_Misc::fix_protocol($url, 1);
	}

	/**
	 * Provides an instance of SimplePie_File (or subclass) to use as
	 * the feed
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

	function set_timeout($timeout = 10)
	{
		$this->timeout = (int) $timeout;
	}

	function set_raw_data($data)
	{
		$this->raw_data = trim((string) $data);
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

	function set_useragent($ua = SIMPLEPIE_USERAGENT)
	{
		$this->useragent = (string) $ua;
	}

	function force_fsockopen($enable = false)
	{
		$this->force_fsockopen = (bool) $enable;
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
		else
		{
			$this->cache_name_function = 'sha1';
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
			$this->javascript = $get;
		}
		else
		{
			$this->javascript = false;
		}
		$this->sanitize->set_javascript($get);
	}

	/**
	 * Set maximum number of feeds to check with autodiscovery
	 *
	 * @access public
	 * @param int $max Maximum number of feeds to check
	 */
	function set_max_checked_feeds($max = 10)
	{
		$this->max_checked_feeds = $max;
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
		$this->sanitize->output_encoding($encoding);
	}

	function set_item_class($class = 'SimplePie_Item')
	{
		return $this->sanitize->set_item_class($class);
	}

	function set_author_class($class = 'SimplePie_Author')
	{
		return $this->sanitize->set_author_class($class);
	}

	function set_enclosure_class($class = 'SimplePie_Enclosure')
	{
		return $this->sanitize->set_enclosure_class($class);
	}

	function init()
	{
		if (!(function_exists('version_compare') && ((version_compare(phpversion(), '4.3.2', '>=') && version_compare(phpversion(), '5', '<')) || version_compare(phpversion(), '5.0.3', '>='))) || !extension_loaded('xml') || !extension_loaded('pcre'))
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
						// If we've hit a collision just rerun it with caching disabled
						if (isset($this->data['url']) && $this->data['url'] != $this->feed_url)
						{
							$cache = false;
						}
						// If we've got a feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL
						else if (!empty($this->data['feed_url']))
						{
							if ($this->data['feed_url'] == $this->data['url'])
							{
								$cache->unlink();
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
				$file->close();
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
			else if (!empty($headers['content-type']) && preg_match('/charset=([^;]*)/i', $headers['content-type'], $charset))
			{
				$encoding = $charset[1];
			}
			// Then prolog, if at the very start of the document
			else if (preg_match('/^<\?xml(.*)?>/msiU', $data, $prolog) && preg_match('/encoding\s*=\s*("|\')([a-z][a-z0-9._\-]*)("|\')/i', $prolog[1], $encoding))
			{
				$encoding = $encoding[2];
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
			$data = SimplePie_Misc::change_encoding($data, $encoding, 'UTF-8');

			// Strip illegal characters (if on less  than PHP5, as on PHP5 expat can manage fine, thereby breaking the XML spec)
			if (version_compare(phpversion(), '5', '<'))
			{
				$data = SimplePie_Misc::utf8_bad_replace($data);
			}

			// Start parsing
			$data =& new $this->parser_class($data, 'UTF-8', $this->xml_dump);
			// If we want the XML, just output that and quit
			if ($this->xml_dump)
			{
				header('Content-type: text/xml; charset=UTF-8');
				echo $data->data;
				exit;
			}
			// If it's parsed fine
			else if (!$data->error_code)
			{
				// Parse the data, and make it sane
				$this->sanitize->parse_data_array($data->data, $this->feed_url);
				unset($data);
				// Make sure the data array is empty
				$this->data = array();
				// Get the sane data
				$this->data['feedinfo'] = $this->sanitize->feedinfo;
				unset($this->sanitize->feedinfo);
				$this->data['info'] = $this->sanitize->info;
				unset($this->sanitize->info);
				$this->data['items'] = $this->sanitize->items;
				unset($this->sanitize->items);
				$this->data['feedinfo']['encoding'] = $this->sanitize->output_encoding;
				$this->data['url'] = $this->feed_url;

				// Store the headers that we need
				if (!empty($headers['last-modified']))
				{
					$this->data['last-modified'] = $headers['last-modified'];
				}
				if (!empty($headers['etag']))
				{
					$this->data['etag'] = $headers['etag'];
				}

				// If we want to order it by date, check if all items have a date, and then sort it
				if ($this->order_by_date && !empty($this->data['items']))
				{
					$do_sort = true;
					foreach ($this->data['items'] as $item)
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
						usort($this->data['items'], create_function('$a, $b', 'if ($a->get_date(\'U\') == $b->get_date(\'U\')) return 1; return ($a->get_date(\'U\') < $b->get_date(\'U\')) ? 1 : -1;'));
					}
				}

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
				$this->error = "XML error: $data->error_string at line $data->current_line, column $data->current_column";
				SimplePie_Misc::error($this->error, E_USER_NOTICE, __FILE__, __LINE__);
				return false;
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
				$file->close();

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

	function get_feed_title()
	{
		if (!empty($this->data['info']['title']))
		{
			return $this->data['info']['title'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_link()
	{
		if (!empty($this->data['info']['link']['alternate'][0]))
		{
			return $this->data['info']['link']['alternate'][0];
		}
		else
		{
			return false;
		}
	}

	function get_feed_links()
	{
		if (!empty($this->data['info']['link']))
		{
			return $this->data['info']['link'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_description()
	{
		if (!empty($this->data['info']['description']))
		{
			return $this->data['info']['description'];
		}
		else if (!empty($this->data['info']['dc:description']))
		{
			return $this->data['info']['dc:description'];
		}
		else if (!empty($this->data['info']['tagline']))
		{
			return $this->data['info']['tagline'];
		}
		else if (!empty($this->data['info']['subtitle']))
		{
			return $this->data['info']['subtitle'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_copyright()
	{
		if (!empty($this->data['info']['copyright']))
		{
			return $this->data['info']['copyright'];
		}
		else
		{
			return false;
		}
	}

	function get_feed_language()
	{
		if (!empty($this->data['info']['language']))
		{
			return $this->data['info']['language'];
		}
		else if (!empty($this->data['info']['xml:lang']))
		{
			return $this->data['info']['xml:lang'];
		}
		else
		{
			return false;
		}
	}

	function get_image_exist()
	{
		if (!empty($this->data['info']['image']['url']) || !empty($this->data['info']['image']['logo']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_image_title()
	{
		if (!empty($this->data['info']['image']['title']))
		{
			return $this->data['info']['image']['title'];
		}
		else
		{
			return false;
		}
	}

	function get_image_url()
	{
		if (!empty($this->data['info']['image']['url']))
		{
			return $this->data['info']['image']['url'];
		}
		else if (!empty($this->data['info']['image']['logo']))
		{
			return $this->data['info']['image']['logo'];
		}
		else
		{
			return false;
		}
	}

	function get_image_link()
	{
		if (!empty($this->data['info']['image']['link']))
		{
			return $this->data['info']['image']['link'];
		}
		else
		{
			return false;
		}
	}

	function get_image_width()
	{
		if (!empty($this->data['info']['image']['width']))
		{
			return $this->data['info']['image']['width'];
		}
		else
		{
			return false;
		}
	}

	function get_image_height()
	{
		if (!empty($this->data['info']['image']['height']))
		{
			return $this->data['info']['image']['height'];
		}
		else
		{
			return false;
		}
	}

	function get_item_quantity($max = 0)
	{
		if (!empty($this->data['items']))
		{
			$qty = sizeof($this->data['items']);
		}
		else
		{
			$qty = 0;
		}
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
		if (!empty($this->data['items'][$key]))
		{
			return $this->data['items'][$key];
		}
		else
		{
			return false;
		}
	}

	function get_items($start = 0, $end = 0)
	{
		if ($this->get_item_quantity() > 0)
		{
			if ($end == 0)
			{
				return array_slice($this->data['items'], $start);
			}
			else
			{
				return array_slice($this->data['items'], $start, $end);
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
	var $data;

	function SimplePie_Item($data)
	{
		$this->data =& $data;
	}

	function get_id()
	{
		if (!empty($this->data['guid']['data']))
		{
			return $this->data['guid']['data'];
		}
		else if (!empty($this->data['id']))
		{
			return $this->data['id'];
		}
		else
		{
			return false;
		}
	}

	function get_title()
	{
		if (!empty($this->data['title']))
		{
			return $this->data['title'];
		}
		else if (!empty($this->data['dc:title']))
		{
			return $this->data['dc:title'];
		}
		else
		{
			return false;
		}
	}

	function get_description()
	{
		if (!empty($this->data['content']))
		{
			return $this->data['content'];
		}
		else if (!empty($this->data['encoded']))
		{
			return $this->data['encoded'];
		}
		else if (!empty($this->data['summary']))
		{
			return $this->data['summary'];
		}
		else if (!empty($this->data['description']))
		{
			return $this->data['description'];
		}
		else if (!empty($this->data['dc:description']))
		{
			return $this->data['dc:description'];
		}
		else if (!empty($this->data['longdesc']))
		{
			return $this->data['longdesc'];
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

	function get_categories()
	{
		$categories = array();
		if (!empty($this->data['category']))
		{
			$categories = array_merge($categories, $this->data['category']);
		}
		if (!empty($this->data['subject']))
		{
			$categories = array_merge($categories, $this->data['subject']);
		}
		if (!empty($this->data['term']))
		{
			$categories = array_merge($categories, $this->data['term']);
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

	function get_authors()
	{
		$authors = array();
		if (!empty($this->data['author']))
		{
			$authors = array_merge($authors, $this->data['author']);
		}
		if (!empty($this->data['creator']))
		{
			$authors = array_merge($authors, $this->data['creator']);
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
		if (!empty($this->data['pubdate']))
		{
			$date = $this->data['pubdate'];
		}
		else if (!empty($this->data['dc:date']))
		{
			$date = $this->data['dc:date'];
		}
		else if (!empty($this->data['issued']))
		{
			$date = $this->data['issued'];
		}
		else if (!empty($this->data['published']))
		{
			$date = $this->data['published'];
		}
		else if (!empty($this->data['modified']))
		{
			$date = $this->data['modified'];
		}
		else if (!empty($this->data['updated']))
		{
			$date = $this->data['updated'];
		}
		else
		{
			return false;
		}
		if ($date_format == 'U')
		{
			return $date;
		}
		else
		{
			return date($date_format, $date);
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

	function get_links($rel = 'alternate')
	{
		if ($rel == 'alternate')
		{
			$links = array();
			if (!empty($this->data['link'][$rel]))
			{
				$links = $this->data['link'][$rel];
			}
			if (!empty($this->data['guid']['data']) && $this->data['guid']['permalink'] == true)
			{
				$links[] = $this->data['guid']['data'];
			}
			return $links;
		}
		else if (!empty($this->data['link'][$rel]))
		{
			return $this->data['link'][$rel];
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

	function get_enclosures()
	{
		$enclosures = array();
		$links = $this->get_links('enclosure');
		if (!empty($this->data['enclosures']))
		{
			$enclosures = array_merge($enclosures, $this->data['enclosures']);
		}
		if (!empty($links))
		{
			$enclosures = array_merge($enclosures, $links);
		}
		if (!empty($enclosures))
		{
			return array_unique($enclosures);
		}
		else
		{
			return false;
		}
	}

	function get_latitude()
	{
	    if (!empty($this->data['geo:lat']))
		{
			return $this->data['geo:lat'];
		}
		else if (!empty($this->data['georss:point']))
		{
		    list($latitude, $longitude) = explode(' ', trim($this->data['georss:point']));
		    return $latitude;
	    }
	    else
		{
			return false;
		}
    }

    function get_longitude()
    {
	    if (!empty($this->data['geo:long']))
		{
			return $this->data['geo:long'];
		}
		else if (!empty($this->data['georss:point']))
		{
		    list($latitude, $longitude) = explode(' ', trim($this->data['georss:point']));
		    return $longitude;
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
					return false;
				}
				$info = curl_getinfo($fp);
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
					return false;
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
					}
					else
					{
						$this->close();
						$this->error = 'fsocket timed out';
						$this->success = false;
						return false;
					}
				}
			}
			return $this->headers['status']['code'];
		}
		else
		{
			$this->method = 'fopen';
			if ($this->fp = fopen($url, 'r'))
			{
				return true;
			}
			else
			{
				$this->error = 'fopen could not open the file';
				$this->success = false;
				return false;
			}
		}
	}

	function headers()
	{
		return $this->headers;
	}

	function body()
	{
		if (is_null($this->body))
		{
			if ($this->fp)
			{
				$info = stream_get_meta_data($this->fp);
				$this->body = '';
				if ($this->method == 'fsockopen')
				{
					$read = 1160;
				}
				else
				{
					$read = 1024;
				}
				while (!$info['eof'] && !$info['timed_out'])
				{
					$this->body .= fread($this->fp, $read);
					$info = stream_get_meta_data($this->fp);
				}
				if (!$info['timed_out'])
				{
					$this->body = trim($this->body);
					if ($this->method == 'fsockopen' && !empty($this->headers['content-encoding']) && ($this->headers['content-encoding'] == 'gzip' || $this->headers['content-encoding'] == 'deflate'))
					{
						if (substr($this->body, 0, 8) == "\x1f\x8b\x08\x00\x00\x00\x00\x00")
						{
							$this->body = substr($this->body, 10);
						}
						$this->body = gzinflate($this->body);
					}
					$this->close();
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		return $this->body;
	}

	function close()
	{
		if (!is_null($this->fp))
		{
			if (fclose($this->fp))
			{
				$this->fp = null;
				return true;
			}
			else
			{
				return false;
			}
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
			$head[strtolower(trim($data[0]))] = preg_replace("/(\r\n)?(\x09|\x20)+/", '', $data[1]);
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
		$relative = trim($relative);
		$base = trim($base);
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
							if ($base['path'] == '/' || empty($base['path']))
							{
								$target['path'] = '/' . $relative['path'];
							}
							else
							{
								$target['path'] = preg_replace('/^(.*)((\/)([^\/]*))?$/sU', '\\1', $base['path']) . '/' . $relative['path'];
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

	function get_element($realname, $string)
	{
		$return = array();
		$name = preg_quote($realname, '/');
		if (preg_match_all("/<($name)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "((\/)?>|>(.*)<\/$name>)/siU", $string, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE))
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
					$return[$i]['content'] = $matches[$i][5][0];
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
						$return[$i]['attribs'][strtoupper($attribs[$j][1])]['data'] = SimplePie_Misc::entities_decode($attribs[$j][count($attribs[$j])-1], 'UTF-8', $cache);
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
		if (preg_match('/^(([^:\/?#]+):)?(\/\/([^\/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?$/i', $url, $match))
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
	 * Replace bad bytes
	 *
	 * PCRE Pattern to locate bad bytes in a UTF-8 string
	 * Comes from W3 FAQ: Multilingual Forms
	 * Note: modified to include full ASCII range including control
	 * chars
	 *
	 * Modified by Geoffrey Sneddon 2006-11-19 to remove functionality
	 * to choose what the replace string is, and to use a variable for
	 * the output instead of PHP's output buffer
	 *
	 * Modified by Geoffrey Sneddon 2006-12-04 to use iconv or
	 * mbstring if either is enabled
	 *
	 * Modified by Geoffrey Sneddon 2006-12-16 to use preg_match_all(),
	 * so the regular expression is only run once
	 *
	 * @author Harry Fuecks <hfuecks@gmail.com>
	 * @author Geoffrey Sneddon
	 * @see http://www.w3.org/International/questions/qa-forms-utf-8
	 * @param string $str String to search
	 * @return string Clean string
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
			$UTF8_BAD =
			 '([\x00-\x7F]' .							# ASCII (including control chars)
			 '|[\xC2-\xDF][\x80-\xBF]' .				# non-overlong 2-byte
			 '|\xE0[\xA0-\xBF][\x80-\xBF]' .			# excluding overlongs
			 '|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}' .		# straight 3-byte
			 '|\xED[\x80-\x9F][\x80-\xBF]' .			# excluding surrogates
			 '|\xF0[\x90-\xBF][\x80-\xBF]{2}' .			# planes 1-3
			 '|[\xF1-\xF3][\x80-\xBF]{3}' .				# planes 4-15
			 '|\xF4[\x80-\x8F][\x80-\xBF]{2}' .			# plane 16
			 '|(.{1}))';								# invalid byte
			$output = '';
			if (preg_match_all('/' . $UTF8_BAD . '/S', $str, $matches, PREG_SET_ORDER))
			{
				foreach ($matches as $match)
				{
					if (!isset($match[2]))
					{
						$output .= $match[0];
					}
				}
			}
			return $output;
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

		if ($input != $output)
		{
			if (function_exists('iconv') && $data = @iconv($input, $output, $data))
			{
				return $data;
			}
			else if (function_exists('mb_convert_encoding') && $data = @mb_convert_encoding($data, $output, $input))
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
		if (preg_match('/(?:(([0-9]{1,2})\s*(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s*([0-9]{4}|[0-9]{2}))|(([0-9]{2})(?:([0-9]{2})(?:(?:-|\s)*(?:([0-9]{2})([0-9]{2})|([0-9]{3})|([0-9]{2})(?:(?:-|\s)*([0-9]{2}))?|W([0-9]{2})(?:(?:-|\s)*([0-9]))?))?)?))((?:T|\s)*([0-9]{2})(?:(?:,|\.)([0-9]*)|(?:\:|\s)*([0-9]{2})(?:(?:,|\.)([0-9]*)|(?:\:|\s)*([0-9]{2})(?:(?:,|\.)([0-9]*))?)?)?(?:\s)*((?:(\\+|-)([0-9]{2})(?:(?:,|\.)([0-9]*)|(?:\:|\s)*(?:([0-9]{2})(?:(?:,|\.)([0-9]*))?))?)|([A-Z]{1,3}))?)?/i', $dt, $match))
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
							if ($match[28] == 'Z' || $match[28] == 'z')
							{
								$timezone = 0;
							}
							else if (preg_match('/^[a-ik-y]$/i', $match[28]))
							{
								if ($rfc822_tz)
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
								else
								{
									$timezone = 0;
								}
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

	function entities_decode($data, $encoding, &$cache)
	{
		return preg_replace('/&(#)?(x)?([0-9a-z]+);/ie', 'SimplePie_Misc::do_entities_decode(\'\\0\', $encoding, $cache)', $data);
	}

	function do_entities_decode($data, $encoding, &$cache)
	{
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
		if (preg_match('/^([^;]*)(;|$)/i', trim($mime), $match))
		{
			return rtrim($match[1]);
		}
		else
		{
			return $mime;
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

	function SimplePie_Locator(&$file, $timeout = 10, $useragent = null, $file_class = 'SimplePie_File', $max_checked_feeds)
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

		if ($this->checked_feeds != $this->max_checked_feeds && $type & (SIMPLEPIE_LOCATOR_LOCAL_EXTENSION | SIMPLEPIE_LOCATOR_LOCAL_BODY | SIMPLEPIE_LOCATOR_REMOTE_EXTENSION | SIMPLEPIE_LOCATOR_REMOTE_BODY) && $this->get_links())
		{
			if (!empty($this->local))
			{
				if ($this->checked_feeds != $this->max_checked_feeds && $type & SIMPLEPIE_LOCATOR_LOCAL_EXTENSION && $working = $this->extension($this->local))
				{
					return $working;
				}

				if ($this->checked_feeds != $this->max_checked_feeds && $type & SIMPLEPIE_LOCATOR_LOCAL_BODY && $working = $this->body($this->local))
				{
					return $working;
				}
			}

			if ($this->checked_feeds != $this->max_checked_feeds && !empty($this->elsewhere))
			{
				if ($this->checked_feeds != $this->max_checked_feeds && $type & SIMPLEPIE_LOCATOR_REMOTE_EXTENSION && $working = $this->extension($this->elsewhere))
				{
					return $working;
				}

				if ($this->checked_feeds != $this->max_checked_feeds && $type & SIMPLEPIE_LOCATOR_REMOTE_BODY && $working = $this->body($this->elsewhere))
				{
					return $working;
				}
			}
		}
		return false;
	}

	function is_feed(&$file)
	{
		$body = SimplePie_Misc::strip_comments($file->body());
		if (preg_match('/<([^\s:]+:)?(rss|RDF|feed)/i', $body))
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
	var $encoding;
	var $data;
	var $namespaces = array('xml' => 'HTTP://WWW.W3.ORG/XML/1998/NAMESPACE', 'atom' => 'ATOM', 'rss2' => 'RSS', 'rdf' => 'RDF', 'rss1' => 'RSS', 'dc' => 'DC', 'xhtml' => 'XHTML', 'content' => 'CONTENT', 'geo' => 'GEO', 'georss' => 'GEORSS');
	var $xml;
	var $error_code;
	var $error_string;
	var $current_line;
	var $current_column;
	var $current_byte;
	var $tag_name;
	var $inside_item;
	var $item_number = 0;
	var $inside_channel;
	var $author_number= 0;
	var $category_number = 0;
	var $enclosure_number = 0;
	var $link_number = 0;
	var $item_link_number = 0;
	var $inside_image;
	var $attribs;
	var $is_first;
	var $inside_author;
	var $depth_inside_item = 0;


	function SimplePie_Parser(&$data, $encoding, $return_xml = false)
	{
		$this->encoding = $encoding;

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
		if (preg_match('/^<\?xml(.*)?>/siU', $data, $prolog))
		{
			$data = substr_replace($data, '', 0, strlen($prolog[0]));
		}
		$data = "<?xml version='1.0' encoding='$encoding'?>\n" . $data;

		// Put some data into CDATA blocks
		// If we're RSS
		if (preg_match('/<([^\s:]+:)?(rss|RDF)/i', $data))
		{
			$sp_elements = array(
				'author',
				'category',
				'copyright',
				'description',
				'docs',
				'generator',
				'guid',
				'language',
				'lastBuildDate',
				'link',
				'managingEditor',
				'pubDate',
				'title',
				'url',
				'webMaster',
			);
		}
		// Or if we're Atom
		else
		{
			$sp_elements = array(
				'content',
				'copyright',
				'name',
				'subtitle',
				'summary',
				'tagline',
				'title',
			);
		}
		foreach ($sp_elements as $full)
		{
			$data = preg_replace_callback("/<($full)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(\/>|>(.*)<\/$full>)/siU", array(&$this, 'add_cdata'), $data);
		}
		foreach ($sp_elements as $full)
		{
			// Deal with CDATA within CDATA (this can be caused by us inserting CDATA above)
			$data = preg_replace_callback("/<($full)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(\/>|><!\[CDATA\[(.*)\]\]><\/$full>)/msiU", array(&$this, 'cdata_in_cdata'), $data);
		}

		// Return the XML, if so desired
		if ($return_xml)
		{
			$this->data =& $data;
			return;
		}

		// Create the parser
		$this->xml = xml_parser_create_ns($encoding);
		xml_parser_set_option($this->xml, XML_OPTION_SKIP_WHITE, 1);
		xml_set_object($this->xml, $this);
		xml_set_character_data_handler($this->xml, 'data_handler');
		xml_set_element_handler($this->xml, 'start_handler', 'end_handler');
		xml_set_start_namespace_decl_handler($this->xml, 'start_name_space');
		xml_set_end_namespace_decl_handler($this->xml, 'end_name_space');

		// Parse!
		if (!xml_parse($this->xml, $data))
		{
			$this->data = null;
			$this->error_code = xml_get_error_code($this->xml);
			$this->error_string = xml_error_string($this->error_code);
		}
		$this->current_line = xml_get_current_line_number($this->xml);
		$this->current_column = xml_get_current_column_number($this->xml);
		$this->current_byte = xml_get_current_byte_index($this->xml);
		xml_parser_free($this->xml);
		return;
	}

	function add_cdata($match)
	{
		if (isset($match[4]))
		{
			return "<$match[1]$match[2]><![CDATA[$match[4]]]></$match[1]>";
		}
		return $match[0];
	}

	function cdata_in_cdata($match)
	{
		if (isset($match[4]))
		{
			$match[4] = preg_replace_callback('/<!\[CDATA\[(.*)\]\]>/siU', array(&$this, 'real_cdata_in_cdata'), $match[4]);
			return "<$match[1]$match[2]><![CDATA[$match[4]]]></$match[1]>";
		}
		return $match[0];
	}

	function real_cdata_in_cdata($match)
	{
		return htmlspecialchars($match[1], ENT_NOQUOTES);
	}

	function do_add_content(&$array, $data)
	{
		if ($this->is_first)
		{
			$array['data'] = $data;
			$array['attribs'] = $this->attribs;
		}
		else
		{
			$array['data'] .= $data;
		}
	}

	function start_handler($parser, $name, $attribs)
	{
		$this->tag_name = $name;
		$this->attribs = $attribs;
		$this->is_first = true;

		if ($this->inside_item)
		{
			$this->depth_inside_item++;
		}

		switch ($this->tag_name)
		{
			case 'ITEM':
			case $this->namespaces['rss2'] . ':ITEM':
			case $this->namespaces['rss1'] . ':ITEM':
			case 'ENTRY':
			case $this->namespaces['atom'] . ':ENTRY':
				$this->inside_item = true;
				$this->do_add_content($this->data['items'][$this->item_number], '');
				break;

			case 'CHANNEL':
			case $this->namespaces['rss2'] . ':CHANNEL':
			case $this->namespaces['rss1'] . ':CHANNEL':
				$this->inside_channel = true;
				break;

			case 'RSS':
			case $this->namespaces['rss2'] . ':RSS':
				$this->data['feedinfo']['type'] = 'RSS';
				$this->do_add_content($this->data['feeddata'], '');
				if (!empty($attribs['VERSION']))
				{
					$this->data['feedinfo']['version'] = trim($attribs['VERSION']);
				}
				break;

			case $this->namespaces['rdf'] . ':RDF':
				$this->data['feedinfo']['type'] = 'RSS';
				$this->do_add_content($this->data['feeddata'], '');
				$this->data['feedinfo']['version'] = 1;
				break;

			case 'FEED':
			case $this->namespaces['atom'] . ':FEED':
				$this->data['feedinfo']['type'] = 'Atom';
				$this->do_add_content($this->data['feeddata'], '');
				if (!empty($attribs['VERSION']))
				{
					$this->data['feedinfo']['version'] = trim($attribs['VERSION']);
				}
				break;

			case 'IMAGE':
			case $this->namespaces['rss2'] . ':IMAGE':
			case $this->namespaces['rss1'] . ':IMAGE':
				if ($this->inside_channel)
				{
					$this->inside_image = true;
				}
				break;
		}

		if (!empty($this->data['feedinfo']['type']) && $this->data['feedinfo']['type'] == 'Atom' && ($this->tag_name == 'AUTHOR' || $this->tag_name == $this->namespaces['atom'] . ':AUTHOR'))
		{
			$this->inside_author = true;
		}
		$this->data_handler($this->xml, '');
	}

	function data_handler($parser, $data)
	{
		if ($this->inside_item && $this->depth_inside_item == 1)
		{
			switch ($this->tag_name)
			{
				case 'TITLE':
				case $this->namespaces['rss1'] . ':TITLE':
				case $this->namespaces['rss2'] . ':TITLE':
				case $this->namespaces['atom'] . ':TITLE':
					$this->do_add_content($this->data['items'][$this->item_number]['title'], $data);
					break;

				case $this->namespaces['dc'] . ':TITLE':
					$this->do_add_content($this->data['items'][$this->item_number]['dc:title'], $data);
					break;

				case 'CONTENT':
				case $this->namespaces['atom'] . ':CONTENT':
					$this->do_add_content($this->data['items'][$this->item_number]['content'], $data);
					break;

				case $this->namespaces['content'] . ':ENCODED':
					$this->do_add_content($this->data['items'][$this->item_number]['encoded'], $data);
					break;

				case 'SUMMARY':
				case $this->namespaces['atom'] . ':SUMMARY':
					$this->do_add_content($this->data['items'][$this->item_number]['summary'], $data);
					break;

				case 'LONGDESC':
					$this->do_add_content($this->data['items'][$this->item_number]['longdesc'], $data);
					break;

				case 'DESCRIPTION':
				case $this->namespaces['rss1'] . ':DESCRIPTION':
				case $this->namespaces['rss2'] . ':DESCRIPTION':
					$this->do_add_content($this->data['items'][$this->item_number]['description'], $data);
					break;

				case $this->namespaces['dc'] . ':DESCRIPTION':
					$this->do_add_content($this->data['items'][$this->item_number]['dc:description'], $data);
					break;

				case 'LINK':
				case $this->namespaces['rss1'] . ':LINK':
				case $this->namespaces['rss2'] . ':LINK':
				case $this->namespaces['atom'] . ':LINK':
					$this->do_add_content($this->data['items'][$this->item_number]['link'][$this->item_link_number], $data);
					break;

				case 'ENCLOSURE':
				case $this->namespaces['rss1'] . ':ENCLOSURE':
				case $this->namespaces['rss2'] . ':ENCLOSURE':
				case $this->namespaces['atom'] . ':ENCLOSURE':
					$this->do_add_content($this->data['items'][$this->item_number]['enclosure'][$this->enclosure_number], $data);
					break;

				case 'GUID':
				case $this->namespaces['rss1'] . ':GUID':
				case $this->namespaces['rss2'] . ':GUID':
					$this->do_add_content($this->data['items'][$this->item_number]['guid'], $data);
					break;

				case 'ID':
				case $this->namespaces['atom'] . ':ID':
					$this->do_add_content($this->data['items'][$this->item_number]['id'], $data);
					break;

				case 'PUBDATE':
				case $this->namespaces['rss1'] . ':PUBDATE':
				case $this->namespaces['rss2'] . ':PUBDATE':
					$this->do_add_content($this->data['items'][$this->item_number]['pubdate'], $data);
					break;

				case $this->namespaces['dc'] . ':DATE':
					$this->do_add_content($this->data['items'][$this->item_number]['dc:date'], $data);
					break;

				case 'ISSUED':
				case $this->namespaces['atom'] . ':ISSUED':
					$this->do_add_content($this->data['items'][$this->item_number]['issued'], $data);
					break;

				case 'PUBLISHED':
				case $this->namespaces['atom'] . ':PUBLISHED':
					$this->do_add_content($this->data['items'][$this->item_number]['published'], $data);
					break;

				case 'MODIFIED':
				case $this->namespaces['atom'] . ':MODIFIED':
					$this->do_add_content($this->data['items'][$this->item_number]['modified'], $data);
					break;

				case 'UPDATED':
				case $this->namespaces['atom'] . ':UPDATED':
					$this->do_add_content($this->data['items'][$this->item_number]['updated'], $data);
					break;

				case 'CATEGORY':
				case $this->namespaces['rss1'] . ':CATEGORY':
				case $this->namespaces['rss2'] . ':CATEGORY':
				case $this->namespaces['atom'] . ':CATEGORY':
					$this->do_add_content($this->data['items'][$this->item_number]['category'][$this->category_number], $data);
					break;

				case $this->namespaces['dc'] . ':SUBJECT':
					$this->do_add_content($this->data['items'][$this->item_number]['subject'][$this->category_number], $data);
					break;

				case $this->namespaces['dc'] . ':CREATOR':
					$this->do_add_content($this->data['items'][$this->item_number]['creator'][$this->author_number], $data);
					break;

				case 'AUTHOR':
				case $this->namespaces['rss1'] . ':AUTHOR':
				case $this->namespaces['rss2'] . ':AUTHOR':
					$this->do_add_content($this->data['items'][$this->item_number]['author'][$this->author_number]['rss'], $data);
					break;

		        case $this->namespaces['geo'] . ':LAT':
    				$this->do_add_content($this->data['items'][$this->item_number]['geo:lat'], $data);
    				break;

    			case $this->namespaces['geo'] . ':LONG':
				    $this->do_add_content($this->data['items'][$this->item_number]['geo:long'], $data);
				    break;
				
				case $this->namespaces['georss'] . ':POINT':
        			$this->do_add_content($this->data['items'][$this->item_number]['georss:point'], $data);
        			break;
			}
		}
		else if ($this->inside_author && $this->depth_inside_item == 2)
		{
			switch ($this->tag_name)
			{
				case 'NAME':
				case $this->namespaces['atom'] . ':NAME':
					$this->do_add_content($this->data['items'][$this->item_number]['author'][$this->author_number]['name'], $data);
					break;

				case 'URL':
				case $this->namespaces['atom'] . ':URL':
					$this->do_add_content($this->data['items'][$this->item_number]['author'][$this->author_number]['url'], $data);
					break;

				case 'URI':
				case $this->namespaces['atom'] . ':URI':
					$this->do_add_content($this->data['items'][$this->item_number]['author'][$this->author_number]['uri'], $data);
					break;

				case 'HOMEPAGE':
				case $this->namespaces['atom'] . ':HOMEPAGE':
					$this->do_add_content($this->data['items'][$this->item_number]['author'][$this->author_number]['homepage'], $data);
					break;

				case 'EMAIL':
				case $this->namespaces['atom'] . ':EMAIL':
					$this->do_add_content($this->data['items'][$this->item_number]['author'][$this->author_number]['email'], $data);
					break;
			}
		}
		else if (!$this->inside_item && (($this->inside_channel && !$this->inside_image) || (isset($this->data['feedinfo']['type']) && $this->data['feedinfo']['type'] == 'Atom')))
		{
			switch ($this->tag_name)
			{
				case 'TITLE':
				case $this->namespaces['rss1'] . ':TITLE':
				case $this->namespaces['rss2'] . ':TITLE':
				case $this->namespaces['atom'] . ':TITLE':
					$this->do_add_content($this->data['info']['title'], $data);
					break;

				case 'LINK':
				case $this->namespaces['rss1'] . ':LINK':
				case $this->namespaces['rss2'] . ':LINK':
				case $this->namespaces['atom'] . ':LINK':
					$this->do_add_content($this->data['info']['link'][$this->link_number], $data);
					break;

				case 'DESCRIPTION':
				case $this->namespaces['rss1'] . ':DESCRIPTION':
				case $this->namespaces['rss2'] . ':DESCRIPTION':
					$this->do_add_content($this->data['info']['description'], $data);
					break;

				case $this->namespaces['dc'] . ':DESCRIPTION':
					$this->do_add_content($this->data['info']['dc:description'], $data);
					break;

				case 'TAGLINE':
				case $this->namespaces['atom'] . ':TAGLINE':
					$this->do_add_content($this->data['info']['tagline'], $data);
					break;

				case 'SUBTITLE':
				case $this->namespaces['atom'] . ':SUBTITLE':
					$this->do_add_content($this->data['info']['subtitle'], $data);
					break;

				case 'COPYRIGHT':
				case $this->namespaces['rss1'] . ':COPYRIGHT':
				case $this->namespaces['rss2'] . ':COPYRIGHT':
				case $this->namespaces['atom'] . ':COPYRIGHT':
					$this->do_add_content($this->data['info']['copyright'], $data);
					break;

				case 'LANGUAGE':
				case $this->namespaces['rss1'] . ':LANGUAGE':
				case $this->namespaces['rss2'] . ':LANGUAGE':
					$this->do_add_content($this->data['info']['language'], $data);
					break;

				case 'LOGO':
				case $this->namespaces['atom'] . ':LOGO':
					$this->do_add_content($this->data['info']['logo'], $data);
					break;

			}
		}

		else if ($this->inside_channel && $this->inside_image)
		{
			switch ($this->tag_name)
			{
				case 'TITLE':
				case $this->namespaces['rss1'] . ':TITLE':
				case $this->namespaces['rss2'] . ':TITLE':
					$this->do_add_content($this->data['info']['image']['title'], $data);
					break;

				case 'URL':
				case $this->namespaces['rss1'] . ':URL':
				case $this->namespaces['rss2'] . ':URL':
					$this->do_add_content($this->data['info']['image']['url'], $data);
					break;

				case 'LINK':
				case $this->namespaces['rss1'] . ':LINK':
				case $this->namespaces['rss2'] . ':LINK':
					$this->do_add_content($this->data['info']['image']['link'], $data);
					break;

				case 'WIDTH':
				case $this->namespaces['rss1'] . ':WIDTH':
				case $this->namespaces['rss2'] . ':WIDTH':
					$this->do_add_content($this->data['info']['image']['width'], $data);
					break;

				case 'HEIGHT':
				case $this->namespaces['rss1'] . ':HEIGHT':
				case $this->namespaces['rss2'] . ':HEIGHT':
					$this->do_add_content($this->data['info']['image']['height'], $data);
					break;
			}
		}
		$this->is_first = false;
	}

	function end_handler($parser, $name)
	{
		$this->tag_name = '';
		switch ($name)
		{
			case 'ITEM':
			case $this->namespaces['rss1'] . ':ITEM':
			case $this->namespaces['rss2'] . ':ITEM':
			case 'ENTRY':
			case $this->namespaces['atom'] . ':ENTRY':
				$this->inside_item = false;
				$this->item_number++;
				$this->author_number = 0;
				$this->category_number = 0;
				$this->enclosure_number = 0;
				$this->item_link_number = 0;
				break;

			case 'CHANNEL':
			case $this->namespaces['rss1'] . ':CHANNEL':
			case $this->namespaces['rss2'] . ':CHANNEL':
				$this->inside_channel = false;
				break;

			case 'IMAGE':
			case $this->namespaces['rss1'] . ':IMAGE':
			case $this->namespaces['rss2'] . ':IMAGE':
				$this->inside_image = false;
				break;

			case 'AUTHOR':
			case $this->namespaces['rss1'] . ':AUTHOR':
			case $this->namespaces['rss2'] . ':AUTHOR':
			case $this->namespaces['atom'] . ':AUTHOR':
				$this->author_number++;
				$this->inside_author = false;
				break;

			case 'CATEGORY':
			case $this->namespaces['rss1'] . ':CATEGORY':
			case $this->namespaces['rss2'] . ':CATEGORY':
			case $this->namespaces['atom'] . ':CATEGORY':
			case $this->namespaces['dc'] . ':SUBJECT':
				$this->category_number++;
				break;

			case 'ENCLOSURE':
			case $this->namespaces['rss1'] . ':ENCLOSURE':
			case $this->namespaces['rss2'] . ':ENCLOSURE':
				$this->enclosure_number++;
				break;

			case 'LINK':
			case $this->namespaces['rss1'] . ':LINK':
			case $this->namespaces['rss2'] . ':LINK':
			case $this->namespaces['atom'] . ':LINK':
				if ($this->inside_item)
				{
					$this->item_link_number++;
				}
				else
				{
					$this->link_number++;
				}
				break;
		}

		if ($this->inside_item)
		{
			$this->depth_inside_item--;
		}
	}

	function start_name_space($parser, $prefix, $uri = null)
	{
		$prefix = strtoupper($prefix);
		$uri = strtoupper($uri);
		if ($prefix == 'ATOM' || $uri == 'HTTP://WWW.W3.ORG/2005/ATOM' || $uri == 'HTTP://PURL.ORG/ATOM/NS#')
		{
			$this->namespaces['atom'] = $uri;
		}
		else if ($prefix == 'RSS2' || $uri == 'HTTP://BACKEND.USERLAND.COM/RSS2')
		{
			$this->namespaces['rss2'] = $uri;
		}
		else if ($prefix == 'RDF' || $uri == 'HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#')
		{
			$this->namespaces['rdf'] = $uri;
		}
		else if ($prefix == 'RSS' || $uri == 'HTTP://PURL.ORG/RSS/1.0/' || $uri == 'HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/')
		{
			$this->namespaces['rss1'] = $uri;
		}
		else if ($prefix == 'DC' || $uri == 'HTTP://PURL.ORG/DC/ELEMENTS/1.1/')
		{
			$this->namespaces['dc'] = $uri;
		}
		else if ($prefix == 'XHTML' || $uri == 'HTTP://WWW.W3.ORG/1999/XHTML')
		{
			$this->namespaces['xhtml'] = $uri;
			$this->xhtml_prefix = $prefix;
		}
		else if ($prefix == 'CONTENT' || $uri == 'HTTP://PURL.ORG/RSS/1.0/MODULES/CONTENT/')
		{
			$this->namespaces['content'] = $uri;
		}
		else if ($prefix == 'GEO' || $uri == 'HTTP://WWW.W3.ORG/2003/01/GEO/WGS84_pos#')
		{
			$this->namespaces['geo'] = $uri;
		}
		else if ($prefix == 'GEORSS' || $uri == 'HTTP://WWW.GEORSS.ORG/GEORSS')
		{
			$this->namespaces['georss'] = $uri;
		}
	}

	function end_name_space($parser, $prefix)
	{
		if ($key = array_search(strtoupper($prefix), $this->namespaces))
		{
			if ($key == 'atom')
			{
				$this->namespaces['atom'] = 'ATOM';
			}
			else if ($key == 'rss2')
			{
				$this->namespaces['rss2'] = 'RSS';
			}
			else if ($key == 'rdf')
			{
				$this->namespaces['rdf'] = 'RDF';
			}
			else if ($key == 'rss1')
			{
				$this->namespaces['rss1'] = 'RSS';
			}
			else if ($key == 'dc')
			{
				$this->namespaces['dc'] = 'DC';
			}
			else if ($key == 'xhtml')
			{
				$this->namespaces['xhtml'] = 'XHTML';
				$this->xhtml_prefix = 'XHTML';
			}
			else if ($key == 'content')
			{
				$this->namespaces['content'] = 'CONTENT';
			}
			else if ($key == 'geo')
			{
				$this->namespaces['geo'] = 'GEO';
			}
			else if ($key == 'georss')
			{
				$this->namespaces['georss'] = 'GEORSS';
			}
		}
	}
}

class SimplePie_Sanitize
{
	// Private vars
	var $feedinfo;
	var $info;
	var $items;
	var $feed_xmlbase;
	var $item_xmlbase;
	var $attribs;
	var $cached_entities;
	var $cache_convert_entities;

	// Options
	var $remove_div = true;
	var $replace_headers = false;
	var $bypass_image_hotlink = false;
	var $bypass_image_hotlink_page = false;
	var $strip_htmltags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style');
	var $encode_instead_of_strip = false;
	var $strip_attributes = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur');
	var $input_encoding = 'UTF-8';
	var $output_encoding = 'UTF-8';
	var $item_class = 'SimplePie_Item';
	var $author_class = 'SimplePie_Author';
	var $enclosure_class = 'SimplePie_Enclosure';
	var $javascript = 'js';

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

	function encode_instead_of_strip($enable = false)
	{
		$this->encode_instead_of_strip = (bool) $enable;
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

	function set_input_encoding($encoding = 'UTF-8')
	{
		$this->input_encoding = (string) $encoding;
	}

	function set_output_encoding($encoding = 'UTF-8')
	{
		$this->output_encoding = (string) $encoding;
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
			$this->javascript = $get;
		}
		else
		{
			$this->javascript = false;
		}
	}

	function parse_data_array(&$data, $url)
	{
		// Parse feed URL
		$parsed_url = SimplePie_Misc::parse_url($url);

		// XML Base status
		$xmlbase = true;

		// Feed Info (Type and Version)
		if (!empty($data['feedinfo']['type']))
		{
			$this->feedinfo = $data['feedinfo'];
		}

		// Feed XML Base
		if (!empty($data['feeddata']['attribs']['XML:BASE']))
		{
			$this->feed_xmlbase = $data['feeddata']['attribs']['XML:BASE'];
		}
		else if (!empty($data['feeddata']['attribs']['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:BASE']))
		{
			$this->feed_xmlbase = $data['feeddata']['attribs']['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:BASE'];
		}
		// Local URL
		else if (empty($parsed_url['authority']))
		{
			$this->feed_xmlbase = preg_replace('/^' . preg_quote(realpath($_SERVER['DOCUMENT_ROOT']), '/') . '/', '', realpath($url));
		}
		// Just take the feed URL
		else
		{
			$this->feed_xmlbase = $url;
			$xmlbase = false;
		}


		// Feed link(s)
		if (!empty($data['info']['link']))
		{
			foreach ($data['info']['link'] as $link)
			{
				if (empty($link['attribs']['REL']))
				{
					$rel = 'alternate';
				}
				else
				{
					$rel = strtolower($link['attribs']['REL']);
				}
				if ($rel == 'enclosure')
				{
					$href = null;
					$type = null;
					$length = null;
					if (!empty($link['data']))
					{
						$href = $this->sanitize($link['data'], $link['attribs'], true);
					}
					else if (!empty($link['attribs']['HREF']))
					{
						$href = $this->sanitize($link['attribs']['HREF'], $link['attribs'], true);
					}
					if (!empty($link['attribs']['TYPE']))
					{
						$type = $this->sanitize($link['attribs']['TYPE'], $link['attribs']);
					}
					if (!empty($link['attribs']['LENGTH']))
					{
						$length = $this->sanitize($link['attribs']['LENGTH'], $link['attribs']);
					}
					$this->info['link']['enclosure'][] =& new $this->enclosure_class($href, $type, $length, $this->javascript);
				}
				else
				{
					if (!empty($link['data']))
					{
						$this->info['link'][$rel][] = $this->sanitize($link['data'], $link['attribs'], true);
					}
					else if (!empty($link['attribs']['HREF']))
					{
						$this->info['link'][$rel][] = $this->sanitize($link['attribs']['HREF'], $link['attribs'], true);
					}
				}
			}
		}

		// Use the first alternate link if we don't have a xml base
		if (!$xmlbase && !empty($this->info['link']['alternate'][0]))
		{
			$this->feed_xmlbase = $this->info['link']['alternate'][0];
		}

		// Feed Title
		if (!empty($data['info']['title']['data']))
		{
			$this->info['title'] = $this->sanitize($data['info']['title']['data'], $data['info']['title']['attribs']);
		}

		// Feed Descriptions
		if (!empty($data['info']['description']['data']))
		{
			$this->info['description'] = $this->sanitize($data['info']['description']['data'], $data['info']['description']['attribs'], false, true);
		}
		if (!empty($data['info']['dc:description']['data']))
		{
			$this->info['dc:description'] = $this->sanitize($data['info']['dc:description']['data'], $data['info']['dc:description']['attribs']);
		}
		if (!empty($data['info']['tagline']['data']))
		{
			$this->info['tagline'] = $this->sanitize($data['info']['tagline']['data'], $data['info']['tagline']['attribs']);
		}
		if (!empty($data['info']['subtitle']['data']))
		{
			$this->info['subtitle'] = $this->sanitize($data['info']['subtitle']['data'], $data['info']['subtitle']['attribs']);
		}

		// Feed Language
		if (!empty($data['info']['language']['data']))
		{
			$this->info['language'] = $this->sanitize($data['info']['language']['data'], $data['info']['language']['attribs']);
		}
		if (!empty($data['feeddata']['attribs']['XML:LANG']))
		{
			$this->info['xml:lang'] = $this->sanitize($data['feeddata']['attribs']['XML:LANG'], null);
		}
		else if (!empty($data['feeddata']['attribs']['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:LANG']))
		{
			$this->info['xml:lang'] = $this->sanitize($data['feeddata']['attribs']['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:LANG'], null);
		}

		// Feed Copyright
		if (!empty($data['info']['copyright']['data']))
		{
			$this->info['copyright'] = $this->sanitize($data['info']['copyright']['data'], $data['info']['copyright']['attribs']);
		}

		// Feed Image
		if (!empty($data['info']['image']['title']['data']))
		{
			$this->info['image']['title'] = $this->sanitize($data['info']['image']['title']['data'], $data['info']['image']['title']['attribs']);
		}
		if (!empty($data['info']['image']['url']['data']))
		{
			$this->info['image']['url'] = $this->sanitize($data['info']['image']['url']['data'], $data['info']['image']['url']['attribs'], true);
		}
		if (!empty($data['info']['logo']['data']))
		{
			$this->info['image']['logo'] = $this->sanitize($data['info']['logo']['data'], $data['info']['logo']['attribs'], true);
		}
		if (!empty($data['info']['image']['link']['data']))
		{
			$this->info['image']['link'] = $this->sanitize($data['info']['image']['link']['data'], $data['info']['image']['link']['attribs'], true);
		}
		if (!empty($data['info']['image']['width']['data']))
		{
			$this->info['image']['width'] = $this->sanitize($data['info']['image']['width']['data'], $data['info']['image']['width']['attribs']);
		}
		if (!empty($data['info']['image']['height']['data']))
		{
			$this->info['image']['height'] = $this->sanitize($data['info']['image']['height']['data'], $data['info']['image']['height']['attribs']);
		}

		// Items
		if (!empty($data['items']))
		{
			foreach ($data['items'] as $key => $item)
			{
				$newitem = null;

				// Item level xml:base
				if (!empty($item['attribs']['XML:BASE']))
				{
					$this->item_xmlbase = SimplePie_Misc::absolutize_url($item['attribs']['XML:BASE'], $this->feed_xmlbase);
				}
				else if (!empty($item['attribs']['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:BASE']))
				{
					$this->item_xmlbase = SimplePie_Misc::absolutize_url($item['attribs']['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:BASE'], $this->feed_xmlbase);
				}
				else
				{
					$this->item_xmlbase = null;
				}

				// Title
				if (!empty($item['title']['data']))
				{
					$newitem['title'] = $this->sanitize($item['title']['data'], $item['title']['attribs']);
				}
				if (!empty($item['dc:title']['data']))
				{
					$newitem['dc:title'] = $this->sanitize($item['dc:title']['data'], $item['dc:title']['attribs']);
				}

				// Description
				if (!empty($item['content']['data']))
				{
					$newitem['content'] = $this->sanitize($item['content']['data'], $item['content']['attribs']);
				}
				if (!empty($item['encoded']['data']))
				{
					$newitem['encoded'] = $this->sanitize($item['encoded']['data'], $item['encoded']['attribs']);
				}
				if (!empty($item['summary']['data']))
				{
					$newitem['summary'] = $this->sanitize($item['summary']['data'], $item['summary']['attribs']);
				}
				if (!empty($item['description']['data']))
				{
					$newitem['description'] = $this->sanitize($item['description']['data'], $item['description']['attribs'], false, true);
				}
				if (!empty($item['dc:description']['data']))
				{
					$newitem['dc:description'] = $this->sanitize($item['dc:description']['data'], $item['dc:description']['attribs']);
				}
				if (!empty($item['longdesc']['data']))
				{
					$newitem['longdesc'] = $this->sanitize($item['longdesc']['data'], $item['longdesc']['attribs']);
				}

				// Link(s)
				if (!empty($item['link']))
				{
					foreach ($item['link'] as $link)
					{
						if (empty($link['attribs']['REL']))
						{
							$rel = 'alternate';
						}
						else
						{
							$rel = strtolower($link['attribs']['REL']);
						}
						if ($rel == 'enclosure')
						{
							$href = null;
							$type = null;
							$length = null;
							if (!empty($link['data']))
							{
								$href = $this->sanitize($link['data'], $link['attribs'], true);
							}
							else if (!empty($link['attribs']['HREF']))
							{
								$href = $this->sanitize($link['attribs']['HREF'], $link['attribs'], true);
							}
							if (!empty($link['attribs']['TYPE']))
							{
								$type = $this->sanitize($link['attribs']['TYPE'], $link['attribs']);
							}
							if (!empty($link['attribs']['LENGTH']))
							{
								$length = $this->sanitize($link['attribs']['LENGTH'], $link['attribs']);
							}
							if (!empty($href))
							{
								$newitem['link'][$rel][] =& new $this->enclosure_class($href, $type, $length, $this->javascript);
							}
						}
						else
						{
							if (!empty($link['data']))
							{
								$newitem['link'][$rel][] = $this->sanitize($link['data'], $link['attribs'], true);
							}
							else if (!empty($link['attribs']['HREF']))
							{
								$newitem['link'][$rel][] = $this->sanitize($link['attribs']['HREF'], $link['attribs'], true);
							}
						}
					}
				}

				// Enclosure(s)
				if (!empty($item['enclosure']))
				{
					foreach ($item['enclosure'] as $enclosure)
					{
						if (!empty($enclosure['attribs']['URL']))
						{
							$type = null;
							$length = null;
							$href = $this->sanitize($enclosure['attribs']['URL'], $enclosure['attribs'], true);
							if (!empty($enclosure['attribs']['TYPE']))
							{
								$type = $this->sanitize($enclosure['attribs']['TYPE'], $enclosure['attribs']);
							}
							if (!empty($enclosure['attribs']['LENGTH']))
							{
								$length = $this->sanitize($enclosure['attribs']['LENGTH'], $enclosure['attribs']);
							}
							$newitem['enclosures'][] =& new $this->enclosure_class($href, $type, $length, $this->javascript);
						}
					}
				}

				// ID
				if (!empty($item['guid']['data']))
				{
					if (!empty($item['guid']['attribs']['ISPERMALINK']) && strtolower($item['guid']['attribs']['ISPERMALINK']) == 'false')
					{
						$newitem['guid']['permalink'] = false;
					}
					else
					{
						$newitem['guid']['permalink'] = true;
					}
					$newitem['guid']['data'] = $this->sanitize($item['guid']['data'], $item['guid']['attribs']);
				}
				if (!empty($item['id']['data']))
				{
					$newitem['id'] = $this->sanitize($item['id']['data'], $item['id']['attribs']);
				}

				// Date
				if (!empty($item['pubdate']['data']))
				{
					$newitem['pubdate'] = SimplePie_Misc::parse_date($this->sanitize($item['pubdate']['data'], $item['pubdate']['attribs']));
				}
				if (!empty($item['dc:date']['data']))
				{
					$newitem['dc:date'] = SimplePie_Misc::parse_date($this->sanitize($item['dc:date']['data'], $item['dc:date']['attribs']));
				}
				if (!empty($item['issued']['data']))
				{
					$newitem['issued'] = SimplePie_Misc::parse_date($this->sanitize($item['issued']['data'], $item['issued']['attribs']));
				}
				if (!empty($item['published']['data']))
				{
					$newitem['published'] = SimplePie_Misc::parse_date($this->sanitize($item['published']['data'], $item['published']['attribs']));
				}
				if (!empty($item['modified']['data']))
				{
					$newitem['modified'] = SimplePie_Misc::parse_date($this->sanitize($item['modified']['data'], $item['modified']['attribs']));
				}
				if (!empty($item['updated']['data']))
				{
					$newitem['updated'] = SimplePie_Misc::parse_date($this->sanitize($item['updated']['data'], $item['updated']['attribs']));
				}

				// Categories
				if (!empty($item['category']))
				{
					foreach ($item['category'] as $category)
					{
						if (!empty($category['data']))
						{
							$newitem['category'][] = $this->sanitize($category['data'], $category['attribs']);
						}
						else if (!empty($category['attribs']['TERM']))
						{
							$newitem['term'][] = $this->sanitize($category['attribs']['TERM'], $category['attribs']);
						}
					}
				}
				if (!empty($item['subject']))
				{
					foreach ($item['subject'] as $category)
					{
						if (!empty($category['data']))
						{
							$newitem['subject'][] = $this->sanitize($category['data'], $category['attribs']);
						}
					}
				}

				// Author
				if (!empty($item['creator']))
				{
					foreach ($item['creator'] as $creator)
					{
						if (!empty($creator['data']))
						{
							$newitem['creator'][] =& new $this->author_class($this->sanitize($creator['data'], $creator['attribs']), null, null);
						}
					}
				}
				if (!empty($item['author']))
				{
					foreach ($item['author'] as $author)
					{
						$name = null;
						$link = null;
						$email = null;
						if (!empty($author['rss']))
						{
							$sane_nocomment = $sane = $this->sanitize($author['rss']['data'], $author['rss']['attribs']);
							if (SimplePie_Misc::validate_rfc822_email($sane_nocomment))
							{
								/**
								 * The following PCRE removes RFC822 comments
								 *
								 * @author Tomas V.V.Cox <cox@idecnet.com>
								 * @author Pierre-Alain Joye <pajoye@php.net>
								 * @author Amir Mohammad Saied <amir@php.net>
								 * @copyright 1997-2006 Pierre-Alain Joye,Tomas V.V.Cox,Amir Mohammad Saied
								 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
								 * @version CVS: $Id: Validate.php,v 1.104 2006/11/17 16:32:06 amir Exp $
								 * @link http://pear.php.net/package/Validate
								 */
								if (preg_match('/((?:(?:\\\\"|[^("])*(?:"(?:[^"\\\\\r]|\\\\.)*"\s*)?)*)((?<!\\\\)\(((?:(?2)|.)*)?(?<!\\\\)\))$/', $sane, $match))
								{
									$name = trim($match[3]);
								}
								$email = trim($sane_nocomment);
							}
							else
							{
								$name = $sane;
							}
						}
						else
						{
							if (!empty($author['name']))
							{
								$name = $this->sanitize($author['name']['data'], $author['name']['attribs']);
							}
							if (!empty($author['url']))
							{
								$link = $this->sanitize($author['url']['data'], $author['url']['attribs'], true);
							}
							else if (!empty($author['uri']))
							{
								$link = $this->sanitize($author['uri']['data'], $author['uri']['attribs'], true);
							}
							else if (!empty($author['homepage']))
							{
								$link = $this->sanitize($author['homepage']['data'], $author['homepage']['attribs'], true);
							}
							if (!empty($author['email']))
							{
								$email = $this->sanitize($author['email']['data'], $author['email']['attribs']);
							}
						}
						$newitem['author'][] =& new $this->author_class($name, $link, $email);
					}
				}

				// Geo
				if (!empty($item['geo:lat']['data']))
				{
					$newitem['geo:lat'] = $this->sanitize($item['geo:lat']['data'], $item['geo:lat']['attribs']);
				}
				if (!empty($item['geo:long']['data']))
				{
					$newitem['geo:long'] = $this->sanitize($item['geo:long']['data'], $item['geo:long']['attribs']);
				}
				if (!empty($item['georss:point']['data']))
				{
					$newitem['georss:point'] = $this->sanitize($item['georss:point']['data'], $item['georss:point']['attribs']);
				}

				unset($data['items'][$key]);
				$this->items[] =& new $this->item_class($newitem);
			}
		}
	}

	function sanitize($data, $attribs, $is_url = false, $force_decode = false)
	{
		$this->attribs = $attribs;
		if (isset($this->feedinfo['type']) && $this->feedinfo['type'] == 'Atom')
		{
			if ((!empty($attribs['MODE']) && $attribs['MODE'] == 'base64') || (!empty($attribs['TYPE']) && $attribs['TYPE'] == 'application/octet-stream'))
			{
				$data = htmlspecialchars(base64_decode($data));
			}
			else if ((!empty($attribs['MODE']) && $attribs['MODE'] == 'escaped' || !empty($attribs['TYPE']) && ($attribs['TYPE'] == 'html' || $attribs['TYPE'] == 'text/html')))
			{
				$data = SimplePie_Misc::entities_decode($data, $this->input_encoding, $this->cached_entities);
			}
			if (!empty($attribs['TYPE']) && ($attribs['TYPE'] == 'xhtml' || $attribs['TYPE'] == 'application/xhtml+xml'))
			{
				if ($this->remove_div)
				{
					$data = preg_replace('/^\s*<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '', $data);
					$data = preg_replace('/<\/div>\s*$/', '', $data);
				}
				else
				{
					$data = preg_replace('/^\s*<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '<div>', $data);
				}
				$data = $this->convert_entities($data);
			}
		}
		else
		{
			$data = $this->convert_entities($data);
		}
		if ($force_decode)
		{
			$data = SimplePie_Misc::entities_decode($data, $this->input_encoding, $this->cached_entities);
		}
		$data = trim($data);
		$data = SimplePie_Misc::strip_comments($data);

		// Replace H1, H2, and H3 tags with the less important H4 tags.
		// This is because on a site, the more important headers might make sense,
		// but it most likely doesn't fit in the context of RSS-in-a-webpage.
		if ($this->replace_headers)
		{
			$data = preg_replace('/<h[1-3]' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>/i', '<h4\\1>', $data);
			$data = preg_replace('/<\/h[1-3]' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>/i', '</h4>', $data);
		}

		if ($is_url)
		{
			$data = $this->replace_urls($data, true);
		}
		else
		{
			$data = preg_replace_callback('/<(\S+)' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '(\/>|>(.*)<\/\S+>)/siU', array(&$this, 'replace_urls'), $data);
		}

		// If Bypass Image Hotlink is enabled, rewrite all the image tags.
		if ($this->bypass_image_hotlink)
		{
			$images = SimplePie_Misc::get_element('img', $data);
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
					$img['attribs']['SRC']['data'] = $pre . rawurlencode(strtr($img['attribs']['SRC']['data'], array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES))));
					$data = str_replace($img['full'], SimplePie_Misc::element_implode($img), $data);
				}
			}
		}

		// Strip out HTML tags and attributes that might cause various security problems.
		// Based on recommendations by Mark Pilgrim at:
		// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
		if ($this->strip_htmltags)
		{
			foreach ($this->strip_htmltags as $tag)
			{
				$pcre = "/<($tag)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(\/>|>(.*)<\/($tag)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>)/siU';
				while (preg_match($pcre, $data))
				{
					$data = preg_replace_callback($pcre, array(&$this, 'do_strip_htmltags'), $data);
				}
			}
		}

		if ($this->strip_attributes)
		{
			foreach ($this->strip_attributes as $attrib)
			{
				$data = preg_replace('/ '. trim($attrib) .'=("|&quot;)(\w|\s|=|-|:|;|\/|\.|\?|&|,|#|!|\(|\)|\'|&apos;|<|>|\+|{|})*("|&quot;)/i', '', $data);
				$data = preg_replace('/ '. trim($attrib) .'=(\'|&apos;)(\w|\s|=|-|:|;|\/|\.|\?|&|,|#|!|\(|\)|"|&quot;|<|>|\+|{|})*(\'|&apos;)/i', '', $data);
				$data = preg_replace('/ '. trim($attrib) .'=(\w|\s|=|-|:|;|\/|\.|\?|&|,|#|!|\(|\)|\+|{|})*/i', '', $data);
			}
		}

		// Convert encoding
		$data = SimplePie_Misc::change_encoding($data, $this->input_encoding, $this->output_encoding);

		return $data;
	}

	function do_strip_htmltags($match)
	{
		if ($this->encode_instead_of_strip)
		{
			if (isset($match[4]) && !in_array(strtolower($match[1]), array('script', 'style')))
			{
				$match[1] = htmlspecialchars($match[1]);
				$match[2] = htmlspecialchars($match[2]);
				return "&lt;$match[1]$match[2]&gt;$match[4]&lt;/$match[1]&gt;";
			}
			else
			{
				return htmlspecialchars($match[0]);
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

	function replace_urls($data, $raw_url = false)
	{
		if (!empty($this->attribs['XML:BASE']))
		{
			$xmlbase = $attribs['XML:BASE'];
		}
		else if (!empty($this->attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:BASE']))
		{
			$xmlbase = $this->attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE:BASE'];
		}
		if (!empty($xmlbase))
		{
			if (!empty($this->item_xmlbase))
			{
				$xmlbase = SimplePie_Misc::absolutize_url($xmlbase, $this->item_xmlbase);
			}
			else
			{
				$xmlbase = SimplePie_Misc::absolutize_url($xmlbase, $this->feed_xmlbase);
			}
		}
		else if (!empty($this->item_xmlbase))
		{
			$xmlbase = $this->item_xmlbase;
		}
		else
		{
			$xmlbase = $this->feed_xmlbase;
		}

		if ($raw_url)
		{
			return SimplePie_Misc::absolutize_url($data, $xmlbase);
		}
		else
		{
			$attributes = array(
				'background',
				'href',
				'src',
				'longdesc',
				'usemap',
				'codebase',
				'data',
				'classid',
				'cite',
				'action',
				'profile',
				'for'
			);
			foreach ($attributes as $attribute)
			{
				if (preg_match("/$attribute='(.*)'/siU", $data[0], $attrib) || preg_match("/$attribute=\"(.*)\"/siU", $data[0], $attrib) || preg_match("/$attribute=(.*)[ |\/|>]/siU", $data[0], $attrib))
				{
					$new_tag = str_replace($attrib[1], SimplePie_Misc::absolutize_url($attrib[1], $xmlbase), $attrib[0]);
					$data[0] = str_replace($attrib[0], $new_tag, $data[0]);
				}
			}
			return $data[0];
		}
	}

	function convert_entities($data)
	{
		return preg_replace_callback('/&#(x)?([0-9a-z]+);/i', array(&$this, 'do_convert_entities'), $data);
	}

	function do_convert_entities($data)
	{
		if (isset($this->cache_convert_entities[$data[0]]))
		{
			return $this->cache_convert_entities[$data[0]];
		}
		else if (isset($this->cached_entities[$data[0]]))
		{
			$return = SimplePie_Misc::change_encoding(htmlentities($this->cached_entities[$data[0]], ENT_QUOTES, 'UTF-8'), 'UTF-8', $this->input_encoding);
		}
		else
		{
			$return = SimplePie_Misc::change_encoding(htmlentities(SimplePie_Misc::replace_num_entity($data[0]), ENT_QUOTES, 'UTF-8'), 'UTF-8', $this->input_encoding);
		}
		$this->cache_convert_entities[$data[0]] = $return;
		return $return;
	}
}

?>
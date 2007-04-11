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
 * @todo phpDoc comments
 * @todo Add support for itunes and media namespaces
 * @todo Check all regular expressions
 */

/**
 * SimplePie Name
 */
define('SIMPLEPIE_NAME', 'SimplePie');

/**
 * SimplePie Version
 */
define('SIMPLEPIE_VERSION', 'Razzleberry++');

/**
 * SimplePie Build
 * @todo Hardcode for release (there's no need to have to call SimplePie_Misc::parse_date() only every load of simplepie.inc)
 */
define('SIMPLEPIE_BUILD', gmdate('YmdHis', SimplePie_Misc::parse_date('$Date$')));

/**
 * SimplePie Website URL
 */
define('SIMPLEPIE_URL', 'http://simplepie.org/');

/**
 * SimplePie Useragent
 * @see SimplePie::set_useragent()
 */
define('SIMPLEPIE_USERAGENT', SIMPLEPIE_NAME . '/' . SIMPLEPIE_VERSION . ' (Feed Parser; ' . SIMPLEPIE_URL . '; Allow like Gecko) Build/' . SIMPLEPIE_BUILD);

/**
 * SimplePie Linkback
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
 * No known feed type
 */
define('SIMPLEPIE_TYPE_NONE', 0);

/**
 * RSS 0.90
 */
define('SIMPLEPIE_TYPE_RSS_090', 1);

/**
 * RSS 0.91 (Netscape)
 */
define('SIMPLEPIE_TYPE_RSS_091_NETSCAPE', 2);

/**
 * RSS 0.91 (Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091_USERLAND', 4);

/**
 * RSS 0.91 (both Netscape and Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091', 6);

/**
 * RSS 0.92
 */
define('SIMPLEPIE_TYPE_RSS_092', 8);

/**
 * RSS 0.93
 */
define('SIMPLEPIE_TYPE_RSS_093', 16);

/**
 * RSS 0.94
 */
define('SIMPLEPIE_TYPE_RSS_094', 32);

/**
 * RSS 1.0
 */
define('SIMPLEPIE_TYPE_RSS_10', 64);

/**
 * RSS 2.0
 */
define('SIMPLEPIE_TYPE_RSS_20', 128);

/**
 * RDF-based RSS
 */
define('SIMPLEPIE_TYPE_RSS_RDF', 65);

/**
 * Non-RDF-based RSS (truly intended as syndication format)
 */
define('SIMPLEPIE_TYPE_RSS_SYNDICATION', 190);

/**
 * All RSS
 */
define('SIMPLEPIE_TYPE_RSS_ALL', 255);

/**
 * Atom 0.3
 */
define('SIMPLEPIE_TYPE_ATOM_03', 256);

/**
 * Atom 1.0
 */
define('SIMPLEPIE_TYPE_ATOM_10', 512);

/**
 * All Atom
 */
define('SIMPLEPIE_TYPE_ATOM_ALL', 768);

/**
 * All feed types
 */
define('SIMPLEPIE_TYPE_ALL', 1023);

/**
 * No construct
 */
define('SIMPLEPIE_CONSTRUCT_NONE', 0);

/**
 * Text construct
 */
define('SIMPLEPIE_CONSTRUCT_TEXT', 1);

/**
 * HTML construct
 */
define('SIMPLEPIE_CONSTRUCT_HTML', 2);

/**
 * XHTML construct
 */
define('SIMPLEPIE_CONSTRUCT_XHTML', 4);

/**
 * base64-encoded construct
 */
define('SIMPLEPIE_CONSTRUCT_BASE64', 8);

/**
 * IRI construct
 */
define('SIMPLEPIE_CONSTRUCT_IRI', 16);

/**
 * All constructs
 */
define('SIMPLEPIE_CONSTRUCT_ALL', 31);

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
 * @todo Add geo namespace support at feed level
 * @todo Cache all HTTP headers
 * @todo Option for type of fetching (cache, not modified header, fetch, etc.)
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
	 * @var int Auto-discovery cache duration (in seconds)
	 * @see SimplePie::set_autodiscovery_cache_duration()
	 * @access private
	 */
	var $autodiscovery_cache_duration = 604800; // 7 Days.

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
	 * @var string Web-accessible path to the handler_favicon.php file.
	 * @see SimplePie::set_favicon_handler()
	 * @access private
	 */
	var $favicon_handler = '';

	/**
	 * @var string Web-accessible path to the handler_image.php file.
	 * @see SimplePie::set_image_handler()
	 * @access private
	 */
	var $image_handler = '';

	/**
	 * The SimplePie class contains feed level data and options
	 *
	 * There are two ways that you can create a new SimplePie object. The first
	 * is by passing a feed URL as a parameter to the SimplePie constructor
	 * (as well as optionally setting the cache location and cache expiry). This
	 * will initialise the whole feed with all of the default settings, and you
	 * can begin accessing methods and properties immediately.
	 *
	 * The second way is to create the SimplePie object with no parameters
	 * at all. This will enable you to set configuration options. After setting
	 * them, you must initialise the feed using $feed->init(). At that point the
	 * object's methods and properties will be available to you. This format is
	 * what is used throughout this documentation.
	 *
	 * @access public
	 * @since 1.0 Preview Release
	 * @param string $feed_url This is the URL you want to parse.
	 * @param string $cache_location This is where you want the cache to be stored.
	 * @param int $cache_duration This is the number of seconds that you want to store the cache file for.
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
	 * This is the URL of the feed you want to parse.
	 *
	 * This allows you to enter the URL of the feed you want to parse, or the
	 * website you want to try to use auto-discovery on. This takes priority
	 * over any set raw data.
	 *
	 * @access public
	 * @since 1.0 Preview Release
	 * @param string $url This is the URL of the feed you want to parse.
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
	 * Allows you to use a string of RSS/Atom data instead of a remote feed.
	 *
	 * If you have a feed available as a string in PHP, you can tell SimplePie
	 * to parse that data string instead of a remote feed. Any set feed URL
	 * takes precedence.
	 *
	 * @access public
	 * @since 1.0 Beta 3
	 * @param string $data RSS or Atom data as a string.
	 * @see SimplePie::set_feed_url()
	 */
	function set_raw_data($data)
	{
		$this->raw_data = trim($data);
	}

	/**
	 * Allows you to override the default timeout for fetching remote feeds.
	 *
	 * This allows you to change the maximum time the feed's server to respond
	 * and send the feed back.
	 *
	 * @access public
	 * @since 1.0 Beta 3
	 * @param int $timeout The maximum number of seconds to spend waiting to retrieve a feed.
	 */
	function set_timeout($timeout = 10)
	{
		$this->timeout = (int) $timeout;
	}

	/**
	 * Forces SimplePie to use fsockopen() instead of the preferred cURL
	 * functions.
	 *
	 * @access public
	 * @since 1.0 Beta 3
	 * @param bool $enable Force fsockopen() to be used
	 */
	function force_fsockopen($enable = false)
	{
		$this->force_fsockopen = (bool) $enable;
	}

	/**
	 * Outputs the raw XML content of the feed, after it has gone through
	 * SimplePie's filters.
	 *
	 * Used only for debugging, this function will output the XML content as
	 * text/xml. When SimplePie reads in a feed, it does a bit of cleaning up
	 * before trying to parse it. Many parts of the feed are re-written in
	 * memory, and in the end, you have a parsable feed. XML dump shows you the
	 * actual XML that SimplePie tries to parse, which may or may not be very
	 * different from the original feed.
	 *
	 * @access public
	 * @since 1.0 Preview Release
	 * @param bool $enable Enable XML dump
	 */
	function enable_xml_dump($enable = false)
	{
		$this->xml_dump = (bool) $enable;
	}

	/**
	 * Enables/disables caching in SimplePie.
	 *
	 * This option allows you to disable caching all-together in SimplePie.
	 * However, disabling the cache can lead to longer load times.
	 *
	 * @access public
	 * @since 1.0 Preview Release
	 * @param bool $enable Enable caching
	 */
	function enable_cache($enable = true)
	{
		$this->cache = (bool) $enable;
	}

	/**
	 * Set the length of time (in seconds) that the contents of a feed
	 * will be cached.
	 *
	 * @access public
	 * @param int $seconds The feed content cache duration.
	 */
	function set_cache_duration($seconds = 3600)
	{
		$this->cache_duration = (int) $seconds;
	}

	/**
	 * Set the length of time (in seconds) that the autodiscovered feed
	 * URL will be cached.
	 *
	 * @access public
	 * @param int $seconds The autodiscovered feed URL cache duration.
	 */
	function set_autodiscovery_cache_duration($seconds = 604800)
	{
		$this->autodiscovery_cache_duration = (int) $seconds;
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

	function strip_attributes($attribs = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc'))
	{
		$this->sanitize->strip_attributes($attribs);
	}

	function set_output_encoding($encoding = 'UTF-8')
	{
		$this->sanitize->set_output_encoding($encoding);
	}

	/**
	 * Set the handler to enable the display of cached favicons.
	 *
	 * @access public
	 * @param str $page Web-accessible path to the handler_favicon.php file.
	 */
	function set_favicon_handler($page = false)
	{
		$this->favicon_handler = $page . '?i=';
	}

	/**
	 * Set the handler to enable the display of cached images.
	 *
	 * @access public
	 * @param str $page Web-accessible path to the handler_image.php file.
	 */
	function set_image_handler($page = false)
	{
		$this->sanitize->set_image_handler($page . '?i=');
		$this->sanitize->pass_cache_data($this->cache_location, $this->cache_name_function, $this->cache_class);
		$this->sanitize->pass_file_data($this->file_class, $this->timeout, $this->useragent, $this->force_fsockopen);
	}

	function init()
	{
		if ((function_exists('version_compare') && version_compare(phpversion(), '4.3.2', '<')) || !extension_loaded('xml') || !extension_loaded('pcre'))
		{
			return false;
		}
		if (isset($_GET[$this->javascript]))
		{
			if (function_exists('ob_gzhandler'))
			{
				ob_start('ob_gzhandler');
			}
			header('Content-type: text/javascript; charset: UTF-8');
			header('Cache-Control: must-revalidate');
			header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
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

		if (!is_null($this->feed_url) || !is_null($this->raw_data))
		{
			$this->data = array();
			$cache = false;

			if (!is_null($this->feed_url))
			{
				$parsed_feed_url = SimplePie_Misc::parse_url($this->feed_url);
				// Decide whether to enable caching
				if ($this->cache && $parsed_feed_url['scheme'] !== '')
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
						// If we've got a non feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL.
						else if (isset($this->data['feed_url']))
						{
							// If the autodiscovery cache is still valid use it.
							if ($cache->mtime() + $this->autodiscovery_cache_duration > time())
							{
								// Do not need to do feed autodiscovery yet.
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
						}
						// Check if the cache has been updated
						else if ($cache->mtime() + $this->cache_duration < time())
						{
							// If we have last-modified and/or etag set
							if (isset($this->data['headers']['last-modified'][0]) || isset($this->data['headers']['etag'][0]))
							{
								$headers = array();
								if (isset($this->data['headers']['last-modified'][0]))
								{
									$headers['if-modified-since'] = $this->data['headers']['last-modified'][0];
								}
								if (isset($this->data['headers']['etag'][0]))
								{
									$headers['if-none-match'] = $this->data['headers']['etag'][0];
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
					// We need to unset this so that if SimplePie::set_file() has been called that object is untouched
					unset($file);
					if ($file = $locate->find($this->autodiscovery))
					{
						if ($cache)
						{
							if (!$cache->save(array('url' => $this->feed_url, 'feed_url' => $file->url, 'build' => SIMPLEPIE_BUILD)))
							{
								$this->error = "$cache->name is not writeable";
								SimplePie_Misc::error($this->error, E_USER_WARNING, __FILE__, __LINE__);
							}
							$cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $file->url), 'spc');
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
			if ($this->input_encoding !== false)
			{
				$encoding = $this->input_encoding;
			}
			// Second try HTTP headers
			else if (isset($headers['content-type'][0]) && preg_match('/;charset=([^;]*)/i', $headers['content-type'][0], $charset))
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
			else if (isset($headers['content-type'][0]) && strtolower(SimplePie_Misc::parse_mime($headers['content-type'][0])) == 'text/xml')
			{
				$encoding = 'US-ASCII';
			}
			else if (isset($headers['content-type'][0]) && preg_match('/^text\//i', SimplePie_Misc::parse_mime($headers['content-type'][0])))
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
				if (isset($this->data['child']))
				{
					if (isset($headers))
					{
						$this->data['headers'] = $headers;
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
				else
				{
					$this->error = "A feed could not be found at $this->feed_url";
					SimplePie_Misc::error($this->error, E_USER_NOTICE, __FILE__, __LINE__);
					return false;
				}
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

	function get_type()
	{
		$type = SIMPLEPIE_TYPE_ALL;
		if (isset($this->data['child']['HTTP://WWW.W3.ORG/2005/ATOM']['FEED']))
		{
			$type &= SIMPLEPIE_TYPE_ATOM_10;
		}
		else if (isset($this->data['child']['HTTP://PURL.ORG/ATOM/NS#']['FEED']))
		{
			$type &= SIMPLEPIE_TYPE_ATOM_03;
		}
		else if (isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF']))
		{
			if (isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://PURL.ORG/RSS/1.0/']['CHANNEL'])
			|| isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://PURL.ORG/RSS/1.0/']['IMAGE'])
			|| isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://PURL.ORG/RSS/1.0/']['ITEM'])
			|| isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://PURL.ORG/RSS/1.0/']['TEXTINPUT']))
			{
				$type &= SIMPLEPIE_TYPE_RSS_10;
			}
			if (isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['CHANNEL'])
			|| isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['IMAGE'])
			|| isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['ITEM'])
			|| isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child']['HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/']['TEXTINPUT']))
			{
				$type &= SIMPLEPIE_TYPE_RSS_090;
			}
		}
		else if (isset($this->data['child']['']['RSS']))
		{
			$type &= SIMPLEPIE_TYPE_RSS_ALL;
			if (isset($this->data['child']['']['RSS'][0]['attribs']['']['VERSION']))
			{
				switch (trim($this->data['child']['']['RSS'][0]['attribs']['']['VERSION']))
				{
					case '0.91':
						$type &= SIMPLEPIE_TYPE_RSS_091;
						if (isset($this->data['child']['']['RSS'][0]['child']['']['SKIPHOURS']['HOUR'][0]['data']))
						{
							switch (trim($this->data['child']['']['RSS'][0]['child']['']['SKIPHOURS']['HOUR'][0]['data']))
							{
								case '0':
									$type &= SIMPLEPIE_TYPE_RSS_091_NETSCAPE;
									break;

								case '24':
									$type &= SIMPLEPIE_TYPE_RSS_091_USERLAND;
									break;
							}
						}
						break;

					case '0.92':
						$type &= SIMPLEPIE_TYPE_RSS_092;
						break;

					case '0.93':
						$type &= SIMPLEPIE_TYPE_RSS_093;
						break;

					case '0.94':
						$type &= SIMPLEPIE_TYPE_RSS_094;
						break;

					case '2.0':
						$type &= SIMPLEPIE_TYPE_RSS_20;
						break;
				}
			}
		}
		else
		{
			$type = SIMPLEPIE_TYPE_NONE;
		}
		return $type;
	}

	/**
	 * Returns the URL for the favicon of the feed's website.
	 *
	 * @access public
	 * @since 1.0
	 * @param string $alternate This is the image that will be used if no other favicons are found.
	 */
	function get_favicon($alternate = '')
	{
		if ($this->get_feed_link())
		{
			$favicon = SimplePie_Misc::absolutize_url('/favicon.ico', $this->get_feed_link());
			$cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $favicon), 'image');

			if ($cache->load())
			{
				return $this->favicon_handler . $favicon;
			}
			else
			{
				$file =& new $this->file_class($favicon, $this->timeout/10, 5, array('X-FORWARDED-FOR' => $_SERVER['REMOTE_ADDR']), $this->useragent, $this->force_fsockopen);
				$headers = $file->headers();

				if ($file->success && ($headers['status']['code'] == 200 || ($headers['status']['code'] > 206 && $headers['status']['code'] < 300)))
				{
					if ($this->favicon_handler)
					{
						if ($cache->save(array('headers' => $file->headers(), 'body' => $file->body())))
						{
							return $this->favicon_handler . $favicon;
						}
						else
						{
							$this->error = "$cache->name is not writeable";
							SimplePie_Misc::error($this->error, E_USER_WARNING, __FILE__, __LINE__);
						}
					}
					return $favicon;
				}
				else
				{
					unset($file);
					$file =& new $this->file_class($this->get_feed_link(), $this->timeout/10, 5, array('X-FORWARDED-FOR' => $_SERVER['REMOTE_ADDR']), $this->useragent, $this->force_fsockopen);
					$headers = $file->headers();

					if ($file->success && ($headers['status']['code'] == 200 || ($headers['status']['code'] > 206 && $headers['status']['code'] < 300)))
					{
						preg_match_all('/<link([^>]*)rel=("|\')shortcut icon("|\')([^>]*)>/i', $file->body(), $m);
						if (isset($m[0][0]) && !empty($m[0][0]))
						{
							preg_match_all('/href=("|\')([^("|\')]*)("|\')/i', $m[0][0], $m);
							if (isset($m[2][0]) && !empty($m[0][0]))
							{
								unset($file);
								$file =& new $this->file_class($m[2][0], $this->timeout/10, 5, array('X-FORWARDED-FOR' => $_SERVER['REMOTE_ADDR']), $this->useragent, $this->force_fsockopen);

								if ($this->favicon_handler)
								{
									if ($cache->save(array('headers' => $file->headers(), 'body' => $file->body())))
									{
										return $this->favicon_handler . $favicon;
									}
									else
									{
										$this->error = "$cache->name is not writeable";
										SimplePie_Misc::error($this->error, E_USER_WARNING, __FILE__, __LINE__);
									}
								}
								return $m[2][0];
							}
							else
							{
								return $alternate;
							}
						}
						else
						{
							return $alternate;
						}
					}
				}
			}
		}
		return false;
	}

	/**
	 * @todo If we have a perm redirect we should return the new URL
	 */
	function subscribe_url()
	{
		if (!is_null($this->feed_url))
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
		if (!is_null($this->feed_url))
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
		if (!is_null($this->feed_url))
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
		if (!is_null($this->feed_url))
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
	function subscribe_service($feed_url, $site_url = null)
	{
		if ($this->subscribe_url())
		{
			$return = $feed_url . rawurlencode($this->subscribe_url());
			if (!is_null($site_url) && !is_null($this->get_feed_link()))
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

	function get_feed_tags($namespace, $tag)
	{
		$type = $this->get_type();
		if ($type & SIMPLEPIE_TYPE_ATOM_10)
		{
			if (isset($this->data['child']['HTTP://WWW.W3.ORG/2005/ATOM']['FEED'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['HTTP://WWW.W3.ORG/2005/ATOM']['FEED'][0]['child'][$namespace][$tag];
			}
		}
		if ($type & SIMPLEPIE_TYPE_ATOM_03)
		{
			if (isset($this->data['child']['HTTP://PURL.ORG/ATOM/NS#']['FEED'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['HTTP://PURL.ORG/ATOM/NS#']['FEED'][0]['child'][$namespace][$tag];
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_RDF)
		{
			if (isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['child'][$namespace][$tag];
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_SYNDICATION)
		{
			if (isset($this->data['child']['']['RSS'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child']['']['RSS'][0]['child'][$namespace][$tag];
			}
		}
		return null;
	}

	function get_channel_tags($namespace, $tag)
	{
		$type = $this->get_type();
		if ($type & SIMPLEPIE_TYPE_ATOM_ALL)
		{
			if ($return = $this->get_feed_tags($namespace, $tag))
			{
				return $return;
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_10)
		{
			if ($channel = $this->get_feed_tags('HTTP://PURL.ORG/RSS/1.0/', 'CHANNEL'))
			{
				if (isset($channel[0]['child'][$namespace][$tag]))
				{
					return $channel[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_090)
		{
			if ($channel = $this->get_feed_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'CHANNEL'))
			{
				if (isset($channel[0]['child'][$namespace][$tag]))
				{
					return $channel[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_SYNDICATION)
		{
			if ($channel = $this->get_feed_tags('', 'CHANNEL'))
			{
				if (isset($channel[0]['child'][$namespace][$tag]))
				{
					return $channel[0]['child'][$namespace][$tag];
				}
			}
		}
		return null;
	}

	function get_image_tags($namespace, $tag)
	{
		$type = $this->get_type();
		if ($type & SIMPLEPIE_TYPE_RSS_10)
		{
			if ($image = $this->get_feed_tags('HTTP://PURL.ORG/RSS/1.0/', 'IMAGE'))
			{
				if (isset($image[0]['child'][$namespace][$tag]))
				{
					return $image[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_090)
		{
			if ($image = $this->get_feed_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'IMAGE'))
			{
				if (isset($image[0]['child'][$namespace][$tag]))
				{
					return $image[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_SYNDICATION)
		{
			if ($image = $this->get_channel_tags('', 'IMAGE'))
			{
				if (isset($image[0]['child'][$namespace][$tag]))
				{
					return $image[0]['child'][$namespace][$tag];
				}
			}
		}
		return null;
	}

	function get_base($element = array())
	{
		if (!($this->get_type() & SIMPLEPIE_TYPE_RSS_SYNDICATION) && !empty($element['xml_base_explicit']) && isset($element['xml_base']))
		{
			return $element['xml_base'];
		}
		else if (!is_null($this->get_feed_link()))
		{
			return $this->get_feed_link();
		}
		else
		{
			return $this->subscribe_url();
		}
	}

	function sanitize($data, $type, $base = '')
	{
		return $this->sanitize->sanitize($data, $type, $base);
	}

	/**
	 * @todo Remove support for this function.  Use $feed->get_title() instead.  This should have died when we moved from get_item_title() to get_title().
	 */
	function get_feed_title()
	{
		return $this->get_title();
	}

	function get_title()
	{
		if ($return = $this->get_channel_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/ATOM/NS#', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/RSS/1.0/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * @todo Remove support for this function.  Use $feed->get_link() instead.  This should have died when we moved from get_item_title() to get_title().
	 */
	function get_feed_link($key = 0, $rel = 'alternate') {
		return $this->get_link($key, $rel);
	}

	function get_link($key = 0, $rel = 'alternate')
	{
		$links = $this->get_links($rel);
		if (isset($links[$key]))
		{
			return $links[$key];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Added for parity between the parent-level and the item/entry-level.
	 */
	function get_permalink()
	{
		return $this->get_link(0);
	}

	/**
	 * @todo Remove support for this function.  Use $feed->get_links() instead.  This should have died when we moved from get_item_title() to get_title().
	 */
	function get_feed_links($rel = 'alternate')
	{
		return $this->get_links($rel);
	}

	function get_links($rel = 'alternate')
	{
		if (!isset($this->data['links']))
		{
			$this->data['links'] = array();
			if ($links = $this->get_channel_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LINK'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['']['HREF']))
					{
						$link_rel = (isset($link['attribs']['']['REL'])) ? $link['attribs']['']['REL'] : 'alternate';
						$this->data['links'][$link_rel][] = $this->sanitize($link['attribs']['']['HREF'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));
					}
				}
			}
			if ($links = $this->get_channel_tags('HTTP://PURL.ORG/ATOM/NS#', 'LINK'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['']['HREF']))
					{
						$link_rel = (isset($link['attribs']['']['REL'])) ? $link['attribs']['']['REL'] : 'alternate';
						$this->data['links'][$link_rel][] = $this->sanitize($link['attribs']['']['HREF'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));

					}
				}
			}
			if ($links = $this->get_channel_tags('HTTP://PURL.ORG/RSS/1.0/', 'LINK'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_channel_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'LINK'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_channel_tags('', 'LINK'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}

			$keys = array_keys($this->data['links']);
			foreach ($keys as $key)
			{
				if (SimplePie_Misc::is_isegment_nz_nc($key))
				{
					if (isset($this->data['links']['http://www.iana.org/assignments/relation/' . $key]))
					{
						$this->data['links']['http://www.iana.org/assignments/relation/' . $key] = array_merge($this->data['links'][$key], $this->data['links']['http://www.iana.org/assignments/relation/' . $key]);
						$this->data['links'][$key] =& $this->data['links']['http://www.iana.org/assignments/relation/' . $key];
					}
					else
					{
						$this->data['links']['http://www.iana.org/assignments/relation/' . $key] =& $this->data['links'][$key];
					}
				}
				else if (substr($key, 0, 41) == 'http://www.iana.org/assignments/relation/')
				{
					$this->data['links'][substr($key, 41)] =& $this->data['links'][$key];
				}
				$this->data['links'][$key] = array_unique($this->data['links'][$key]);
			}
		}

		if (isset($this->data['links'][$rel]))
		{
			return $this->data['links'][$rel];
		}
		else
		{
			return null;
		}
	}

	/**
	 * @todo Remove support for this function.  Use $feed->get_description() instead.  This should have died when we moved from get_item_title() to get_title().
	 */
	function get_feed_description() {
		return $this->get_description();
	}

	function get_description()
	{
		if ($return = $this->get_channel_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'SUBTITLE'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/ATOM/NS#', 'TAGLINE'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/RSS/1.0/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * @todo Remove support for this function.  Use $feed->get_copyright() instead.  This should have died when we moved from get_item_title() to get_title().
	 */
	function get_feed_copyright() {
		return $this->get_copyright();
	}

	function get_copyright()
	{
		if ($return = $this->get_channel_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'RIGHTS'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_channel_tags('', 'COPYRIGHT'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'RIGHTS'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'RIGHTS'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * @todo Remove support for this function.  Use $feed->get_language() instead.  This should have died when we moved from get_item_title() to get_title().
	 */
	function get_feed_language() {
		return $this->get_language();
	}

	function get_language()
	{
		if ($return = $this->get_channel_tags('', 'LANGUAGE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'LANGUAGE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_channel_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'LANGUAGE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if (isset($this->data['child']['HTTP://WWW.W3.ORG/2005/ATOM']['FEED'][0]['xml_lang']))
		{
			return $this->sanitize($this->data['child']['HTTP://WWW.W3.ORG/2005/ATOM']['FEED'][0]['xml_lang'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if (isset($this->data['child']['HTTP://PURL.ORG/ATOM/NS#']['FEED'][0]['xml_lang']))
		{
			return $this->sanitize($this->data['child']['HTTP://PURL.ORG/ATOM/NS#']['FEED'][0]['xml_lang'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if (isset($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['xml_lang']))
		{
			return $this->sanitize($this->data['child']['HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#']['RDF'][0]['xml_lang'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if (isset($this->data['headers']['content-language'][0]))
		{
			return $this->sanitize($this->data['headers']['content-language'][0], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	function get_image_title()
	{
		if ($return = $this->get_image_tags('HTTP://PURL.ORG/RSS/1.0/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_image_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_image_tags('', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_image_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_image_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	function get_image_url()
	{
		if ($return = $this->get_channel_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LOGO'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else if ($return = $this->get_channel_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ICON'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else if ($return = $this->get_image_tags('HTTP://PURL.ORG/RSS/1.0/', 'URL'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else if ($return = $this->get_image_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'URL'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else if ($return = $this->get_image_tags('', 'URL'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else
		{
			return null;
		}
	}

	function get_image_link()
	{
		if ($return = $this->get_image_tags('HTTP://PURL.ORG/RSS/1.0/', 'LINK'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else if ($return = $this->get_image_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'LINK'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else if ($return = $this->get_image_tags('', 'LINK'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else
		{
			return null;
		}
	}

	function get_image_width()
	{
		if ($return = $this->get_image_tags('', 'WIDTH'))
		{
			return round($return[0]['data']);
		}
		else if ($this->get_type() & SIMPLEPIE_TYPE_RSS_SYNDICATION && $this->get_image_tags('', 'URL'))
		{
			return 88.0;
		}
		else
		{
			return null;
		}
	}

	function get_image_height()
	{
		if ($return = $this->get_image_tags('', 'HEIGHT'))
		{
			return round($return[0]['data']);
		}
		else if ($this->get_type() & SIMPLEPIE_TYPE_RSS_SYNDICATION && $this->get_image_tags('', 'URL'))
		{
			return 31.0;
		}
		else
		{
			return null;
		}
	}

	function get_item_quantity($max = 0)
	{
		$qty = count($this->get_items());
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
		if (!isset($this->data['items']))
		{
			if ($items = $this->get_feed_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ENTRY'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = new $this->item_class($this, $items[$key]);
				}
			}
			if ($items = $this->get_feed_tags('HTTP://PURL.ORG/ATOM/NS#', 'ENTRY'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = new $this->item_class($this, $items[$key]);
				}
			}
			if ($items = $this->get_feed_tags('HTTP://PURL.ORG/RSS/1.0/', 'ITEM'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = new $this->item_class($this, $items[$key]);
				}
			}
			if ($items = $this->get_feed_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'ITEM'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = new $this->item_class($this, $items[$key]);
				}
			}
			if ($items = $this->get_channel_tags('', 'ITEM'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = new $this->item_class($this, $items[$key]);
				}
			}
		}

		if (!empty($this->data['items']))
		{
			// If we want to order it by date, check if all items have a date, and then sort it
			if ($this->order_by_date)
			{
				if (!isset($this->data['ordered_items']))
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
					$this->data['ordered_items'] = $this->data['items'];
					if ($do_sort)
					{
						usort($this->data['ordered_items'], array(&$this, 'sort_items'));
					}
				}
				$items = $this->data['ordered_items'];
			}
			else
			{
				$items = $this->data['items'];
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

	function sort_items($a, $b)
	{
		return $a->get_date('U') <= $b->get_date('U');
	}

	function merge_items($start = 0, $end = 0)
	{
		if (func_num_args() > 2)
		{
			$items = array();
			$args = func_get_args();
			unset($args[0], $args[1]);
			foreach ($args as $arg)
			{
				if (is_a($arg, 'SimplePie'))
				{
					$items = array_merge($items, $arg->get_items());
				}
				else
				{
					trigger_error('Arguments must be SimplePie objects', E_USER_WARNING);
				}
			}

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
				usort($items, array('SimplePie', 'sort_items'));
			}

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
			trigger_error('Cannot merge zero SimplePie objects', E_USER_WARNING);
			return array();
		}
	}
}

class SimplePie_Item
{
	var $feed;
	var $data = array();

	function SimplePie_Item($feed, $data)
	{
		$this->feed = $feed;
		$this->data = $data;
	}

	function get_item_tags($namespace, $tag)
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

	function get_base($element = array())
	{
		return $this->feed->get_base($element);
	}

	function sanitize($data, $type, $base = '')
	{
		return $this->feed->sanitize($data, $type, $base);
	}

	function get_feed()
	{
		return $this->feed;
	}

	/**
	 * @todo Create ID instead of returning false
	 */
	function get_id()
	{
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'ID'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'ID'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('', 'GUID'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'IDENTIFIER'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'IDENTIFIER'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	function get_title()
	{
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/RSS/1.0/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'TITLE'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	function get_description()
	{
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'SUMMARY'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'SUMMARY'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/RSS/1.0/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'CONTENT'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_content_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'CONTENT'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/RSS/1.0/MODULES/CONTENT/', 'ENCODED'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else
		{
			return null;
		}
	}

	function get_content()
	{
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'CONTENT'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_content_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'CONTENT'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/RSS/1.0/MODULES/CONTENT/', 'ENCODED'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'SUMMARY'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_10_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'SUMMARY'))
		{
			return $this->sanitize($return[0]['data'], SimplePie_Misc::atom_03_construct_type($return[0]['attribs']), $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/RSS/1.0/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DESCRIPTION'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	function get_category($key = 0)
	{
		$categories = $this->get_categories();
		if (isset($categories[$key]))
		{
			return $categories[$key];
		}
		else
		{
			return false;
		}
	}

	/**
	 * @todo Move categories into an object, allowing access to label/term/scheme
	 */
	function get_categories()
	{
		$categories = array();

		foreach ((array) $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'CATEGORY') as $category)
		{
			if (isset($category['attribs']['']['LABEL']))
			{
				$categories[] = $this->sanitize($category['attribs']['']['LABEL'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			else if (isset($category['attribs']['']['TERM']))
			{
				$categories[] = $this->sanitize($category['attribs']['']['TERM'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
		}
		foreach ((array) $this->get_item_tags('', 'CATEGORY') as $category)
		{
			$categories[] = $this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		foreach ((array) $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'SUBJECT') as $category)
		{
			$categories[] = $this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		foreach ((array) $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'SUBJECT') as $category)
		{
			$categories[] = $this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT);
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
		if (isset($authors[$key]))
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
		foreach ((array) $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'AUTHOR') as $author)
		{
			$name = null;
			$uri = null;
			$email = null;
			if (isset($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['NAME'][0]['data']))
			{
				$name = $this->sanitize($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['NAME'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['URI'][0]['data']))
			{
				$uri = $this->sanitize($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['URI'][0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['URI'][0]));
			}
			if (isset($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['EMAIL'][0]['data']))
			{
				$email = $this->sanitize($author['child']['HTTP://WWW.W3.ORG/2005/ATOM']['EMAIL'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (!is_null($name) || !is_null($email) || !is_null($uri))
			{
				$authors[] = new $this->feed->author_class($name, $uri, $email);
			}
		}
		if ($author = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'AUTHOR'))
		{
			$name = null;
			$url = null;
			$email = null;
			if (isset($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['NAME'][0]['data']))
			{
				$name = $this->sanitize($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['NAME'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['URL'][0]['data']))
			{
				$uri = $this->sanitize($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['URL'][0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['URL'][0]));
			}
			if (isset($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['EMAIL'][0]['data']))
			{
				$email = $this->sanitize($author[0]['child']['HTTP://PURL.ORG/ATOM/NS#']['EMAIL'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (!is_null($name) || !is_null($email) || !is_null($url))
			{
				$authors[] = new $this->feed->author_class($name, $url, $email);
			}
		}
		if ($author = $this->get_item_tags('', 'AUTHOR'))
		{
			$authors[] = new $this->feed->author_class(null, null, $this->sanitize($author[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT));
		}
		foreach ((array) $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'CREATOR') as $author)
		{
			$authors[] = new $this->feed->author_class($this->sanitize($author['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
		}
		foreach ((array) $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'CREATOR') as $author)
		{
			$authors[] = new $this->feed->author_class($this->sanitize($author['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
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
		if (!isset($this->data['date']))
		{
			if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'PUBLISHED'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'UPDATED'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'ISSUED'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'CREATED'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'MODIFIED'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('', 'PUBDATE'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DATE'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DATE'))
			{
				$this->data['date']['raw'] = $return[0]['data'];
			}
			else
			{
				$this->data['date'] = null;
			}
			if ($this->data['date'])
			{
				$this->data['date']['parsed'] = SimplePie_Misc::parse_date($this->data['date']['raw']);
			}
		}
		if ($this->data['date'])
		{
			switch ($date_format)
			{
				case false:
					return $this->sanitize($this->data['date']['raw'], SIMPLEPIE_CONSTRUCT_TEXT);
				
				case 'U':
					return $this->data['date']['parsed'];
				
				default:
					return date($date_format, $this->data['date']['parsed']);
			}
		}
	}

	function get_ftime($date_format = '%d %B %Y, %I:%M %p')
	{
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'PUBLISHED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'UPDATED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'ISSUED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'CREATED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'MODIFIED'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('', 'PUBDATE'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.1/', 'DATE'))
		{
			$date = $return[0]['data'];
		}
		else if ($return = $this->get_item_tags('HTTP://PURL.ORG/DC/ELEMENTS/1.0/', 'DATE'))
		{
			$date = $return[0]['data'];
		}
		else
		{
			return false;
		}
		if (!$date_format)
		{
			return $this->sanitize($date, SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return strftime($date_format, SimplePie_Misc::parse_date($date));
		}
	}

	function get_permalink()
	{
		$link = $this->get_link();
		$enclosure = $this->get_enclosure(0);
		if (!is_null($link))
		{
			return $link;
		}
		else if (!is_null($enclosure))
		{
			return $enclosure->get_link();
		}
		else
		{
			return null;
		}
	}

	function get_link($key = 0, $rel = 'alternate')
	{
		$links = $this->get_links($rel);
		if (!is_null($links[$key]))
		{
			return $links[$key];
		}
		else
		{
			return null;
		}
	}

	function get_links($rel = 'alternate')
	{
		if (!isset($this->data['links']))
		{
			$this->data['links'] = array();
			foreach ((array) $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LINK') as $link)
			{
				if (isset($link['attribs']['']['HREF']))
				{
					$link_rel = (isset($link['attribs']['']['REL'])) ? $link['attribs']['']['REL'] : 'alternate';
					$this->data['links'][$link_rel][] = $this->sanitize($link['attribs']['']['HREF'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));

				}
			}
			foreach ((array) $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'LINK') as $link)
			{
				if (isset($link['attribs']['']['HREF']))
				{
					$link_rel = (isset($link['attribs']['']['REL'])) ? $link['attribs']['']['REL'] : 'alternate';
					$this->data['links'][$link_rel][] = $this->sanitize($link['attribs']['']['HREF'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));
				}
			}
			if ($links = $this->get_item_tags('HTTP://PURL.ORG/RSS/1.0/', 'LINK'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_item_tags('HTTP://MY.NETSCAPE.COM/RDF/SIMPLE/0.9/', 'LINK'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_item_tags('', 'LINK'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_item_tags('', 'GUID'))
			{
				if (!isset($links[0]['attribs']['']['ISPERMALINK']) || strtolower(trim($links[0]['attribs']['']['ISPERMALINK'])) == 'true')
				{
					$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
				}
			}

			$keys = array_keys($this->data['links']);
			foreach ($keys as $key)
			{
				if (SimplePie_Misc::is_isegment_nz_nc($key))
				{
					if (isset($this->data['links']['http://www.iana.org/assignments/relation/' . $key]))
					{
						$this->data['links']['http://www.iana.org/assignments/relation/' . $key] = array_merge($this->data['links'][$key], $this->data['links']['http://www.iana.org/assignments/relation/' . $key]);
						$this->data['links'][$key] =& $this->data['links']['http://www.iana.org/assignments/relation/' . $key];
					}
					else
					{
						$this->data['links']['http://www.iana.org/assignments/relation/' . $key] =& $this->data['links'][$key];
					}
				}
				else if (substr($key, 0, 41) == 'http://www.iana.org/assignments/relation/')
				{
					$this->data['links'][substr($key, 41)] =& $this->data['links'][$key];
				}
				$this->data['links'][$key] = array_unique($this->data['links'][$key]);
			}
		}
		if (isset($this->data['links'][$rel]))
		{
			return $this->data['links'][$rel];
		}
		else
		{
			return null;
		}
	}

	function get_enclosure($key = 0)
	{
		$enclosures = $this->get_enclosures();
		if (isset($enclosures[$key]))
		{
			return $enclosures[$key];
		}
		else
		{
			return null;
		}
	}

	function get_enclosures()
	{
		if (!isset($this->data['enclosures']))
		{
			$this->data['enclosures'] = array();
			foreach ((array) $this->get_item_tags('HTTP://WWW.W3.ORG/2005/ATOM', 'LINK') as $link)
			{
				if (isset($link['attribs']['']['HREF']) && !empty($link['attribs']['']['REL']) && $link['attribs']['']['REL'] == 'enclosure')
				{
					$url = null;
					$type = null;
					$length = null;
					$url = $this->sanitize($link['attribs']['']['HREF'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));
					if (isset($link['attribs']['']['TYPE']))
					{
						$type = $this->sanitize($link['attribs']['']['TYPE'], SIMPLEPIE_CONSTRUCT_TEXT);
					}
					if (isset($link['attribs']['']['LENGTH']))
					{
						$length = ceil($link['attribs']['']['LENGTH']);
					}
					$this->data['enclosures'][] = new $this->feed->enclosure_class($url, $type, $length, $this->feed->javascript);
				}
			}
			foreach ((array) $this->get_item_tags('HTTP://PURL.ORG/ATOM/NS#', 'LINK') as $link)
			{
				if (isset($link['attribs']['']['HREF']) && !empty($link['attribs']['']['REL']) && $link['attribs']['']['REL'] == 'enclosure')
				{
					$url = null;
					$type = null;
					$length = null;
					$url = $this->sanitize($link['attribs']['']['HREF'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));
					if (isset($link['attribs']['']['TYPE']))
					{
						$type = $this->sanitize($link['attribs']['']['TYPE'], SIMPLEPIE_CONSTRUCT_TEXT);
					}
					if (isset($link['attribs']['']['LENGTH']))
					{
						$length = ceil($link['attribs']['']['LENGTH']);
					}
					$this->data['enclosures'][] = new $this->feed->enclosure_class($url, $type, $length, $this->feed->javascript);
				}
			}
			if ($enclosure = $this->get_item_tags('', 'ENCLOSURE'))
			{
				if (isset($enclosure[0]['attribs']['']['URL']))
				{
					$url = null;
					$type = null;
					$length = null;
					$url = $this->sanitize($enclosure[0]['attribs']['']['URL'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($enclosure[0]));
					if (isset($enclosure[0]['attribs']['']['TYPE']))
					{
						$type = $this->sanitize($enclosure[0]['attribs']['']['TYPE'], SIMPLEPIE_CONSTRUCT_TEXT);
					}
					if (isset($enclosure[0]['attribs']['']['LENGTH']))
					{
						$length = ceil($enclosure[0]['attribs']['']['LENGTH']);
					}
					$this->data['enclosures'][] = new $this->feed->enclosure_class($url, $type, $length, $this->feed->javascript);
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
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2003/01/GEO/WGS84_POS#', 'LAT'))
		{
			return (float) $return[0]['data'];
		}
		else if (($return = $this->get_item_tags('HTTP://WWW.GEORSS.ORG/GEORSS', 'POINT')) && preg_match('/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/', $return[0]['data'], $match))
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
		if ($return = $this->get_item_tags('HTTP://WWW.W3.ORG/2003/01/GEO/WGS84_POS#', 'LONG'))
		{
			return (float) $return[0]['data'];
		}
		else if (($return = $this->get_item_tags('HTTP://WWW.GEORSS.ORG/GEORSS', 'POINT')) && preg_match('/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/', $return[0]['data'], $match))
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
	function add_to_service($feed_url, $title_url = null)
	{
		if ($this->get_permalink())
		{
			$return = $feed_url . rawurlencode($this->get_permalink());
			if (!is_null($title_url) && $this->get_title())
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
		return sha1(serialize($this));
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
		return sha1(serialize($this));
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
				$width = '480';
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
				$height = '0';
			}
			else if ($mime == 'video')
			{
				$height = '360';
			}
			else
			{
				$height = '376';
			}
		}
		else
		{
			if ($mime == 'audio')
			{
				$height = '0';
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
				$embed .= '<embed src="http://odeo.com/flash/audio_player_fullsize.swf" pluginspage="http://adobe.com/go/getflashplayer" type="application/x-shockwave-flash" quality="high" width="440" height="80" wmode="transparent" allowScriptAccess="any" flashvars="valid_sample_rate=true&external_url=' . $this->get_link() . '"></embed>';
			}
			else
			{
				$embed .= '<script type="text/javascript">embed_odeo("' . $this->get_link() . '");</script>';
			}
		}

		// Flash
		else if (in_array($type, array('application/x-shockwave-flash', 'application/futuresplash')))
		{
			if ($native)
			{
				$embed .= "<embed src=\"" . $this->get_link() . "\" pluginspage=\"http://adobe.com/go/getflashplayer\" type=\"$type\" quality=\"high\" width=\"$width\" height=\"$height\" bgcolor=\"$bgcolor\" loop=\"$loop\"></embed>";
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_flash('$bgcolor', '$width', '$height', '" . $this->get_link() . "', '$loop', '$type');</script>";
			}
		}

		// Flash Media Player file types.
		// Preferred handler for MP3 file types.
		else if (in_array($type, array('audio/mp3', 'audio/x-mp3', 'audio/mpeg', 'audio/x-mpeg', 'video/flv', 'video/x-flv')) && ($mediaplayer != ''))
		{
			$height += 20;
			if ($native)
			{
				$embed .= "<embed src=\"$mediaplayer\" pluginspage=\"http://adobe.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" quality=\"high\" width=\"$width\" height=\"$height\" wmode=\"transparent\" flashvars=\"file=" . rawurlencode($this->get_link()) . "&autostart=false&repeat=$loop&showdigits=true&showfsbutton=false\"></embed>";
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_flv('$width', '$height', '" . rawurlencode($this->get_link()) . "', '$placeholder', '$loop', '$mediaplayer');</script>";
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
					$embed .= "<embed type=\"$type\" style=\"cursor:hand; cursor:pointer;\" href=\"" . $this->get_link() . "\" src=\"$placeholder\" width=\"$width\" height=\"$height\" autoplay=\"false\" target=\"myself\" controller=\"false\" loop=\"$loop\" scale=\"aspect\" bgcolor=\"$bgcolor\" pluginspage=\"http://apple.com/quicktime/download/\"></embed>";
				}
				else {
					$embed .= "<embed type=\"$type\" style=\"cursor:hand; cursor:pointer;\" src=\"" . $this->get_link() . "\" width=\"$width+\" height=\"$height\" autoplay=\"false\" target=\"myself\" controller=\"true\" loop=\"$loop\" scale=\"aspect\" bgcolor=\"$bgcolor\" pluginspage=\"http://apple.com/quicktime/download/\"></embed>";
				}
			}
			else
			{
				$embed .= "<script type='text/javascript'>embed_quicktime('$type', '$bgcolor', '$width', '$height', '" . $this->get_link() . "', '$placeholder', '$loop');</script>";
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

/**
 * @todo Move to properly supporting RFC2616 (HTTP/1.1)
 */
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
					if (($this->headers['status']['code'] == 300 || $this->headers['status']['code'] == 301 || $this->headers['status']['code'] == 302 || $this->headers['status']['code'] == 303 || $this->headers['status']['code'] == 307 || $this->headers['status']['code'] > 307 && $this->headers['status']['code'] < 400) && !empty($this->headers['location'][0]) && $this->redirects < $redirects)
					{
						$this->redirects++;
						return $this->SimplePie_File($this->headers['location'][0], $timeout, $redirects, $headers, $useragent, $force_fsockopen);
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
						if (($this->headers['status']['code'] == 300 || $this->headers['status']['code'] == 301 || $this->headers['status']['code'] == 302 || $this->headers['status']['code'] == 303 || $this->headers['status']['code'] == 307 || $this->headers['status']['code'] > 307 && $this->headers['status']['code'] < 400) && !empty($this->headers['location'][0]) && $this->redirects < $redirects)
						{
							$this->redirects++;
							return $this->SimplePie_File($this->headers['location'][0], $timeout, $redirects, $headers, $useragent, $force_fsockopen);
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
							if (!empty($this->headers['content-encoding'][0]) && ($this->headers['content-encoding'][0] == 'gzip' || $this->headers['content-encoding'][0] == 'deflate'))
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
			$header_name = strtolower(trim($data[0]));
			if (in_array($header_name, array('date', 'expires', 'if-range', 'if-unmodified-since', 'last-modified', 'retry-after')))
			{
				$head[$header_name][] = $data[1];
			}
			else
			{
				$head[$header_name][] = preg_replace('/(\r\n)?[\x09\x20]+/', '', $data[1]);
			}
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
		if ($relative !== '')
		{
			$relative = SimplePie_Misc::parse_url($relative);
			if ($relative['scheme'] !== '')
			{
				$target = $relative;
			}
			else if ($base !== '')
			{
				$base = SimplePie_Misc::parse_url($base);
				$target = SimplePie_Misc::parse_url('');
				if ($relative['authority'] !== '')
				{
					$target = $relative;
					$target['scheme'] = $base['scheme'];
				}
				else
				{
					$target['scheme'] = $base['scheme'];
					$target['authority'] = $base['authority'];
					if ($relative['path'] !== '')
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
						if ($relative['query'] !== '')
						{
							$target['query'] = $relative['query'];
						}
					}
					else
					{
						if ($base['path'] !== '')
						{
							$target['path'] = $base['path'];
						}
						else
						{
							$target['path'] = '/';
						}
						if ($relative['query'] !== '')
						{
							$target['query'] = $relative['query'];
						}
						else if ($base['query'] !== '')
						{
							$target['query'] = $base['query'];
						}
					}
				}
				if ($relative['fragment'] !== '')
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
		while (strpos($input, './') !== false || strpos($input, '/.') !== false || $input == '.' || $input == '..')
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
				$output = preg_replace('/(\/)?([^\/]+)$/', '', $output);
			}
			else if ($input == '/..')
			{
				$input = '/';
				$output = preg_replace('/(\/)?([^\/]+)$/', '', $output);
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
					// We've ended up in an infinite loop, so do what we otherwise never will: return false.
					return false;
				}
			}
		}
		return $output . $input;
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
					for ($j = 0; $j < $total_attribs; $j++)
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

	/**
	 * If a file has been cached, retrieve and display it.
	 * 
	 * This is most useful for caching images (get_favicon(), etc.), 
	 * however it works for all cached files.  This WILL NOT display ANY 
	 * file/image/page/whatever, but rather only display what has already 
	 * been cached by SimplePie.
	 *
	 * @access public
	 * @see SimplePie::get_favicon()
	 * @param str $identifier_url URL that is used to identify the content.  
	 * This may or may not be the actual URL of the live content.
	 * @param str $cache_location Location of SimplePie's cache.  Defaults 
	 * to './cache'.
	 * @param str $cache_extension The file extension that the file was 
	 * cached with.  Defaults to 'spc'.
	 * @param str $cache_class Name of the cache-handling class being used 
	 * in SimplePie.  Defaults to 'SimplePie_Cache', and should be left 
	 * as-is unless you've overloaded the class.
	 * @param str $cache_name_function Function that converts the filename 
	 * for saving.  Defaults to 'sha1'.
	 */
	function display_cached_file($identifier_url, $cache_location = './cache', $cache_extension = 'spc', $cache_class = 'SimplePie_Cache', $cache_name_function = 'sha1')
	{
		$cache = new $cache_class($cache_location, call_user_func($cache_name_function, $identifier_url), $cache_extension);

		if ($file = $cache->load())
		{
			header('Content-type:' . $file['headers']['Content-type']);
			echo $file['body'];
			exit;
		}

		die('Cached file for ' . $identifier_url . ' cannot be found.');
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
		if ($scheme !== '')
		{
			$return .= "$scheme:";
		}
		if ($authority !== '')
		{
			$return .= "//$authority";
		}
		if ($path !== '')
		{
			$return .= $path;
		}
		if ($query !== '')
		{
			$return .= "?$query";
		}
		if ($fragment !== '')
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

		if (function_exists('iconv') && ($return = @iconv($input, $output, $data)))
		{
			return $return;
		}
		else if (function_exists('mb_convert_encoding') && ($return = @mb_convert_encoding($data, $output, $input)))
		{
			return $return;
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
		// Character sets are case-insensitive (though we'll return them in the form given in their registration)
		switch (strtoupper($encoding))
		{
			case 'ANSI_X3.4-1968':
			case 'ISO-IR-6':
			case 'ANSI_X3.4-1986':
			case 'ISO_646.IRV:1991':
			case 'ASCII':
			case 'ISO646-US':
			case 'US-ASCII':
			case 'US':
			case 'IBM367':
			case 'CP367':
			case 'CSASCII':
				return 'US-ASCII';

			case 'ISO-10646-UTF-1':
			case 'CSISO10646UTF1':
				return 'ISO-10646-UTF-1';

			case 'ISO_646.BASIC:1983':
			case 'REF':
			case 'CSISO646BASIC1983':
				return 'ISO_646.basic:1983';

			case 'INVARIANT':
			case 'CSINVARIANT':
				return 'INVARIANT';

			case 'ISO_646.IRV:1983':
			case 'ISO-IR-2':
			case 'IRV':
			case 'CSISO2INTLREFVERSION':
				return 'ISO_646.irv:1983';

			case 'BS_4730':
			case 'ISO-IR-4':
			case 'ISO646-GB':
			case 'GB':
			case 'UK':
			case 'CSISO4UNITEDKINGDOM':
				return 'BS_4730';

			case 'NATS-SEFI':
			case 'ISO-IR-8-1':
			case 'CSNATSSEFI':
				return 'NATS-SEFI';

			case 'NATS-SEFI-ADD':
			case 'ISO-IR-8-2':
			case 'CSNATSSEFIADD':
				return 'NATS-SEFI-ADD';

			case 'NATS-DANO':
			case 'ISO-IR-9-1':
			case 'CSNATSDANO':
				return 'NATS-DANO';

			case 'NATS-DANO-ADD':
			case 'ISO-IR-9-2':
			case 'CSNATSDANOADD':
				return 'NATS-DANO-ADD';

			case 'SEN_850200_B':
			case 'ISO-IR-10':
			case 'FI':
			case 'ISO646-FI':
			case 'ISO646-SE':
			case 'SE':
			case 'CSISO10SWEDISH':
				return 'SEN_850200_B';

			case 'SEN_850200_C':
			case 'ISO-IR-11':
			case 'ISO646-SE2':
			case 'SE2':
			case 'CSISO11SWEDISHFORNAMES':
				return 'SEN_850200_C';

			case 'KS_C_5601-1987':
			case 'ISO-IR-149':
			case 'KS_C_5601-1989':
			case 'KSC_5601':
			case 'KOREAN':
			case 'CSKSC56011987':
				return 'KS_C_5601-1987';

			case 'ISO-2022-KR':
			case 'CSISO2022KR':
				return 'ISO-2022-KR';

			case 'EUC-KR':
			case 'CSEUCKR':
				return 'EUC-KR';

			case 'ISO-2022-JP':
			case 'CSISO2022JP':
				return 'ISO-2022-JP';

			case 'ISO-2022-JP-2':
			case 'CSISO2022JP2':
				return 'ISO-2022-JP-2';

			case 'ISO-2022-CN':
				return 'ISO-2022-CN';

			case 'ISO-2022-CN-EXT':
				return 'ISO-2022-CN-EXT';

			case 'JIS_C6220-1969-JP':
			case 'JIS_C6220-1969':
			case 'ISO-IR-13':
			case 'KATAKANA':
			case 'X0201-7':
			case 'CSISO13JISC6220JP':
				return 'JIS_C6220-1969-jp';

			case 'JIS_C6220-1969-RO':
			case 'ISO-IR-14':
			case 'JP':
			case 'ISO646-JP':
			case 'CSISO14JISC6220RO':
				return 'JIS_C6220-1969-ro';

			case 'IT':
			case 'ISO-IR-15':
			case 'ISO646-IT':
			case 'CSISO15ITALIAN':
				return 'IT';

			case 'PT':
			case 'ISO-IR-16':
			case 'ISO646-PT':
			case 'CSISO16PORTUGUESE':
				return 'PT';

			case 'ES':
			case 'ISO-IR-17':
			case 'ISO646-ES':
			case 'CSISO17SPANISH':
				return 'ES';

			case 'GREEK7-OLD':
			case 'ISO-IR-18':
			case 'CSISO18GREEK7OLD':
				return 'greek7-old';

			case 'LATIN-GREEK':
			case 'ISO-IR-19':
			case 'CSISO19LATINGREEK':
				return 'latin-greek';

			case 'DIN_66003':
			case 'ISO-IR-21':
			case 'DE':
			case 'ISO646-DE':
			case 'CSISO21GERMAN':
				return 'DIN_66003';

			case 'NF_Z_62-010_(1973)':
			case 'ISO-IR-25':
			case 'ISO646-FR1':
			case 'CSISO25FRENCH':
				return 'NF_Z_62-010_(1973)';

			case 'LATIN-GREEK-1':
			case 'ISO-IR-27':
			case 'CSISO27LATINGREEK1':
				return 'Latin-greek-1';

			case 'ISO_5427':
			case 'ISO-IR-37':
			case 'CSISO5427CYRILLIC':
				return 'ISO_5427';

			case 'JIS_C6226-1978':
			case 'ISO-IR-42':
			case 'CSISO42JISC62261978':
				return 'JIS_C6226-1978';

			case 'BS_VIEWDATA':
			case 'ISO-IR-47':
			case 'CSISO47BSVIEWDATA':
				return 'BS_viewdata';

			case 'INIS':
			case 'ISO-IR-49':
			case 'CSISO49INIS':
				return 'INIS';

			case 'INIS-8':
			case 'ISO-IR-50':
			case 'CSISO50INIS8':
				return 'INIS-8';

			case 'INIS-CYRILLIC':
			case 'ISO-IR-51':
			case 'CSISO51INISCYRILLIC':
				return 'INIS-cyrillic';

			case 'ISO_5427:1981':
			case 'ISO-IR-54':
			case 'ISO5427CYRILLIC1981':
				return 'ISO_5427:1981';

			case 'ISO_5428:1980':
			case 'ISO-IR-55':
			case 'CSISO5428GREEK':
				return 'ISO_5428:1980';

			case 'GB_1988-80':
			case 'ISO-IR-57':
			case 'CN':
			case 'ISO646-CN':
			case 'CSISO57GB1988':
				return 'GB_1988-80';

			case 'GB_2312-80':
			case 'ISO-IR-58':
			case 'CHINESE':
			case 'CSISO58GB231280':
				return 'GB_2312-80';

			case 'NS_4551-1':
			case 'ISO-IR-60':
			case 'ISO646-NO':
			case 'NO':
			case 'CSISO60DANISHNORWEGIAN':
			case 'CSISO60NORWEGIAN1':
				return 'NS_4551-1';

			case 'NS_4551-2':
			case 'ISO646-NO2':
			case 'ISO-IR-61':
			case 'NO2':
			case 'CSISO61NORWEGIAN2':
				return 'NS_4551-2';

			case 'NF_Z_62-010':
			case 'ISO-IR-69':
			case 'ISO646-FR':
			case 'FR':
			case 'CSISO69FRENCH':
				return 'NF_Z_62-010';

			case 'VIDEOTEX-SUPPL':
			case 'ISO-IR-70':
			case 'CSISO70VIDEOTEXSUPP1':
				return 'videotex-suppl';

			case 'PT2':
			case 'ISO-IR-84':
			case 'ISO646-PT2':
			case 'CSISO84PORTUGUESE2':
				return 'PT2';

			case 'ES2':
			case 'ISO-IR-85':
			case 'ISO646-ES2':
			case 'CSISO85SPANISH2':
				return 'ES2';

			case 'MSZ_7795.3':
			case 'ISO-IR-86':
			case 'ISO646-HU':
			case 'HU':
			case 'CSISO86HUNGARIAN':
				return 'MSZ_7795.3';

			case 'JIS_C6226-1983':
			case 'ISO-IR-87':
			case 'X0208':
			case 'JIS_X0208-1983':
			case 'CSISO87JISX0208':
				return 'JIS_C6226-1983';

			case 'GREEK7':
			case 'ISO-IR-88':
			case 'CSISO88GREEK7':
				return 'greek7';

			case 'ASMO_449':
			case 'ISO_9036':
			case 'ARABIC7':
			case 'ISO-IR-89':
			case 'CSISO89ASMO449':
				return 'ASMO_449';

			case 'ISO-IR-90':
			case 'CSISO90':
				return 'iso-ir-90';

			case 'JIS_C6229-1984-A':
			case 'ISO-IR-91':
			case 'JP-OCR-A':
			case 'CSISO91JISC62291984A':
				return 'JIS_C6229-1984-a';

			case 'JIS_C6229-1984-B':
			case 'ISO-IR-92':
			case 'ISO646-JP-OCR-B':
			case 'JP-OCR-B':
			case 'CSISO92JISC62991984B':
				return 'JIS_C6229-1984-b';

			case 'JIS_C6229-1984-B-ADD':
			case 'ISO-IR-93':
			case 'JP-OCR-B-ADD':
			case 'CSISO93JIS62291984BADD':
				return 'JIS_C6229-1984-b-add';

			case 'JIS_C6229-1984-HAND':
			case 'ISO-IR-94':
			case 'JP-OCR-HAND':
			case 'CSISO94JIS62291984HAND':
				return 'JIS_C6229-1984-hand';

			case 'JIS_C6229-1984-HAND-ADD':
			case 'ISO-IR-95':
			case 'JP-OCR-HAND-ADD':
			case 'CSISO95JIS62291984HANDADD':
				return 'JIS_C6229-1984-hand-add';

			case 'JIS_C6229-1984-KANA':
			case 'ISO-IR-96':
			case 'CSISO96JISC62291984KANA':
				return 'JIS_C6229-1984-kana';

			case 'ISO_2033-1983':
			case 'ISO-IR-98':
			case 'E13B':
			case 'CSISO2033':
				return 'ISO_2033-1983';

			case 'ANSI_X3.110-1983':
			case 'ISO-IR-99':
			case 'CSA_T500-1983':
			case 'NAPLPS':
			case 'CSISO99NAPLPS':
				return 'ANSI_X3.110-1983';

			case 'ISO_8859-1:1987':
			case 'ISO-IR-100':
			case 'ISO_8859-1':
			case 'ISO-8859-1':
			case 'LATIN1':
			case 'L1':
			case 'IBM819':
			case 'CP819':
			case 'CSISOLATIN1':
				return 'ISO-8859-1';

			case 'ISO_8859-2:1987':
			case 'ISO-IR-101':
			case 'ISO_8859-2':
			case 'ISO-8859-2':
			case 'LATIN2':
			case 'L2':
			case 'CSISOLATIN2':
				return 'ISO-8859-2';

			case 'T.61-7BIT':
			case 'ISO-IR-102':
			case 'CSISO102T617BIT':
				return 'T.61-7bit';

			case 'T.61-8BIT':
			case 'T.61':
			case 'ISO-IR-103':
			case 'CSISO103T618BIT':
				return 'T.61-8bit';

			case 'ISO_8859-3:1988':
			case 'ISO-IR-109':
			case 'ISO_8859-3':
			case 'ISO-8859-3':
			case 'LATIN3':
			case 'L3':
			case 'CSISOLATIN3':
				return 'ISO-8859-3';

			case 'ISO_8859-4:1988':
			case 'ISO-IR-110':
			case 'ISO_8859-4':
			case 'ISO-8859-4':
			case 'LATIN4':
			case 'L4':
			case 'CSISOLATIN4':
				return 'ISO-8859-4';

			case 'ECMA-CYRILLIC':
			case 'ISO-IR-111':
			case 'KOI8-E':
			case 'CSISO111ECMACYRILLIC':
				return 'ECMA-cyrillic';

			case 'CSA_Z243.4-1985-1':
			case 'ISO-IR-121':
			case 'ISO646-CA':
			case 'CSA7-1':
			case 'CA':
			case 'CSISO121CANADIAN1':
				return 'CSA_Z243.4-1985-1';

			case 'CSA_Z243.4-1985-2':
			case 'ISO-IR-122':
			case 'ISO646-CA2':
			case 'CSA7-2':
			case 'CSISO122CANADIAN2':
				return 'CSA_Z243.4-1985-2';

			case 'CSA_Z243.4-1985-GR':
			case 'ISO-IR-123':
			case 'CSISO123CSAZ24341985GR':
				return 'CSA_Z243.4-1985-gr';

			case 'ISO_8859-6:1987':
			case 'ISO-IR-127':
			case 'ISO_8859-6':
			case 'ISO-8859-6':
			case 'ECMA-114':
			case 'ASMO-708':
			case 'ARABIC':
			case 'CSISOLATINARABIC':
				return 'ISO-8859-6';

			case 'ISO_8859-6-E':
			case 'CSISO88596E':
			case 'ISO-8859-6-E':
				return 'ISO-8859-6-E';

			case 'ISO_8859-6-I':
			case 'CSISO88596I':
			case 'ISO-8859-6-I':
				return 'ISO-8859-6-I';

			case 'ISO_8859-7:1987':
			case 'ISO-IR-126':
			case 'ISO_8859-7':
			case 'ISO-8859-7':
			case 'ELOT_928':
			case 'ECMA-118':
			case 'GREEK':
			case 'GREEK8':
			case 'CSISOLATINGREEK':
				return 'ISO-8859-7';

			case 'T.101-G2':
			case 'ISO-IR-128':
			case 'CSISO128T101G2':
				return 'T.101-G2';

			case 'ISO_8859-8:1988':
			case 'ISO-IR-138':
			case 'ISO_8859-8':
			case 'ISO-8859-8':
			case 'HEBREW':
			case 'CSISOLATINHEBREW':
				return 'ISO-8859-8';

			case 'ISO_8859-8-E':
			case 'CSISO88598E':
			case 'ISO-8859-8-E':
				return 'ISO-8859-8-E';

			case 'ISO_8859-8-I':
			case 'CSISO88598I':
			case 'ISO-8859-8-I':
				return 'ISO-8859-8-I';

			case 'CSN_369103':
			case 'ISO-IR-139':
			case 'CSISO139CSN369103':
				return 'CSN_369103';

			case 'JUS_I.B1.002':
			case 'ISO-IR-141':
			case 'ISO646-YU':
			case 'JS':
			case 'YU':
			case 'CSISO141JUSIB1002':
				return 'JUS_I.B1.002';

			case 'ISO_6937-2-ADD':
			case 'ISO-IR-142':
			case 'CSISOTEXTCOMM':
				return 'ISO_6937-2-add';

			case 'IEC_P27-1':
			case 'ISO-IR-143':
			case 'CSISO143IECP271':
				return 'IEC_P27-1';

			case 'ISO_8859-5:1988':
			case 'ISO-IR-144':
			case 'ISO_8859-5':
			case 'ISO-8859-5':
			case 'CYRILLIC':
			case 'CSISOLATINCYRILLIC':
				return 'ISO-8859-5';

			case 'JUS_I.B1.003-SERB':
			case 'ISO-IR-146':
			case 'SERBIAN':
			case 'CSISO146SERBIAN':
				return 'JUS_I.B1.003-serb';

			case 'JUS_I.B1.003-MAC':
			case 'MACEDONIAN':
			case 'ISO-IR-147':
			case 'CSISO147MACEDONIAN':
				return 'JUS_I.B1.003-mac';

			case 'ISO_8859-9:1989':
			case 'ISO-IR-148':
			case 'ISO_8859-9':
			case 'ISO-8859-9':
			case 'LATIN5':
			case 'L5':
			case 'CSISOLATIN5':
				return 'ISO-8859-9';

			case 'GREEK-CCITT':
			case 'ISO-IR-150':
			case 'CSISO150':
			case 'CSISO150GREEKCCITT':
				return 'greek-ccitt';

			case 'NC_NC00-10:81':
			case 'CUBA':
			case 'ISO-IR-151':
			case 'ISO646-CU':
			case 'CSISO151CUBA':
				return 'NC_NC00-10:81';

			case 'ISO_6937-2-25':
			case 'ISO-IR-152':
			case 'CSISO6937ADD':
				return 'ISO_6937-2-25';

			case 'GOST_19768-74':
			case 'ST_SEV_358-88':
			case 'ISO-IR-153':
			case 'CSISO153GOST1976874':
				return 'GOST_19768-74';

			case 'ISO_8859-SUPP':
			case 'ISO-IR-154':
			case 'LATIN1-2-5':
			case 'CSISO8859SUPP':
				return 'ISO_8859-supp';

			case 'ISO_10367-BOX':
			case 'ISO-IR-155':
			case 'CSISO10367BOX':
				return 'ISO_10367-box';

			case 'ISO-8859-10':
			case 'ISO-IR-157':
			case 'L6':
			case 'ISO_8859-10:1992':
			case 'CSISOLATIN6':
			case 'LATIN6':
				return 'ISO-8859-10';

			case 'LATIN-LAP':
			case 'LAP':
			case 'ISO-IR-158':
			case 'CSISO158LAP':
				return 'latin-lap';

			case 'JIS_X0212-1990':
			case 'X0212':
			case 'ISO-IR-159':
			case 'CSISO159JISX02121990':
				return 'JIS_X0212-1990';

			case 'DS_2089':
			case 'DS2089':
			case 'ISO646-DK':
			case 'DK':
			case 'CSISO646DANISH':
				return 'DS_2089';

			case 'US-DK':
			case 'CSUSDK':
				return 'us-dk';

			case 'DK-US':
			case 'CSDKUS':
				return 'dk-us';

			case 'JIS_X0201':
			case 'X0201':
			case 'CSHALFWIDTHKATAKANA':
				return 'JIS_X0201';

			case 'KSC5636':
			case 'ISO646-KR':
			case 'CSKSC5636':
				return 'KSC5636';

			case 'ISO-10646-UCS-2':
			case 'CSUNICODE':
				return 'ISO-10646-UCS-2';

			case 'ISO-10646-UCS-4':
			case 'CSUCS4':
				return 'ISO-10646-UCS-4';

			case 'DEC-MCS':
			case 'DEC':
			case 'CSDECMCS':
				return 'DEC-MCS';

			case 'HP-ROMAN8':
			case 'ROMAN8':
			case 'R8':
			case 'CSHPROMAN8':
				return 'hp-roman8';

			case 'MACINTOSH':
			case 'MAC':
			case 'CSMACINTOSH':
				return 'macintosh';

			case 'IBM037':
			case 'CP037':
			case 'EBCDIC-CP-US':
			case 'EBCDIC-CP-CA':
			case 'EBCDIC-CP-WT':
			case 'EBCDIC-CP-NL':
			case 'CSIBM037':
				return 'IBM037';

			case 'IBM038':
			case 'EBCDIC-INT':
			case 'CP038':
			case 'CSIBM038':
				return 'IBM038';

			case 'IBM273':
			case 'CP273':
			case 'CSIBM273':
				return 'IBM273';

			case 'IBM274':
			case 'EBCDIC-BE':
			case 'CP274':
			case 'CSIBM274':
				return 'IBM274';

			case 'IBM275':
			case 'EBCDIC-BR':
			case 'CP275':
			case 'CSIBM275':
				return 'IBM275';

			case 'IBM277':
			case 'EBCDIC-CP-DK':
			case 'EBCDIC-CP-NO':
			case 'CSIBM277':
				return 'IBM277';

			case 'IBM278':
			case 'CP278':
			case 'EBCDIC-CP-FI':
			case 'EBCDIC-CP-SE':
			case 'CSIBM278':
				return 'IBM278';

			case 'IBM280':
			case 'CP280':
			case 'EBCDIC-CP-IT':
			case 'CSIBM280':
				return 'IBM280';

			case 'IBM281':
			case 'EBCDIC-JP-E':
			case 'CP281':
			case 'CSIBM281':
				return 'IBM281';

			case 'IBM284':
			case 'CP284':
			case 'EBCDIC-CP-ES':
			case 'CSIBM284':
				return 'IBM284';

			case 'IBM285':
			case 'CP285':
			case 'EBCDIC-CP-GB':
			case 'CSIBM285':
				return 'IBM285';

			case 'IBM290':
			case 'CP290':
			case 'EBCDIC-JP-KANA':
			case 'CSIBM290':
				return 'IBM290';

			case 'IBM297':
			case 'CP297':
			case 'EBCDIC-CP-FR':
			case 'CSIBM297':
				return 'IBM297';

			case 'IBM420':
			case 'CP420':
			case 'EBCDIC-CP-AR1':
			case 'CSIBM420':
				return 'IBM420';

			case 'IBM423':
			case 'CP423':
			case 'EBCDIC-CP-GR':
			case 'CSIBM423':
				return 'IBM423';

			case 'IBM424':
			case 'CP424':
			case 'EBCDIC-CP-HE':
			case 'CSIBM424':
				return 'IBM424';

			case 'IBM437':
			case 'CP437':
			case '437':
			case 'CSPC8CODEPAGE437':
				return 'IBM437';

			case 'IBM500':
			case 'CP500':
			case 'EBCDIC-CP-BE':
			case 'EBCDIC-CP-CH':
			case 'CSIBM500':
				return 'IBM500';

			case 'IBM775':
			case 'CP775':
			case 'CSPC775BALTIC':
				return 'IBM775';

			case 'IBM850':
			case 'CP850':
			case '850':
			case 'CSPC850MULTILINGUAL':
				return 'IBM850';

			case 'IBM851':
			case 'CP851':
			case '851':
			case 'CSIBM851':
				return 'IBM851';

			case 'IBM852':
			case 'CP852':
			case '852':
			case 'CSPCP852':
				return 'IBM852';

			case 'IBM855':
			case 'CP855':
			case '855':
			case 'CSIBM855':
				return 'IBM855';

			case 'IBM857':
			case 'CP857':
			case '857':
			case 'CSIBM857':
				return 'IBM857';

			case 'IBM860':
			case 'CP860':
			case '860':
			case 'CSIBM860':
				return 'IBM860';

			case 'IBM861':
			case 'CP861':
			case '861':
			case 'CP-IS':
			case 'CSIBM861':
				return 'IBM861';

			case 'IBM862':
			case 'CP862':
			case '862':
			case 'CSPC862LATINHEBREW':
				return 'IBM862';

			case 'IBM863':
			case 'CP863':
			case '863':
			case 'CSIBM863':
				return 'IBM863';

			case 'IBM864':
			case 'CP864':
			case 'CSIBM864':
				return 'IBM864';

			case 'IBM865':
			case 'CP865':
			case '865':
			case 'CSIBM865':
				return 'IBM865';

			case 'IBM866':
			case 'CP866':
			case '866':
			case 'CSIBM866':
				return 'IBM866';

			case 'IBM868':
			case 'CP868':
			case 'CP-AR':
			case 'CSIBM868':
				return 'IBM868';

			case 'IBM869':
			case 'CP869':
			case '869':
			case 'CP-GR':
			case 'CSIBM869':
				return 'IBM869';

			case 'IBM870':
			case 'CP870':
			case 'EBCDIC-CP-ROECE':
			case 'EBCDIC-CP-YU':
			case 'CSIBM870':
				return 'IBM870';

			case 'IBM871':
			case 'CP871':
			case 'EBCDIC-CP-IS':
			case 'CSIBM871':
				return 'IBM871';

			case 'IBM880':
			case 'CP880':
			case 'EBCDIC-CYRILLIC':
			case 'CSIBM880':
				return 'IBM880';

			case 'IBM891':
			case 'CP891':
			case 'CSIBM891':
				return 'IBM891';

			case 'IBM903':
			case 'CP903':
			case 'CSIBM903':
				return 'IBM903';

			case 'IBM904':
			case 'CP904':
			case '904':
			case 'CSIBBM904':
				return 'IBM904';

			case 'IBM905':
			case 'CP905':
			case 'EBCDIC-CP-TR':
			case 'CSIBM905':
				return 'IBM905';

			case 'IBM918':
			case 'CP918':
			case 'EBCDIC-CP-AR2':
			case 'CSIBM918':
				return 'IBM918';

			case 'IBM1026':
			case 'CP1026':
			case 'CSIBM1026':
				return 'IBM1026';

			case 'EBCDIC-AT-DE':
			case 'CSIBMEBCDICATDE':
				return 'EBCDIC-AT-DE';

			case 'EBCDIC-AT-DE-A':
			case 'CSEBCDICATDEA':
				return 'EBCDIC-AT-DE-A';

			case 'EBCDIC-CA-FR':
			case 'CSEBCDICCAFR':
				return 'EBCDIC-CA-FR';

			case 'EBCDIC-DK-NO':
			case 'CSEBCDICDKNO':
				return 'EBCDIC-DK-NO';

			case 'EBCDIC-DK-NO-A':
			case 'CSEBCDICDKNOA':
				return 'EBCDIC-DK-NO-A';

			case 'EBCDIC-FI-SE':
			case 'CSEBCDICFISE':
				return 'EBCDIC-FI-SE';

			case 'EBCDIC-FI-SE-A':
			case 'CSEBCDICFISEA':
				return 'EBCDIC-FI-SE-A';

			case 'EBCDIC-FR':
			case 'CSEBCDICFR':
				return 'EBCDIC-FR';

			case 'EBCDIC-IT':
			case 'CSEBCDICIT':
				return 'EBCDIC-IT';

			case 'EBCDIC-PT':
			case 'CSEBCDICPT':
				return 'EBCDIC-PT';

			case 'EBCDIC-ES':
			case 'CSEBCDICES':
				return 'EBCDIC-ES';

			case 'EBCDIC-ES-A':
			case 'CSEBCDICESA':
				return 'EBCDIC-ES-A';

			case 'EBCDIC-ES-S':
			case 'CSEBCDICESS':
				return 'EBCDIC-ES-S';

			case 'EBCDIC-UK':
			case 'CSEBCDICUK':
				return 'EBCDIC-UK';

			case 'EBCDIC-US':
			case 'CSEBCDICUS':
				return 'EBCDIC-US';

			case 'UNKNOWN-8BIT':
			case 'CSUNKNOWN8BIT':
				return 'UNKNOWN-8BIT';

			case 'MNEMONIC':
			case 'CSMNEMONIC':
				return 'MNEMONIC';

			case 'MNEM':
			case 'CSMNEM':
				return 'MNEM';

			case 'VISCII':
			case 'CSVISCII':
				return 'VISCII';

			case 'VIQR':
			case 'CSVIQR':
				return 'VIQR';

			case 'KOI8-R':
			case 'CSKOI8R':
				return 'KOI8-R';

			case 'KOI8-U':
				return 'KOI8-U';

			case 'IBM00858':
			case 'CCSID00858':
			case 'CP00858':
			case 'PC-MULTILINGUAL-850+EURO':
				return 'IBM00858';

			case 'IBM00924':
			case 'CCSID00924':
			case 'CP00924':
			case 'EBCDIC-LATIN9--EURO':
				return 'IBM00924';

			case 'IBM01140':
			case 'CCSID01140':
			case 'CP01140':
			case 'EBCDIC-US-37+EURO':
				return 'IBM01140';

			case 'IBM01141':
			case 'CCSID01141':
			case 'CP01141':
			case 'EBCDIC-DE-273+EURO':
				return 'IBM01141';

			case 'IBM01142':
			case 'CCSID01142':
			case 'CP01142':
			case 'EBCDIC-DK-277+EURO':
			case 'EBCDIC-NO-277+EURO':
				return 'IBM01142';

			case 'IBM01143':
			case 'CCSID01143':
			case 'CP01143':
			case 'EBCDIC-FI-278+EURO':
			case 'EBCDIC-SE-278+EURO':
				return 'IBM01143';

			case 'IBM01144':
			case 'CCSID01144':
			case 'CP01144':
			case 'EBCDIC-IT-280+EURO':
				return 'IBM01144';

			case 'IBM01145':
			case 'CCSID01145':
			case 'CP01145':
			case 'EBCDIC-ES-284+EURO':
				return 'IBM01145';

			case 'IBM01146':
			case 'CCSID01146':
			case 'CP01146':
			case 'EBCDIC-GB-285+EURO':
				return 'IBM01146';

			case 'IBM01147':
			case 'CCSID01147':
			case 'CP01147':
			case 'EBCDIC-FR-297+EURO':
				return 'IBM01147';

			case 'IBM01148':
			case 'CCSID01148':
			case 'CP01148':
			case 'EBCDIC-INTERNATIONAL-500+EURO':
				return 'IBM01148';

			case 'IBM01149':
			case 'CCSID01149':
			case 'CP01149':
			case 'EBCDIC-IS-871+EURO':
				return 'IBM01149';

			case 'BIG5-HKSCS':
				return 'Big5-HKSCS';

			case 'IBM1047':
			case 'IBM-1047':
				return 'IBM1047';

			case 'PTCP154':
			case 'CSPTCP154':
			case 'PT154':
			case 'CP154':
			case 'CYRILLIC-ASIAN':
				return 'PTCP154';

			case 'AMIGA-1251':
			case 'AMI1251':
			case 'AMIGA1251':
			case 'AMI-1251':
				return 'Amiga-1251';

			case 'KOI7-SWITCHED':
				return 'KOI7-switched';

			case 'UNICODE-1-1':
			case 'CSUNICODE11':
				return 'UNICODE-1-1';

			case 'SCSU':
				return 'SCSU';

			case 'UTF-7':
				return 'UTF-7';

			case 'UTF-16BE':
				return 'UTF-16BE';

			case 'UTF-16LE':
				return 'UTF-16LE';

			case 'UTF-16':
				return 'UTF-16';

			case 'CESU-8':
			case 'CSCESU-8':
				return 'CESU-8';

			case 'UTF-32':
				return 'UTF-32';

			case 'UTF-32BE':
				return 'UTF-32BE';

			case 'UTF-32LE':
				return 'UTF-32LE';

			case 'BOCU-1':
			case 'CSBOCU-1':
				return 'BOCU-1';

			case 'UNICODE-1-1-UTF-7':
			case 'CSUNICODE11UTF7':
				return 'UNICODE-1-1-UTF-7';

			case 'UTF-8':
				return 'UTF-8';

			case 'ISO-8859-13':
				return 'ISO-8859-13';

			case 'ISO-8859-14':
			case 'ISO-IR-199':
			case 'ISO_8859-14:1998':
			case 'ISO_8859-14':
			case 'LATIN8':
			case 'ISO-CELTIC':
			case 'L8':
				return 'ISO-8859-14';

			case 'ISO-8859-15':
			case 'ISO_8859-15':
			case 'LATIN-9':
				return 'ISO-8859-15';

			case 'ISO-8859-16':
			case 'ISO-IR-226':
			case 'ISO_8859-16:2001':
			case 'ISO_8859-16':
			case 'LATIN10':
			case 'L10':
				return 'ISO-8859-16';

			case 'GBK':
			case 'CP936':
			case 'MS936':
			case 'WINDOWS-936':
				return 'GBK';

			case 'GB18030':
				return 'GB18030';

			case 'OSD_EBCDIC_DF04_15':
				return 'OSD_EBCDIC_DF04_15';

			case 'OSD_EBCDIC_DF03_IRV':
				return 'OSD_EBCDIC_DF03_IRV';

			case 'OSD_EBCDIC_DF04_1':
				return 'OSD_EBCDIC_DF04_1';

			case 'JIS_ENCODING':
			case 'CSJISENCODING':
				return 'JIS_Encoding';

			case 'SHIFT_JIS':
			case 'MS_KANJI':
			case 'CSSHIFTJIS':
				return 'Shift_JIS';

			case 'EXTENDED_UNIX_CODE_PACKED_FORMAT_FOR_JAPANESE':
			case 'CSEUCPKDFMTJAPANESE':
			case 'EUC-JP':
				return 'EUC-JP';

			case 'EXTENDED_UNIX_CODE_FIXED_WIDTH_FOR_JAPANESE':
			case 'CSEUCFIXWIDJAPANESE':
				return 'Extended_UNIX_Code_Fixed_Width_for_Japanese';

			case 'ISO-10646-UCS-BASIC':
			case 'CSUNICODEASCII':
				return 'ISO-10646-UCS-Basic';

			case 'ISO-10646-UNICODE-LATIN1':
			case 'CSUNICODELATIN1':
			case 'ISO-10646':
				return 'ISO-10646-Unicode-Latin1';

			case 'ISO-10646-J-1':
				return 'ISO-10646-J-1';

			case 'ISO-UNICODE-IBM-1261':
			case 'CSUNICODEIBM1261':
				return 'ISO-Unicode-IBM-1261';

			case 'ISO-UNICODE-IBM-1268':
			case 'CSUNICODEIBM1268':
				return 'ISO-Unicode-IBM-1268';

			case 'ISO-UNICODE-IBM-1276':
			case 'CSUNICODEIBM1276':
				return 'ISO-Unicode-IBM-1276';

			case 'ISO-UNICODE-IBM-1264':
			case 'CSUNICODEIBM1264':
				return 'ISO-Unicode-IBM-1264';

			case 'ISO-UNICODE-IBM-1265':
			case 'CSUNICODEIBM1265':
				return 'ISO-Unicode-IBM-1265';

			case 'ISO-8859-1-WINDOWS-3.0-LATIN-1':
			case 'CSWINDOWS30LATIN1':
				return 'ISO-8859-1-Windows-3.0-Latin-1';

			case 'ISO-8859-1-WINDOWS-3.1-LATIN-1':
			case 'CSWINDOWS31LATIN1':
				return 'ISO-8859-1-Windows-3.1-Latin-1';

			case 'ISO-8859-2-WINDOWS-LATIN-2':
			case 'CSWINDOWS31LATIN2':
				return 'ISO-8859-2-Windows-Latin-2';

			case 'ISO-8859-9-WINDOWS-LATIN-5':
			case 'CSWINDOWS31LATIN5':
				return 'ISO-8859-9-Windows-Latin-5';

			case 'ADOBE-STANDARD-ENCODING':
			case 'CSADOBESTANDARDENCODING':
				return 'Adobe-Standard-Encoding';

			case 'VENTURA-US':
			case 'CSVENTURAUS':
				return 'Ventura-US';

			case 'VENTURA-INTERNATIONAL':
			case 'CSVENTURAINTERNATIONAL':
				return 'Ventura-International';

			case 'PC8-DANISH-NORWEGIAN':
			case 'CSPC8DANISHNORWEGIAN':
				return 'PC8-Danish-Norwegian';

			case 'PC8-TURKISH':
			case 'CSPC8TURKISH':
				return 'PC8-Turkish';

			case 'IBM-SYMBOLS':
			case 'CSIBMSYMBOLS':
				return 'IBM-Symbols';

			case 'IBM-THAI':
			case 'CSIBMTHAI':
				return 'IBM-Thai';

			case 'HP-LEGAL':
			case 'CSHPLEGAL':
				return 'HP-Legal';

			case 'HP-PI-FONT':
			case 'CSHPPIFONT':
				return 'HP-Pi-font';

			case 'HP-MATH8':
			case 'CSHPMATH8':
				return 'HP-Math8';

			case 'ADOBE-SYMBOL-ENCODING':
			case 'CSHPPSMATH':
				return 'Adobe-Symbol-Encoding';

			case 'HP-DESKTOP':
			case 'CSHPDESKTOP':
				return 'HP-DeskTop';

			case 'VENTURA-MATH':
			case 'CSVENTURAMATH':
				return 'Ventura-Math';

			case 'MICROSOFT-PUBLISHING':
			case 'CSMICROSOFTPUBLISHING':
				return 'Microsoft-Publishing';

			case 'WINDOWS-31J':
			case 'CSWINDOWS31J':
				return 'Windows-31J';

			case 'GB2312':
			case 'CSGB2312':
				return 'GB2312';

			case 'BIG5':
			case 'CSBIG5':
				return 'Big5';

			case 'WINDOWS-1250':
				return 'windows-1250';

			case 'WINDOWS-1251':
				return 'windows-1251';

			case 'WINDOWS-1252':
				return 'windows-1252';

			case 'WINDOWS-1253':
				return 'windows-1253';

			case 'WINDOWS-1254':
				return 'windows-1254';

			case 'WINDOWS-1255':
				return 'windows-1255';

			case 'WINDOWS-1256':
				return 'windows-1256';

			case 'WINDOWS-1257':
				return 'windows-1257';

			case 'WINDOWS-1258':
				return 'windows-1258';

			case 'TIS-620':
				return 'TIS-620';

			case 'HZ-GB-2312':
				return 'HZ-GB-2312';

			case 'ISO-11548-1':
			case 'ISO_11548-1':
			case 'ISO_TR_11548-1':
			case 'CSISO115481':
				return 'ISO-11548-1';

			case 'KZ-1048':
			case 'STRK1048-2002':
			case 'RK1048':
			case 'CSKZ1048':
				return 'KZ-1048';

			default:
				return (string) $encoding;
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
	 * @return string Comment stripped string
	 */
	function strip_comments($data)
	{
		$output = '';
		while (($start = strpos($data, '<!--')) !== false)
		{
			$output .= substr($data, 0, $start);
			if (($end = strpos($data, '-->', $start)) !== false)
			{
				$data = substr_replace($data, '', 0, $end + 3);
			}
			else
			{
				$data = '';
			}
		}
		return $output . $data;
	}

	function parse_date($dt, $rfc822_tz = true)
	{
		static $cache = array();
		if (!isset($cache[$dt][$rfc822_tz]))
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
	
						// Week Date
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
							$timezone = (int) round($timezone);
	
							if ($match[23] == '-')
							{
								$timezone = -$timezone;
							}
						}
					}
				}
				if ($timezone === false)
				{
					$cache[$dt][$rfc822_tz] = mktime($hour, $minute, $second, $month, $day, $year);
				}
				else
				{
					$cache[$dt][$rfc822_tz] = gmmktime($hour, $minute, $second, $month, $day, $year) - $timezone;
				}
			}
			else if (($time = strtotime($dt)) > 0)
			{
				$cache[$dt][$rfc822_tz] = $time;
			}
			else
			{
				$cache[$dt][$rfc822_tz] = false;
			}
		}
		return $cache[$dt][$rfc822_tz];
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

	function atom_03_construct_type($attribs)
	{
		if (isset($attribs['']['MODE']) && strtolower(trim($attribs['']['MODE']) == 'base64'))
		{
			$mode = SIMPLEPIE_CONSTRUCT_BASE64;
		}
		else
		{
			$mode = SIMPLEPIE_CONSTRUCT_NONE;
		}
		if (isset($attribs['']['TYPE']))
		{
			switch (strtolower(trim($attribs['']['TYPE'])))
			{
				case 'text':
				case 'text/plain':
					return SIMPLEPIE_CONSTRUCT_TEXT | $mode;

				case 'html':
				case 'text/html':
					return SIMPLEPIE_CONSTRUCT_HTML | $mode;

				case 'xhtml':
				case 'application/xhtml+xml':
					return SIMPLEPIE_CONSTRUCT_XHTML | $mode;

				default:
					return SIMPLEPIE_CONSTRUCT_NONE | $mode;
			}
		}
		else
		{
			return SIMPLEPIE_CONSTRUCT_TEXT | $mode;
		}
	}

	function atom_10_construct_type($attribs)
	{
		if (isset($attribs['']['TYPE']))
		{
			switch (strtolower(trim($attribs['']['TYPE'])))
			{
				case 'text':
					return SIMPLEPIE_CONSTRUCT_TEXT;

				case 'html':
					return SIMPLEPIE_CONSTRUCT_HTML;

				case 'xhtml':
					return SIMPLEPIE_CONSTRUCT_XHTML;

				default:
					return SIMPLEPIE_CONSTRUCT_NONE;
			}
		}
		return SIMPLEPIE_CONSTRUCT_TEXT;
	}

	function atom_10_content_construct_type($attribs)
	{
		if (isset($attribs['']['TYPE']))
		{
			$type = strtolower(trim($attribs['']['TYPE']));
			switch ($type)
			{
				case 'text':
					return SIMPLEPIE_CONSTRUCT_TEXT;

				case 'html':
					return SIMPLEPIE_CONSTRUCT_HTML;

				case 'xhtml':
					return SIMPLEPIE_CONSTRUCT_XHTML;
			}
			if (in_array(substr($type, -4), array('+xml', '/xml')) || substr($type, 0, 5) == 'text/')
			{
				return SIMPLEPIE_CONSTRUCT_NONE;
			}
			else
			{
				return SIMPLEPIE_CONSTRUCT_BASE64;
			}
		}
		else
		{
			return SIMPLEPIE_CONSTRUCT_TEXT;
		}
	}

	function is_isegment_nz_nc($string)
	{
		return (bool) preg_match('/^([A-Za-z0-9\-._~\x{A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}\x{10000}-\x{1FFFD}\x{20000}-\x{2FFFD}\x{30000}-\x{3FFFD}\x{40000}-\x{4FFFD}\x{50000}-\x{5FFFD}\x{60000}-\x{6FFFD}\x{70000}-\x{7FFFD}\x{80000}-\x{8FFFD}\x{90000}-\x{9FFFD}\x{A0000}-\x{AFFFD}\x{B0000}-\x{BFFFD}\x{C0000}-\x{CFFFD}\x{D0000}-\x{DFFFD}\x{E1000}-\x{EFFFD}!$&\'()*+,;=@]|(%[0-9ABCDEF]{2}))+$/u', $string);
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
		$links = array_merge(SimplePie_Misc::get_element('link', $this->file->body()), SimplePie_Misc::get_element('a', $this->file->body()), SimplePie_Misc::get_element('area', $this->file->body()));
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

/**
 * @todo External entities aren't supported, for some reason xml_set_external_entity_ref_handler()'s callback function isn't called
 */
class SimplePie_Parser
{
	var $xml;
	var $error_code;
	var $error_string;
	var $current_line;
	var $current_column;
	var $current_byte;
	var $feed = false;
	var $namespace = array('');
	var $element = array('');
	var $xml_base = array('');
	var $xml_base_explicit = array(false);
	var $xml_lang = array('');
	var $data = array();
	var $datas = array(array());
	var $current_xhtml_construct = -1;
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

	function tag_open($parser, $tag, $attributes)
	{
		if ($this->feed === 0)
		{
			return;
		}
		else if ($this->feed == false)
		{
			switch ($tag)
			{
				case 'HTTP://WWW.W3.ORG/2005/ATOM:FEED':
				case 'HTTP://PURL.ORG/ATOM/NS#:FEED':
				case 'FEED':
				case 'RSS':
				case 'HTTP://WWW.W3.ORG/1999/02/22-RDF-SYNTAX-NS#:RDF':
					$this->feed = 1;
					break;
			}
		}
		else
		{
			$this->feed++;
		}

		list($this->namespace[], $this->element[]) = $this->split_ns($tag);

		$attribs = array();
		foreach ($attributes as $name => $value)
		{
			list($attrib_namespace, $attribute) = $this->split_ns($name);
			$attribs[$attrib_namespace][$attribute] = $value;
		}

		if (isset($attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['BASE']))
		{
			$this->xml_base[] = SimplePie_Misc::absolutize_url($attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['BASE'], end($this->xml_base));
			$this->xml_base_explicit[] = true;
		}
		else
		{
			$this->xml_base[] = end($this->xml_base);
			$this->xml_base_explicit[] = end($this->xml_base_explicit);
		}

		if (isset($attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['LANG']))
		{
			$this->xml_lang[] = $attribs['HTTP://WWW.W3.ORG/XML/1998/NAMESPACE']['LANG'];
		}
		else
		{
			$this->xml_lang[] = end($this->xml_lang);
		}

		if ($this->current_xhtml_construct >= 0)
		{
			$this->current_xhtml_construct++;
			if (end($this->namespace) == 'HTTP://WWW.W3.ORG/1999/XHTML')
			{
				$this->data['data'] .= '<' . strtolower(end($this->element));
				if (isset($attribs['']))
				{
					foreach ($attribs[''] as $name => $value)
					{
						$this->data['data'] .= ' ' . strtolower($name) . '="' . htmlspecialchars($value, ENT_COMPAT, $this->encoding) . '"';
					}
				}
				$this->data['data'] .= '>';
			}
		}
		else
		{
			$this->datas[] =& $this->data;
			$this->data =& $this->data['child'][end($this->namespace)][end($this->element)][];
			$this->data = array('data' => '', 'attribs' => $attribs, 'xml_base' => end($this->xml_base), 'xml_base_explicit' => end($this->xml_base_explicit), 'xml_lang' => end($this->xml_lang));
			if ((end($this->namespace) == 'HTTP://PURL.ORG/ATOM/NS#' && in_array(end($this->element), array('TITLE', 'TAGLINE', 'COPYRIGHT', 'INFO', 'SUMMARY', 'CONTENT')) && isset($attribs['']['MODE']) && $attribs['']['MODE'] == 'xml')
			|| (end($this->namespace) == 'HTTP://WWW.W3.ORG/2005/ATOM' && in_array(end($this->element), array('RIGHTS', 'SUBTITLE', 'SUMMARY', 'INFO', 'TITLE', 'CONTENT')) && isset($attribs['']['TYPE']) && $attribs['']['TYPE'] == 'xhtml'))
			{
				$this->current_xhtml_construct = 0;
			}
		}
	}

	function cdata($parser, $cdata)
	{
		if ($this->current_xhtml_construct >= 0)
		{
			$this->data['data'] .= htmlspecialchars($cdata, ENT_QUOTES, $this->encoding);
		}
		else if ($this->feed > 1)
		{
			$this->data['data'] .= $cdata;
		}
	}

	function tag_close($parser, $tag)
	{
		if ($this->feed == 0)
		{
			return;
		}

		if ($this->current_xhtml_construct >= 0)
		{
			$this->current_xhtml_construct--;
			if (end($this->namespace) == 'HTTP://WWW.W3.ORG/1999/XHTML')
			{
				$this->data['data'] .= '</' . strtolower(end($this->element)) . '>';
			}
		}
		if ($this->current_xhtml_construct == -1)
		{
			$this->data =& $this->datas[count($this->datas)-1];
			array_pop($this->datas);
		}

		array_pop($this->element);
		array_pop($this->namespace);
		array_pop($this->xml_base);
		array_pop($this->xml_base_explicit);
		array_pop($this->xml_lang);
		$this->feed--;
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
}

/**
 * @todo Move to using an actual HTML parser (this will allow tags to be properly stripped, and to switch between HTML and XHTML), this will also make it easier to shortern a string while preserving HTML tags
 */
class SimplePie_Sanitize
{
	// Private vars
	var $base;

	// Options
	var $remove_div = true;
	var $replace_headers = false;
	var $image_handler = false;
	var $strip_htmltags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style');
	var $encode_instead_of_strip = false;
	var $strip_attributes = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc');
	var $output_encoding = 'UTF-8';
	var $cache_location = './cache';
	var $cache_name_function = 'sha1';
	var $cache_class = 'SimplePie_Cache';
	var $file_class = 'SimplePie_File';
	var $timeout = 10;
	var $useragent = '';
	var $force_fsockopen = false;

	function remove_div($enable = true)
	{
		$this->remove_div = (bool) $enable;
	}

	function replace_headers($enable = false)
	{
		$this->enable_headers = (bool) $enable;
	}

	function set_image_handler($page = false)
	{
		if ($page)
		{
			$this->image_handler = (string) $page;
		}
		else
		{
			$this->image_handler = false;
		}
	}

	function pass_cache_data($cache_location = './cache', $cache_name_function = 'sha1', $cache_class = 'SimplePie_Cache')
	{
		if ($cache_location)
		{
			$this->cache_location = (string) $cache_location;
		}

		if ($cache_name_function)
		{
			$this->cache_name_function = (string) $cache_name_function;
		}

		if ($cache_class)
		{
			$this->cache_class = (string) $cache_class;
		}
	}

	function pass_file_data($file_class = 'SimplePie_File', $timeout = 10, $useragent = '', $force_fsockopen = false)
	{
		if ($file_class)
		{
			$this->file_class = (string) $file_class;
		}

		if ($timeout)
		{
			$this->timeout = (string) $timeout;
		}

		if ($useragent)
		{
			$this->useragent = (string) $useragent;
		}

		if ($force_fsockopen)
		{
			$this->force_fsockopen = (string) $force_fsockopen;
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

	function strip_attributes($attribs = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc'))
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

	function sanitize($data, $type, $base = '')
	{
		$data = trim($data);
		if ($data !== '' || $type & SIMPLEPIE_CONSTRUCT_IRI)
		{
			if ($type & SIMPLEPIE_CONSTRUCT_BASE64)
			{
				$data = base64_decode($data);
			}

			if ($type & SIMPLEPIE_CONSTRUCT_XHTML)
			{
				if ($this->remove_div)
				{
					$data = preg_replace('/^<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '', $data);
					$data = preg_replace('/<\/div>$/', '', $data);
				}
				else
				{
					$data = preg_replace('/^<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '<div>', $data);
				}
			}

			if ($type & (SIMPLEPIE_CONSTRUCT_HTML | SIMPLEPIE_CONSTRUCT_XHTML))
			{
				// Strip comments
				$data = SimplePie_Misc::strip_comments($data);

				// Replace H1, H2, and H3 tags with the less important H4 tags.
				// This is because on a site, the more important headers might make sense,
				// but it most likely doesn't fit in the context of RSS-in-a-webpage.
				if ($this->replace_headers)
				{
					$data = preg_replace('/<h[1-3]' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>/i', '<h4\\1>', $data);
					$data = preg_replace('/<\/h[1-3]' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>/i', '</h4>', $data);
				}

				// Strip out HTML tags and attributes that might cause various security problems.
				// Based on recommendations by Mark Pilgrim at:
				// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
				if ($this->strip_htmltags)
				{
					foreach ($this->strip_htmltags as $tag)
					{
						$pcre = "/<($tag)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(>(.*)<\/$tag" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>|(\/)?>)/siU';
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

				// Replace relative URLs
				$this->base = $base;
				$this->replace_urls($data, 'blockquote', 'CITE');
				$this->replace_urls($data, 'ins', 'CITE');
				$this->replace_urls($data, 'del', 'CITE');
				$this->replace_urls($data, 'a', 'HREF');
				$this->replace_urls($data, 'q', 'CITE');
				$this->replace_urls($data, 'img', 'SRC');
				$this->replace_urls($data, 'img', 'LONGDESC');
				$this->replace_urls($data, 'area', 'HREF');
				$this->replace_urls($data, 'form', 'ACTION');
				$this->replace_urls($data, 'input', 'SRC');

				// If image handling (caching, etc.) is enabled, cache and rewrite all the image tags.
				if ($this->image_handler)
				{
					$images = SimplePie_Misc::get_element('img', $data);
					foreach ($images as $img)
					{
						if (!empty($img['attribs']['SRC']['data']))
						{
							$image_url = $img['attribs']['SRC']['data'];
							$cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $image_url), 'image');

							if ($cache->load())
							{
								$img['attribs']['SRC']['data'] = $this->image_handler . rawurlencode($img['attribs']['SRC']['data']);
								$data = str_replace($img['full'], SimplePie_Misc::element_implode($img), $data);
							}
							else
							{
								$file =& new $this->file_class($image_url, $this->timeout, 5, array('X-FORWARDED-FOR' => $_SERVER['REMOTE_ADDR']), $this->useragent, $this->force_fsockopen);
								$headers = $file->headers();

								if ($file->success && ($headers['status']['code'] == 200 || ($headers['status']['code'] > 206 && $headers['status']['code'] < 300)))
								{
									if (!$cache->save(array('headers' => $file->headers(), 'body' => $file->body())))
									{
										$this->error = "$cache->name is not writeable";
										SimplePie_Misc::error($this->error, E_USER_WARNING, __FILE__, __LINE__);
									}
									$img['attribs']['SRC']['data'] = $this->image_handler . rawurlencode($img['attribs']['SRC']['data']);
									$data = str_replace($img['full'], SimplePie_Misc::element_implode($img), $data);
								}
							}
						}
					}
				}

				// Having (possibly) taken stuff out, there may now be whitespace at the beginning/end of the data
				$data = trim($data);
			}

			if ($type & SIMPLEPIE_CONSTRUCT_IRI)
			{
				$data = SimplePie_Misc::absolutize_url($data, $base);
			}

			if ($type & (SIMPLEPIE_CONSTRUCT_TEXT | SIMPLEPIE_CONSTRUCT_IRI))
			{
				$data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
			}

			if ($this->output_encoding != 'UTF-8')
			{
				$data = SimplePie_Misc::change_encoding($data, 'UTF-8', $this->output_encoding);
			}
		}
		return $data;
	}

	function replace_urls(&$data, $tag, $attribute)
	{
		$elements = SimplePie_Misc::get_element($tag, $data);
		foreach ($elements as $element)
		{
			if (!empty($element['attribs'][$attribute]['data']))
			{
				$element['attribs'][$attribute]['data'] = SimplePie_Misc::absolutize_url($element['attribs'][$attribute]['data'], $this->base);
				$data = str_replace($element['full'], SimplePie_Misc::element_implode($element), $data);
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
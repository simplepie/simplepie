<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2012, Ryan Parman, Geoffrey Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @version 1.4-dev
 * @copyright 2004-2012 Ryan Parman, Geoffrey Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

/**
 * SimplePie Name
 */
define('SIMPLEPIE_NAME', 'SimplePie');

/**
 * SimplePie Version
 */
define('SIMPLEPIE_VERSION', '1.4-dev');

/**
 * SimplePie Build
 * @todo Hardcode for release (there's no need to have to call SimplePie_Misc::get_build() only every load of simplepie.inc)
 */
define('SIMPLEPIE_BUILD', gmdate('YmdHis', SimplePie_Misc::get_build()));

/**
 * SimplePie Website URL
 */
define('SIMPLEPIE_URL', 'http://simplepie.org');

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
 * A construct that might be HTML
 */
define('SIMPLEPIE_CONSTRUCT_MAYBE_HTML', 32);

/**
 * All constructs
 */
define('SIMPLEPIE_CONSTRUCT_ALL', 63);

/**
 * Don't change case
 */
define('SIMPLEPIE_SAME_CASE', 1);

/**
 * Change to lowercase
 */
define('SIMPLEPIE_LOWERCASE', 2);

/**
 * Change to uppercase
 */
define('SIMPLEPIE_UPPERCASE', 4);

/**
 * PCRE for HTML attributes
 */
define('SIMPLEPIE_PCRE_HTML_ATTRIBUTE', '((?:[\x09\x0A\x0B\x0C\x0D\x20]+[^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3D\x3E]*(?:[\x09\x0A\x0B\x0C\x0D\x20]*=[\x09\x0A\x0B\x0C\x0D\x20]*(?:"(?:[^"]*)"|\'(?:[^\']*)\'|(?:[^\x09\x0A\x0B\x0C\x0D\x20\x22\x27\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x3E]*)?))?)*)[\x09\x0A\x0B\x0C\x0D\x20]*');

/**
 * PCRE for XML attributes
 */
define('SIMPLEPIE_PCRE_XML_ATTRIBUTE', '((?:\s+(?:(?:[^\s:]+:)?[^\s:]+)\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'))*)\s*');

/**
 * XML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XML', 'http://www.w3.org/XML/1998/namespace');

/**
 * Atom 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_10', 'http://www.w3.org/2005/Atom');

/**
 * Atom 0.3 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_03', 'http://purl.org/atom/ns#');

/**
 * RDF Namespace
 */
define('SIMPLEPIE_NAMESPACE_RDF', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');

/**
 * RSS 0.90 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_090', 'http://my.netscape.com/rdf/simple/0.9/');

/**
 * RSS 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10', 'http://purl.org/rss/1.0/');

/**
 * RSS 1.0 Content Module Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10_MODULES_CONTENT', 'http://purl.org/rss/1.0/modules/content/');

/**
 * RSS 2.0 Namespace
 * (Stupid, I know, but I'm certain it will confuse people less with support.)
 */
define('SIMPLEPIE_NAMESPACE_RSS_20', '');

/**
 * DC 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_10', 'http://purl.org/dc/elements/1.0/');

/**
 * DC 1.1 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_11', 'http://purl.org/dc/elements/1.1/');

/**
 * W3C Basic Geo (WGS84 lat/long) Vocabulary Namespace
 */
define('SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO', 'http://www.w3.org/2003/01/geo/wgs84_pos#');

/**
 * GeoRSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_GEORSS', 'http://www.georss.org/georss');

/**
 * Media RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS', 'http://search.yahoo.com/mrss/');

/**
 * Wrong Media RSS Namespace. Caused by a long-standing typo in the spec.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG', 'http://search.yahoo.com/mrss');

/**
 * Wrong Media RSS Namespace #2. New namespace introduced in Media RSS 1.5.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG2', 'http://video.search.yahoo.com/mrss');

/**
 * Wrong Media RSS Namespace #3. A possible typo of the Media RSS 1.5 namespace.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG3', 'http://video.search.yahoo.com/mrss/');

/**
 * Wrong Media RSS Namespace #4. New spec location after the RSS Advisory Board takes it over, but not a valid namespace.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG4', 'http://www.rssboard.org/media-rss');

/**
 * Wrong Media RSS Namespace #5. A possible typo of the RSS Advisory Board URL.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG5', 'http://www.rssboard.org/media-rss/');

/**
 * iTunes RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_ITUNES', 'http://www.itunes.com/dtds/podcast-1.0.dtd');

/**
 * XHTML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XHTML', 'http://www.w3.org/1999/xhtml');

/**
 * IANA Link Relations Registry
 */
define('SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY', 'http://www.iana.org/assignments/relation/');

/**
 * No file source
 */
define('SIMPLEPIE_FILE_SOURCE_NONE', 0);

/**
 * Remote file source
 */
define('SIMPLEPIE_FILE_SOURCE_REMOTE', 1);

/**
 * Local file source
 */
define('SIMPLEPIE_FILE_SOURCE_LOCAL', 2);

/**
 * fsockopen() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FSOCKOPEN', 4);

/**
 * cURL file source
 */
define('SIMPLEPIE_FILE_SOURCE_CURL', 8);

/**
 * file_get_contents() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FILE_GET_CONTENTS', 16);



/**
 * SimplePie
 *
 * @package SimplePie
 * @subpackage API
 */
class SimplePie
{
	/**
	 * @var array Raw data
	 * @access private
	 */
	public $data = array();

	/**
	 * @var mixed Error string
	 * @access private
	 */
	public $error;

	/**
	 * @var object Instance of SimplePie_Sanitize (or other class)
	 * @see SimplePie::set_sanitize_class()
	 * @access private
	 */
	public $sanitize;

	/**
	 * @var string SimplePie Useragent
	 * @see SimplePie::set_useragent()
	 * @access private
	 */
	public $useragent = SIMPLEPIE_USERAGENT;

	/**
	 * @var int Timeout for fetching remote files
	 * @see SimplePie::set_timeout()
	 * @access private
	 */
	public $timeout = 10;

	/**
	 * @var bool Forces fsockopen() to be used for remote files instead
	 * of cURL, even if a new enough version is installed
	 * @see SimplePie::force_fsockopen()
	 * @access private
	 */
	public $force_fsockopen = false;

	/**
	 * @var bool Enable/Disable Caching
	 * @see SimplePie::enable_cache()
	 * @access private
	 */
	public $cache = true;

	/**
	 * @var int Cache duration (in seconds)
	 * @see SimplePie::set_cache_duration()
	 * @access private
	 */
	public $cache_duration = 3600;

	/**
	 * @var int Auto-discovery cache duration (in seconds)
	 * @see SimplePie::set_autodiscovery_cache_duration()
	 * @access private
	 */
	public $autodiscovery_cache_duration = 604800; // 7 Days.

	/**
	 * @var string Cache location (relative to executing script)
	 * @see SimplePie::set_cache_location()
	 * @access private
	 */
	public $cache_location = './cache';

	/**
	 * @var string Function that creates the cache filename
	 * @see SimplePie::set_cache_name_function()
	 * @access private
	 */
	public $cache_name_function = 'md5';

	/**
	 * @var bool Reorder feed by date descending
	 * @see SimplePie::enable_order_by_date()
	 * @access private
	 */
	public $order_by_date = true;

	/**
	 * @var mixed Force input encoding to be set to the follow value
	 * (false, or anything type-cast to false, disables this feature)
	 * @see SimplePie::set_input_encoding()
	 * @access private
	 */
	public $input_encoding = false;

	/**
	 * @var int Feed Autodiscovery Level
	 * @see SimplePie::set_autodiscovery_level()
	 * @access private
	 */
	public $autodiscovery = SIMPLEPIE_LOCATOR_ALL;

	/**
	 * Class registry object
	 *
	 * @var SimplePie_Registry
	 */
	public $registry;

	/**
	 * @var int Maximum number of feeds to check with autodiscovery
	 * @see SimplePie::set_max_checked_feeds()
	 * @access private
	 */
	public $max_checked_feeds = 10;

	/**
	 * @var array All the feeds found during the autodiscovery process
	 * @see SimplePie::get_all_discovered_feeds()
	 * @access private
	 */
	public $all_discovered_feeds = array();

	/**
	 * @var string Web-accessible path to the handler_image.php file.
	 * @see SimplePie::set_image_handler()
	 * @access private
	 */
	public $image_handler = '';

	/**
	 * @var array Stores the URLs when multiple feeds are being initialized.
	 * @see SimplePie::set_feed_url()
	 * @access private
	 */
	public $multifeed_url = array();

	/**
	 * @var array Stores SimplePie objects when multiple feeds initialized.
	 * @access private
	 */
	public $multifeed_objects = array();

	/**
	 * @var array Stores the get_object_vars() array for use with multifeeds.
	 * @see SimplePie::set_feed_url()
	 * @access private
	 */
	public $config_settings = null;

	/**
	 * @var integer Stores the number of items to return per-feed with multifeeds.
	 * @see SimplePie::set_item_limit()
	 * @access private
	 */
	public $item_limit = 0;

	/**
	 * @var array Stores the default attributes to be stripped by strip_attributes().
	 * @see SimplePie::strip_attributes()
	 * @access private
	 */
	public $strip_attributes = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc');

	/**
	 * @var array Stores the default tags to be stripped by strip_htmltags().
	 * @see SimplePie::strip_htmltags()
	 * @access private
	 */
	public $strip_htmltags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style');

	/**
	 * The SimplePie class contains feed level data and options
	 *
	 * To use SimplePie, create the SimplePie object with no parameters. You can
	 * then set configuration options using the provided methods. After setting
	 * them, you must initialise the feed using $feed->init(). At that point the
	 * object's methods and properties will be available to you.
	 *
	 * Previously, it was possible to pass in the feed URL along with cache
	 * options directly into the constructor. This has been removed as of 1.3 as
	 * it caused a lot of confusion.
	 *
	 * @since 1.0 Preview Release
	 */
	public function __construct()
	{
		if (version_compare(PHP_VERSION, '5.2', '<'))
		{
			trigger_error('PHP 4.x, 5.0 and 5.1 are no longer supported. Please upgrade to PHP 5.2 or newer.');
			die();
		}

		// Other objects, instances created here so we can set options on them
		$this->sanitize = new SimplePie_Sanitize();
		$this->registry = new SimplePie_Registry();

		if (func_num_args() > 0)
		{
			$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
			trigger_error('Passing parameters to the constructor is no longer supported. Please use set_feed_url(), set_cache_location(), and set_cache_location() directly.', $level);

			$args = func_get_args();
			switch (count($args)) {
				case 3:
					$this->set_cache_duration($args[2]);
				case 2:
					$this->set_cache_location($args[1]);
				case 1:
					$this->set_feed_url($args[0]);
					$this->init();
			}
		}
	}

	/**
	 * Used for converting object to a string
	 */
	public function __toString()
	{
		return md5(serialize($this->data));
	}

	/**
	 * Remove items that link back to this before destroying this object
	 */
	public function __destruct()
	{
		if ((version_compare(PHP_VERSION, '5.3', '<') || !gc_enabled()) && !ini_get('zend.ze1_compatibility_mode'))
		{
			if (!empty($this->data['items']))
			{
				foreach ($this->data['items'] as $item)
				{
					$item->__destruct();
				}
				unset($item, $this->data['items']);
			}
			if (!empty($this->data['ordered_items']))
			{
				foreach ($this->data['ordered_items'] as $item)
				{
					$item->__destruct();
				}
				unset($item, $this->data['ordered_items']);
			}
		}
	}

	/**
	 * Set the URL of the feed you want to parse
	 *
	 * This allows you to enter the URL of the feed you want to parse, or the
	 * website you want to try to use auto-discovery on. This takes priority
	 * over any set raw data.
	 *
	 * You can set multiple feeds to mash together by passing an array instead
	 * of a string for the $url. Remember that with each additional feed comes
	 * additional processing and resources.
	 *
	 * @since 1.0 Preview Release
	 * @see set_raw_data()
	 * @param string|array $url This is the URL (or array of URLs) that you want to parse.
	 */
	public function set_feed_url($url)
	{
		$url = (array) $url;
		$this->multifeed_url = array();
		foreach ($url as $value)
		{
			$this->multifeed_url[] = $this->registry->call('Misc', 'fix_protocol', array($value, 1));
		}
	}

	/**
	 * Set the the default timeout for fetching remote feeds
	 *
	 * This allows you to change the maximum time the feed's server to respond
	 * and send the feed back.
	 *
	 * @since 1.0 Beta 3
	 * @param int $timeout The maximum number of seconds to spend waiting to retrieve a feed.
	 */
	public function set_timeout($timeout = 10)
	{
		$this->timeout = (int) $timeout;
	}

	/**
	 * Force SimplePie to use fsockopen() instead of cURL
	 *
	 * @since 1.0 Beta 3
	 * @param bool $enable Force fsockopen() to be used
	 */
	public function force_fsockopen($enable = false)
	{
		$this->force_fsockopen = (bool) $enable;
	}

	/**
	 * Enable/disable caching in SimplePie.
	 *
	 * This option allows you to disable caching all-together in SimplePie.
	 * However, disabling the cache can lead to longer load times.
	 *
	 * @since 1.0 Preview Release
	 * @param bool $enable Enable caching
	 */
	public function enable_cache($enable = true)
	{
		$this->cache = (bool) $enable;
	}

	/**
	 * Set the length of time (in seconds) that the contents of a feed will be
	 * cached
	 *
	 * @param int $seconds The feed content cache duration
	 */
	public function set_cache_duration($seconds = 3600)
	{
		$this->cache_duration = (int) $seconds;
	}

	/**
	 * Set the length of time (in seconds) that the autodiscovered feed URL will
	 * be cached
	 *
	 * @param int $seconds The autodiscovered feed URL cache duration.
	 */
	public function set_autodiscovery_cache_duration($seconds = 604800)
	{
		$this->autodiscovery_cache_duration = (int) $seconds;
	}

	/**
	 * Set the file system location where the cached files should be stored
	 *
	 * @param string $location The file system location.
	 */
	public function set_cache_location($location = './cache')
	{
		$this->cache_location = (string) $location;
	}

	/**
	 * Set whether feed items should be sorted into reverse chronological order
	 *
	 * @param bool $enable Sort as reverse chronological order.
	 */
	public function enable_order_by_date($enable = true)
	{
		$this->order_by_date = (bool) $enable;
	}

	/**
	 * Set the character encoding used to parse the feed
	 *
	 * This overrides the encoding reported by the feed, however it will fall
	 * back to the normal encoding detection if the override fails
	 *
	 * @param string $encoding Character encoding
	 */
	public function set_input_encoding($encoding = false)
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
	 * @see SIMPLEPIE_LOCATOR_NONE
	 * @see SIMPLEPIE_LOCATOR_AUTODISCOVERY
	 * @see SIMPLEPIE_LOCATOR_LOCAL_EXTENSION
	 * @see SIMPLEPIE_LOCATOR_LOCAL_BODY
	 * @see SIMPLEPIE_LOCATOR_REMOTE_EXTENSION
	 * @see SIMPLEPIE_LOCATOR_REMOTE_BODY
	 * @see SIMPLEPIE_LOCATOR_ALL
	 * @param int $level Feed Autodiscovery Level (level can be a combination of the above constants, see bitwise OR operator)
	 */
	public function set_autodiscovery_level($level = SIMPLEPIE_LOCATOR_ALL)
	{
		$this->autodiscovery = (int) $level;
	}

	/**
	 * Get the class registry
	 *
	 * Use this to override SimplePie's default classes
	 * @see SimplePie_Registry
	 * @return SimplePie_Registry
	 */
	public function &get_registry()
	{
		return $this->registry;
	}

	/**#@+
	 * Useful when you are overloading or extending SimplePie's default classes.
	 *
	 * @deprecated Use {@see get_registry()} instead
	 * @link http://php.net/manual/en/language.oop5.basic.php#language.oop5.basic.extends PHP5 extends documentation
	 * @param string $class Name of custom class
	 * @return boolean True on success, false otherwise
	 */
	/**
	 * Set which class SimplePie uses for caching
	 */
	public function set_cache_class($class = 'SimplePie_Cache')
	{
		return $this->registry->register('Cache', $class, true);
	}

	/**
	 * Set which class SimplePie uses for auto-discovery
	 */
	public function set_locator_class($class = 'SimplePie_Locator')
	{
		return $this->registry->register('Locator', $class, true);
	}

	/**
	 * Set which class SimplePie uses for XML parsing
	 */
	public function set_parser_class($class = 'SimplePie_Parser')
	{
		return $this->registry->register('Parser', $class, true);
	}

	/**
	 * Set which class SimplePie uses for remote file fetching
	 */
	public function set_file_class($class = 'SimplePie_File')
	{
		return $this->registry->register('File', $class, true);
	}

	/**
	 * Set which class SimplePie uses for data sanitization
	 */
	public function set_sanitize_class($class = 'SimplePie_Sanitize')
	{
		return $this->registry->register('Sanitize', $class, true);
	}

	/**
	 * Set which class SimplePie uses for handling feed items
	 */
	public function set_item_class($class = 'SimplePie_Item')
	{
		return $this->registry->register('Item', $class, true);
	}

	/**
	 * Set which class SimplePie uses for handling author data
	 */
	public function set_author_class($class = 'SimplePie_Author')
	{
		return $this->registry->register('Author', $class, true);
	}

	/**
	 * Set which class SimplePie uses for handling category data
	 */
	public function set_category_class($class = 'SimplePie_Category')
	{
		return $this->registry->register('Category', $class, true);
	}

	/**
	 * Set which class SimplePie uses for feed enclosures
	 */
	public function set_enclosure_class($class = 'SimplePie_Enclosure')
	{
		return $this->registry->register('Enclosure', $class, true);
	}

	/**
	 * Set which class SimplePie uses for `<media:text>` captions
	 */
	public function set_caption_class($class = 'SimplePie_Caption')
	{
		return $this->registry->register('Caption', $class, true);
	}

	/**
	 * Set which class SimplePie uses for `<media:copyright>`
	 */
	public function set_copyright_class($class = 'SimplePie_Copyright')
	{
		return $this->registry->register('Copyright', $class, true);
	}

	/**
	 * Set which class SimplePie uses for `<media:credit>`
	 */
	public function set_credit_class($class = 'SimplePie_Credit')
	{
		return $this->registry->register('Credit', $class, true);
	}

	/**
	 * Set which class SimplePie uses for `<media:rating>`
	 */
	public function set_rating_class($class = 'SimplePie_Rating')
	{
		return $this->registry->register('Rating', $class, true);
	}

	/**
	 * Set which class SimplePie uses for `<media:restriction>`
	 */
	public function set_restriction_class($class = 'SimplePie_Restriction')
	{
		return $this->registry->register('Restriction', $class, true);
	}

	/**
	 * Set which class SimplePie uses for content-type sniffing
	 */
	public function set_content_type_sniffer_class($class = 'SimplePie_Content_Type_Sniffer')
	{
		return $this->registry->register('Content_Type_Sniffer', $class, true);
	}

	/**
	 * Set which class SimplePie uses item sources
	 */
	public function set_source_class($class = 'SimplePie_Source')
	{
		return $this->registry->register('Source', $class, true);
	}
	/**#@-*/

	/**
	 * Set the user agent string
	 *
	 * @param string $ua New user agent string.
	 */
	public function set_useragent($ua = SIMPLEPIE_USERAGENT)
	{
		$this->useragent = (string) $ua;
	}

	/**
	 * Set callback function to create cache filename with
	 *
	 * @param mixed $function Callback function
	 */
	public function set_cache_name_function($function = 'md5')
	{
		if (is_callable($function))
		{
			$this->cache_name_function = $function;
		}
	}

	/**
	 * Set options to make SP as fast as possible
	 *
	 * Forgoes a substantial amount of data sanitization in favor of speed. This
	 * turns SimplePie into a dumb parser of feeds.
	 *
	 * @param bool $set Whether to set them or not
	 */
	public function set_stupidly_fast($set = false)
	{
		if ($set)
		{
			$this->enable_order_by_date(false);
			$this->remove_div(false);
			$this->strip_comments(false);
			$this->strip_htmltags(false);
			$this->strip_attributes(false);
			$this->set_image_handler(false);
		}
	}

	/**
	 * Set maximum number of feeds to check with autodiscovery
	 *
	 * @param int $max Maximum number of feeds to check
	 */
	public function set_max_checked_feeds($max = 10)
	{
		$this->max_checked_feeds = (int) $max;
	}

	public function remove_div($enable = true)
	{
		$this->sanitize->remove_div($enable);
	}

	public function strip_htmltags($tags = '', $encode = null)
	{
		if ($tags === '')
		{
			$tags = $this->strip_htmltags;
		}
		$this->sanitize->strip_htmltags($tags);
		if ($encode !== null)
		{
			$this->sanitize->encode_instead_of_strip($tags);
		}
	}

	public function encode_instead_of_strip($enable = true)
	{
		$this->sanitize->encode_instead_of_strip($enable);
	}

	public function strip_attributes($attribs = '')
	{
		if ($attribs === '')
		{
			$attribs = $this->strip_attributes;
		}
		$this->sanitize->strip_attributes($attribs);
	}

	/**
	 * Set the output encoding
	 *
	 * Allows you to override SimplePie's output to match that of your webpage.
	 * This is useful for times when your webpages are not being served as
	 * UTF-8.  This setting will be obeyed by {@see handle_content_type()}, and
	 * is similar to {@see set_input_encoding()}.
	 *
	 * It should be noted, however, that not all character encodings can support
	 * all characters.  If your page is being served as ISO-8859-1 and you try
	 * to display a Japanese feed, you'll likely see garbled characters.
	 * Because of this, it is highly recommended to ensure that your webpages
	 * are served as UTF-8.
	 *
	 * The number of supported character encodings depends on whether your web
	 * host supports {@link http://php.net/mbstring mbstring},
	 * {@link http://php.net/iconv iconv}, or both. See
	 * {@link http://simplepie.org/wiki/faq/Supported_Character_Encodings} for
	 * more information.
	 *
	 * @param string $encoding
	 */
	public function set_output_encoding($encoding = 'UTF-8')
	{
		$this->sanitize->set_output_encoding($encoding);
	}

	public function strip_comments($strip = false)
	{
		$this->sanitize->strip_comments($strip);
	}

	/**
	 * Set element/attribute key/value pairs of HTML attributes
	 * containing URLs that need to be resolved relative to the feed
	 *
	 * Defaults to |a|@href, |area|@href, |blockquote|@cite, |del|@cite,
	 * |form|@action, |img|@longdesc, |img|@src, |input|@src, |ins|@cite,
	 * |q|@cite
	 *
	 * @since 1.0
	 * @param array|null $element_attribute Element/attribute key/value pairs, null for default
	 */
	public function set_url_replacements($element_attribute = null)
	{
		$this->sanitize->set_url_replacements($element_attribute);
	}

	/**
	 * Set the handler to enable the display of cached images.
	 *
	 * @param str $page Web-accessible path to the handler_image.php file.
	 * @param str $qs The query string that the value should be passed to.
	 */
	public function set_image_handler($page = false, $qs = 'i')
	{
		if ($page !== false)
		{
			$this->sanitize->set_image_handler($page . '?' . $qs . '=');
		}
		else
		{
			$this->image_handler = '';
		}
	}

	/**
	 * Set the limit for items returned per-feed with multifeeds
	 *
	 * @param integer $limit The maximum number of items to return.
	 */
	public function set_item_limit($limit = 0)
	{
		$this->item_limit = (int) $limit;
	}

	/**
	 * Enable throwing exceptions
	 *
	 * @param boolean $enable Should we throw exceptions, or use the old-style error property?
	 */
	public function enable_exceptions($enable = true)
	{
		$this->enable_exceptions = $enable;
	}

	/**
	 * Initialize the feed object
	 *
	 * This is what makes everything happen.  Period.  This is where all of the
	 * configuration options get processed, feeds are fetched, cached, and
	 * parsed, and all of that other good stuff.
	 *
	 * @return boolean True if successful, false otherwise
	 */
	public function init()
	{
		// Check absolute bare minimum requirements.
		if (!extension_loaded('xml') || !extension_loaded('pcre'))
		{
			return false;
		}
		// Then check the xml extension is sane (i.e., libxml 2.7.x issue on PHP < 5.2.9 and libxml 2.7.0 to 2.7.2 on any version) if we don't have xmlreader.
		elseif (!extension_loaded('xmlreader'))
		{
			static $xml_is_sane = null;
			if ($xml_is_sane === null)
			{
				$parser_check = xml_parser_create();
				xml_parse_into_struct($parser_check, '<foo>&amp;</foo>', $values);
				xml_parser_free($parser_check);
				$xml_is_sane = isset($values[0]['value']);
			}
			if (!$xml_is_sane)
			{
				return false;
			}
		}

		if (method_exists($this->sanitize, 'set_registry'))
		{
			$this->sanitize->set_registry($this->registry);
		}

		// Pass whatever was set with config options over to the sanitizer.
		// Pass the classes in for legacy support; new classes should use the registry instead
		$this->sanitize->pass_cache_data($this->cache, $this->cache_location, $this->cache_name_function, $this->registry->get_class('Cache'));
		$this->sanitize->pass_file_data($this->registry->get_class('File'), $this->timeout, $this->useragent, $this->force_fsockopen);

		if (empty($this->multifeed_url))
		{
			return false;
		}

		$i = 0;
		$success = 0;
		$this->multifeed_objects = array();
		$this->error = array();
		foreach ($this->multifeed_url as $url)
		{
			$this->multifeed_objects[$i] = new SimplePie_Feed($this);
			$this->multifeed_objects[$i]->set_feed_url($url);
			$single_success = $this->multifeed_objects[$i]->init();
			$success |= $single_success;
			if (!$single_success)
			{
				$this->error[$i] = $this->multifeed_objects[$i]->error();
			}
			$i++;
		}
		return (bool) $success;
	}

	/**
	 * Get the error message for the occured error
	 *
	 * @return array Array of messages for multifeeds
	 */
	public function error()
	{
		return $this->error;
	}

	/**
	 * Get the character encoding used for output
	 *
	 * @since Preview Release
	 * @return string
	 */
	public function get_encoding()
	{
		return $this->sanitize->output_encoding;
	}

	/**
	 * Get all items from the feed
	 *
	 * This is better suited for {@link http://php.net/for for()} loops, whereas
	 * {@see get_items()} is better suited for
	 * {@link http://php.net/foreach foreach()} loops.
	 *
	 * @see get_item_quantity
	 * @since Beta 2
	 * @param int $start Index to start at
	 * @param int $end Number of items to return. 0 for all items after `$start`
	 * @return array|null List of {@see SimplePie_Item} objects
	 */
	public function get_items($start = 0, $end = 0)
	{
		if (!isset($this->data['items']))
		{
			$order_callback = false;
			if ($this->order_by_date)
			{
				$order_callback = array(get_class(), 'sort_items');
			}
			$this->data['items'] = self::merge_items($this->multifeed_objects, $start, $end, $this->item_limit, $order_callback);
		}

		if (!empty($this->data['items']))
		{
			// Slice the data as desired
			if ($end === 0)
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

	/**
	 * Send the content-type header with correct encoding
	 *
	 * This method ensures that the SimplePie-enabled page is being served with
	 * the correct {@link http://www.iana.org/assignments/media-types/ mime-type}
	 * and character encoding HTTP headers (character encoding determined by the
	 * {@see set_output_encoding} config option).
	 *
	 * This won't work properly if any content or whitespace has already been
	 * sent to the browser, because it relies on PHP's
	 * {@link http://php.net/header header()} function, and these are the
	 * circumstances under which the function works.
	 *
	 * Because it's setting these settings for the entire page (as is the nature
	 * of HTTP headers), this should only be used once per page (again, at the
	 * top).
	 *
	 * @param string $mime MIME type to serve the page as
	 */
	public function handle_content_type($mime = 'text/html')
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
	 * Sanitize feed data
	 *
	 * @access private
	 * @see SimplePie_Sanitize::sanitize()
	 * @param string $data Data to sanitize
	 * @param int $type One of the SIMPLEPIE_CONSTRUCT_* constants
	 * @param string $base Base URL to resolve URLs against
	 * @return string Sanitized data
	 */
	public function sanitize($data, $type, $base = '')
	{
		try
		{
			return $this->sanitize->sanitize($data, $type, $base);
		}
		catch (SimplePie_Exception $e)
		{
			if (!$this->enable_exceptions)
			{
				$this->error = $e->getMessage();
				$this->registry->call('Misc', 'error', array($this->error, E_USER_WARNING, $e->getFile(), $e->getLine()));
				return '';
			}

			throw $e;
		}
	}

	/**
	 * Set the favicon handler
	 *
	 * @deprecated Use your own favicon handling instead
	 */
	public function set_favicon_handler($page = false, $qs = 'i')
	{
		$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
		trigger_error('Favicon handling has been removed, please use your own handling', $level);
		return false;
	}

	/**
	 * Get the URL for the feed
	 *
	 * May or may not be different from the URL passed to {@see set_feed_url()},
	 * depending on whether auto-discovery was used.
	 *
	 * @since Preview Release (previously called `get_feed_url()` since SimplePie 0.8.)
	 * @todo If we have a perm redirect we should return the new URL
	 * @todo When we make the above change, let's support <itunes:new-feed-url> as well
	 * @todo Also, |atom:link|@rel=self
	 * @return string|null
	 */
	public function subscribe_url()
	{
		if (!empty($this->multifeed_objects))
		{
			if (count($this->multifeed_objects) > 1)
			{
				$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
				trigger_error('Feed-level data from SimplePie has been deprecated, use get_feed(0) instead', $level);
			}
			return $this->multifeed_objects[0]->subscribe_url();
		}
		else
		{
			return null;
		}
	}

	/**
	 * Magic method handler
	 *
	 * @param string $method Method name
	 * @param array $args Arguments to the method
	 * @return mixed
	 */
	public function __call($method, $args)
	{
		if (strpos($method, 'subscribe_') === 0)
		{
			$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
			trigger_error('subscribe_*() has been deprecated, implement the callback yourself', $level);
			return '';
		}
		if ($method === 'enable_xml_dump')
		{
			$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
			trigger_error('enable_xml_dump() has been deprecated, use get_raw_data() instead', $level);
			return false;
		}
		if (!empty($this->multifeed_objects) && method_exists($this->multifeed_objects[0], $method))
		{
			if (count($this->multifeed_objects) > 1)
			{
				$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
				trigger_error('Feed-level data from SimplePie has been deprecated, use get_feed(0) instead', $level);
			}
			return call_user_func_array(array($this->multifeed_objects[0], $method), $args);
		}

		$class = get_class($this);
		$trace = debug_backtrace();
		$file = $trace[0]['file'];
		$line = $trace[0]['line'];
		trigger_error("Call to undefined method $class::$method() in $file on line $line", E_USER_ERROR);
	}

	/**
	 * Sorting callback for items
	 *
	 * @access private
	 * @param SimplePie $a
	 * @param SimplePie $b
	 * @return boolean
	 */
	public static function sort_items($a, $b)
	{
		return $a->get_date('U') <= $b->get_date('U');
	}

	/**
	 * Merge items from several feeds into one
	 *
	 * If you're merging multiple feeds together, they need to all have dates
	 * for the items or else SimplePie will refuse to sort them.
	 *
	 * @link http://simplepie.org/wiki/tutorial/sort_multiple_feeds_by_time_and_date#if_feeds_require_separate_per-feed_settings
	 * @param array $urls List of SimplePie feed objects to merge
	 * @param int $start Starting item
	 * @param int $end Number of items to return
	 * @param int $limit Maximum number of items per feed
	 * @return array
	 */
	public static function merge_items($urls, $start = 0, $end = 0, $limit = 0, $order_callback = false)
	{
		if (is_array($urls) && sizeof($urls) > 0)
		{
			$items = array();
			foreach ($urls as $arg)
			{
				if ($arg instanceof SimplePie || $arg instanceof SimplePie_Feed)
				{
					$items = array_merge($items, $arg->get_items(0, $limit));
				}
				else
				{
					trigger_error('Arguments must be SimplePie objects', E_USER_WARNING);
				}
			}

			foreach ($items as $item)
			{
				if (!$item->get_date('U'))
				{
					$order_callback = false;
					break;
				}
			}
			$item = null;
			if ($order_callback)
			{
				usort($items, $order_callback);
			}

			if ($end === 0)
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

<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2009, Ryan Parman, Geoffrey Sneddon, Ryan McCue, and contributors
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
 * Feed-level accessors and processing
 *
 * @package SimplePie
 * @subpackage API
 */
class SimplePie_Feed
{
	/**
	 * @var SimplePie $controller
	 */
	protected $controller;

	/**
	 * @var string Feed URL
	 * @see self::set_feed_url()
	 */
	protected $feed_url;

	/**
	 * @var object Instance of SimplePie_File to use as a feed
	 * @see self::set_file()
	 */
	protected $file;

	/**
	 * @var bool Force the given data/URL to be treated as a feed no matter what
	 * it appears like
	 * @see self::force_feed()
	 */
	protected $force_feed = false;

	/**
	 * Class registry object
	 *
	 * @var SimplePie_Registry
	 */
	protected $registry;

	public function __construct($controller)
	{
		$this->controller = $controller;
		$this->registry = $controller->registry;
	}

	/**
	 * Force the given data/URL to be treated as a feed
	 *
	 * This tells SimplePie to ignore the content-type provided by the server.
	 * Be careful when using this option, as it will also disable autodiscovery.
	 *
	 * @since 1.1
	 * @param bool $enable Force the given data/URL to be treated as a feed
	 */
	public function force_feed($enable = false)
	{
		$this->force_feed = (bool) $enable;
	}

	/**
	 * Set the URL of the feed you want to parse
	 *
	 * This allows you to enter the URL of the feed you want to parse, or the
	 * website you want to try to use auto-discovery on. This takes priority
	 * over any set raw data.
	 *
	 * @since 1.0 Preview Release
	 * @see set_raw_data()
	 * @param string|array $url This is the URL (or array of URLs) that you want to parse.
	 */
	public function set_feed_url($url)
	{
		$this->feed_url = $this->registry->call('Misc', 'fix_protocol', array($url, 1));
	}

	/**
	 * Set an instance of {@see SimplePie_File} to use as a feed
	 *
	 * @param SimplePie_File &$file
	 * @return bool True on success, false on failure
	 */
	public function set_file(&$file)
	{
		if ($file instanceof SimplePie_File)
		{
			$this->feed_url = $file->url;
			$this->file =& $file;
			return true;
		}
		return false;
	}

	/**
	 * Set the raw XML data to parse
	 *
	 * Allows you to use a string of RSS/Atom data instead of a remote feed.
	 *
	 * If you have a feed available as a string in PHP, you can tell SimplePie
	 * to parse that data string instead of a remote feed. Any set feed URL
	 * takes precedence.
	 *
	 * @since 1.0 Beta 3
	 * @param string $data RSS or Atom data as a string.
	 * @see set_feed_url()
	 */
	public function set_raw_data($data)
	{
		$this->raw_data = $data;
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
		if ($this->feed_url === null && $this->raw_data === null)
		{
			return false;
		}

		$this->error = null;
		$this->data = array();
		$cache = false;

		if ($this->feed_url !== null)
		{
			$parsed_feed_url = $this->registry->call('Misc', 'parse_url', array($this->feed_url));

			// Decide whether to enable caching
			if ($this->controller->cache && $parsed_feed_url['scheme'] !== '')
			{
				$cache = $this->registry->call('Cache', 'get_handler', array($this->controller->cache_location, call_user_func($this->controller->cache_name_function, $this->feed_url), 'spc'));
			}

			// Fetch the data via SimplePie_File into $this->raw_data
			if (($fetched = $this->fetch_data($cache)) === true)
			{
				return true;
			}
			elseif ($fetched === false) {
				return false;
			}

			list($headers, $sniffed) = $fetched;
		}

		// Set up array of possible encodings
		$encodings = array();

		// First check to see if input has been overridden.
		if ($this->controller->input_encoding !== false)
		{
			$encodings[] = $this->controller->input_encoding;
		}

		$application_types = array('application/xml', 'application/xml-dtd', 'application/xml-external-parsed-entity');
		$text_types = array('text/xml', 'text/xml-external-parsed-entity');

		// RFC 3023 (only applies to sniffed content)
		if (isset($sniffed))
		{
			if (in_array($sniffed, $application_types) || substr($sniffed, 0, 12) === 'application/' && substr($sniffed, -4) === '+xml')
			{
				if (isset($headers['content-type']) && preg_match('/;\x20?charset=([^;]*)/i', $headers['content-type'], $charset))
				{
					$encodings[] = strtoupper($charset[1]);
				}
				$encodings = array_merge($encodings, $this->registry->call('Misc', 'xml_encoding', array($this->raw_data, &$this->registry)));
				$encodings[] = 'UTF-8';
			}
			elseif (in_array($sniffed, $text_types) || substr($sniffed, 0, 5) === 'text/' && substr($sniffed, -4) === '+xml')
			{
				if (isset($headers['content-type']) && preg_match('/;\x20?charset=([^;]*)/i', $headers['content-type'], $charset))
				{
					$encodings[] = $charset[1];
				}
				$encodings[] = 'US-ASCII';
			}
			// Text MIME-type default
			elseif (substr($sniffed, 0, 5) === 'text/')
			{
				$encodings[] = 'US-ASCII';
			}
		}

		// Fallback to XML 1.0 Appendix F.1/UTF-8/ISO-8859-1
		$encodings = array_merge($encodings, $this->registry->call('Misc', 'xml_encoding', array($this->raw_data, &$this->registry)));
		$encodings[] = 'UTF-8';
		$encodings[] = 'ISO-8859-1';

		// There's no point in trying an encoding twice
		$encodings = array_unique($encodings);

		// Loop through each possible encoding, till we return something, or run out of possibilities
		foreach ($encodings as $encoding)
		{
			// Change the encoding to UTF-8 (as we always use UTF-8 internally)
			if ($utf8_data = $this->registry->call('Misc', 'change_encoding', array($this->raw_data, $encoding, 'UTF-8')))
			{
				// Create new parser
				$parser = $this->registry->create('Parser');

				// If it's parsed fine
				if ($parser->parse($utf8_data, 'UTF-8'))
				{
					$this->data = $parser->get_data();
					if (!($this->get_type() & ~SIMPLEPIE_TYPE_NONE))
					{
						$this->error = "A feed could not be found at $this->feed_url. This does not appear to be a valid RSS or Atom feed.";
						$this->registry->call('Misc', 'error', array($this->error, E_USER_NOTICE, __FILE__, __LINE__));
						return false;
					}

					if (isset($headers))
					{
						$this->data['headers'] = $headers;
					}
					$this->data['build'] = SIMPLEPIE_BUILD;

					// Cache the file if caching is enabled
					if ($cache && !$cache->save($this))
					{
						trigger_error("$this->controller->cache_location is not writeable. Make sure you've set the correct relative or absolute path, and that the location is server-writable.", E_USER_WARNING);
					}
					return true;
				}
			}
		}

		if (isset($parser))
		{
			// We have an error, just set SimplePie_Misc::error to it and quit
			$this->error = sprintf('This XML document is invalid, likely due to invalid characters. XML error: %s at line %d, column %d', $parser->get_error_string(), $parser->get_current_line(), $parser->get_current_column());
		}
		else
		{
			$this->error = 'The data could not be converted to UTF-8. You MUST have either the iconv or mbstring extension installed. Upgrading to PHP 5.x (which includes iconv) is highly recommended.';
		}

		$this->registry->call('Misc', 'error', array($this->error, E_USER_NOTICE, __FILE__, __LINE__));

		return false;
	}

	/**
	 * Fetch the data via SimplePie_File
	 *
	 * If the data is already cached, attempt to fetch it from there instead
	 * @param SimplePie_Cache|false $cache Cache handler, or false to not load from the cache
	 * @return array|true Returns true if the data was loaded from the cache, or an array of HTTP headers and sniffed type
	 */
	protected function fetch_data(&$cache)
	{
		// If it's enabled, use the cache
		if ($cache)
		{
			// Load the Cache
			$this->data = $cache->load();
			if (!empty($this->data))
			{
				// If the cache is for an outdated build of SimplePie
				if (!isset($this->data['build']) || $this->data['build'] !== SIMPLEPIE_BUILD)
				{
					$cache->unlink();
					$this->data = array();
				}
				// If we've hit a collision just rerun it with caching disabled
				elseif (isset($this->data['url']) && $this->data['url'] !== $this->feed_url)
				{
					$cache = false;
					$this->data = array();
				}
				// If we've got a non feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL.
				elseif (isset($this->data['feed_url']))
				{
					// If the autodiscovery cache is still valid use it.
					if ($cache->mtime() + $this->controller->autodiscovery_cache_duration > time())
					{
						// Do not need to do feed autodiscovery yet.
						if ($this->data['feed_url'] !== $this->data['url'])
						{
							$this->set_feed_url($this->data['feed_url']);
							return $this->init();
						}

						$cache->unlink();
						$this->data = array();
					}
				}
				// Check if the cache has been updated
				elseif ($cache->mtime() + $this->controller->cache_duration < time())
				{
					// If we have last-modified and/or etag set
					if (isset($this->data['headers']['last-modified']) || isset($this->data['headers']['etag']))
					{
						$headers = array(
							'Accept' => 'application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1',
						);
						if (isset($this->data['headers']['last-modified']))
						{
							$headers['if-modified-since'] = $this->data['headers']['last-modified'];
						}
						if (isset($this->data['headers']['etag']))
						{
							$headers['if-none-match'] = $this->data['headers']['etag'];
						}

						$file = $this->registry->create('File', array($this->feed_url, $this->controller->timeout/10, 5, $headers, $this->controller->useragent, $this->controller->force_fsockopen));

						if ($file->success)
						{
							if ($file->status_code === 304)
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
					$this->raw_data = false;
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
			if ($this->file instanceof SimplePie_File && $this->file->url === $this->feed_url)
			{
				$file =& $this->file;
			}
			else
			{
				$headers = array(
					'Accept' => 'application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1',
				);
				$file = $this->registry->create('File', array($this->feed_url, $this->controller->timeout, 5, $headers, $this->controller->useragent, $this->controller->force_fsockopen));
			}
		}
		// If the file connection has an error, set SimplePie::error to that and quit
		if (!$file->success && !($file->method & SIMPLEPIE_FILE_SOURCE_REMOTE === 0 || ($file->status_code === 200 || $file->status_code > 206 && $file->status_code < 300)))
		{
			$this->error = $file->error;
			return !empty($this->data);
		}

		if (!$this->force_feed)
		{
			// Check if the supplied URL is a feed, if it isn't, look for it.
			$locate = $this->registry->create('Locator', array(&$file, $this->controller->timeout, $this->controller->useragent, $this->controller->max_checked_feeds));

			if (!$locate->is_feed($file))
			{
				// We need to unset this so that if SimplePie::set_file() has been called that object is untouched
				unset($file);
				try
				{
					if (!($file = $locate->find($this->controller->autodiscovery, $this->all_discovered_feeds)))
					{
						$this->error = "A feed could not be found at $this->feed_url. A feed with an invalid mime type may fall victim to this error, or " . SIMPLEPIE_NAME . " was unable to auto-discover it.. Use force_feed() if you are certain this URL is a real feed.";
						$this->registry->call('Misc', 'error', array($this->error, E_USER_NOTICE, __FILE__, __LINE__));
						return false;
					}
				}
				catch (SimplePie_Exception $e)
				{
					// This is usually because DOMDocument doesn't exist
					$this->error = $e->getMessage();
					$this->registry->call('Misc', 'error', array($this->error, E_USER_NOTICE, $e->getFile(), $e->getLine()));
					return false;
				}
				if ($cache)
				{
					$this->data = array('url' => $this->feed_url, 'feed_url' => $file->url, 'build' => SIMPLEPIE_BUILD);
					if (!$cache->save($this))
					{
						trigger_error("$this->cache_location is not writeable. Make sure you've set the correct relative or absolute path, and that the location is server-writable.", E_USER_WARNING);
					}
					$cache = $this->registry->call('Cache', 'get_handler', array($this->controller->cache_location, call_user_func($this->controller->cache_name_function, $file->url), 'spc'));
				}
				$this->feed_url = $file->url;
			}
			$locate = null;
		}

		$this->raw_data = $file->body;

		$headers = $file->headers;
		$sniffer = $this->registry->create('Content_Type_Sniffer', array(&$file));
		$sniffed = $sniffer->get_type();

		return array($headers, $sniffed);
	}

	/**
	 * Get the error message for the occured error
	 *
	 * @return string Error message
	 */
	public function error()
	{
		return $this->error;
	}

	/**
	 * Sanitize feed data
	 *
	 * @see SimplePie_Sanitize::sanitize()
	 * @param string $data Data to sanitize
	 * @param int $type One of the SIMPLEPIE_CONSTRUCT_* constants
	 * @param string $base Base URL to resolve URLs against
	 * @return string Sanitized data
	 */
	public function sanitize($data, $type, $base = '')
	{
		return $this->controller->sanitize($data, $type, $base);
	}

	/**
	 * Get the raw XML
	 *
	 * This is the same as the old `$feed->enable_xml_dump(true)`, but returns
	 * the data instead of printing it.
	 *
	 * @return string|boolean Raw XML data, false if the cache is used
	 */
	public function get_raw_data()
	{
		return $this->raw_data;
	}

	/**
	 * Get the title of the feed
	 *
	 * Uses `<atom:title>`, `<title>` or `<dc:title>`
	 *
	 * @since 1.0 (previously called `get_feed_title` since 0.8)
	 * @return string|null
	 */
	public function get_title()
	{
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'title'))
		{
			return $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_10_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'title'))
		{
			return $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_03_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get a category for the feed
	 *
	 * @since Unknown
	 * @param int $key The category that you want to return.  Remember that arrays begin with 0, not 1
	 * @return SimplePie_Category|null
	 */
	public function get_category($key = 0)
	{
		$categories = $this->get_categories();
		if (isset($categories[$key]))
		{
			return $categories[$key];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get all categories for the feed
	 *
	 * Uses `<atom:category>`, `<category>` or `<dc:subject>`
	 *
	 * @since Unknown
	 * @return array|null List of {@see SimplePie_Category} objects
	 */
	public function get_categories()
	{
		$categories = array();

		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'category') as $category)
		{
			$term = null;
			$scheme = null;
			$label = null;
			if (isset($category['attribs']['']['term']))
			{
				$term = $this->sanitize($category['attribs']['']['term'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($category['attribs']['']['scheme']))
			{
				$scheme = $this->sanitize($category['attribs']['']['scheme'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($category['attribs']['']['label']))
			{
				$label = $this->sanitize($category['attribs']['']['label'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			$categories[] = $this->registry->create('Category', array($term, $scheme, $label));
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'category') as $category)
		{
			// This is really the label, but keep this as the term also for BC.
			// Label will also work on retrieving because that falls back to term.
			$term = $this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			if (isset($category['attribs']['']['domain']))
			{
				$scheme = $this->sanitize($category['attribs']['']['domain'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			else
			{
				$scheme = null;
			}
			$categories[] = $this->registry->create('Category', array($term, $scheme, null));
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'subject') as $category)
		{
			$categories[] = $this->registry->create('Category', array($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null));
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'subject') as $category)
		{
			$categories[] = $this->registry->create('Category', array($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null));
		}

		if (!empty($categories))
		{
			return array_unique($categories);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get an author for the feed
	 *
	 * @since 1.1
	 * @param int $key The author that you want to return.  Remember that arrays begin with 0, not 1
	 * @return SimplePie_Author|null
	 */
	public function get_author($key = 0)
	{
		$authors = $this->get_authors();
		if (isset($authors[$key]))
		{
			return $authors[$key];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get all authors for the feed
	 *
	 * Uses `<atom:author>`, `<author>`, `<dc:creator>` or `<itunes:author>`
	 *
	 * @since 1.1
	 * @return array|null List of {@see SimplePie_Author} objects
	 */
	public function get_authors()
	{
		$authors = array();
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'author') as $author)
		{
			$name = null;
			$uri = null;
			$email = null;
			if (isset($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['name'][0]['data']))
			{
				$name = $this->sanitize($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['name'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['uri'][0]['data']))
			{
				$uri = $this->sanitize($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['uri'][0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['uri'][0]));
			}
			if (isset($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['email'][0]['data']))
			{
				$email = $this->sanitize($author['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['email'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if ($name !== null || $email !== null || $uri !== null)
			{
				$authors[] = $this->registry->create('Author', array($name, $uri, $email));
			}
		}
		if ($author = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'author'))
		{
			$name = null;
			$url = null;
			$email = null;
			if (isset($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['name'][0]['data']))
			{
				$name = $this->sanitize($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['name'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['url'][0]['data']))
			{
				$url = $this->sanitize($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['url'][0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['url'][0]));
			}
			if (isset($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['email'][0]['data']))
			{
				$email = $this->sanitize($author[0]['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['email'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if ($name !== null || $email !== null || $url !== null)
			{
				$authors[] = $this->registry->create('Author', array($name, $url, $email));
			}
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'creator') as $author)
		{
			$authors[] = $this->registry->create('Author', array($this->sanitize($author['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null));
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'creator') as $author)
		{
			$authors[] = $this->registry->create('Author', array($this->sanitize($author['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null));
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ITUNES, 'author') as $author)
		{
			$authors[] = $this->registry->create('Author', array($this->sanitize($author['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null));
		}

		if (!empty($authors))
		{
			return array_unique($authors);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get a contributor for the feed
	 *
	 * @since 1.1
	 * @param int $key The contrbutor that you want to return.  Remember that arrays begin with 0, not 1
	 * @return SimplePie_Author|null
	 */
	public function get_contributor($key = 0)
	{
		$contributors = $this->get_contributors();
		if (isset($contributors[$key]))
		{
			return $contributors[$key];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get all contributors for the feed
	 *
	 * Uses `<atom:contributor>`
	 *
	 * @since 1.1
	 * @return array|null List of {@see SimplePie_Author} objects
	 */
	public function get_contributors()
	{
		$contributors = array();
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'contributor') as $contributor)
		{
			$name = null;
			$uri = null;
			$email = null;
			if (isset($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['name'][0]['data']))
			{
				$name = $this->sanitize($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['name'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['uri'][0]['data']))
			{
				$uri = $this->sanitize($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['uri'][0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['uri'][0]));
			}
			if (isset($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['email'][0]['data']))
			{
				$email = $this->sanitize($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['email'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if ($name !== null || $email !== null || $uri !== null)
			{
				$contributors[] = $this->registry->create('Author', array($name, $uri, $email));
			}
		}
		foreach ((array) $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'contributor') as $contributor)
		{
			$name = null;
			$url = null;
			$email = null;
			if (isset($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['name'][0]['data']))
			{
				$name = $this->sanitize($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['name'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['url'][0]['data']))
			{
				$url = $this->sanitize($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['url'][0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['url'][0]));
			}
			if (isset($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['email'][0]['data']))
			{
				$email = $this->sanitize($contributor['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['email'][0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if ($name !== null || $email !== null || $url !== null)
			{
				$contributors[] = $this->registry->create('Author', array($name, $url, $email));
			}
		}

		if (!empty($contributors))
		{
			return array_unique($contributors);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get a single link for the feed
	 *
	 * @since 1.0 (previously called `get_feed_link` since Preview Release, `get_feed_permalink()` since 0.8)
	 * @param int $key The link that you want to return.  Remember that arrays begin with 0, not 1
	 * @param string $rel The relationship of the link to return
	 * @return string|null Link URL
	 */
	public function get_link($key = 0, $rel = 'alternate')
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
	 * Get the permalink for the item
	 *
	 * Returns the first link available with a relationship of "alternate".
	 * Identical to {@see get_link()} with key 0
	 *
	 * @see get_link
	 * @since 1.0 (previously called `get_feed_link` since Preview Release, `get_feed_permalink()` since 0.8)
	 * @internal Added for parity between the parent-level and the item/entry-level.
	 * @return string|null Link URL
	 */
	public function get_permalink()
	{
		return $this->get_link(0);
	}

	/**
	 * Get all links for the feed
	 *
	 * Uses `<atom:link>` or `<link>`
	 *
	 * @since Beta 2
	 * @param string $rel The relationship of links to return
	 * @return array|null Links found for the feed (strings)
	 */
	public function get_links($rel = 'alternate')
	{
		if (!isset($this->data['links']))
		{
			$this->data['links'] = array();
			if ($links = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'link'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['']['href']))
					{
						$link_rel = (isset($link['attribs']['']['rel'])) ? $link['attribs']['']['rel'] : 'alternate';
						$this->data['links'][$link_rel][] = $this->sanitize($link['attribs']['']['href'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));
					}
				}
			}
			if ($links = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'link'))
			{
				foreach ($links as $link)
				{
					if (isset($link['attribs']['']['href']))
					{
						$link_rel = (isset($link['attribs']['']['rel'])) ? $link['attribs']['']['rel'] : 'alternate';
						$this->data['links'][$link_rel][] = $this->sanitize($link['attribs']['']['href'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($link));

					}
				}
			}
			if ($links = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'link'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'link'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}
			if ($links = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'link'))
			{
				$this->data['links']['alternate'][] = $this->sanitize($links[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($links[0]));
			}

			$keys = array_keys($this->data['links']);
			foreach ($keys as $key)
			{
				if ($this->registry->call('Misc', 'is_isegment_nz_nc', array($key)))
				{
					if (isset($this->data['links'][SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY . $key]))
					{
						$this->data['links'][SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY . $key] = array_merge($this->data['links'][$key], $this->data['links'][SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY . $key]);
						$this->data['links'][$key] =& $this->data['links'][SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY . $key];
					}
					else
					{
						$this->data['links'][SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY . $key] =& $this->data['links'][$key];
					}
				}
				elseif (substr($key, 0, 41) === SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY)
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

	public function get_all_discovered_feeds()
	{
		return $this->all_discovered_feeds;
	}

	/**
	 * Get the content for the item
	 *
	 * Uses `<atom:subtitle>`, `<atom:tagline>`, `<description>`,
	 * `<dc:description>`, `<itunes:summary>` or `<itunes:subtitle>`
	 *
	 * @since 1.0 (previously called `get_feed_description()` since 0.8)
	 * @return string|null
	 */
	public function get_description()
	{
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'subtitle'))
		{
			return $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_10_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'tagline'))
		{
			return $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_03_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'description'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'description'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'description'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'description'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'description'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ITUNES, 'summary'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ITUNES, 'subtitle'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the copyright info for the feed
	 *
	 * Uses `<atom:rights>`, `<atom:copyright>` or `<dc:rights>`
	 *
	 * @since 1.0 (previously called `get_feed_copyright()` since 0.8)
	 * @return string|null
	 */
	public function get_copyright()
	{
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'rights'))
		{
			return $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_10_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'copyright'))
		{
			return $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_03_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'copyright'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'rights'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'rights'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the language for the feed
	 *
	 * Uses `<language>`, `<dc:language>`, or @xml_lang
	 *
	 * @since 1.0 (previously called `get_feed_language()` since 0.8)
	 * @return string|null
	 */
	public function get_language()
	{
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'language'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'language'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'language'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif (isset($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['feed'][0]['xml_lang']))
		{
			return $this->sanitize($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['feed'][0]['xml_lang'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif (isset($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['feed'][0]['xml_lang']))
		{
			return $this->sanitize($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['feed'][0]['xml_lang'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['xml_lang']))
		{
			return $this->sanitize($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['xml_lang'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif (isset($this->data['headers']['content-language']))
		{
			return $this->sanitize($this->data['headers']['content-language'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the latitude coordinates for the item
	 *
	 * Compatible with the W3C WGS84 Basic Geo and GeoRSS specifications
	 *
	 * Uses `<geo:lat>` or `<georss:point>`
	 *
	 * @since 1.0
	 * @link http://www.w3.org/2003/01/geo/ W3C WGS84 Basic Geo
	 * @link http://www.georss.org/ GeoRSS
	 * @return string|null
	 */
	public function get_latitude()
	{

		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO, 'lat'))
		{
			return (float) $return[0]['data'];
		}
		elseif (($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_GEORSS, 'point')) && preg_match('/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/', trim($return[0]['data']), $match))
		{
			return (float) $match[1];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the longitude coordinates for the feed
	 *
	 * Compatible with the W3C WGS84 Basic Geo and GeoRSS specifications
	 *
	 * Uses `<geo:long>`, `<geo:lon>` or `<georss:point>`
	 *
	 * @since 1.0
	 * @link http://www.w3.org/2003/01/geo/ W3C WGS84 Basic Geo
	 * @link http://www.georss.org/ GeoRSS
	 * @return string|null
	 */
	public function get_longitude()
	{
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO, 'long'))
		{
			return (float) $return[0]['data'];
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO, 'lon'))
		{
			return (float) $return[0]['data'];
		}
		elseif (($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_GEORSS, 'point')) && preg_match('/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/', trim($return[0]['data']), $match))
		{
			return (float) $match[2];
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the feed logo's title
	 *
	 * RSS 0.9.0, 1.0 and 2.0 feeds are allowed to have a "feed logo" title.
	 *
	 * Uses `<image><title>` or `<image><dc:title>`
	 *
	 * @return string|null
	 */
	public function get_image_title()
	{
		if ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_DC_11, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_DC_10, 'title'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the feed logo's URL
	 *
	 * RSS 0.9.0, 2.0, Atom 1.0, and feeds with iTunes RSS tags are allowed to
	 * have a "feed logo" URL. This points directly to the image itself.
	 *
	 * Uses `<itunes:image>`, `<atom:logo>`, `<atom:icon>`,
	 * `<image><title>` or `<image><dc:title>`
	 *
	 * @return string|null
	 */
	public function get_image_url()
	{
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ITUNES, 'image'))
		{
			return $this->sanitize($return[0]['attribs']['']['href'], SIMPLEPIE_CONSTRUCT_IRI);
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'logo'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'icon'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'url'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'url'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'url'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else
		{
			return null;
		}
	}


	/**
	 * Get the feed logo's link
	 *
	 * RSS 0.9.0, 1.0 and 2.0 feeds are allowed to have a "feed logo" link. This
	 * points to a human-readable page that the image should link to.
	 *
	 * Uses `<itunes:image>`, `<atom:logo>`, `<atom:icon>`,
	 * `<image><title>` or `<image><dc:title>`
	 *
	 * @return string|null
	 */
	public function get_image_link()
	{
		if ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'link'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'link'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		elseif ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'link'))
		{
			return $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_IRI, $this->get_base($return[0]));
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the feed logo's link
	 *
	 * RSS 2.0 feeds are allowed to have a "feed logo" width.
	 *
	 * Uses `<image><width>` or defaults to 88.0 if no width is specified and
	 * the feed is an RSS 2.0 feed.
	 *
	 * @return int|float|null
	 */
	public function get_image_width()
	{
		if ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'width'))
		{
			return round($return[0]['data']);
		}
		elseif ($this->get_type() & SIMPLEPIE_TYPE_RSS_SYNDICATION && $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'url'))
		{
			return 88.0;
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the feed logo's height
	 *
	 * RSS 2.0 feeds are allowed to have a "feed logo" height.
	 *
	 * Uses `<image><height>` or defaults to 31.0 if no height is specified and
	 * the feed is an RSS 2.0 feed.
	 *
	 * @return int|float|null
	 */
	public function get_image_height()
	{
		if ($return = $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'height'))
		{
			return round($return[0]['data']);
		}
		elseif ($this->get_type() & SIMPLEPIE_TYPE_RSS_SYNDICATION && $this->get_image_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'url'))
		{
			return 31.0;
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get the number of items in the feed
	 *
	 * This is well-suited for {@link http://php.net/for for()} loops with
	 * {@see get_item()}
	 *
	 * @param int $max Maximum value to return. 0 for no limit
	 * @return int Number of items in the feed
	 */
	public function get_item_quantity($max = 0)
	{
		$max = (int) $max;
		$qty = count($this->get_items());
		if ($max === 0)
		{
			return $qty;
		}
		else
		{
			return ($qty > $max) ? $max : $qty;
		}
	}

	/**
	 * Get a single item from the feed
	 *
	 * This is better suited for {@link http://php.net/for for()} loops, whereas
	 * {@see get_items()} is better suited for
	 * {@link http://php.net/foreach foreach()} loops.
	 *
	 * @see get_item_quantity()
	 * @since Beta 2
	 * @param int $key The item that you want to return.  Remember that arrays begin with 0, not 1
	 * @return SimplePie_Item|null
	 */
	public function get_item($key = 0)
	{
		$items = $this->get_items();
		if (isset($items[$key]))
		{
			return $items[$key];
		}
		else
		{
			return null;
		}
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
			$this->data['items'] = array();
			if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'entry'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = $this->registry->create('Item', array($this, $items[$key]));
				}
			}
			if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'entry'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = $this->registry->create('Item', array($this, $items[$key]));
				}
			}
			if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'item'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = $this->registry->create('Item', array($this, $items[$key]));
				}
			}
			if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'item'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = $this->registry->create('Item', array($this, $items[$key]));
				}
			}
			if ($items = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'item'))
			{
				$keys = array_keys($items);
				foreach ($keys as $key)
				{
					$this->data['items'][] = $this->registry->create('Item', array($this, $items[$key]));
				}
			}
		}

		if (!empty($this->data['items']))
		{
			$items = $this->data['items'];

			// Slice the data as desired
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
			return array();
		}
	}

	/**
	 * Get the type of the feed
	 *
	 * This returns a SIMPLEPIE_TYPE_* constant, which can be tested against
	 * using {@link http://php.net/language.operators.bitwise bitwise operators}
	 *
	 * @since 0.8 (usage changed to using constants in 1.0)
	 * @see SIMPLEPIE_TYPE_NONE Unknown.
	 * @see SIMPLEPIE_TYPE_RSS_090 RSS 0.90.
	 * @see SIMPLEPIE_TYPE_RSS_091_NETSCAPE RSS 0.91 (Netscape).
	 * @see SIMPLEPIE_TYPE_RSS_091_USERLAND RSS 0.91 (Userland).
	 * @see SIMPLEPIE_TYPE_RSS_091 RSS 0.91.
	 * @see SIMPLEPIE_TYPE_RSS_092 RSS 0.92.
	 * @see SIMPLEPIE_TYPE_RSS_093 RSS 0.93.
	 * @see SIMPLEPIE_TYPE_RSS_094 RSS 0.94.
	 * @see SIMPLEPIE_TYPE_RSS_10 RSS 1.0.
	 * @see SIMPLEPIE_TYPE_RSS_20 RSS 2.0.x.
	 * @see SIMPLEPIE_TYPE_RSS_RDF RDF-based RSS.
	 * @see SIMPLEPIE_TYPE_RSS_SYNDICATION Non-RDF-based RSS (truly intended as syndication format).
	 * @see SIMPLEPIE_TYPE_RSS_ALL Any version of RSS.
	 * @see SIMPLEPIE_TYPE_ATOM_03 Atom 0.3.
	 * @see SIMPLEPIE_TYPE_ATOM_10 Atom 1.0.
	 * @see SIMPLEPIE_TYPE_ATOM_ALL Any version of Atom.
	 * @see SIMPLEPIE_TYPE_ALL Any known/supported feed type.
	 * @return int SIMPLEPIE_TYPE_* constant
	 */
	public function get_type()
	{
		if (!isset($this->data['type']))
		{
			$this->data['type'] = SIMPLEPIE_TYPE_ALL;
			if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['feed']))
			{
				$this->data['type'] &= SIMPLEPIE_TYPE_ATOM_10;
			}
			elseif (isset($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['feed']))
			{
				$this->data['type'] &= SIMPLEPIE_TYPE_ATOM_03;
			}
			elseif (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF']))
			{
				if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_10]['channel'])
				|| isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_10]['image'])
				|| isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_10]['item'])
				|| isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_10]['textinput']))
				{
					$this->data['type'] &= SIMPLEPIE_TYPE_RSS_10;
				}
				if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_090]['channel'])
				|| isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_090]['image'])
				|| isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_090]['item'])
				|| isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_090]['textinput']))
				{
					$this->data['type'] &= SIMPLEPIE_TYPE_RSS_090;
				}
			}
			elseif (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss']))
			{
				$this->data['type'] &= SIMPLEPIE_TYPE_RSS_ALL;
				if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss'][0]['attribs']['']['version']))
				{
					switch (trim($this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss'][0]['attribs']['']['version']))
					{
						case '0.91':
							$this->data['type'] &= SIMPLEPIE_TYPE_RSS_091;
							if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_20]['skiphours']['hour'][0]['data']))
							{
								switch (trim($this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss'][0]['child'][SIMPLEPIE_NAMESPACE_RSS_20]['skiphours']['hour'][0]['data']))
								{
									case '0':
										$this->data['type'] &= SIMPLEPIE_TYPE_RSS_091_NETSCAPE;
										break;

									case '24':
										$this->data['type'] &= SIMPLEPIE_TYPE_RSS_091_USERLAND;
										break;
								}
							}
							break;

						case '0.92':
							$this->data['type'] &= SIMPLEPIE_TYPE_RSS_092;
							break;

						case '0.93':
							$this->data['type'] &= SIMPLEPIE_TYPE_RSS_093;
							break;

						case '0.94':
							$this->data['type'] &= SIMPLEPIE_TYPE_RSS_094;
							break;

						case '2.0':
							$this->data['type'] &= SIMPLEPIE_TYPE_RSS_20;
							break;
					}
				}
			}
			else
			{
				$this->data['type'] = SIMPLEPIE_TYPE_NONE;
			}
		}
		return $this->data['type'];
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
		if ($this->feed_url !== null)
		{
			return $this->sanitize($this->feed_url, SIMPLEPIE_CONSTRUCT_IRI);
		}
		else
		{
			return null;
		}
	}

	/**
	 * Get data for an feed-level element
	 *
	 * This method allows you to get access to ANY element/attribute that is a
	 * sub-element of the opening feed tag.
	 *
	 * The return value is an indexed array of elements matching the given
	 * namespace and tag name. Each element has `attribs`, `data` and `child`
	 * subkeys. For `attribs` and `child`, these contain namespace subkeys.
	 * `attribs` then has one level of associative name => value data (where
	 * `value` is a string) after the namespace. `child` has tag-indexed keys
	 * after the namespace, each member of which is an indexed array matching
	 * this same format.
	 *
	 * For example:
	 * <pre>
	 * // This is probably a bad example because we already support
	 * // <media:content> natively, but it shows you how to parse through
	 * // the nodes.
	 * $group = $item->get_item_tags(SIMPLEPIE_NAMESPACE_MEDIARSS, 'group');
	 * $content = $group[0]['child'][SIMPLEPIE_NAMESPACE_MEDIARSS]['content'];
	 * $file = $content[0]['attribs']['']['url'];
	 * echo $file;
	 * </pre>
	 *
	 * @since 1.0
	 * @see http://simplepie.org/wiki/faq/supported_xml_namespaces
	 * @param string $namespace The URL of the XML namespace of the elements you're trying to access
	 * @param string $tag Tag name
	 * @return array
	 */
	public function get_feed_tags($namespace, $tag)
	{
		$type = $this->get_type();
		if ($type & SIMPLEPIE_TYPE_ATOM_10)
		{
			if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['feed'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_10]['feed'][0]['child'][$namespace][$tag];
			}
		}
		if ($type & SIMPLEPIE_TYPE_ATOM_03)
		{
			if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['feed'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child'][SIMPLEPIE_NAMESPACE_ATOM_03]['feed'][0]['child'][$namespace][$tag];
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_RDF)
		{
			if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child'][SIMPLEPIE_NAMESPACE_RDF]['RDF'][0]['child'][$namespace][$tag];
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_SYNDICATION)
		{
			if (isset($this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss'][0]['child'][$namespace][$tag]))
			{
				return $this->data['child'][SIMPLEPIE_NAMESPACE_RSS_20]['rss'][0]['child'][$namespace][$tag];
			}
		}
		return null;
	}

	/**
	 * Get data for an channel-level element
	 *
	 * This method allows you to get access to ANY element/attribute in the
	 * channel/header section of the feed.
	 *
	 * See {@see SimplePie::get_feed_tags()} for a description of the return value
	 *
	 * @since 1.0
	 * @see http://simplepie.org/wiki/faq/supported_xml_namespaces
	 * @param string $namespace The URL of the XML namespace of the elements you're trying to access
	 * @param string $tag Tag name
	 * @return array
	 */
	public function get_channel_tags($namespace, $tag)
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
			if ($channel = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'channel'))
			{
				if (isset($channel[0]['child'][$namespace][$tag]))
				{
					return $channel[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_090)
		{
			if ($channel = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'channel'))
			{
				if (isset($channel[0]['child'][$namespace][$tag]))
				{
					return $channel[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_SYNDICATION)
		{
			if ($channel = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'channel'))
			{
				if (isset($channel[0]['child'][$namespace][$tag]))
				{
					return $channel[0]['child'][$namespace][$tag];
				}
			}
		}
		return null;
	}

	/**
	 * Get data for an channel-level element
	 *
	 * This method allows you to get access to ANY element/attribute in the
	 * image/logo section of the feed.
	 *
	 * See {@see SimplePie::get_feed_tags()} for a description of the return value
	 *
	 * @since 1.0
	 * @see http://simplepie.org/wiki/faq/supported_xml_namespaces
	 * @param string $namespace The URL of the XML namespace of the elements you're trying to access
	 * @param string $tag Tag name
	 * @return array
	 */
	public function get_image_tags($namespace, $tag)
	{
		$type = $this->get_type();
		if ($type & SIMPLEPIE_TYPE_RSS_10)
		{
			if ($image = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'image'))
			{
				if (isset($image[0]['child'][$namespace][$tag]))
				{
					return $image[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_090)
		{
			if ($image = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'image'))
			{
				if (isset($image[0]['child'][$namespace][$tag]))
				{
					return $image[0]['child'][$namespace][$tag];
				}
			}
		}
		if ($type & SIMPLEPIE_TYPE_RSS_SYNDICATION)
		{
			if ($image = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'image'))
			{
				if (isset($image[0]['child'][$namespace][$tag]))
				{
					return $image[0]['child'][$namespace][$tag];
				}
			}
		}
		return null;
	}

	/**
	 * Get the base URL value from the feed
	 *
	 * Uses `<xml:base>` if available, otherwise uses the first link in the
	 * feed, or failing that, the URL of the feed itself.
	 *
	 * @see get_link
	 * @see subscribe_url
	 *
	 * @param array $element
	 * @return string
	 */
	public function get_base($element = array())
	{
		if (!($this->get_type() & SIMPLEPIE_TYPE_RSS_SYNDICATION) && !empty($element['xml_base_explicit']) && isset($element['xml_base']))
		{
			return $element['xml_base'];
		}
		elseif ($this->get_link() !== null)
		{
			return $this->get_link();
		}
		else
		{
			return $this->subscribe_url();
		}
	}

	/**
	 * Get the favicon for the current feed
	 *
	 * @deprecated Use your own favicon handling instead
	 */
	public function get_favicon()
	{
		$level = defined('E_USER_DEPRECATED') ? E_USER_DEPRECATED : E_USER_WARNING;
		trigger_error('Favicon handling has been removed, please use your own handling', $level);

		if (($url = $this->get_link()) !== null)
		{
			return 'http://g.etfv.co/' . urlencode($url);
		}

		return false;
	}
}
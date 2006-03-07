<?php
/****************************************************
SIMPLE PIE
A Simple PHP-Based RSS/Atom Parser
Simplifies the process of displaying the values of commonly used feed tags.

Version: 1.0 Preview Release
Updated: 9 January 2006
Copyright: 2004-2006 Ryan Parman, Geoffrey Sneddon
http://www.simplepie.org

LICENSE:
Creative Commons Attribution-ShareAlike License 2.0
http://www.creativecommons.org/licenses/by-sa/2.0/

You are free:
	- to copy, distribute, display, and perform the work
	- to make derivative works
	- to make commercial use of the work

Under the following conditions:
	- Attribution. You must give the original author credit.
	- Share Alike. If you alter, transform, or build upon this work, you may distribute the resulting work only under a license identical to this one.
		- For any reuse or distribution, you must make clear to others the license terms of this work.
		- Any of these conditions can be waived if you get permission from the copyright holder.

Please see release notes for information on code that was borrowed
from other open-source projects.

Please submit all bug reports and feature requests to the SimplePie forums.
http://support.simplepie.org

****************************************************/


class SimplePie {

	// SimplePie Information
	var $name = 'SimplePie';
	var $version = '1.0PR Bugfix 1';
	var $build = '20060109';
	var $url = 'http://www.simplepie.org/';
	var $useragent;
	var $linkback;

	// Run-time Variables
	var $rss_url;
	var $encoding;
	var $xml_dump = false;
	var $caching = true;
	var $max_minutes = 60;
	var $cache_location = './cache';
	var $replace_headers = false;

	// XML Parsing Variables
	var $xml;
	var $tagName;
	var $insideItem;
	var $insideChannel;
	var $insideImage;
	var $insideAuthor;
	var $descriptionPriority;
	var $lastDescription;
	var $useGuid = false;
	var $itemNumber = 0;
	var $data = false;




	/****************************************************
	CONSTRUCTOR
	Initiates a couple of variables
	****************************************************/
	function SimplePie() {
		$this->useragent = $this->name . '/' . $this->version . ' (Feed Parser; ' . $this->url . ') Build/' . $this->build;
		$this->linkback = '<a href="' . $this->url . '" title="' . $this->name . ' ' . $this->version . '">' . $this->name . ' ' . $this->version . '</a>';
	}




	/****************************************************
	CONFIGURE OPTIONS
	Set various options (feed URL, XML dump, caching, etc.)
	****************************************************/
	// Feed URL
	function feed_url($url) {
		$url = $this->fix_protocol($url, 1);
		$this->rss_url = $url;
		return true;
	}

	// XML Dump
	function enable_xmldump($enable) {
		$this->xml_dump = $enable;
		return true;
	}

	// Caching
	function enable_caching($enable) {
		$this->caching = $enable;
		return true;
	}

	// Cache Timeout
	function cache_max_minutes($minutes) {
		$this->max_minutes = (int) $minutes;
		return true;
	}

	// Cache Location
	function cache_location($location) {
		$this->cache_location = (string) $location;
		return true;
	}

	// Replace H1, H2, and H3 tags with the less important H4 tags.
	function replace_headers($enable) {
		$this->replace_headers = (bool) $enable;
		return true;
	}





	/****************************************************
	MAIN SIMPLEPIE FUNCTION
	Rewrites the feed so that it actually resembles XML, processes the XML,
	and builds an array from the feed.
	****************************************************/
	function init() {

		// Cache location
		$cache = './cache';

		// Get Feed URL
		$rss_feed = $this->rss_url;

		// Get XML Dump Status
		$enable_xmldump = $this->xml_dump;

		// Get Caching Status
		$enable_caching = $this->caching;

		// Get Cache Timeout
		$max_minutes = $this->max_minutes;

		// Get Cache Location
		$cache = $this->cache_location;

		// Get Replace Headers Status
		$replace_headers = $this->replace_headers;

		// Return the User-Agent string to the website's logs.
		ini_set('user_agent', $this->useragent);

		// Clear all outdated cache from the server's cache folder
		$this->clear_cache($cache, $max_minutes);

		if ($rss_feed) {
			// Read the XML file for processing.
			$cache_filename = $cache . '/' . urlencode($rss_feed) . '.spc';
			if ($enable_caching && !$enable_xmldump && substr($rss_feed, 0, 7) == 'http://' && file_exists($cache_filename)) {
				if ($fp = fopen($cache_filename, 'r')) {
					$data = '';
					while (!feof($fp)) {
						$data .= fread($fp, 2048);
					}
					fclose($fp);
					$mp_rss = unserialize($data);
					if (empty($mp_rss)) {
						$this->caching = false;
						return $this->init();
					} else {
						$this->data = $mp_rss;
						return true;
					}
				} else {
					$this->caching = false;
					return $this->init();
				}
			} else {
				if (substr($rss_feed, 0, 7) == 'http://' && extension_loaded('curl')) {
					$gch = curl_init();
					curl_setopt ($gch, CURLOPT_URL, $rss_feed);
					curl_setopt ($gch, CURLOPT_HEADER, 0);
					curl_setopt ($gch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt ($gch, CURLOPT_TIMEOUT, 10);
					curl_setopt ($gch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($gch, CURLOPT_USERAGENT, $this->useragent);
					$mp_rss = curl_exec ($gch);
					curl_close ($gch);
				} else {
					if ($fp = fopen($rss_feed, 'r')) {
						stream_set_blocking($fp, false);
						stream_set_timeout($fp, 10);
						$status = socket_get_status($fp);
						$mp_rss = '';
						while (!feof($fp) && !$status['timed_out'])
						{
							$mp_rss .= fread($fp, 2048);
							$status = socket_get_status($fp);
						}
						if ($status['timed_out'])
							return false;
						fclose($fp);
					} else return false;
				}

				// Check if file is a feed or a webpage
				// If it's a webpage, auto-discover the feed and re-pass it to init()
				$html_tag = stristr($mp_rss, '<html');
				$head_tag = stristr($mp_rss, '<head');
				if ($html_tag || $head_tag) {
					$this->rss_url = $this->rss_discovery($mp_rss, $rss_feed);
					return $this->init();
				}

				// Trim out any whitespace at the beginning or the end of the file
				$mp_rss = trim($mp_rss);

				// Encode entities within CDATA
				$mp_rss = preg_replace_callback('/<!\[CDATA\[(.*)\]\]>/Uis', array($this, 'cdata_encode'), $mp_rss);

				// Strip out all CDATA tags
				$mp_rss = str_replace('<![CDATA[', '', $mp_rss);
				$mp_rss = str_replace(']]>', '', $mp_rss);

				// Replace any other brackets with their entities
				$mp_rss = preg_replace('/\[/', '&#91;', $mp_rss); // [ character -- problems with CDATA
				$mp_rss = preg_replace('/\]/', '&#93;', $mp_rss); // ] character -- problems with CDATA

				// Fix tags inside code and pre tags.
				$mp_rss = preg_replace_callback('|<code>(.*)<\/code>|Uis', array($this, 'code_encode'), $mp_rss);
				$mp_rss = preg_replace_callback('|<pre>(.*)<\/pre>|Uis', array($this, 'code_encode'), $mp_rss);

				// Create an array of all of the elements that SimplePie supports the parsing of.
				$sp_elements = array(
					// These elements are supported by SimplePie
					'title',
					'description',
					'dc:description',
					'tagline',
					'copyright',
					'dc:language',
					'language',
					'url',
					'width',
					'height',
					'content',
					'summary',
					'category',
					'dc:subject',
					'dc:creator',
					'name',
					'pubDate',
					'dc:date',
					'issued',
					'guid',

					// These elements are not currently supported by SimplePie
					// We'll just CDATA them to be safe.
					'managingEditor',
					'webMaster',
					'lastBuildDate',
					'generator',
					'docs',
					'ttl',
					'rating',
					'comments',
					'sy:updatePeriod',
					'sy:updateFrequency',
					'sy:updateBase',
					'dc:title',
					'dc:publisher',
					'dc:contributor',
					'dc:type',
					'dc:format',
					'dc:identifier',
					'dc:source',
					'dc:relation',
					'dc:coverage',
					'dc:rights',
					'media:text',
					'media:credit',
					'itunes:summary',
					'itunes:name',
					'itunes:email',
					'itunes:keywords',
					'itunes:explicit',
					'itunes:author',
					'itunes:subtitle',
					'itunes:duration'
				);

				// Store the number of elements in the above array.
				// Helps execution time in JavaScript, why not PHP?
				$sp_elements_size = sizeof($sp_elements);

				$mp_rss = str_replace('content:encoded', 'content', $mp_rss);

				for ($i=0; $i < $sp_elements_size; $i++) {
					$full = $sp_elements[$i];
					$short = substr($full, 0, -1);

					$mp_rss = preg_replace('%<' . $short . "[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i", '<' . $full . '></' . $full . '>', $mp_rss);
					$mp_rss = preg_replace('%<' . $full . '(.|\s)*?>%i', '<' . $full . '\\0<![CDATA[', $mp_rss);
					$mp_rss = str_replace('<' . $full . '<' . $full, '<' . $full, $mp_rss);
					$mp_rss = preg_replace('%</' . $full . '>%i', ']]></' . $full . '>', $mp_rss);
				}

				// Separate rules for some tags.
				if (preg_match('/<rdf:rdf/i', $mp_rss) || preg_match('/<rss/i', $mp_rss)) {
					// <author>
					$mp_rss = preg_replace("%<autho[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i", '<author></author>', $mp_rss);
					$mp_rss = preg_replace('%<author(.|\s)*?>%i', '<author\\0<![CDATA[', $mp_rss);
					$mp_rss = str_replace('<author<author', '<author', $mp_rss);
					$mp_rss = preg_replace('%</author>%i', ']]></author>',$mp_rss);

					// <link>
					$mp_rss = preg_replace('%<link(.|\s)*?>%i', '<link\\0<![CDATA[', $mp_rss);
					$mp_rss = str_replace('<link<link', '<link', $mp_rss);
					$mp_rss = preg_replace('%</link>%i', ']]></link>', $mp_rss);
				}

				// Strip out HTML tags that might cause various security problems.
				// Based on recommendations by Mark Pilgrim at:
				// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
				$tags_to_strip = array(
					'html',
					'body',
					'script',
					'noscript',
					'embed',
					'object',
					'frameset',
					'frame',
					'iframe',
					'meta',
					'style',
					'param',
					'doctype',
					'form',
					'input',
					'blink',
					'marquee',
					'font'
				);
				foreach ($tags_to_strip as $tag) {
					$mp_rss = preg_replace('/<\/?' . $tag . '(.|\s)*?>/i', '', $mp_rss);
				}

				// Strip out HTML attributes that might cause various security problems.
				// Based on recommendations by Mark Pilgrim at:
				// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
				$stripAttrib = '\' (style|id|class)="(.*?)"\'i';
				$mp_rss = preg_replace($stripAttrib, '', $mp_rss);

				// Swap out problematic characters.
				$mp_rss = str_replace('﻿', '', $mp_rss); // UTF-8 BOM
				$mp_rss = preg_replace("/�|�|–|—/", '--', $mp_rss); // em/en dash
				$mp_rss = preg_replace("/�|�|’|‘;/", "'", $mp_rss); // single-quotes
				$mp_rss = preg_replace("/�|�|“|”/", '"', $mp_rss); // double-quotes
				$mp_rss = preg_replace("/�/", '', $mp_rss); // bad character

				// Swap out funky characters with their named entities.
				// Code is from Feedsplitter at chxo.com
				$mp_rss = preg_replace(array('/\&([a-z\d\#]+)\;/i',
					'/\&/',
					'/\#\|\|([a-z\d\#]+)\|\|\#/i',
					'/(\=\"\-\/\%\?\!\'\(\)\[\\{\}\ \#\+\,\@_])/e'
					),
					array('#||\\1||#',
					'&amp;',
					'&\\1;',
					"'&#'.ord('\\1').';'"
					),
					$mp_rss
				);

				// Get rid of invalid UTF-8 characters
				// Code is from chregu at blog.bitflux.ch
				if (function_exists('iconv'))
					$mp_rss = iconv('UTF-8', 'UTF-8//IGNORE', $mp_rss);

				if ($replace_headers) {
					// Replace H1, H2, and H3 tags with the less important H4 tags.
					// This is because on a site, the more important headers might make sense,
					// but it most likely doesn't fit in the context of RSS-in-a-webpage.
					$mp_rss = preg_replace('/<h[1-3](.|\s)*?>/i', '<h4>', $mp_rss);
					$mp_rss = preg_replace('/<\/h[1-3](.|\s)*?>/i', '</h4>', $mp_rss);
				}

				// Find the domain name of the feed being read.
				$feed_path = parse_url($rss_feed);
				if (isset($feed_path['host'])) {
					$feed_host = $feed_path['host'];

					// Change certain types of relative URL's into absolute URL's
					$mp_rss = str_replace('href="/', 'href="http://' . $feed_host . '/', $mp_rss);
					$mp_rss = str_replace('href=&quot;/', 'href="http://' . $feed_host . '/', $mp_rss);
					$mp_rss = str_replace('src="/', 'src="http://' . $feed_host . '/', $mp_rss);
					$mp_rss = str_replace('src=&quot;/', 'src="http://' . $feed_host . '/', $mp_rss);
				}

				// Get encoding
				preg_match("'encoding=[\'\"](.*?)[\'\"]'si", $mp_rss, $encoding);
				if (isset($encoding[1])) {
					switch (strtoupper($encoding[1])) {
						case 'UTF-8':
							$encoding = 'UTF-8';
							break;
						case 'US-ASCII':
							$encoding = 'US-ASCII';
							break;
						default:
							$encoding = 'ISO-8859-1';
							break;
					}
				} else {
					$encoding = 'ISO-8859-1';
				}
				$this->encoding = $encoding;

				// If XML Dump is enabled, send feed to the page and quit.
				if ($enable_xmldump) {
					header("Content-type: text/xml; charset=$encoding");
					echo $mp_rss;
					exit;
				}

				$this->xml = xml_parser_create($encoding);
				xml_parser_set_option($this->xml, XML_OPTION_SKIP_WHITE, 1);
				xml_set_object($this->xml, $this);
				xml_set_character_data_handler($this->xml, 'dataHandler');
				xml_set_element_handler($this->xml, 'startHandler', 'endHandler');
				if (xml_parse($this->xml, $mp_rss))
				{
					if ($enable_caching) {
						if ($this->is_writeable_createable($cache_filename)) {
							$fp = fopen($cache_filename, 'w+');
							fwrite($fp, serialize($this->data));
							fclose($fp);
						}
						else trigger_error("$cache_filename is not writeable", E_USER_WARNING);
					}
					return true;
				}
				else
				{
					trigger_error(sprintf('XML error: %s at line %d, column %d', xml_error_string(xml_get_error_code($this->xml)), xml_get_current_line_number($this->xml), xml_get_current_column_number($this->xml)), E_USER_WARNING);
					$this->data = array();
					xml_parser_free($this->xml);
					return false;
				}
			}
		}
		else return false;
	}




	/****************************************************
	GET FEED ENCODING
	****************************************************/
	function get_encoding() {
		return (isset($this->encoding)) ? $this->encoding : false;
	}




	/****************************************************
	GET FEED VERSION NUMBER
	****************************************************/
	function get_version() {
		if (isset($this->data['feedinfo'])) {
			return (isset($this->data['feedinfo']['version'])) ? $this->data['feedinfo']['type'] . ' ' . $this->data['feedinfo']['version'] : $this->data['feedinfo']['type'];
		}
		else return false;
	}




	/****************************************************
	SUBSCRIPTION URLS
	This allows people to subscribe to the feed in various services.
	****************************************************/
	function subscribe_url() {
		if (isset($this->rss_url)) {
			$temp = $this->fix_protocol($this->rss_url, 1);
			if (strstr($temp, '../')) {
				$retVal = substr_replace($temp, '', 0, 3);
				return $retVal;
			}
			else return $temp;
		}
		else return false;
	}

	function subscribe_feed() {
		if (isset($this->rss_url)) {
			return $this->fix_protocol($this->rss_url, 2);
		}
		else false;
	}

	function subscribe_bloglines() {
		return 'http://www.bloglines.com/sub/' . rawurlencode($this->subscribe_url());
	}

	function subscribe_google() {
		return 'http://fusion.google.com/add?feedurl=' . rawurlencode($this->subscribe_url());
	}

	function subscribe_newsgator() {
		return 'http://www.newsgator.com/ngs/subscriber/subext.aspx?url=' . rawurlencode($this->subscribe_url());
	}

	function subscribe_pluck() {
		return 'http://client.pluck.com/pluckit/prompt.aspx?GCID=C12286x053&amp;a=' . rawurlencode($this->subscribe_url());
	}

	function subscribe_rojo() {
		return 'http://www.rojo.com/add-subscription?resource=' . rawurlencode($this->subscribe_url());
	}

	function subscribe_yahoo() {
		return 'http://add.my.yahoo.com/rss?url=' . rawurlencode($this->subscribe_url());
	}




	/****************************************************
	PARSE OUT GENERAL FEED-RELATED DATA
	****************************************************/
	// Reads the feed's title
	function get_feed_title() {
		return (isset($this->data['info']['name'])) ? $this->data['info']['name'] : false;
	}

	// Reads the feed's link (URL)
	function get_feed_link() {
		return (isset($this->data['info']['link'])) ? $this->data['info']['link'] : false;
	}

	// Reads the feed's description (RSS) or tagline (Atom)
	function get_feed_description() {
		return (isset($this->data['info']['description'])) ? $this->data['info']['description'] : false;
	}

	// Reads the feed's copyright information.
	function get_feed_copyright() {
		return (isset($this->data['info']['copyright'])) ? $this->data['info']['copyright'] : false;
	}

	// Reads the feed's language (via language or dc:language)
	function get_feed_language() {
		return (isset($this->data['info']['language'])) ? $this->data['info']['language'] : false;
	}




	/****************************************************
	PARSE OUT IMAGE-RELATED DATA
	Apparently Atom doesn't have feed images.
	****************************************************/
	// Check if an image element exists (returns true/false)
	function get_image_exist() {
		return (isset($this->data['info']['image']['url'])) ? true : false;
	}

	// Get the image title (to be used in alt and/or title)
	function get_image_title() {
		return (isset($this->data['info']['image']['title'])) ? $this->data['info']['image']['title'] : false;
	}

	// The path to the actual image
	function get_image_url() {
		return (isset($this->data['info']['image']['url'])) ? $this->data['info']['image']['url'] : false;
	}

	// The URL that the image is supposed to link to.
	function get_image_link() {
		return (isset($this->data['info']['image']['link'])) ? $this->data['info']['image']['link'] : false;
	}

	// Get the image width
	function get_image_width() {
		return (isset($this->data['info']['image']['width'])) ? $this->data['info']['image']['width'] : false;
	}

	// Get the image height
	function get_image_height() {
		return (isset($this->data['info']['image']['height'])) ? $this->data['info']['image']['height'] : false;
	}




	/****************************************************
	PARSE OUT ITEM-RELATED DATA
	Most of these have two parameters: position in array, feed reference.
	****************************************************/
	// Get the size of the array of items (for use in a for-loop)
	function get_item_quantity() {
		return (isset($this->data['items'])) ? sizeof($this->data['items']) : 0;
	}

	// Get the title of the item
	function get_item_title($gitArrayValue) {
		return (isset($this->data['items'][$gitArrayValue]['title'])) ? $this->data['items'][$gitArrayValue]['title'] : false;
	}

	// Get the description of the item
	function get_item_description($gitArrayValue) {
		return (isset($this->data['items'][$gitArrayValue]['description'])) ? $this->data['items'][$gitArrayValue]['description'] : false;
	}

	// Get the category of the item
	function get_item_category($gitArrayValue) {
		return (isset($this->data['items'][$gitArrayValue]['category'])) ? $this->data['items'][$gitArrayValue]['category'] : false;
	}

	// Get the author of the item
	function get_item_author($gitArrayValue) {
		return (isset($this->data['items'][$gitArrayValue]['author'])) ? implode(', ', $this->data['items'][$gitArrayValue]['author']) : false;
	}

	// Get the date of the item
	// Also, allow users to set the format of how dates are displayed on a webpage.
	function get_item_date($gitArrayValue, $date_format = 'j F Y, g:i a') {
		return (isset($this->data['items'][$gitArrayValue]['date'])) ? date($date_format, $this->data['items'][$gitArrayValue]['date']) : false;
	}

	// Get the Permalink of the item (checks for link, then guid)
	function get_item_permalink($gitArrayValue) {
		// If there is a link, take it. Fine.
		if (isset($this->data['items'][$gitArrayValue]['link'])) {
			return $this->data['items'][$gitArrayValue]['link'];
		}

		// If there isn't, check for a guid.
		else if (isset($this->data['items'][$gitArrayValue]['guid'])) {
			return $this->data['items'][$gitArrayValue]['guid'];
		}

		// If there isn't, check for an enclosure, if that exists, give that.
		else if ($this->get_item_enclosure($gitArrayValue)) {
			return $this->get_item_enclosure($gitArrayValue);
		}
		else return false;
	}

	// Get the enclosure of the item
	function get_item_enclosure($gitArrayValue) {
		return (isset($this->data['items'][$gitArrayValue]['enclosure'])) ? $this->data['items'][$gitArrayValue]['enclosure'] : false;
	}




	/****************************************************
	"ADD TO" LINKS
	Allows people to easily add news postings to social bookmarking sites.
	****************************************************/
	function add_to_delicious($gitArrayValue) {
		return 'http://del.icio.us/post/?v=3&amp;url=' . rawurlencode($this->get_item_permalink($gitArrayValue)) . '&amp;title=' . rawurlencode($this->get_item_title($gitArrayValue));
	}

	function add_to_newsvine($gitArrayValue) {
		return 'http://www.newsvine.com/_wine/save?u=' . rawurlencode($this->get_item_permalink($gitArrayValue)) . '&amp;h=' . rawurlencode($this->get_item_title($gitArrayValue));
	}




	/****************************************************
	SEARCHES
	Metadata searches
	****************************************************/
	function search_technorati($gitArrayValue) {
		return 'http://www.technorati.com/search/' . rawurlencode($this->get_item_permalink($gitArrayValue));
	}




	/****************************************************
	FIX PROTOCOL
	Convert feed:// and no-protocol URL's to http://
	Feed is allowed to have no protocol.  Local files are toggled in init().
	This is an internal function and is not intended to be used publically.

	$http=1, http://www.domain.com/feed.xml (absolute)
	$http=2, feed://www.domain.com/feed.xml (absolute)
	****************************************************/
	function fix_protocol($mp_feed_proto, $http = 1) {
		$url = $mp_feed_proto;

		// Swap out feed://http:// for http://-only
		if (stristr($mp_feed_proto, 'feed://http://')) {
			$url = substr_replace($mp_feed_proto, 'http://', 0, 14);
		}

		// Swap out feed:http:// for http://
		else if (stristr($mp_feed_proto, 'feed:http://' )) {
			$url = substr_replace($mp_feed_proto, 'http://', 0, 12);
		}

		// Swap out feed:// protocols in favor of http:// protocols
		else if (stristr($mp_feed_proto, 'feed://' )) {
			$url = substr_replace($mp_feed_proto, 'http://', 0, 7);
		}

		// Swap out feed:www. for http://www.
		else if (stristr($mp_feed_proto, 'feed:')) {
			$url = substr_replace($mp_feed_proto, 'http://', 0, 5);
		}

		// If it doesn't have http:// in it, and doesn't exist locally, add http://
		else if (!stristr($mp_feed_proto, 'http://') && !file_exists($mp_feed_proto)) {
			$url = "http://$url";
		}

		if ($http == 1) return $url;
		else if ($http == 2) {
			if (strstr($url, 'http://')) {
				$url = substr_replace($url, 'feed', 0, 4);
				return $url;
			}
			else return $url;
		}
	}




	/****************************************************
	AUTO DISCOVERY
	By Keith Devens <http://keithdevens.com/weblog/archive/2002/Jun/03/RSSAuto-DiscoveryPHP>
	Modified by Geoffrey Sneddon to redo the URL discovery, and allow protocols apart from http://
	This function enables support for RSS auto-discovery.
	****************************************************/
	function rss_discovery($html, $location) {
		if (!$html || !$location) {
			return false;
		} else {
			if (preg_match_all('/<link (.*)[\/]?>/siU', $html, $matches)) {
				foreach($matches[1] as $match) {
					if (preg_match('/type=[\'|"](application\/rss\+xml|application\/atom\+xml|application\/rdf\+xml|application\/xml\+rss|application\/xml\+atom|application\/xml\+rdf|application\/xml|text\/xml)[\'|"]/iU', $match, $type)) {
						if (preg_match('/href=[\'|"](.*)[\'|"]/iU', $match, $href)) {
							$href = $href[1];
							break;
						}
					}
				}
				if (!empty($href)) {
					if (stristr($href, 'http://') !== false) {
						return $href;
					} else {
						// otherwise, 'absolutize' it
						$url_parts = parse_url($location);

						$full_url = "$url_parts[scheme]://$url_parts[host]";

						if (isset($url_parts['port'])) {
							$full_url .= ":$url_parts[port]";
						}
						if ($href{0} != '/') {
							// it's a relative link on the domain
							$full_url .= dirname($url_parts['path']);

								if (substr($full_url, -1) != '/') {
								// if the last character isn't a '/', add it
								$full_url .= '/';
							}
						}
						$full_url .= $href;
						return $full_url;
					}
				}
			}
			return false;
		}
	}




	/****************************************************
	DELETE OUTDATED CACHE FILES
	By adam[at]roomvoter[dot]com
	This function deletes cache files that have not been used in a hour.
	****************************************************/
	function clear_cache($path, $max_minutes=60) {
		if (is_dir($path) ) {
			$handle = opendir($path);

			while (false !== ($file = readdir($handle))) {
				if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'spc') {
					$Diff = (time() - filemtime("$path/$file"))/60/60;
					if ($Diff > $max_minutes) unlink("$path/$file");
				}
			}
			closedir($handle);
		}
	}




	/****************************************************
	SEES IF A FILE IS WRITEABLE, OR CREATEABLE
	****************************************************/
	function is_writeable_createable($file) {
		if (file_exists($file))
			return is_writeable($file);
		else
			return is_writeable(dirname($file));
	}




	/****************************************************
	CALLBACK FUNCTIONS FOR PREG_REPLACE_CALLBACK
	****************************************************/
	function code_encode($regs) {
		return str_replace($regs[1], htmlspecialchars($regs[1]), $regs[0]);
	}

	function cdata_encode($regs) {
		return str_replace($regs[1], htmlentities($regs[1]), $regs[0]);
	}




	/****************************************************
	FUNCTIONS FOR XML_PARSE
	****************************************************/
	function startHandler($parser, $name, $attribs) {
		$this->tagName = $name;
		switch ($name) {
			case 'ITEM':
			case 'ENTRY':
				$this->insideItem = true;
				$this->descriptionPriority = 1000;
				$this->lastDescription = 1000;
				break;

			case 'CHANNEL':
				$this->insideChannel = true;
				break;

			case 'RSS':
				$this->data['feedinfo']['type'] = 'RSS';
				if (!empty($attribs['VERSION'])) {
					$this->data['feedinfo']['version'] = trim($attribs['VERSION']);
				}
				break;

			case 'RDF:RDF':
				$this->data['feedinfo']['type'] = 'RSS';
				$this->data['feedinfo']['version'] = 1;
				break;

			case 'FEED':
				$this->data['feedinfo']['type'] = 'Atom';
				if (!empty($attribs['VERSION'])) {
					$this->data['feedinfo']['version'] = trim($attribs['VERSION']);
				}
				if (!empty($attribs['XML:LANG'])) {
					$this->data['info']['language'] = html_entity_decode(trim($attribs['XML:LANG']));
				}
				break;

			case 'IMAGE':
				if ($this->insideChannel) $this->insideImage = true;
				break;

			case 'GUID':
				if (isset($attribs['ISPERMALINK']) && $attribs['ISPERMALINK'] == 'false') $this->useGuid = false;
				else $this->useGuid = true;
				break;
		}

		if ($this->data['feedinfo']['type'] == 'Atom') {
			switch ($name) {
				case 'AUTHOR':
					$this->insideAuthor = true;
					break;

				case 'LINK':
					if (!empty($attribs['HREF'])) {
						if ($this->insideItem) $this->data['items'][$this->itemNumber]['link'] = html_entity_decode(trim($attribs['HREF']));
						else $this->data['info']['link'] = html_entity_decode(trim($attribs['HREF']));
					}
					break;
			}
		}

		if ($this->insideItem) {
			if ($name == 'ENCLOSURE' || ($name == 'LINK' && isset($attribs['REL']) && strtolower($attribs['REL']) == 'enclosure')) {
				if (isset($attribs['TYPE']) && strpos($attribs['TYPE'], 'audio/') === 0) $use = true;
				else $use = false;

				if (!isset($attribs['TYPE']) || !$use) {
					if (isset($attribs['URL'])) $ext = pathinfo($attribs['URL'], PATHINFO_EXTENSION);
					else if (isset($attribs['HREF'])) $ext = pathinfo($attribs['HREF'], PATHINFO_EXTENSION);

					if (isset($ext)) {
						switch (strtolower($ext['extension'])) {
							case 'aif':
							case 'aifc':
							case 'aiff':
							case 'au':
							case 'funk':
							case 'gsd':
							case 'gsm':
							case 'it':
							case 'jam':
							case 'kar':
							case 'la':
							case 'lam':
							case 'lma':
							case 'm2a':
							case 'm3u':
							case 'mid':
							case 'midi':
							case 'mjf':
							case 'mod':
							case 'mp2':
							case 'mp3':
							case 'mpa':
							case 'mpg':
							case 'mpga':
							case 'my':
							case 'pfunk':
							case 'qcp':
							case 'ra':
							case 'ram':
							case 'rm':
							case 'rmm':
							case 'rmp':
							case 'rpm':
							case 's3m':
							case 'sid':
							case 'snd':
							case 'tsi':
							case 'tsp':
							case 'voc':
							case 'vox':
							case 'vqe':
							case 'vqf':
							case 'vql':
							case 'wav':
							case 'xm':
								$use = true;
								break;

							default:
								$use = false;
								break;
						}
					}
				}
				if (isset($use) && $use) {
					if (isset($attribs['URL'])) $this->data['items'][$this->itemNumber]['enclosure'] = $attribs['URL'];
					else if (isset($attribs['HREF'])) $this->data['items'][$this->itemNumber]['enclosure'] = $attribs['HREF'];
				}
			}
		}
	}

	function dataHandler($parser, $data) {
		if ($this->insideItem) {
			switch ($this->tagName) {
				case 'TITLE':
					$this->data['items'][$this->itemNumber]['title'] = html_entity_decode(trim($data));
				break;

				case 'CONTENT':
					if ($this->descriptionPriority > 0) {
						if ($this->lastDescription > 0)
							$this->data['items'][$this->itemNumber]['description'] = html_entity_decode($data);
						else
							$this->data['items'][$this->itemNumber]['description'] .= html_entity_decode($data);
						$this->lastDescription = 0;
					}
				break;

				case 'SUMMARY':
					if ($this->descriptionPriority > 1) {
						if ($this->lastDescription > 1)
							$this->data['items'][$this->itemNumber]['description'] = html_entity_decode($data);
						else
							$this->data['items'][$this->itemNumber]['description'] .= html_entity_decode($data);
						$this->lastDescription = 1;
					}
				break;

				case 'DC:DESCRIPTION':
					if ($this->descriptionPriority > 2) {
						if ($this->lastDescription > 2)
							$this->data['items'][$this->itemNumber]['description'] = html_entity_decode($data);
						else
							$this->data['items'][$this->itemNumber]['description'] .= html_entity_decode($data);
						$this->lastDescription = 2;
					}
				break;

				case 'LONGDESC':
					if ($this->descriptionPriority > 3) {
						if ($this->lastDescription > 3)
							$this->data['items'][$this->itemNumber]['description'] = html_entity_decode($data);
						else
							$this->data['items'][$this->itemNumber]['description'] .= html_entity_decode($data);
						$this->lastDescription = 3;
					}
				break;

				case 'DESCRIPTION':
					if ($this->descriptionPriority > 4) {
						if ($this->lastDescription > 4)
							$this->data['items'][$this->itemNumber]['description'] = html_entity_decode($data);
						else
							$this->data['items'][$this->itemNumber]['description'] .= html_entity_decode($data);
						$this->lastDescription = 4;
					}
				break;

				case 'LINK':
					$this->data['items'][$this->itemNumber]['link'] = html_entity_decode(trim($data));
				break;

				case 'GUID':
					if ($this->useGuid) $this->data['items'][$this->itemNumber]['guid'] = html_entity_decode(trim($data));
				break;

				case 'PUBDATE':
				case 'DC:DATE':
				case 'ISSUED':
				case 'PUBLISHED':
					$data = trim($data);
					$this->data['items'][$this->itemNumber]['date'] = (stristr($data, '-')) ? strtotime(preg_replace('%(\-|\+)[0-1][0-9](:?)[0-9][0-9]%', '', str_replace('Z', '', $data))) : strtotime($data);
				break;

				case 'CATEGORY':
				case 'DC:SUBJECT':
					$this->data['items'][$this->itemNumber]['category'] = html_entity_decode(trim($data));
				break;

				case 'DC:CREATOR':
					$this->data['items'][$this->itemNumber]['author'][] = html_entity_decode(trim($data));
				break;

				case 'AUTHOR':
					if ($this->data['feedinfo']['type'] != 'Atom') $this->data['items'][$this->itemNumber]['author'][] = html_entity_decode(trim($data));
				break;
			}

			if ($this->insideAuthor) {
				if ($this->tagName == 'NAME') $this->data['items'][$this->itemNumber]['author'][] = html_entity_decode(trim($data));
			}
		}

		else if ($this->insideChannel) {
			switch ($this->tagName) {
				case 'TITLE':
					$this->data['info']['name'] = html_entity_decode(trim($data));
				break;

				case 'LINK':
					$this->data['info']['link'] = html_entity_decode(trim($data));
				break;

				case 'DESCRIPTION':
				case 'TAGLINE':
				case 'SUBTITLE':
					$this->data['info']['description'] = html_entity_decode(trim($data));
				break;

				case 'COPYRIGHT':
					$this->data['info']['copyright'] = html_entity_decode(trim($data));
				break;

				case 'LANGUAGE':
				case 'DC:LANGUAGE':
					$this->data['info']['language'] = html_entity_decode(trim($data));
				break;
			}
			if ($this->insideImage) {
				switch ($this->tagName) {
					case 'TITLE':
						$this->data['info']['image']['title'] = html_entity_decode(trim($data));
					break;

					case 'URL':
						$this->data['info']['image']['url'] = html_entity_decode(trim($data));
					break;

					case 'LINK':
						$this->data['info']['image']['link'] = html_entity_decode(trim($data));
					break;

					case 'WIDTH':
						$this->data['info']['image']['width'] = html_entity_decode(trim($data));
					break;

					case 'HEIGHT':
						$this->data['info']['image']['height'] = html_entity_decode(trim($data));
					break;
				}
			}
		}

		else if (!$this->insideItem && $this->data['feedinfo']['type'] == 'Atom') {
			switch ($this->tagName) {
				case 'TITLE':
					$this->data['info']['name'] = html_entity_decode(trim($data));
				break;

				case 'TAGLINE':
					$this->data['info']['description'] = html_entity_decode(trim($data));
				break;

				case 'COPYRIGHT':
					$this->data['info']['copyright'] = html_entity_decode(trim($data));
				break;
			}
		}
	}

	function endHandler($parser, $name) {
		$this->tagName = '';
		switch ($name) {
			case 'CONTENT':
				$this->descriptionPriority = 0;
			break;
			case 'SUMMARY':
				$this->descriptionPriority = 1;
			break;
			case 'DC:DESCRIPTION':
				$this->descriptionPriority = 2;
			break;
			case 'LONGDESC':
				$this->descriptionPriority = 3;
			break;
			case 'DESCRIPTION':
				$this->descriptionPriority = 4;
			break;
			case 'ITEM':
			case 'ENTRY':
				$this->insideItem = false;
				$this->itemNumber++;
			break;

			case 'CHANNEL':
				$this->insideChannel = false;
			break;

			case 'IMAGE':
				if ($this->insideChannel) $this->insideImage = false;
			break;

			case 'AUTHOR':
				if ($this->data['feedinfo']['type'] == 'Atom') $this->insideAuthor = false;
			break;
		}
	}
}

?>
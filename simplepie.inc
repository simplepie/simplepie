<?php
/****************************************************
SIMPLE PIE
A Simple PHP-Based RSS/Atom Parser
Simplifies the process of displaying the values of commonly used feed tags.

Version: 0.95
Updated: 10 October 2004
Copyleft: 2004, Ryan Parman
http://www.skyzyx.com/projects/simplepie/

Free for any and all purposes.  I only ask that I be given credit 
for the work I've done in all future versions and derivative works.

Please see release notes for information on code that was borrowed 
from other open-source projects.
****************************************************/


/****************************************************
GLOBAL VARIABLES
Will be used later on.
****************************************************/
$true_rss_url="";




/****************************************************
SIMPLEPIE INFORMATION
****************************************************/
define("SP_NAME", "SimplePie");
define("SP_VERSION", "0.95");
define("SP_BUILD", "20041010");
define("SP_URL", "http://www.skyzyx.com/projects/simplepie/");
define("SP_USERAGENT", SP_NAME . '/' . SP_VERSION . ' (RSS Parser; ' . SP_URL . ') Build/' . SP_BUILD);




/****************************************************
SIMPLEPIE INFORMATION PUBLIC FUNCTIONS
****************************************************/
function sp_name() { return SP_NAME; }
function sp_version() { return SP_VERSION; }
function sp_url() { return SP_URL; }
function sp_build() { return SP_BUILD; }
function sp_useragent() { return SP_USERAGENT; }

function sp_linkback() {
	$linkback = '<a href="' . SP_URL . '" title="' . SP_NAME . ' ' . SP_VERSION . '">' . SP_NAME . ' ' . SP_VERSION . '</a>';
	return $linkback;
}




/****************************************************
MAIN SIMPLEPIE FUNCTION
Validates the file location and creates an array.
****************************************************/
function simplepie($rss_feed, $enable_debug=false, $enable_caching=true, $max_days=7, $replace_headers=false) {
	// Testing Modes
	// $enable_debug = true;
	// $enable_caching = false;
	// $replace_headers = true;

	// Fix any protocol formatting problems.
	$rss_feed=fix_protocol($rss_feed);

	// Set the global variable with this value so that
	// get_feed_url() and get_feedproto_url() can access the unprocessed URL.
	$GLOBALS["true_rss_url"] = $rss_feed;

	// Return the User-Agent string to the website's logs.
	ini_set('user_agent', SP_USERAGENT); 

	clear_cache("./cache", $max_days);

	if ($rss_feed) {
		// Read the XML file (up to 1 MB - 1048576) for processing.
		if ($enable_caching && substr($rss_feed, 0, 7) == "http://") { $mp_rss = fread(cached_fopen($rss_feed, "r"), 1048576); }
		else { $mp_rss = fread(fopen($rss_feed, "r"), 1048576); }

		// Check if file is a feed or a webpage
		// If it's a webpage, auto-discover the feed and re-pass it to simplepie()
		$html_file = stristr($mp_rss, "<html");
		if ($html_file) {
			$new_feed_url = rss_discovery($mp_rss, $rss_feed);
			return simplepie($new_feed_url);
		}

		// Strip out all CDATA tags
		$mp_rss = str_replace("<![CDATA[", "", $mp_rss);
		$mp_rss = str_replace("]]>", "", $mp_rss);

		// Add CDATA for <description>
		$mp_rss = preg_replace("%<descriptio[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i","<description></description>",$mp_rss);
		$mp_rss = preg_replace("%<description(.|\s)*?>%i","<description\\0<![CDATA[",$mp_rss);
		$mp_rss = str_replace("<description<description", "<description", $mp_rss);
		$mp_rss = preg_replace("%</description>%i","]]></description>",$mp_rss);

		// Add CDATA for <tagline>
		$mp_rss = preg_replace("%<taglin[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i","<tagline></tagline>",$mp_rss);
		$mp_rss = preg_replace("%<tagline(.|\s)*?>%i","<tagline\\0<![CDATA[",$mp_rss);
		$mp_rss = str_replace("<tagline<tagline", "<tagline", $mp_rss);
		$mp_rss = preg_replace("%</tagline>%i","]]></tagline>",$mp_rss);

		// Add CDATA for <summary>
		$mp_rss = preg_replace("%<summar[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i","<summary></summary>",$mp_rss);
		$mp_rss = preg_replace("%<summary(.|\s)*?>%i","<summary\\0<![CDATA[",$mp_rss);
		$mp_rss = str_replace("<summary<summary", "<summary", $mp_rss);
		$mp_rss = preg_replace("%</summary>%i","]]></summary>",$mp_rss);

		// Add CDATA for <content>
		$mp_rss = str_replace("content:encoded", "content", $mp_rss);
		$mp_rss = preg_replace("%<conten[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i","<content></content>",$mp_rss);
		$mp_rss = preg_replace("%<content(.|\s)*?>%i","<content\\0<![CDATA[",$mp_rss);
		$mp_rss = str_replace("<content<content", "<content", $mp_rss);
		$mp_rss = preg_replace("%</content>%i","]]></content>",$mp_rss);

		// Add CDATA for <title>
		$mp_rss = preg_replace("%<titl[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i","<title></title>",$mp_rss);
		$mp_rss = preg_replace("%<title(.|\s)*?>%i","<title\\0<![CDATA[",$mp_rss);
		$mp_rss = str_replace("<title<title", "<title", $mp_rss);
		$mp_rss = preg_replace("%</title>%i","]]></title>",$mp_rss);

		// Add CDATA for <guid>
		$mp_rss = preg_replace("%<gui[^>/]+((\"[^\"]*\")|(\'[^\']*\')|([^>/]*))((\s*)|([^\s]))/>%i","<guid></guid>",$mp_rss);
		$mp_rss = preg_replace("%<guid(.|\s)*?>%i","<guid\\0<![CDATA[",$mp_rss);
		$mp_rss = str_replace("<guid<guid", "<guid", $mp_rss);
		$mp_rss = preg_replace("%</guid>%i","]]></guid>",$mp_rss);

		// Add CDATA for <link> (safe)
		$mp_rss = preg_replace("/<link>/i","<link><![CDATA[",$mp_rss);
		$mp_rss = preg_replace("/<\/link>/i","]]></link>",$mp_rss);

		// Replace angle-bracket entities with their real characters.
		$mp_rss = str_replace("&amp;","&",$mp_rss);
		$mp_rss = str_replace("&lt;","<",$mp_rss);
		$mp_rss = str_replace("&gt;",">",$mp_rss);
		$mp_rss = str_replace("&quot;",'"',$mp_rss);

		// Fix tags inside code and pre tags.
		$mp_rss = preg_replace_callback("|<code>(.*)<\/code>|Uis", 'code_encode', $mp_rss);
		$mp_rss = preg_replace_callback("|<pre>(.*)<\/pre>|Uis", 'code_encode', $mp_rss);

		// Respect line breaks for <pre> content.
		$mp_rss = preg_replace_callback("|<pre>(.*)<\/pre>|Uis", 'pre_linebreaks', $mp_rss);

		// Strip out HTML tags that might cause various security problems.
		// Based on recommendations by Mark Pilgrim at:
		// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
		$tags_to_strip = array(
			"html",
			"body",
			"script",
			"noscript",
			"embed",
			"object",
			"frameset",
			"frame",
			"iframe",
			"meta",
			"style",
			"param",
			"doctype",
			"form", 
			"input", 
			"blink",
			"marquee",
			"font"
		);
		foreach ($tags_to_strip as $tag) {
			$mp_rss = preg_replace("/<\/?" . $tag . "(.|\s)*?>/i","",$mp_rss);
		}

		// Strip out HTML attributes that might cause various security problems.
		// Based on recommendations by Mark Pilgrim at:
		// http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely
		$stripAttrib = "' (style|id|class)=\"(.*?)\"'i";
		$mp_rss = preg_replace($stripAttrib, '', $mp_rss);

		// Swap out problematic characters.
		$mp_rss = str_replace("﻿", "", $mp_rss); // UTF-8 BOM
		$mp_rss = preg_replace("/�|�|–|—/", "--", $mp_rss); // em/en dash
		$mp_rss = preg_replace("/�|�|’|‘;/", "'", $mp_rss); // single-quotes
		$mp_rss = preg_replace("/�|�|“|�/", '"', $mp_rss); // double-quotes
		$mp_rss = preg_replace("/�/", "", $mp_rss); // bad character

		// Swap out funky characters with their named entities.
		// Code is from Feedsplitter at chxo.com
		$mp_rss = preg_replace(array("/\&([a-z\d\#]+)\;/i",
			"/\&/",
			"/\#\|\|([a-z\d\#]+)\|\|\#/i",
			"/(\=\"\-\/\%\?\!\'\(\)\[\\{\}\ \#\+\,\@_])/e"
			),
			array("#||\\1||#",
			"&amp;",
			"&\\1;",
			"'&#'.ord('\\1').';'"
			),
			$mp_rss
		);

		if ($replace_headers) {
			// Replace H1, H2, and H3 tags with the less important H4 tags.
			// This is because on a site, the more important headers might make sense,
			// but it most likely doesn't fit in the context of RSS-in-a-webpage.
			$mp_rss = preg_replace("/<h[1-3](.|\s)*?>/i","<h4>",$mp_rss);
			$mp_rss = preg_replace("/<\/h[1-3](.|\s)*?>/i","</h4>",$mp_rss);
		}

		// Find the domain name of the feed being read.
		$feed_path = split("/", preg_replace("/http:\/\//", "", $rss_feed));
		$feed_host = $feed_path[0];

		// Change certain types of relative URL's into absolute URL's
		$mp_rss = str_replace('href="/', 'href="http://' . $feed_host . '/', $mp_rss);
		$mp_rss = str_replace('href=&quot;/', 'href="http://' . $feed_host . '/', $mp_rss);
		$mp_rss = str_replace('src="/', 'src="http://' . $feed_host . '/', $mp_rss);
		$mp_rss = str_replace('src=&quot;/', 'src="http://' . $feed_host . '/', $mp_rss);

		// If debug is on, send feed to the page.
		if ($enable_debug) {
			echo "************************************************************\n";
			echo $mp_rss . "\n";
			echo "************************************************************\n";
		}

		// XMLize the corrected XML file and return it.
		$mp_rss = _xmlize($mp_rss);
		return $mp_rss;
	}
	else return false;
}




/****************************************************
GET FEED VERSION NUMBER
****************************************************/
function get_version($rss_feed) {
	$feed_type_version = "";

	if (@ $rss_feed["rss"]) {
		$feed_type="RSS";
		$feed_version=$rss_feed["rss"]["@"]["version"];
		$feed_type_version = $feed_type . " " . $feed_version;
		return $feed_type_version;
	}
	else if (@ $rss_feed["rdf:RDF"]) {
		$feed_type="RSS";
		$feed_version="1.0";
		$feed_type_version = $feed_type . " " . $feed_version;
		return $feed_type_version;
	}
	else if (@ $rss_feed["feed"]) {
		$feed_type="Atom";
		$feed_version=$rss_feed["feed"]["@"]["version"];
		$feed_type_version = $feed_type . " " . $feed_version;
		return $feed_type_version;
	}
	else return false;
}




/****************************************************
ECHO FEED URL
This may seem trivial, and it may be, but it also might be useful.
****************************************************/
function get_feed_url() {
	$temp = fix_protocol($GLOBALS["true_rss_url"], 1);
	if (strstr($temp, "../")) {
		$retVal=substr_replace($temp, "", 0, 3);
		return $retVal;
	}
	else return $temp;
}

function get_feedproto_url() {
	return fix_protocol($GLOBALS["true_rss_url"], 2);
}




/****************************************************
PARSE OUT GENERAL FEED-RELATED DATA
****************************************************/
// Reads the feed's title
function get_feed_title($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["title"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["title"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["title"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Reads the feed's link (URL)
function get_feed_link($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["link"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["link"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["link"][0]["@"]["href"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Reads the feed's description (RSS) or tagline (Atom)
function get_feed_description($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["description"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["description"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["tagline"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Reads the feed's copyright information.
function get_feed_copyright($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["copyright"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["copyright"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["copyright"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Reads the feed's language (via language or dc:language)
function get_feed_language($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["language"][0]["#"];
	@ $rss_var2 = $rss_feed["rss"]["#"]["channel"][0]["#"]["dc:language"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["language"][0]["#"];
	@ $rdf_var2 = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["dc:language"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["@"]["xml:lang"];

	if ($rss_var) return $rss_var;
	else if ($rss_var2) return $rss_var2;
	else if ($rdf_var) return $rdf_var;
	else if ($rdf_var2) return $rdf_var2;
	else if ($atom_var) return $atom_var;
	else return false;
}




/****************************************************
PARSE OUT IMAGE-RELATED DATA
Apparently Atom doesn't have feed images.
****************************************************/
// Check if an image element exists (returns true/false)
function get_image_exist($rss_feed) {
	if (@ $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]) return true;
	else if (@ $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]) return true;
	else return false;
}

// Get the image title (to be used in alt and/or title)
function get_image_title($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["title"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["title"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else return false;
}

// The path to the actual image
function get_image_url($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["url"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["url"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else return false;
}

// The URL that the image is supposed to link to.
function get_image_link($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["link"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["link"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else return false;
}

// Get the image width
function get_image_width($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["width"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["width"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else return false;
}

// Get the image height
function get_image_height($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["height"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["height"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else return false;
}




/****************************************************
PARSE OUT ITEM-RELATED DATA
Most of these have two parameters: position in array, feed object
****************************************************/
// Get the size of the array of items (for use in a for-loop)
function get_item_quantity($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"];

	if ($rss_var) return sizeof($rss_var);
	else if ($rdf_var) return sizeof($rdf_var);
	else if ($atom_var) return sizeof($atom_var);
	else return false;
}

// Get the title of the item
function get_item_title($gitArrayValue, $rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["title"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["title"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["title"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Get the description of the item
function get_item_description($gitArrayValue, $rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["content"][0]["#"];
	@ $rss_var2 = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["description"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["content"][0]["#"];
	@ $rdf_var2 = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["description"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["content"][0]["#"];
	@ $atom_var2 = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["summary"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rss_var2) return $rss_var2;
	else if ($rdf_var) return $rdf_var;
	else if ($rdf_var2) return $rdf_var2;
	else if ($atom_var) return $atom_var;
	else if ($atom_var2) return $atom_var2;
	else return false;
}

// Get the category of the item
function get_item_category($gitArrayValue, $rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["category"][0]["#"];
	@ $rss_var2 = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["dc:subject"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["category"][0]["#"];
	@ $rdf_var2 = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["dc:subject"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["category"][0]["#"];
	@ $atom_var2 = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["dc:subject"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rss_var2) return $rss_var2;
	else if ($rdf_var) return $rdf_var;
	else if ($rdf_var2) return $rdf_var2;
	else if ($atom_var) return $atom_var;
	else if ($atom_var2) return $atom_var2;
	else return false;
}

// Get the author of the item
function get_item_author($gitArrayValue, $rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["author"][0]["#"];
	@ $rss_var2 = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["dc:creator"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["author"][0]["#"];
	@ $rdf_var2 = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["dc:creator"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["author"][0]["#"]["name"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rss_var2) return $rss_var2;
	else if ($rdf_var) return $rdf_var;
	else if ($rdf_var2) return $rdf_var2;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Get the date of the item
function get_item_date($gitArrayValue, $rss_feed, $date_format = "j F Y, g:i a") {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["pubDate"][0]["#"];
	@ $rss_var2 = $rss_feed["rss"]["#"]["item"][$gitArrayValue]["#"]["pubdate"][0]["#"];
	@ $rss_var3 = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["dc:date"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["dc:date"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["issued"][0]["#"];

	if ($rss_var) {
		if ($date_format) {
			if (stristr($rss_var, "-")) $rss_var = date($date_format, strtotime(preg_replace("%(\-|\+)[0-1][0-9][:*][0-9][0-9]%", "", str_replace("Z", "", $rss_var))));
			else $rss_var = date($date_format, strtotime($rss_var));
		}
		return $rss_var;
	}
	else if ($rss_var2) {
		if ($date_format) {
			if (stristr($rss_var2, "-")) $rss_var2 = date($date_format, strtotime(preg_replace("%(\-|\+)[0-1][0-9][:*][0-9][0-9]%", "", str_replace("Z", "", $rss_var2))));
			else $rss_var2 = date($date_format, strtotime($rss_var2));
		}
		return $rss_var2;
	}
	else if ($rss_var3) {
		if ($date_format) {
			if (stristr($rss_var3, "-")) $rss_var3 = date($date_format, strtotime(preg_replace("%(\-|\+)[0-1][0-9][:*][0-9][0-9]%", "", str_replace("Z", "", $rss_var3))));
			else $rss_var3 = date($date_format, strtotime($rss_var3));
		}
		return $rss_var3;
	}
	else if ($rdf_var) {
		if ($date_format) {
			if (stristr($rdf_var, "-")) $rdf_var = date($date_format, strtotime(preg_replace("%(\-|\+)[0-1][0-9][:*][0-9][0-9]%", "", str_replace("Z", "", $rdf_var))));
			else $rdf_var = date($date_format, strtotime($rdf_var));
		}
		return $rdf_var;
	}
	else if ($atom_var) {
		if ($date_format) {
			if (stristr($atom_var, "-")) $atom_var = date($date_format, strtotime(preg_replace("%(\-|\+)[0-1][0-9][:*][0-9][0-9]%", "", str_replace("Z", "", $atom_var))));
			else $atom_var = date($date_format, strtotime($atom_var));
		}
		return $atom_var;
	}
	else return false;
}

// Get the Permalink of the item (checks for link, then guid)
function get_item_permalink($gitArrayValue, $rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["link"][0]["#"];
	@ $rss_var2 = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["guid"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["link"][0]["#"];
	@ $rdf_var2 = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["@"]["rdf:about"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["link"][0]["@"]["href"];

	if ($rss_var) return $rss_var;
	else if ($rss_var2) return $rss_var2;
	else if ($rdf_var) return $rdf_var;
	else if ($rdf_var2) return $rdf_var2;
	else if ($atom_var) return $atom_var;
	else return false;
}



/****************************************************
FIX PROTOCOL
XMLize only understands the http:// protocol.
Convert feed:// and no-protocol URL's to http://
Feed is allowed to have no protocol as long as it begins with "www.".
This is an internal function and is not intended to be used publically.

$http=1, http://www.domain.com/feed.xml (absolute)
$http=2, feed://www.domain.com/feed.xml (absolute)
****************************************************/
function fix_protocol($mp_feed_proto, $http=1) {
	$url = $mp_feed_proto;

	// Swap out feed://http:// for http://-only
	if ( stristr( $mp_feed_proto, 'feed://http://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 14 );
	}

	// Swap out feed:http:// for http://
	else if ( stristr( $mp_feed_proto, 'feed:http://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 12 );
	}

	// Swap out feed:// protocols in favor of http:// protocols, which SimplePie can parse.
	else if ( stristr( $mp_feed_proto, 'feed://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 7 );
	}

	// Swap out feed:www. for http://www.
	else if ( stristr( $mp_feed_proto, 'feed:' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 5 );
	}

	// Swap out feed:www. for http://www.
	else if ( substr($mp_feed_proto, 0, 4) == "www." ) {
		$url = substr_replace( $mp_feed_proto, 'http://www.', 0, 4 );
	}

	if ($http == 1) return $url;
	else if ($http == 2) {
		if (strstr($url, "http://")) {
			$url = substr_replace( $url, 'feed', 0, 4 );
			return $url;
		}
		else return $url;
	}
}




/****************************************************
CACHED FOPEN
By zwiskle[at]vol[dot]at, posted at http://us2.php.net/function.fopen
This is a basic, lightweight, caching system that checks for freshness.
This is an internal function and is not intended to be used publically.
****************************************************/
// cache a (http) fopen - with cache-timeout.
function cached_fopen($file, $file_mode, $timeout_seconds = 3600, $cache_path = "./cache") {
	$debug=false;
	clearstatcache();

	$cache_filename=$cache_path . "/" . urlencode($file) .".cached";

	if ($debug) { print "<p>local_cache creation_time =" . @filemtime($cache_filename) . " actual time = " . time() . " timeout = " . $timeout_seconds ."</p>";}

	if ( ( @file_exists($cache_filename ) and ( ( @filemtime($cache_filename) + $timeout_seconds) > ( time() ) ) ) ) {
		// ok, file is already cached and young enough
		if ($debug) { print "<p>using cached file ($cache_filename)</p>";}
	}
	else {
		if ($debug) { print "<p>caching file ($file) to local ($cache_filename)</p>";}

		// cache file from net to local
		$f = fopen($file,"r");
		$f2 = fopen($cache_filename,"w+");

		while ($r=fread($f, 1048576) ) {
			fwrite($f2,$r);
		}

		fclose($f2);
		fclose($f);
	}

	// ok, point to (fresh) cached file
	$handle = fopen($cache_filename, $file_mode);
	return $handle;
}




/****************************************************
XMLIZE
By Hans Anderson, www.hansanderson.com/php/xml/
This is an internal function and is not intended to be used publically.
****************************************************/
function _xmlize($data, $WHITE=1) {
	$data = trim($data);
	$vals = $index = $array = array();
	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, $WHITE);
	xml_parse_into_struct($parser, $data, $vals, $index);
	xml_parser_free($parser);

	$i = 0; 

	$tagname = $vals[$i]['tag'];
	if ( isset ($vals[$i]['attributes'] ) ) {
		$array[$tagname]['@'] = $vals[$i]['attributes'];
	}
	else {
		$array[$tagname]['@'] = array();
	}
	$array[$tagname]["#"] = _xml_depth($vals, $i);
	return $array;
}




/****************************************************
XML DEPTH
By Hans Anderson, www.hansanderson.com/php/xml/
This function is called by xmlize() to parse through deeper XML nodes.
This is an internal function and is not intended to be used publically.
****************************************************/
function _xml_depth($vals, &$i) { 
	$children = array(); 

	if ( isset($vals[$i]['value']) ) {
		array_push($children, $vals[$i]['value']);
	}

	while (++$i < count($vals)) { 
		switch ($vals[$i]['type']) { 
		   case 'open': 
				if ( isset ( $vals[$i]['tag'] ) ) {
					$tagname = $vals[$i]['tag'];
				}
				else {
					$tagname = '';
				}

				if ( isset ( $children[$tagname] ) ) {
					$size = sizeof($children[$tagname]);
				}
				else {
					$size = 0;
				}

				if ( isset ( $vals[$i]['attributes'] ) ) {
					$children[$tagname][$size]['@'] = $vals[$i]["attributes"];
				}

				$children[$tagname][$size]['#'] = _xml_depth($vals, $i);
			break; 

			case 'cdata':
				array_push($children, $vals[$i]['value']); 
			break; 

			case 'complete': 
				$tagname = $vals[$i]['tag'];

				if( isset ($children[$tagname]) ) {
					$size = sizeof($children[$tagname]);
				}
				else {
					$size = 0;
				}

				if( isset ( $vals[$i]['value'] ) ) {
					$children[$tagname][$size]["#"] = $vals[$i]['value'];
				}
				else {
					$children[$tagname][$size]["#"] = '';
				}

				if ( isset ($vals[$i]['attributes']) ) {
					$children[$tagname][$size]['@'] = $vals[$i]['attributes'];
				}
			break; 

			case 'close':
				return $children; 
			break;
		} 
	} 
	return $children;
}




/****************************************************
TRAVERSE XMLIZE
By acebone[at]f2s[dot]com, part of the XMLize library.
This helps you understand the structure of the array xmlize() outputs.
*****************************************************
Usage:
$xml = fread(fopen("somefile.xml", "r"), 8192);
_traverse_xmlize(_xmlize($xml), "xml");
print '<pre>' . implode("", $traverse_array) . '</pre>';
****************************************************/
function _traverse_xmlize($array, $arrName = "array", $level = 0) {
	foreach($array as $key=>$val) {
		if ( is_array($val) ) {
			_traverse_xmlize($val, $arrName . "[" . $key . "]", $level + 1);
		}
		else {
			$GLOBALS['traverse_array'][] = '$' . $arrName . '[' . $key . '] = "' . $val . "\"\n";
		}
	}
	return 1;
}




/****************************************************
AUTO DISCOVERY
By Keith Devens <http://keithdevens.com/weblog/archive/2002/Jun/03/RSSAuto-DiscoveryPHP>
This function enables support for RSS auto-discovery.
****************************************************/
function rss_discovery($html, $location) {
	if (!$html or !$location) {
		return false;
	}
	else {
		// Search through the HTML, save all <link> tags
		// and store each link's attributes in an associative array
		preg_match_all('/<link\s+(.*?)\s*\/?>/si', $html, $matches);
		$links = $matches[1];
		$final_links = array();
		$link_count = count($links);

		for ($n=0; $n<$link_count; $n++) {
			$attributes = preg_split('/\s+/s', $links[$n]);

			foreach ($attributes as $attribute) {
				$att = preg_split('/\s*=\s*/s', $attribute, 2);

				if (isset($att[1])) {
					$att[1] = preg_replace('/([\'"]?)(.*)\1/', '$2', $att[1]);
					$final_link[strtolower($att[0])] = $att[1];
				}
			}
			$final_links[$n] = $final_link;
		}

		// Now figure out which one points to the RSS file.
		// Modified by Ryan Parman to also support Atom and RSS 1.0 mime-types.
		for($n=0; $n<$link_count; $n++) {
			if (strtolower($final_links[$n]['rel']) != '') {
				if (strtolower($final_links[$n]['type']) == 'application/rss+xml' || 
					strtolower($final_links[$n]['type']) == 'application/atom+xml' || 
					strtolower($final_links[$n]['type']) == 'application/rdf+xml' || 
					strtolower($final_links[$n]['type']) == 'application/xml+rss' || 
					strtolower($final_links[$n]['type']) == 'application/xml+atom' || 
					strtolower($final_links[$n]['type']) == 'application/xml+rdf' || 
					strtolower($final_links[$n]['type']) == 'application/xml'
					) {

					$href = $final_links[$n]['href'];
				}

				if (!$href and strtolower($final_links[$n]['type']) == 'text/xml') {
					// kludge to make the first version of this still work
					$href = $final_links[$n]['href'];
				}

				if ($href) {
					if (strstr($href, "http://") !== false) {
						// if it's absolute
						$full_url = $href;
					}
					else{
						#otherwise, 'absolutize' it
						$url_parts = parse_url($location);

						#only made it work for http:// links. Any problem with this?
						$full_url = "http://$url_parts[host]";

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
					}
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
This function deletes cache files that have not been used in a week.
****************************************************/
function clear_cache($path, $max_days=7) {
	if (is_dir("$path") ) {
		$handle=opendir($path);

		while (false!==($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				$Diff = (time() - filectime("$path/$file"))/60/60/24;
				if ($Diff > $max_days) unlink("$path/$file");
			}
		}
		closedir($handle);
	}
}




/****************************************************
CALLBACK FUNCTIONS FOR PREG_REPLACE_CALLBACK
****************************************************/
function code_encode($regs) {
	return str_replace($regs[1], htmlspecialchars($regs[1]), $regs[0]);
}

function pre_linebreaks($regs) {
	return str_replace($regs[1], nl2br($regs[1]), $regs[0]);
}
?>

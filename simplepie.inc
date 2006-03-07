<?php
/****************************************************
SIMPLE PIE
A Simple API for Magpie RSS 0.61+
Simplifies the process of displaying commonly used feed tags.

Version: 0.8
Updated: 20 July 2004
Copyleft: 2004, Ryan Parman
http://www.skyzyx.com/projects/simplepie/

Free for any and all purposes.  I only ask that I be given credit 
for the work I've done in all future versions and derivative works.

This software uses and interacts with the following software:
- Magpie RSS by Kellan Elliott-McCrea, www.laughingmeme.org
- XMLize by Hans Anderson, www.hansanderson.com
****************************************************/


/****************************************************
IMPORT MAGPIE LIBRARIES AND XMLIZE
****************************************************/
require_once("rss_cache.inc");
require_once("rss_fetch.inc");
require_once("rss_parse.inc");
require_once("rss_utils.inc");
require_once("xmlize.inc");




/****************************************************
CHECKS FOR THE VALIDITY OF THE FEED BEFORE PARSING.
****************************************************/
function simplepie($rss_feed) {
	@ $valid=fopen($rss_feed, "r");

	if ($valid) return $rss_feed;
	else return false;
}




/****************************************************
GET FEED VERSION NUMBER
****************************************************/
function get_version($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);
	$feed_type_version = "";

	if (@ $rss_feed->is_rss()) {
		$feed_type="RSS";
		$feed_version=$rss_feed->is_rss();
		$feed_type_version = $feed_type . " " . $feed_version;
		return $feed_type_version;
	}
	else if (@ $rss_feed->is_atom()) {
		$feed_type="Atom";
		$feed_version=$rss_feed->is_atom();
		$feed_type_version = $feed_type . " " . $feed_version;
		return $feed_type_version;
	}
	else return false;
}




/****************************************************
ECHO FEED URL
This may seem trivial, and it may be, but it also might be useful.
****************************************************/
function get_feed_url($rss_feed) {
	if ($rss_feed) {
		return fix_protocol($rss_feed, 1);
	}
	else return false;
}

function get_feedproto_url($rss_feed) {
	if ($rss_feed) {
		return fix_protocol($rss_feed, 2);
	}
	else return false;
}




/****************************************************
PARSE OUT GENERAL FEED-RELATED DATA
****************************************************/
// Reads the feed's title
function get_feed_title($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->channel['title']) {
		return $rss_feed->channel['title'];
	}
	else return false;
}

// Reads the feed's link (URL)
function get_feed_link($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->channel['link']) {
		return $rss_feed->channel['link'];
	}
	else return false;
}

// Reads the feed's description (RSS) or tagline (Atom)
function get_feed_description($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->channel['description']) {
		return  $rss_feed->channel['description'];
	}
	else if ($rss_feed->channel['tagline']) {
		return $rss_feed->channel['tagline'];
	}
	else return false;
}

// Reads the feed's copyright information.
function get_feed_copyright($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->channel['copyright']) {
		return $rss_feed->channel['copyright'];
	}
	else return false;
}

// Reads the feed's language (via language or dc:language)
function get_feed_language($rss_feed) {
	// XMLize it
	@ $usexmllang = $rss_feed;
	@ $xlangfeed = get_xmlized_feed($usexmllang);
	@ $xlang = $xlangfeed["feed"]["@"]["xml:lang"];

	@ $rss_feed = get_feed($rss_feed);

	if (@ $rss_feed->channel['language']) {
		return $rss_feed->channel['language'];
	}
	else if (@ $rss_feed->channel['dc']['language']) {
		return $rss_feed->channel['dc']['language'];
	}
	else if ($xlang) {
		return $xlang;
	}
	else return false;
}




/****************************************************
PARSE OUT IMAGE-RELATED DATA
****************************************************/
// Check if an image element exists (returns true/false)
function get_image_exist($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->image) return true;
	else return false;
}

// Get the image title (to be used in alt and/or title)
function get_image_title($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->image) {
		if ($rss_feed->image['title']) {
			return $rss_feed->image['title'];
		}
		else return false;
	}
	else return false;
}

// The path to the actual image
function get_image_url($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->image) {
		if ($rss_feed->image['url']) {
			return $rss_feed->image['url'];
		}
		else return false;
	}
	else return false;
}

// The URL that the image is supposed to link to.
function get_image_link($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->image) {
		if ($rss_feed->image['link']) {
			return $rss_feed->image['link'];
		}
		else return false;
	}
	else return false;
}

// Get the image width
function get_image_width($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->image) {
		if ($rss_feed->image['width']) {
			return $rss_feed->image['width'];
		}
		else return false;
	}
	else return false;
}

// Get the image height
function get_image_height($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->image) {
		if ($rss_feed->image['height']) {
			return $rss_feed->image['height'];
		}
		else return false;
	}
	else return false;
}




/****************************************************
PARSE OUT ITEM-RELATED DATA
Most of these have two parameters: position in array, feed object
****************************************************/
// Get the size of the array of items (for use in a for-loop)
function get_item_quantity($rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	return sizeof($rss_feed->items);
}

// Get the title of the item
function get_item_title($gitArrayValue, $rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->items[$gitArrayValue]['title']) {
		return $rss_feed->items[$gitArrayValue]['title'];
	}
	else return false;
}

// Get the description of the item
function get_item_description($gitArrayValue, $rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->items[$gitArrayValue]['description']) {
		return $rss_feed->items[$gitArrayValue]['description'];
	}
	else return false;
}

// Get the category of the item
function get_item_category($gitArrayValue, $rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->items[$gitArrayValue]['category']) {
		return $rss_feed->items[$gitArrayValue]['category'];
	}
	else if ($rss_feed->items[$gitArrayValue]['dc']['subject']) {
		return $rss_feed->items[$gitArrayValue]['dc']['subject'];
	}
	else return false;
}

// Get the author of the item
function get_item_author($gitArrayValue, $rss_feed) {
	//XMLize it
	@ $use_xml_feed = $rss_feed;
	@ $xfeed = get_xmlized_feed($use_xml_feed);

	@ $rss_feed = get_feed($rss_feed);

	if (@ $rss_feed->items[$gitArrayValue]['dc']['creator']) {
		return $rss_feed->items[$gitArrayValue]['dc']['creator'];
	}
	else if (@ $xfeed["feed"]["#"]["entry"][$gitArrayValue]["#"]["author"][0]["#"]["name"][0]["#"]) {
		return $xfeed["feed"]["#"]["entry"][$gitArrayValue]["#"]["author"][0]["#"]["name"][0]["#"];
	}
	else if (@ $rss_feed->items[$gitArrayValue]['author']) {
		return $rss_feed->items[$gitArrayValue]['author'];
	}
	else return false;
}

// Get the date of the item
function get_item_date($gitArrayValue, $rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->items[$gitArrayValue]['pubdate']) {
		return $rss_feed->items[$gitArrayValue]['pubdate'];
	}
	else if ($rss_feed->items[$gitArrayValue]['dc']['date']) {
		return $rss_feed->items[$gitArrayValue]['dc']['date'];
	}
	else if ($rss_feed->items[$gitArrayValue]['modified']) {
		return $rss_feed->items[$gitArrayValue]['modified'];
	}
	else return false;
}

// Get the Permalink of the item (checks for link, then guid)
function get_item_permalink($gitArrayValue, $rss_feed) {
	@ $rss_feed = get_feed($rss_feed);

	if ($rss_feed->items[$gitArrayValue]['link']) {
		return $rss_feed->items[$gitArrayValue]['link'];
	}
	else if ($rss_feed->items[$gitArrayValue]['guid']) {
		return $rss_feed->items[$gitArrayValue]['guid'];
	}
	else return false;
}



/****************************************************
GET THE FEED
This function will create the RSS array via Magpie RSS.
This is an internal function and is not intended to be used publically.
****************************************************/
function get_feed($mp_feedUrl) {
	// Grab the newsfeed's URL
	@ $mp_url = fix_protocol($mp_feedUrl, 1);

	if ( $mp_url ) {
		$mp_rss = fetch_rss( $mp_url );
		return $mp_rss;
	}
}




/****************************************************
XMLIZE A FEED
This is used for patching holes in Magpie's implementation.
This is an internal function and is not intended to be used publically.
****************************************************/
function get_xmlized_feed($xz_feed) {
	@ $xz_feed = fix_protocol($xz_feed, 1);

	$xz_xml=fopen($xz_feed, "r");
	$xz_root=fread($xz_xml, 163840);
	$xml=xmlize($xz_root);

	return $xml;
}




/****************************************************
FIX PROTOCOL
Magpie and XMLize only understand the http:// protocol.
Convert feed:// and no-protocol URL's to http://
This is an internal function and is not intended to be used publically.

$http=1, http://www.domain.com/feed.xml
$http=2, feed://www.domain.com/feed.xml
****************************************************/
function fix_protocol($mp_feed_proto, $http) {
	$url = $mp_feed_proto;

	// Swap out feed://http:// for http://-only
	if ( stristr( $mp_feed_proto, 'feed://http://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 14 );
	}

	// Swap out feed:http:// for http://
	else if ( stristr( $mp_feed_proto, 'feed:http://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 12 );
	}

	// Swap out feed:// protocols in favor of http:// protocols, which Magpie can parse.
	else if ( stristr( $mp_feed_proto, 'feed://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 7 );
	}

	// Swap out feed:www. for http://www.
	else if ( stristr( $mp_feed_proto, 'feed:' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 5 );
	}

	// If feed is missing protocol, check for www subdomain.
	else if ( !stristr( $mp_feed_proto, 'http://' )) {
		$url = "http://" . $mp_feed_proto;
	}

	if ($http == 1) return $url;
	else if ($http == 2) {
		$url = substr_replace( $url, 'feed', 0, 4 );
		return $url;
	}
}
?>

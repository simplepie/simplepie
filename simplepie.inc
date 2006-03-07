<?php
/****************************************************
SIMPLE PIE
A Simple PHP-Based RSS/Atom Parser
Simplifies the process of displaying the values of commonly used feed tags.

Version: 0.91
Updated: 28 August 2004
Copyleft: 2004, Ryan Parman
http://www.skyzyx.com/projects/simplepie/

Free for any and all purposes.  I only ask that I be given credit 
for the work I've done in all future versions and derivative works.

This software includes and utilizes XMLize by Hans Anderson
http://www.hansanderson.com/php/xml/
****************************************************/


/****************************************************
GLOBAL VARIABLES
Will be used later on.
****************************************************/
$true_rss_url="";




/****************************************************
MAIN SIMPLEPIE FUNCTION
Validates the file location and creates an array.
****************************************************/
function simplepie($rss_feed) {
	// Debug mode?
	$debug = false;

	// Temp (Mini-Cache) File
	$cache = "./cache/temp.xml";

	// Fix any protocol formatting problems.
	$rss_feed=fix_protocol($rss_feed);

	// Set the global variable with this value so that
	// get_feed_url() and get_feedproto_url() can access the unprocessed URL.
	$GLOBALS["true_rss_url"] = $rss_feed;

	// Return the User-Agent string to the website's logs.  (Doesn't work yet)
	ini_set('user_agent','SimplePie\/0\.91 \(RSS Parser\; http\:\/\/www.skyzyx.com\/projects\/simplepie\/\)'); 

	// Check to make sure the feed exists.
	$valid=fopen($rss_feed, "r");
	$local_copy = fopen($cache, "w");

	if ($valid) {
		// Read the XML file (up to 1 MB) for processing.
		while (!feof($valid)) {
			$mp_rss = fgets($valid, 1048576);
			fwrite($local_copy, $mp_rss);
		}
		fclose($local_copy);

		// Read the local copy
		$local_read = fopen($cache, "r");
		$mp_rss = fread($local_read, 1048576);

		// Wrap CDATA around the <title> node value.
		$mp_rss = preg_replace("/<title>/", "<title><![CDATA[", $mp_rss);
		$mp_rss = preg_replace("/<\/title>/", "]]></title>", $mp_rss);
		// Remove extra CDATA's if they existed already.
		$mp_rss = preg_replace("/<title><\!\[CDATA\[<\!\[CDATA\[/", "<title><![CDATA[", $mp_rss);
		$mp_rss = preg_replace("/]]>]]><\/title>/", "]]></title>", $mp_rss);

		// Wrap CDATA around the <link> node value.
		$mp_rss = preg_replace("/<link>/", "<link><![CDATA[", $mp_rss);
		$mp_rss = preg_replace("/<\/link>/", "]]></link>", $mp_rss);
		// Remove extra CDATA's if they existed already.
		$mp_rss = preg_replace("/<link><\!\[CDATA\[<\!\[CDATA\[/", "<link><![CDATA[", $mp_rss);
		$mp_rss = preg_replace("/]]>]]><\/link>/", "]]></link>", $mp_rss);

		// Wrap CDATA around the <description> node value.
		$mp_rss = preg_replace("/<description>/", "<description><![CDATA[", $mp_rss);
		$mp_rss = preg_replace("/<\/description>/", "]]></description>", $mp_rss);
		// Remove extra CDATA's if they existed already.
		$mp_rss = preg_replace("/<description><\!\[CDATA\[<\!\[CDATA\[/", "<description><![CDATA[", $mp_rss);
		$mp_rss = preg_replace("/]]>]]><\/description>/", "]]></description>", $mp_rss);

		// If debug is on, send feed to the page.
		if ($debug) {
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
****************************************************/
// Check if an image element exists (returns true/false)
function get_image_exist($rss_feed) {
	if (@ $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]) return true;
	else if (@ $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]) return true;
	else if (@ $rss_feed["feed"]["#"]["image"][0]) return true; // Double-check this against the spec.
	else return false;
}

// Get the image title (to be used in alt and/or title)
function get_image_title($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["title"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["title"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["image"][0]["#"]["title"][0]["#"]; // Double-check this against the spec.

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// The path to the actual image
function get_image_url($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["url"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["url"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["image"][0]["#"]["url"][0]["#"]; // Double-check this against the spec.

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// The URL that the image is supposed to link to.
function get_image_link($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["link"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["link"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["image"][0]["#"]["link"][0]["#"]; // Double-check this against the spec.

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Get the image width
function get_image_width($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["width"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["width"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["image"][0]["#"]["width"][0]["#"]; // Double-check this against the spec.

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
	else return false;
}

// Get the image height
function get_image_height($rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["image"][0]["#"]["height"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["channel"][0]["#"]["image"][0]["#"]["height"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["image"][0]["#"]["height"][0]["#"]; // Double-check this against the spec.

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
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
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["description"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["description"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["content"][0]["#"];
	@ $atom_var2 = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["summary"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rdf_var) return $rdf_var;
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
function get_item_date($gitArrayValue, $rss_feed) {
	@ $rss_var = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["pubDate"][0]["#"];
	@ $rss_var2 = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["pubdate"][0]["#"];
	@ $rss_var3 = $rss_feed["rss"]["#"]["channel"][0]["#"]["item"][$gitArrayValue]["#"]["dc:date"][0]["#"];
	@ $rdf_var = $rss_feed["rdf:RDF"]["#"]["item"][$gitArrayValue]["#"]["dc:date"][0]["#"];
	@ $atom_var = $rss_feed["feed"]["#"]["entry"][$gitArrayValue]["#"]["modified"][0]["#"];

	if ($rss_var) return $rss_var;
	else if ($rss_var2) return $rss_var2;
	else if ($rss_var3) return $rss_var3;
	else if ($rdf_var) return $rdf_var;
	else if ($atom_var) return $atom_var;
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

	// Swap out feed:// protocols in favor of http:// protocols, which Magpie can parse.
	else if ( stristr( $mp_feed_proto, 'feed://' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 7 );
	}

	// Swap out feed:www. for http://www.
	else if ( stristr( $mp_feed_proto, 'feed:' ) ) {
		$url = substr_replace( $mp_feed_proto, 'http://', 0, 5 );
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
?>

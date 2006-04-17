<?php
/***********************************************
SIMPLESCRIPT
SimplePie data exposed as JavaScript

Updated: 15 April 2006
Copyright: 2004-Present, Ryan Parman, Geoffrey Sneddon
http://script.simplepie.org
***********************************************/

// Include Required Libraries
require('smartypants.inc');
require('simplepie.inc');

// Set up initial settings
$feed=$_GET['feed'];
$var=$_GET['var'];
$obj = new SimplePie($feed);

// Enable GZIP Compression
ob_start ("ob_gzhandler");
header("Content-type: text/javascript; charset: " . $obj->get_encoding());
header("Cache-Control: must-revalidate");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");

// Output the JSON to the page
print("/*
 * SIMPLESCRIPT: SimplePie data exposed as JavaScript
 * Build " . $obj->build . ".28 under PHP " . phpversion() . "
 * http://script.simplepie.org
 */

var ".$var." = {

	// SimplePie info
	name:'SimpleScript',
	version:'1.0 Preview',
	build:'" . $obj->build . "',
	url:'http://script.simplepie.org',
	linkback:'<a href=\"http://script.simplepie.org\" title=\"SimpleScript 1.0 Preview\">SimpleScript</a>',

	// Miscellaneous
	getEncoding:'" . $obj->get_encoding() . "',
	getVersion:'" . $obj->get_version() . "',

	// One-click subscribe
	subscribeURL:'" . $obj->subscribe_url() . "',
	subscribeFeed:'" . $obj->subscribe_feed() . "',
	subscribePodcast:'" . $obj->subscribe_podcast() . "',
	subscribeAOL:'" . $obj->subscribe_aol() . "',
	subscribeBloglines:'" . $obj->subscribe_bloglines() . "',
	subscribeGoogle:'" . $obj->subscribe_google() . "',
	subscribeMSN:'" . $obj->subscribe_msn() . "',
	subscribeNewsburst:'" . $obj->subscribe_newsburst() . "',
	subscribeNewsgator:'" . $obj->subscribe_newsgator() . "',
	subscribeOdeo:'" . $obj->subscribe_odeo() . "',
	subscribePluck:'" . $obj->subscribe_pluck() . "',
	subscribePodnova:'" . $obj->subscribe_podnova() . "',
	subscribeRojo:'" . $obj->subscribe_rojo() . "',
	subscribeYahoo:'" . $obj->subscribe_yahoo() . "',

	// Feed info
	getFeedTitle:'" . addslashes($obj->get_feed_title()) . "',
	getFeedLink:'" . addslashes($obj->get_feed_link()) . "',
	getFeedDescription:'" . addslashes($obj->get_feed_description()) . "',
	getFeedCopyright:'" . addslashes($obj->get_feed_copyright()) . "',
	getFeedLanguage:'" . addslashes($obj->get_feed_language()) . "',

	// Feed images
	getImageExist:"); echo ($obj->get_image_exist()) ? 'true' : 'false'; print(",
	getImageTitle:'" . $obj->get_image_title() . "',
	getImageURL:'" . $obj->get_image_url() . "',
	getImageLink:'" . $obj->get_image_link() . "',
	getImageWidth:'" . $obj->get_image_width() . "',
	getImageHeight:'" . $obj->get_image_height() . "',

	// Items/Entries
	getItemQuantity:" . $obj->get_item_quantity() . ",
	getItem: [
");
for ($x=0; $x<$obj->get_item_quantity(); $x++) {
	$item=$obj->get_item($x);

print("		{
			addToBlinklist:'" . $item->add_to_blinklist() . "',
			addToDelicious:'" . $item->add_to_delicious() . "',
			addToDigg:'" . $item->add_to_digg() . "',
			addToFurl:'" . $item->add_to_furl() . "',
			addToMagnolia:'" . $item->add_to_magnolia() . "',
			addToMyWeb20:'" . $item->add_to_myweb20() . "',
			addToNewsvine:'" . $item->add_to_newsvine() . "',
			addToReddit:'" . $item->add_to_reddit() . "',
			addToSpurl:'" . $item->add_to_spurl() . "',

			getId:'" . $item->get_id() . "',
			getTitle:'" . addslashes($item->get_title()) . "',
			getDescription:'" . trim(str_replace("\n", ' ', str_replace("\r", ' ', addslashes(strip_tags(StupefyEntities($item->get_description()), '<a>'))))) . "',
			getCategory:["); $cat=$item->get_category(); for ($y=0; $y<sizeof($cat); $y++) {print("'" . $cat[$y] . "'"); print((sizeof($cat)>1) ? ',':'');} print("],
			getAuthor:["); $author=$item->get_author(); for ($y=0; $y<sizeof($author); $y++) {print("
				{
					name:'" . $author->name . "', 
					link:'" . $author->link . "', 
					email:'" . $author->email . "'
				}"); print((sizeof($author)>1) ? ',':'');} print("
			],
			getAuthors:'',
			getDate:function() {
				return new Date(" . $item->get_date('Y') . ", " . intval($item->get_date('m')-1) . ", " . $item->get_date('j') . ", " . $item->get_date('G') . ", " . $item->get_date('i') . ", 0, 0);
			},
			getPermalink:'" . addslashes($item->get_permalink()) . "',
			getLinks:["); $links=$item->get_links(); for ($y=0; $y<sizeof($links); $y++) {print("'" . $links[$y] . "'"); print((sizeof($links)>1) ? ',':'');} print("],
			getEnclosure:["); $enclosure=$item->get_enclosure(); for ($y=0; $y<sizeof($enclosure); $y++) {print("
				{
					getLink:'',
					getExtension:'',
					getType:'',
					getLink:'',
					getLength:'',
					getSize:'',
				}"); print((sizeof($author)>1) ? ',':'');} print("
			]
		},
");
}
print("
	]
}
");

// GZIP Flush
ob_flush();

?>

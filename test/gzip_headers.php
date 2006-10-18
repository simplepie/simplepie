<?php
include_once('../simplepie.inc');
include_once('../idn/idna_convert.class.php');

header('Content-type:text/plain; charset=utf-8');

if (isset($_GET['feed']) && !empty($_GET['feed'])) {
	$request = new SimplePie_File($_GET['feed'], 10, 5, null, null, false);
	echo 'CURL: ' . SimplePie_Misc::get_curl_version();
	echo "\r\n\r\n";
	echo $request->method;
	echo "\r\n\r\n";
	print_r($request->headers);
	echo "\r\n";
	echo $request->body();
}
else {
	echo "You must pass a feed URL to the ?feed= parameter in the URL.";
}

/*
$feed = new SimplePie();
$feed->feed_url('http://www.xanga.com/Empfindsamkeit/rss');
$feed->enable_caching(false);
$feed->force_fsockopen();
$feed->init();

print_r($feed);
*/

?>

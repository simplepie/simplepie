<?php
include_once('../simplepie.inc');
include_once('../idn/idna_convert.class.php');

header('Content-type:text/plain; charset=utf-8');

if (isset($_GET['feed']) && !empty($_GET['feed'])) {
	$request = new SimplePie_File($_GET['feed']);
	echo 'CURL: ' . SimplePie_Misc::get_curl_version();
	echo "\r\n\r\n";
	print_r($request->headers);
	echo "\r\n";
	echo $request->body();
}
else {
	echo "You must pass a feed URL to the ?feed= parameter in the URL.";
}
?>

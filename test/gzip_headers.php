<?php
include_once('../simplepie.inc');
include_once('../idn/idna_convert.class.php');

if (isset($_GET['input']) && !empty($_GET['input'])) {
	$charset = $_GET['input'];
}
else $charset = 'UTF-8';

header('Content-type:text/plain; charset=' . $charset);

if (isset($_GET['feed']) && !empty($_GET['feed'])) {
	$fsockopen = (isset($_GET['fsockopen'])) ? true:false;
	
	$request = new SimplePie_File($_GET['feed'], 10, 5, null, null, $fsockopen);
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
?>

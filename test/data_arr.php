<?php
include_once('../simplepie.inc');
include_once('../idn/idna_convert.class.php');

if (isset($_GET['feed']) && !empty($_GET['feed'])) {
	$feed = new SimplePie();
	$feed->set_feed_url($_GET['feed']);
	if (isset($_GET['input']) && !empty($_GET['input'])) {
		$feed->set_input_encoding($_GET['input']);
	}
	if (isset($_GET['fsockopen'])) {
		$feed->force_fsockopen(true);
	}
	$feed->init();
	$feed->handle_content_type('text/plain');
	print_r($feed->data);
}
else {
	echo "You must pass a feed URL to the ?feed= parameter in the URL.";
}
?>

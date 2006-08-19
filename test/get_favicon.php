<?php

require('../simplepie.inc');

$feed = new SimplePie();
$feed->feed_url($_GET['feed']);
$feed->enable_caching(false);
$feed->init();

header('Content-type:text/html; charset=utf-8');

if ($feed->get_favicon(true)) {
	echo '<img src="' . $feed->get_favicon(true) . '" />';
}

//print_r($feed->data);

?>
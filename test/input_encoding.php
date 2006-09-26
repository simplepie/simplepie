<?php

require('../simplepie.inc');

$feed = new SimplePie();
$feed->feed_url('http://gwerneck.libsyn.com/rss');
$feed->enable_caching(false);
$feed->init();

$feed->handle_content_type();

echo '<h1>' . $feed->get_feed_title() . '</h1>' . "\r\n";

foreach ($feed->get_items() as $item) {
	echo '<h3><a href="' . $item->get_permalink() . '">' . utf8_decode($item->get_title()) . '</a></h3>' . "\r\n";
	echo $item->get_description() . "\r\n";
}

?>

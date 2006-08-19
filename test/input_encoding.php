<?php

require('../simplepie.inc');

$feed = new SimplePie();
$feed->feed_url('http://nurapt.kaist.ac.kr/~jamaica/htmls/blog/rss.php');
$feed->enable_caching(false);
$feed->input_encoding('EUC-KR'); /* The feed is sending UTF-8, but this is wrong.  We'll override it because we know better. */
$feed->init();

header('Content-type:text/html; charset=utf-8');

echo '<h1>' . $feed->get_feed_title() . '</h1>' . "\r\n";

foreach ($feed->get_items() as $item) {
	echo '<h3><a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a></h3>' . "\r\n";
	echo $item->get_description() . "\r\n";
}

?>
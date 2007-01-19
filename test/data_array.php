<?php
require('../simplepie.inc');

$feed = new SimplePie();
$feed->set_feed_url($_GET['feed']);
$feed->enable_cache(false);
$feed->init();

$feed->handle_content_type('text/plain');
print_r($feed);

?>

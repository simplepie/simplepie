<?php
require('../simplepie.inc');

//$feed = new SimplePie('http://channelfrederator.com/rss/');
//$feed = new SimplePie('http://youtube.com/rss/global/recently_added.rss');
//$feed = new SimplePie('http://php4.skyzyx.net/simplepie/wm/wm.xml');
$feed = new SimplePie('http://odeo.com/channel/rss/4565');

$item = $feed->get_item(0);
$enclosure = $item->get_enclosure(0);
echo $enclosure->embed(array(
	'video' => '../demo/for_the_demo/place_video.png', 
	'audio' => '../demo/for_the_demo/place_audio.png'
));

?>

<?php
require('simplepie.inc');
$feed=new SimplePie();
echo $feed->get_file('http://www.billsaysthis.com/robots.txt');
echo $feed->get_file('http://www.billsaysthis.com/movies/?feed=rss2');
?>

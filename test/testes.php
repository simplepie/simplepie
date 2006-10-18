<?php

require('../simplepie.inc');
$file = new SimplePie_File('http://nymag.com/rss/Movies.xml');

print_r($file);

?>
<?php

require('simplepie.inc');
new SimplePie_File('http://blog.skyzyx.com/feed/');

print_r(get_headers($url, 1));

?>
<?php
require_once('../simplepie.inc');

$favicon = new SimplePie();
$favicon->set_cache_location('./cache');
$favicon->init();

$cache =& new $favicon->cache_class($favicon->cache_location, call_user_func($favicon->cache_name_function, $_GET['i']), 'favicon');

if ($file = $cache->load())
{
	header('Content-type:' . $file['headers']['Content-type']);
	echo $file['body'];
	exit;
}

die('Cached favicon for ' . $_GET['i'] . ' cannot be found.');

?>

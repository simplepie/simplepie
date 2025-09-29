<?php
include_once('../autoloader.php');

// Parse it
$feed = new \SimplePie\SimplePie();
if (isset($_GET['feed']) && $_GET['feed'] !== '') {
    $feed->set_feed_url($_GET['feed']);
    $feed->enable_cache(false);
    $starttime = explode(' ', microtime());
    $starttime = $starttime[1] + $starttime[0];
    $feed->init();
    $endtime = explode(' ', microtime());
    $endtime = $endtime[1] + $endtime[0];
    $time = $endtime - $starttime;
} else {
    $time = 'null';
}

$feed->handle_content_type();

?>
<!DOCTYPE html>
<title>SimplePie Test</title>
<pre>
<?php

// memory_get_peak_usage() only exists on PHP 5.2 and higher if PHP is compiled with the --enable-memory-limit configuration option or on PHP 5.2.1 and higher (which runs as if --enable-memory-limit was on, with no option)
if (function_exists('memory_get_peak_usage')) {
    var_dump($time, memory_get_usage(), memory_get_peak_usage());
}
// memory_get_usage() only exists if PHP is compiled with the --enable-memory-limit configuration option or on PHP 5.2.1 and higher (which runs as if --enable-memory-limit was on, with no option)
elseif (function_exists('memory_get_usage')) {
    var_dump($time, memory_get_usage());
} else {
    var_dump($time);
}

// Output buffer
function callable_htmlspecialchars($string)
{
    return htmlspecialchars($string);
}
ob_start('callable_htmlspecialchars');

// Output
print_r($feed);
ob_end_flush();

?>
</pre>

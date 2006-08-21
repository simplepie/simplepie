<!----------- START SIMPLEPIE TEST ----------->
<?php
error_reporting(E_ALL); // Enable max error reporting
require('../simplepie.inc'); // Require instead of Include

$file = new SimplePie_File('http://simplepie.org/blog/feed/');
echo $file->body() . "\r\n";
$file->close();
echo "<hr />\r\n";

$file = new SimplePie_File('http://simplepie.org/');
echo $file->body() . "\r\n";
$file->close();
echo "<hr />\r\n";

$file = new SimplePie_File('simplepie.org');
echo $file->body() . "\r\n";
$file->close();
?>
<!----------- END SIMPLEPIE TEST ----------->

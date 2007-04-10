<?php
require_once('../simplepie.inc');
SimplePie_Misc::display_cached_file($_GET['i'], './cache', 'image');
?>

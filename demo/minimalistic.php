<?php

function microtime_float()
{
	list($usec, $sec) = explode(' ', microtime());
	return ((float)$usec + (float)$sec);
}

$start = microtime_float();

include('../simplepie.inc');

// Parse it
$feed = new SimplePie();
if (!empty($_GET['feed'])) {
	$feed->feed_url($_GET['feed']);
	$feed->init();
	if (!headers_sent() && $feed->get_encoding()) header('Content-type: text/html; charset=' . $feed->get_encoding());
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo (empty($_GET['feed'])) ? 'SimplePie' : 'SimplePie: ' . $feed->get_feed_title(); ?></title>

<!-- META HTTP-EQUIV -->
<meta http-equiv="content-type" content="text/html; charset=<?php echo ($feed->get_encoding()) ? $feed->get_encoding() : 'UTF-8'; ?>" />
<meta http-equiv="imagetoolbar" content="false" />

<style type="text/css">
html, body {
	height:100%;
	margin:0;
	padding:0;
}

h1 {
	background-color:#333;
	color:#fff;
	font-size:3em;
	margin:0;
	padding:5px 15px;
	text-align:center;
}

div#footer {
	padding:5px 0;
}

div#footer,
div#footer a {
	text-align:center;
	font-size:0.7em;
}

div#footer a {
	text-decoration:underline;
}

code {
	background-color:#f3f3ff;
	color:#000;
}

pre {
	background-color:#f3f3ff;
	color:#000080;
	border:1px dotted #000080;
	padding:3px 5px;
}

form {
	margin:0;
	padding:0;
}

div.chunk {
	border-bottom:1px solid #ccc;
}

form#sp_form {
	text-align:center;
	margin:0;
	padding:0;
}

form#sp_form input.text {
	width:85%;
}
</style>

</head>

<body>
	<h1><?php echo (empty($_GET['feed'])) ? 'SimplePie' : 'SimplePie: ' . $feed->get_feed_title(); ?></h1>

	<form action="" method="get" name="sp_form" id="sp_form">
		<p><input type="text" name="feed" value="<?php echo ($feed->subscribe_url()) ? $feed->subscribe_url() : 'http://'; ?>" class="text" id="feed_input" />&nbsp;<input type="submit" value="Read" class="button" /></p>
	</form>

	<div id="sp_results">
		<?php if ($feed->data): ?>
			<?php $max = $feed->get_item_quantity(); ?>
			<p align="center"><span style="background-color:#ffc;">Displaying <?php echo $max; ?> most recent entries.</span></p>
			<?php for ($x = 0; $x < $max; $x++): ?>
				<div class="chunk" style="padding:0 5px;">
					<h4><a href="<?php echo $feed->get_item_permalink($x); ?>"><?php echo $feed->get_item_title($x); ?></a> <?php echo $feed->get_item_date($x, 'j M Y'); ?></h4>
					<?php echo $feed->get_item_description($x); ?>
					<?php
					if ($feed->get_item_enclosure($x))
						echo '<p><a href="' . $feed->get_item_enclosure($x) . '" class="download"><img src="./for_the_demo/mini_podcast.png" alt="Podcast" title="Download the Podcast" border="0" /></a></p>';
					?>
				</div>
			<?php endfor; ?>
			</div>
		<?php endif; ?>
	</div>

	<div id="footer">
		Powered by <?php echo $feed->linkback; ?>, a product of <a href="http://www.skyzyx.com">Skyzyx Technologies</a>.<br />
		Page created in <?php echo round(microtime_float()-$start, 3); ?> seconds.
	</div>
</body>
</html>

<?php
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include_once("simplepie.inc");
@ $rss = simplepie($_GET["feed"]);
?>

<html>
<head>
<title>
<?php
if (get_feed_title($rss)) {
	echo "SimplePie 0.9.1 Reading: " . get_feed_title($rss);
}
else echo "SimplePie 0.9.1";
?>
</title>

<style type="text/css">
body {
	font-family:verdana, sans-serif;
	font-size:12px;
	color:#000;
	background-color:#fff;
	width:700px;
}

h2 {
	background-color:#ddd;
	margin:35px 0 0 0;
	padding:10px 20px;
}

h3 {
	text-decoration:underline;
	text-transform:uppercase;
}

p {
	text-indent:30px;
}

code {
	background-color:#eef;
	font-family:monospace;
	color:#000080;
	padding:0 3px;
}

blockquote {
	margin:0 45px;
	padding:10px;
	font-size:11px;
	background-color:#e9f5ff;
	border-top:1px solid #2f4a76;
	border-bottom:1px solid #2f4a76;
}

blockquote p {
	padding:0;
	margin:0 0 10px 0;
}

a {
	color:#03f;
	text-decoration:underline;
}

a:hover {
	color:#f60;
}
</style>

</head>

<body>

<!-- CHECK IF FEED EXISTS -->
<?php if ($rss) { ?>

<hr />
<form action="" name="rssfeed" id="rssfeed">
<b>Read another feed:</b>
<input type="text" name="feed" id="feed" value="" style="width:300px;" />
<input type="submit" value="read me" />
<hr />

<!-- DISPLAY TITLE, LINK, AND VERSION OF FEED, IF EXISTS -->
<h1><?php if (get_feed_link($rss)) { ?><a href="<?php echo get_feed_link($rss); ?>"><?php } if (get_feed_title($rss)) {echo get_feed_title($rss);} else echo "A Cool Feed"; if (get_feed_link($rss)) { ?></a><?php } ?> (<?php echo get_version($rss); ?>)</h1>

<!-- DISPLAY FEED'S DESCRIPTION, IF EXISTS -->
<?php if (get_feed_description($rss)) { ?><p><?php echo get_feed_description($rss); ?></p><?php } ?>

<!-- DISPLAY FEED'S LANGUAGE, IF EXISTS -->
<?php if (get_feed_language($rss)) { ?><p>This feed is written using the <code><?php echo get_feed_language($rss); ?></code> language.</p><?php } ?>

<!-- DISPLAY FEED'S COPYRIGHT, IF EXISTS -->
<?php if (get_feed_copyright($rss)) { ?><p><b>Copyright:</b> <?php echo get_feed_copyright($rss); ?></p><?php } ?>

<!-- SUBSCRIBE TO THIS FEED -->
<p>Subscribe to <a href="<?php echo get_feedproto_url($rss); ?>"><?php echo get_feed_url($rss); ?></a></p>

<!-- DISPLAY THE FEED'S IMAGE, OF IT EXISTS -->
<?php if (get_image_exist($rss)) { ?><a href="<?php echo get_image_link($rss) ?>"><img src="<?php echo get_image_url($rss) ?>" alt="<?php echo get_image_title($rss) ?>" title="<?php echo get_image_title($rss) ?>" width="<?php echo get_image_width($rss) ?>" height="<?php echo get_image_height($rss) ?>" border="0" /></a><?php } ?>

<br /><br />
<?php

// LOOP THROUGH THE FEED ITEMS (ENTRIES)
for ($x=0; $x < get_item_quantity($rss); $x++) {
?>
	<?php if (get_item_permalink($x, $rss)) { ?><h2><a href="<?php echo get_item_permalink($x, $rss); ?>"><?php echo get_item_title($x, $rss); ?></a></h2><?php } ?>
	<?php if (get_item_date($x, $rss)) { ?><p>Posted: <?php echo get_item_date($x, $rss); ?></p><?php } ?>
	<?php if (get_item_description($x, $rss)) { ?><?php echo get_item_description($x, $rss); ?><?php } ?>
	<?php if (get_item_category($x, $rss) || get_item_author($x, $rss)) { ?>
		<p><?php if (get_item_category($x, $rss)) { ?>
			<b>Category:</b> <?php echo get_item_category($x, $rss); ?>
		<?php } ?>
		<?php if (get_item_author($x, $rss)) { ?>
			<b>Author: </b><?php echo get_item_author($x, $rss); ?>
		<?php } ?></p>
	<?php } ?>
<?php } ?>
<hr />
<?php
$mtime = explode(' ', microtime());
$totaltime = $mtime[0] + $mtime[1] - $starttime;
printf('Page loaded in %.3f seconds.', $totaltime);
}
else { ?>

<form action="" name="rssfeed" id="rssfeed">
<h1>Enter URL of an RSS/Atom Feed:</h1>
<input type="text" name="feed" id="feed" value="http://www.skyzyx.com/rss/skyzyx.xml" style="width:300px;" />
<input type="submit" value="read me" />
<p>Powered by SimplePie 0.91.  
<?php
$mtime = explode(' ', microtime());
$totaltime = $mtime[0] + $mtime[1] - $starttime;
printf('Page loaded in %.3f seconds.', $totaltime);
?></p>
</form>

<?php } ?>


</body>
</html>
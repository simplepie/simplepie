<?php
/********************************************************************
MULTIFEEDS TEST PAGE

Nothing too exciting here.  Just a sample page that demos integrated 
Multifeeds support as well as cached favicons and perhaps a few other 
things.

The code on this page may or may not work with your configuration 
(PHP short tags, some PHP5-only syntax), and is certainly not optimal, 
but it will definitely get cleaned up in time for the 1.0 release.

Lots of this code is commented to help explain some of the new stuff.

********************************************************************/

// Include the SimplePie library, and the one that handles internationalized domain names.
require_once('../simplepie.inc');
require_once('../idn/idna_convert.class.php');

// We don't HAVE to do this here, but let's just set some proper HTTP headers for the page.
header('Content-type:text/html; charset=utf-8');

// Initialize some feeds for use.
/*
Yes, this is functional, but I don't think it "feels" right.  We can do better than this.  Perhaps:

$feeds = new SimplePie();
$feeds->set_feed_url(array(
	'http://apple.com',
	'http://simplepie.org',
	'http://digg.com',
	'http://tuaw.com',
	'http://slashdot.org',
	'http://uneasysilence.com'
));
$feeds->set_favicon_handler('handler_favicon.php');
$feeds->set_cache_location('./cache');
$feeds->init();
$feeds->handle_content_type();

// etc.

Feed-level information would not be available (because we're mashing several feeds -- they'd all 
conflict), although all of the item-level info would.  We've also introduced $item->get_feed(), 
which brings back the feed-level data as appropriate for the item.  Pretty sweet.
*/
$apple = new SimplePie();
$apple->set_feed_url('http://apple.com');
$apple->set_favicon_handler('handler_favicon.php');
$apple->init();

$sp = new SimplePie();
$sp->set_feed_url('http://simplepie.org/blog/feed/');
$sp->set_favicon_handler('handler_favicon.php');
$sp->init();

$digg = new SimplePie();
$digg->set_feed_url('http://digg.com/rss/index.xml');
$digg->set_favicon_handler('handler_favicon.php');
$digg->init();

$tuaw = new SimplePie();
$tuaw->set_feed_url('http://feeds.tuaw.com/weblogsinc/tuaw');
$tuaw->set_favicon_handler('handler_favicon.php');
$tuaw->init();

$uneasy = new SimplePie();
$uneasy->set_feed_url('http://feeds.uneasysilence.com/uneasysilence/blog/');
$uneasy->set_favicon_handler('handler_favicon.php');
$uneasy->init();

$slashdot = new SimplePie();
$slashdot->set_feed_url('http://rss.slashdot.org/Slashdot/slashdot');
$slashdot->set_favicon_handler('handler_favicon.php');
$slashdot->init();

// Merge everything together (for now... this could/should be simplified as noted above)
$merged = SimplePie::merge_items(0, 0, $digg, $tuaw, $uneasy, $slashdot, $sp, $apple);


// Begin the (X)HTML page.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	
<head>
	<title>Multifeeds Test page</title>
	<link rel="stylesheet" href="../demo/for_the_demo/simplepie.css" type="text/css" media="screen" title="SimplePie Styles" charset="utf-8" />
	<style type="text/css">
	div#site {
		width:600px;
	}
	span.footnote {
		white-space:nowrap;
	}
	h1 {
		line-height:1.4em;
	}
	h4 {
		padding-left:20px;
		background-color:transparent;
		background-repeat:no-repeat;
		background-position:0 1px;
	}
	.clearBoth {
		clear:both;
	}
	</style>
</head>
<body>
<div id="site">

	<? if ($feed->error): ?>
		<p><?=$feed->error()?></p>
	<? endif ?>

	<div class="chunk">
		<h1>Quick-n-Dirty Multifeeds Demo</a></h1>
		<p><i>Mashing SimplePie, Apple, Digg, Slashdot, UNEASYsilence, and TUAW.</i></p>
	</div>

	<? //foreach($feed->get_items() as $item): ?>
	<? foreach($merged as $item): ?>

		<div class="chunk">
			<!-- Here (in the PHP code), we see some PHP5 "chaining" of methods, showing how to grab the appropriate favicon for the source of the item. -->
			<h4 style="background-image:url(<?=$item->get_feed()->get_favicon()?>);"><a href="<?=$item->get_permalink()?>"><?=$item->get_title()?></a></h4>

			<!-- get_description() now prefers summaries over full content -->
			<?=$item->get_description()?>

			<!-- get_content() prefers full content over summaries -->
			<?//=$item->get_content()?>

			<? if ($enclosure = $item->get_enclosure()): ?>
				<div>
				<?=$enclosure->native_embed(array(
					// New 'mediaplayer' attribute shows off Flash-based MP3 and FLV playback.
					'mediaplayer' => '../demo/for_the_demo/mediaplayer.swf'
				))?>
				</div>
			<? endif ?>

			<!-- Here's more of that PHP5 chaining with $item->get_feed()->get_permalink() to get the source feed's permalink -->
			<p class="footnote">Source: <a href="<?=$item->get_feed()->get_permalink()?>"><?=$item->get_feed()->get_title()?></a> | <?=$item->get_date('j M Y | g:i a')?></p>
		</div>

	<? endforeach ?>

	<p class="footnote">This is a test of the emergency broadcast system.  This is only a test&hellip; beeeeeeeeeeeeeeeeeeeeeeeeeep!</p>

</div>
</body>
</html>
<?php
// Start counting time for loading...
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include('../simplepie.inc');

// Parse it
$feed = new SimplePie();
if (!empty($_GET['feed'])) {
	$feed->feed_url($_GET['feed']);
	if (isset($_GET['xmldump'])) $feed->enable_xmldump($_GET['xmldump']);
	$feed->init();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo</title>

<link rel="stylesheet" href="./for_the_demo/simplepie.css" media="screen, projector" />
<script type="text/javascript" src="./for_the_demo/sifr.js"></script>
<script type="text/javascript" src="./for_the_demo/sleight.js"></script>

</head>

<body id="bodydemo">

<div id="site">

	<ul id="menu">
		<!-- Must all be on the same line due to spacing bugs. -->
		<li id="demo"><a href="index.php">Demo</a>|</li><li><a href="http://support.simplepie.org/?CategoryID=2">Bug Reports</a>|</li><li><a href="http://support.simplepie.org/?CategoryID=3">Feature Requests</a>|</li><li><a href="http://www.simplepie.org/docs/reference/">Function Reference</a>|</li><li><a href="http://www.simplepie.org/blog/">Weblog</a></li>
	</ul>


	<h1 id="logo"><a href="http://www.simplepie.org"><img src="./for_the_demo/logo_simplepie_small.png" alt="SimplePie" title="SimplePie" border="0" /></a></h1>

	<div id="content">

		<div id="" class="chunk">
			<h2 class="image"><img src="./for_the_demo/copy_get_your_demos_here.gif" alt="Demos!  Get your demos here!  Well, actually there's only one.  But you can do it over and over again." title="Demos!  Get your demos here!  Well, actually there's only one.  But you can do it over and over again." /></h2>
			<form action="" method="get" name="sp_form" id="sp_form">
				<div id="sp_input">
					<p><strong>Feed URL:</strong>&nbsp;<input type="text" name="feed" value="<?php if ($feed->subscribe_url()) echo $feed->subscribe_url(); ?>" class="text" id="feed_input" />&nbsp;<input type="submit" value="Read" class="button" /></p>
				</div>
			</form>
			<p><strong>Or try one of the following:</strong> <a href="?feed=http://my.abcnews.go.com/rsspublic/fp_rss20.xml">ABC News</a>, <a href="?feed=http://newsrss.bbc.co.uk/rss/newsonline_world_edition/front_page/rss.xml">BBC News</a>, <a href="?feed=http://backpackit.com/weblog/index.xml">Backpack</a>, <a href="?feed=http://daringfireball.net/index.xml">Daring Fireball</a>, <a href="?feed=http://del.icio.us/rss/">Del.icio.us</a>, <a href="?feed=http://digg.com/rss/index.xml">Digg</a>, <a href="?feed=http://www.dooce.com/index.xml">Dooce</a>, <a href="?feed=http://1976design.com/blog/syndicate/main/full/atom/0.3/">Dunstan</a>, <a href="?feed=http://www.flickr.com/services/feeds/photos_public.gne?format=rss2">Flickr</a>, <a href="?feed=http://www.google.com/news?output=rss">Google News</a>, <a href="?feed=http://gvod.blogspot.com/atom.xml">GVOD</a>, <a href="?feed=http://hivelogic.com/index.xml">Hivelogic</a>, <a href="?feed=http://jasonsantamaria.com/index.rdf">Jason Santa Maria</a>, <a href="?feed=http://feeds.feedburner.com/maccast">MacCast</a>, <a href="?feed=http://macnn.com/podcasts/macnn.rss">MacNN</a>, <a href="?feed=http://www.mezzoblue.com/rss/index.xml">Mezzoblue</a>, <a href="?feed=http://www.mikeindustries.com/blog/index.rdf">Mike Davidson</a>, <a href="?feed=http://feeds.feedburner.com/37signals/beMH">Signal vs. Noise</a>, <a href="?feed=http://rss.slashdot.org/Slashdot/slashdot">Slashdot</a>, <a href="?feed=http://www.tuaw.com/rss.xml">TUAW</a>, <a href="?feed=http://www.tvgasm.com/atom.xml">TVgasm</a>, <a href="?feed=http://whitecollarruckus.libsyn.com/rss">White Collar Ruckus</a>, <a href="?feed=http://rss.news.yahoo.com/rss/topstories">Yahoo! News</a>, <a href="?feed=http://www.zeldman.com/feed/zeldman.xml">Zeldman</a></p>
		</div>

		<div id="sp_results">
			<?php if ($feed->data): ?>
				<div class="chunk focus" align="center">
					<h3 class="header"><?php if ($feed->get_feed_link()) echo '<a href="' . $feed->get_feed_link() . '">'; echo $feed->get_feed_title(); if ($feed->get_feed_link()) echo '</a>'; ?></h3>
					<?php echo $feed->get_feed_description(); ?>
				</div>
				<p class="subscribe"><strong>Subscribe:</strong> <a href="<?php echo $feed->subscribe_bloglines(); ?>">Bloglines</a>, <a href="<?php echo $feed->subscribe_google(); ?>">Google Reader</a>, <a href="<?php echo $feed->subscribe_newsgator(); ?>">Newsgator</a>, <a href="<?php echo $feed->subscribe_pluck(); ?>">Pluck</a>, <a href="<?php echo $feed->subscribe_rojo(); ?>">Rojo</a>, <a href="<?php echo $feed->subscribe_yahoo(); ?>">My Yahoo!</a>, <a href="<?php echo $feed->subscribe_feed(); ?>">Other</a></p>
				<?php for ($x = 0; $x < $feed->get_item_quantity(); $x++): ?>
					<div class="chunk">
						<h4><?php if ($feed->get_item_permalink($x)) echo '<a href="' . $feed->get_item_permalink($x) . '">'; echo $feed->get_item_title($x); if ($feed->get_item_permalink($x)) echo '</a>'; ?>&nbsp;<span class="footnote"><?php echo $feed->get_item_date($x, 'j M Y'); ?></span></h4>
						<?php echo $feed->get_item_description($x); ?>
						<?php
						if ($feed->get_item_enclosure($x))
							echo '<p><a href="' . $feed->get_item_enclosure($x) . '" class="download"><img src="./for_the_demo/mini_podcast.png" alt="Podcast" title="Download the Podcast" border="0" /></a></p>';
						?>
						<p>&rarr; <a href="<?php echo $feed->add_to_delicious($x); ?>">Add to Del.icio.us</a> | <a href="<?php echo $feed->add_to_newsvine($x); ?>">Add to Newsvine</a> | <a href="<?php echo $feed->search_technorati($x); ?>">Search Technorati</a></p>
					</div>
				<?php endfor; ?>
				</div>
			<?php endif; ?>
		</div>

		<div>
			<p class="footnote">Page processed in <?php $mtime = explode(' ', microtime()); echo round($mtime[0] + $mtime[1] - $starttime, 3); ?> seconds.</p>
			<p class="footnote">SimplePie is &copy; 2004&ndash;<?php echo date('Y'); ?>, <a href="http://www.skyzyx.com">Skyzyx Technologies</a>, and licensed under the Creative Commons <a href="http://www.creativecommons.org/licenses/by-sa/2.0/">Attribution Share-Alike License 2.0</a>.</p>
			<p class="footnote">Hosted by <a href="http://www.dreamhost.com/r.cgi?skyzyx">Dreamhost</a> and powered by <a href="http://www.wordpress.org">Wordpress</a>, because they're nifty-cool, and we like them.  Syndication support handled by <?php echo $feed->linkback; ?>.</p>
		</div>

	</div>

</div>

<script type="text/javascript">
//<![CDATA[
if(typeof sIFR == "function"){
	sIFR.replaceElement(named({sSelector:"h3.header", sFlashSrc:"./for_the_demo/yanone-kaffeesatz-bold.swf", sColor:"#000000", sHoverColor:"#666666", sBgColor:"#EEFFEE", sFlashVars:"textalign=center"}));
};

//]]>
</script>

</body>
</html>
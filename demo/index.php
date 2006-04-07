<?php
// Start counting time for loading...
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include('../simplepie.inc');

// Parse it
$feed = new SimplePie();
$feed->bypass_image_hotlink();
$feed->strip_ads(true);

if (!empty($_GET['feed'])) {
	$feed->feed_url($_GET['feed']);

	if (isset($_GET['xmldump'])) {
		$feed->enable_xmldump($_GET['xmldump']);
	}
	$feed->init();
	if (!headers_sent() && $feed->get_encoding()) {
		header('Content-type: text/html; charset=' . $feed->get_encoding());
	}
}
else $feed->init();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo</title>

<link rel="stylesheet" href="./for_the_demo/simplepie.css" media="screen, projector" />
<script type="text/javascript" src="./for_the_demo/sifr.js"></script>
<script type="text/javascript" src="./for_the_demo/sleight.js"></script>

<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $feed->get_encoding(); ?>" />

</head>

<body id="bodydemo">

<ul id="menu">
	<!-- Must all be on the same line due to spacing bugs. -->
	<li id="demo"><a href="index.php">Demo</a>|</li><li><a href="http://simplepie.org/support/">Bug Reports &amp; Feature Requests</a>|</li><li><a href="http://simplepie.org/docs/reference/">Function Reference</a>|</li><li><a href="http://simplepie.org/blog/">Weblog</a></li>
</ul>

<div id="site">

	<div id="content">

		<div id="" class="chunk">
			<form action="" method="get" name="sp_form" id="sp_form">
				<div id="sp_input">
					<p><strong>Feed URL:</strong>&nbsp;<input type="text" name="feed" value="<?php if ($feed->subscribe_url()) echo $feed->subscribe_url(); ?>" class="text" id="feed_input" />&nbsp;<input type="submit" value="Read" class="button" /></p>
				</div>
			</form>
			<p class="sample_feeds"><strong>Or try one of the following:</strong> <a href="?feed=http://afterdawn.com/news/afterdawn_rss.xml#feed" title="Ripping, Burning, DRM, and the Dark Side of Consumer Electronics Media">Afterdawn</a>, <a href="?feed=http://feeds.feedburner.com/ajaxian#feed" title="AJAX and Scripting News">Ajaxian</a>, <a href="?feed=http://inessential.com/xml/rss.xml#feed" title="Developer of NetNewsWire">Brent Simmons</a>, <a href="?feed=http://www.crazyapplerumors.com/?feed=rss2#feed" title="Hilarity at its best">Crazy Apple Rumors</a>, <a href="?feed=http://del.icio.us/rss/#feed" title="The defacto social bookmarking site">del.icio.us</a>, <a href="?feed=http://digg.com/rss/index.xml#feed" title="Tech news.  Better than Slashdot.">Digg</a>, <a href="?feed=http://www.flickr.com/services/feeds/photos_public.gne?format=rss2#feed" title="Flickr Photos">Flickr</a>, <a href="?feed=http://gvod.blogspot.com/atom.xml#feed" title="Google Video of the Day">GVOD</a>, <a href="?feed=http://mir.aculo.us/xml/rss/feed.xml#feed" title="Weblog for the developer of Scriptaculous">mir.aculo.us</a>, <a href="?feed=http://images.apple.com/trailers/rss/newtrailers.rss#feed" title="Apple's QuickTime movie trailer site">Movie Trailers</a>, <a href="?feed=http://nick.typepad.com/blog/index.rss#feed" title="Developer of TopStyle and FeedDemon">Nick Bradbury</a>, <a href="?feed=http://feeds.feedburner.com/ok-cancel#feed" title="Usability comics and commentary">OK/Cancel</a>, <a href="?feed=http://osnews.com/files/recent.rdf#feed" title="News about every OS ever">OS News</a>, <a href="?feed=http://technorati.com/watchlists/rss.html?wid=29290#feed" title="Technorati watch for SimplePie">Technorati</a>, <a href="?feed=http://thinksecret.com/rss.xml#feed" title="Credible Mac Rumors">Think Secret</a>, <a href="?feed=http://youtube.com/rss/global/recently_added.rss#feed" title="Funny user-submitted videos">You Tube</a>, <a href="?feed=http://zeldman.com/rss/#feed" title="The father of the web standards movement">Zeldman</a>, <a href="" onclick="document.getElementById('more').style.display='block'; return false;"><strong>MORE &raquo;</strong></a></p>
			<p class="sample_feeds" id="more" style="display:none;"><strong>Test Feeds (hover to see what's tested):</strong> <a href="?feed=http://www.andybudd.com/index.rdf#feed" title="Test: Bypass Image Hotlink Blocking">Andy Budd</a>, <a href="?feed=http://www.ameinfo.com/rss/arabic/1558.xml#feed" title="Test: Windows-1256 Encoding">Arabic Language</a>, <a href="?feed=http://feeds.feedburner.com/AskANinja#feed" title="Test: Embedded Enclosures">Ask a Ninja</a>, <a href="?feed=http://www.atomenabled.org/atom.xml#feed" title="Test: Atom 1.0 Support">AtomEnabled.org</a>, <a href="?feed=http://www.channelfrederator.com/rss#feed" title="Test: Embedded Enclosures">Channel Frederator</a>, <a href="?feed=http://www.dooce.com/atom.xml#feed" title="Test: Ad Stripping">Dooce</a>, <a href="?feed=http://blogs.law.harvard.edu/xml/rss.xml#feed" title="Test: Tag Stripping">Harvard Law</a>, <a href="?feed=http://hagada.org.il/hagada/html/backend.php#feed" title="Test: Window-1255 Encoding">Hebrew Language</a>, <a href="?feed=http://korfball.hu/rss_news.xml#feed" title="ISO-8859-2">Hungarian Language</a>, <a href="?feed=http://www.infoworld.com/rss/news.xml#feed" title="Test: Ad Stripping">InfoWorld</a>, <a href="?feed=http://phobos.apple.com/WebObjects/MZStore.woa/wpa/MRSS/topsongs/limit=10/rss.xml#feed" title="Test: Tag Stripping">iTunes</a>, <a href="?feed=http://blog.japan.cnet.com/lessig/index.rdf#feed" title="Test: EUC-JP Encoding">Japanese Language</a>, <a href="?feed=http://nurapt.kaist.ac.kr/~jamaica/htmls/blog/rss.php#feed" title="Test: EUC-KR Encoding">Korean Language</a>, <a href="?feed=http://macnn.com/podcasts/macnn.rss#feed" title="Test: Embedded Enclosures">MacNN</a>, <a href="?feed=http://weblog.philringnalda.com/feed/#feed" title="Test: Atom 1.0 Support">Phil Ringnalda</a>, <a href="?feed=http://photocast.mac.com/turboderek/iPhoto/top-rides/index.rss#feed" title="Test: iPhoto 6 Photocasting">Photocast #1</a>, <a href="?feed=http://photocast.mac.com/turboderek/iPhoto/best-of-the-ladies/index.rss#feed" title="Test: iPhoto 6 Photocasting">Photocast #2</a>, <a href="?feed=http://photocast.mac.com/awalker/iPhoto/christmas-2005/index.rss#feed" title="Test: iPhoto 6 Photocasting">Photocast #3</a>, <a href="?feed=http://www.pariurisportive.com/blog/xmlsrv/rss2.php?blog=2#feed" title="Test: ISO-8859-1 Encoding">Romanian Language</a>, <a href="?feed=http://www.erased.info/rss2.php#feed" title="Test: KOI8-R Encoding">Russian Language</a>, <a href="?feed=http://ubb.frostyplace.com.tw/rdf.php#feed" title="Test: BIG5 Encoding">Taiwanese Language</a>, <a href="?feed=http://www.tbray.org/ongoing/ongoing.atom#feed" title="Test: Atom 1.0 Support">Tim Bray</a>, <a href="?feed=http://tuaw.com/rss.xml#feed" title="Test: Ad Stripping">TUAW</a>, <a href="?feed=http://www.tvgasm.com/atom.xml#feed" title="Test: Bypass Image Hotlink Blocking">TVgasm</a></p>
			<a name="feed"></a>
		</div>

		<div id="sp_results">
			<?php if ($feed->data): ?>
				<div class="chunk focus" align="center">
					<h3 class="header"><?php if ($feed->get_feed_link()) echo '<a href="' . $feed->get_feed_link() . '">'; echo $feed->get_feed_title(); if ($feed->get_feed_link()) echo '</a>'; ?></h3>
					<?php echo $feed->get_feed_description(); ?>
				</div>
				<p class="subscribe"><strong>Subscribe:</strong> <a href="<?php echo $feed->subscribe_aol(); ?>">My AOL</a>, <a href="<?php echo $feed->subscribe_bloglines(); ?>">Bloglines</a>, <a href="<?php echo $feed->subscribe_google(); ?>">Google Reader</a>, <a href="<?php echo $feed->subscribe_msn(); ?>">My MSN</a>, <a href="<?php echo $feed->subscribe_newsburst(); ?>">Newsburst</a>,<br /><a href="<?php echo $feed->subscribe_newsgator(); ?>">Newsgator</a>, <a href="<?php echo $feed->subscribe_odeo(); ?>">Odeo</a>, <a href="<?php echo $feed->subscribe_pluck(); ?>">Pluck</a>, <a href="<?php echo $feed->subscribe_podnova(); ?>">Podnova</a>, <a href="<?php echo $feed->subscribe_rojo(); ?>">Rojo</a>, <a href="<?php echo $feed->subscribe_yahoo(); ?>">My Yahoo!</a>, <a href="<?php echo $feed->subscribe_feed(); ?>">Desktop Reader</a></p>
				<?php foreach($feed->get_items() as $item): ?>
					<div class="chunk">
						<h4><?php if ($item->get_permalink()) echo '<a href="' . $item->get_permalink() . '">'; echo $item->get_title(); if ($item->get_permalink()) echo '</a>'; ?>&nbsp;<span class="footnote"><?php echo $item->get_date('j M Y'); ?></span></h4>
						<?php echo $item->get_description(); ?>
						<?php
						if ($enclosure = $item->get_enclosure(0)) {
							echo '<p>' . $enclosure->embed("audio:./for_the_demo/place_audio.png, video:./for_the_demo/place_video.png, alt:<img src='./for_the_demo/mini_podcast.png' class='download' border='0' title='Download the Podcast (" . $enclosure->get_extension() . "; " . $enclosure->get_size() . " MB)' />, altclass:download") . '</p>';
						}
						?>
						<p class="footnote" align="center"><a href="<?php echo $item->add_to_delicious(); ?>" title="Add post to del.icio.us">Del.icio.us</a> | <a href="<?php echo $item->add_to_digg(); ?>" title="Digg this!">Digg</a> | <a href="<?php echo $item->add_to_furl(); ?>" title="Add post to Furl">Furl</a> | <a href="<?php echo $item->add_to_myweb20(); ?>" title="Add post to My Web 2.0">My Web 2.0</a> | <a href="<?php echo $item->add_to_newsvine(); ?>" title="Add post to Newsvine">Newsvine</a> | <a href="<?php echo $item->add_to_reddit(); ?>" title="Add post to Reddit">Reddit</a> | <a href="<?php echo $item->add_to_spurl(); ?>" title="Add post to Spurl">Spurl</a> | <a href="<?php echo $item->search_technorati(); ?>" title="Who's linking to this post?">Technorati</a></p>
					</div>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<div>
			<p class="footnote">Page processed in <?php $mtime = explode(' ', microtime()); echo round($mtime[0] + $mtime[1] - $starttime, 3); ?> seconds.</p>
			<p class="footnote"><strong>PHP:</strong> <?php echo phpversion();?>, <strong>mbstring:</strong> <a href="http://simplepie.org/docs/reference/simplepie-core/supported-character-encodings/"><?php echo (extension_loaded('mbstring')) ? 'enabled' : 'not available' ?></a>, <strong>iconv:</strong> <a href="http://simplepie.org/docs/reference/simplepie-core/supported-character-encodings/"><?php echo (extension_loaded('iconv')) ? 'enabled' : 'not available' ?></a></p>
			<p class="footnote"><?php echo $feed->useragent; ?></p>
			<p class="footnote">SimplePie is &copy; 2004&ndash;<?php echo date('Y'); ?>, <a href="http://www.skyzyx.com">Skyzyx Technologies</a>, and licensed under the <a href="http://creativecommons.org/licenses/LGPL/2.1/">LGPL</a>.</p>
		</div>

	</div>

</div>

<script type="text/javascript">
//<![CDATA[

// Load the sIFR font.
if(typeof sIFR == "function"){
	sIFR.replaceElement(named({sSelector:"h3.header", sFlashSrc:"./for_the_demo/yanone-kaffeesatz-bold.swf", sColor:"#000000", sHoverColor:"#666666", sBgColor:"#EEFFEE", sFlashVars:"textalign=center"}));
};

//]]>
</script>

</body>
</html>
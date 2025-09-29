<?php

declare(strict_types=1);

// Start counting time for the page load
$starttime = microtime(true);

// Include SimplePie
// Located in the parent directory
include_once('../autoloader.php');

// Create a new instance of the SimplePie object
$feed = new \SimplePie\SimplePie();

//$feed->force_fsockopen(true);

if (isset($_GET['js'])) {
    \SimplePie\Misc::output_javascript();
    die();
}

// Make sure that page is getting passed a URL
if (isset($_GET['feed']) && $_GET['feed'] !== '') {
    // Use the URL that was passed to the page in SimplePie
    $feed->set_feed_url($_GET['feed']);
}

// Allow us to change the input encoding from the URL string if we want to. (optional)
if (!empty($_GET['input'])) {
    $feed->set_input_encoding($_GET['input']);
}

// Allow us to choose to not re-order the items by date. (optional)
if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false') {
    $feed->enable_order_by_date(false);
}

// Trigger force-feed
if (!empty($_GET['force']) && $_GET['force'] == 'true') {
    $feed->force_feed(true);
}

// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
// all that other good stuff.  The feed's information will not be available to SimplePie before
// this is called.
$success = $feed->init();

// We'll make sure that the right content type and character encoding gets set automatically.
// This function will grab the proper character encoding, as well as set the content type to text/html.
$feed->handle_content_type();

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make
// sure that the browser snaps into Standards Mode.
?><!DOCTYPE html>

<html lang="en-US">
<head>
<title>SimplePie: Demo</title>

<link rel="stylesheet" href="./for_the_demo/sIFR-screen.css" type="text/css" media="screen">
<link rel="stylesheet" href="./for_the_demo/sIFR-print.css" type="text/css" media="print">
<link rel="stylesheet" href="./for_the_demo/simplepie.css" type="text/css" media="screen, projector" />

<script type="text/javascript" src="./for_the_demo/sifr.js"></script>
<script type="text/javascript" src="./for_the_demo/sifr-config.js"></script>
<script type="text/javascript" src="./for_the_demo/sleight.js"></script>
<script type="text/javascript" src="?js"></script>

</head>

<body id="bodydemo">

<div id="header">
    <div id="headerInner">
        <div id="logoContainer">
            <div id="logoContainerInner">
                <div align="center"><a href="http://simplepie.org"><img src="./for_the_demo/logo_simplepie_demo.png" alt="SimplePie Demo: PHP-based RSS and Atom feed handling" title="SimplePie Demo: PHP-based RSS and Atom feed handling" border="0" /></a></div>
                <div class="clearLeft"></div>
            </div>

        </div>
        <div id="menu">
        <!-- I know, I know, I know... tables for layout, I know.  If a web standards evangelist (like me) has to resort
        to using tables for something, it's because no other possible solution could be found.  This issue?  No way to
        do centered floats purely with CSS. The table box model allows for a dynamic width while centered, while the
        CSS box model for DIVs doesn't allow for it. :( -->
        <table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td>
<ul><li id="demo"><a href="./">SimplePie Demo</a></li><li><a href="http://simplepie.org/wiki/faq/start">FAQ/Troubleshooting</a></li><li><a href="http://simplepie.org/support/">Support Forums</a></li><li><a href="http://simplepie.org/wiki/reference/start">API Reference</a></li><li><a href="http://simplepie.org/blog/">Weblog</a></li><li><a href="../test/test.php">Unit Tests</a></li></ul>

            <div class="clearLeft"></div>
        </td></tr></tbody></table>
        </div>
    </div>
</div>

<div id="site">

    <div id="content">

        <div class="chunk">
            <form action="" method="get" name="sp_form" id="sp_form">
                <div id="sp_input">


                    <!-- If a feed has already been passed through the form, then make sure that the URL remains in the form field. -->
                    <p><input type="text" name="feed" value="<?php if ($feed->subscribe_url()) {
                        echo $feed->subscribe_url();
                    } ?>" class="text" id="feed_input" />&nbsp;<input type="submit" value="Read" class="button" /></p>


                </div>
            </form>

<?php
// Check to see if there are more than zero errors (i.e. if there are any errors at all)
if ($feed->error()) {
    // If so, start a <div> element with a classname so we can style it.
    echo '<div class="sp_errors">' . "\r\n";

    // ... and display it.
    echo '<p>' . htmlspecialchars($feed->error()) . "</p>\r\n";

    // Close the <div> element we opened.
    echo '</div>' . "\r\n";
}
?>

            <!-- Here are some sample feeds. -->
            <p class="sample_feeds"><strong>Or try one of the following:</strong>
            <a href="?feed=http://afterdawn.com/news/afterdawn_rss.xml" title="Ripping, Burning, DRM, and the Dark Side of Consumer Electronics Media">Afterdawn</a>,
            <a href="?feed=http://feeds.feedburner.com/ajaxian" title="AJAX and Scripting News">Ajaxian</a>,
            <a href="?feed=http://www.andybudd.com/index.rdf&amp;image=true" title="Test: Bypass Image Hotlink Blocking">Andy Budd</a>,
            <a href="?feed=http://feeds.feedburner.com/AskANinja" title="Test: Embedded Enclosures">Ask a Ninja</a>,
            <a href="?feed=http://newsrss.bbc.co.uk/rss/newsonline_world_edition/front_page/rss.xml" title="World News">BBC News</a>,
            <a href="?feed=http://newsrss.bbc.co.uk/rss/chinese/simp/news/rss.xml" title="Test: GB2312 Encoding">BBC China</a>,
            <a href="?feed=http://inessential.com/xml/rss.xml" title="Developer of NetNewsWire">Brent Simmons</a>,
            <a href="?feed=http://rss.cnn.com/rss/cnn_topstories.rss" title="World News">CNN</a>,
            <a href="?feed=http://digg.com/rss/index.xml" title="Tech news. Better than Slashdot.">Digg</a>,
            <a href="?feed=http://www.flickr.com/services/feeds/photos_public.gne?format=rss2" title="Flickr Photos">Flickr</a>,
            <a href="?feed=http://news.google.com/?output=rss" title="World News">Google News</a>,
            <a href="?feed=http://blogs.law.harvard.edu/home/feed/rdf/" title="Test: Tag Stripping">Harvard Law</a>,
            <a href="?feed=http://phobos.apple.com/WebObjects/MZStore.woa/wpa/MRSS/topsongs/limit=10/rss.xml&amp;orderbydate=false" title="Test: Tag Stripping">iTunes</a>,
            <a href="?feed=http://blog.japan.cnet.com/lessig/index.rdf" title="Test: EUC-JP Encoding">Japanese Language</a>,
            <a href="?feed=http://www.newspond.com/rss/main.xml" title="Tech and Science News">Newspond</a>,
            <a href="?feed=http://feeds.feedburner.com/ok-cancel" title="Usability comics and commentary">OK/Cancel</a>,
            <a href="?feed=http://osnews.com/files/recent.rdf" title="News about every OS ever">OS News</a>,
            <a href="?feed=http://weblog.philringnalda.com/feed/" title="Test: Atom 1.0 Support">Phil Ringnalda</a>,
            <a href="?feed=http://www.reddit.com/.rss" title="Top links from around the web">reddit</a>,
            <a href="?feed=http://www.pariurisportive.com/blog/xmlsrv/rss2.php?blog=2" title="Test: ISO-8859-1 Encoding">Romanian Language</a>,
            <a href="?feed=http://blog.ryanparman.com/feed/" title="SimplePie developer alumnus">Ryan Parman</a>,
            <a href="?feed=http://technorati.com/watchlists/rss.html?wid=29290" title="Technorati watch for SimplePie">Technorati</a>,
            <a href="?feed=http://engadget.com/rss.xml" title="Tech web magazine">Engadget</a>,
            <a href="?feed=http://feeds.feedburner.com/web20Show" title="Test: Embedded Enclosures">Web 2.0 Show</a>,
            <a href="?feed=http://xkcd.com/rss.xml" title="Test: LightHTTPd and GZipping">XKCD</a>,
            <a href="?feed=http://rss.news.yahoo.com/rss/topstories" title="World News">Yahoo! News</a>,
            <a href="?feed=http://zeldman.com/rss/" title="The father of the web standards movement">Zeldman</a></p>

        </div>

        <div id="sp_results">

            <!-- As long as the feed has data to work with... -->
            <?php if ($success): ?>
                <div class="chunk focus" align="center">

                    <!-- If the feed has a link back to the site that publishes it (which 99% of them do), link the feed's title to it. -->
                    <h3 class="header">
                    <?php
                    $link = $feed->get_link();
                $title = $feed->get_title();
                if ($link) {
                    $title = "<a href='$link' title='$title'>$title</a>";
                }
                echo $title;
                ?>
                    </h3>

                    <!-- If the feed has a description, display it. -->
                    <?php echo $feed->get_description(); ?>

                </div>

                <!-- Let's begin looping through each individual news item in the feed. -->
                <?php foreach ($feed->get_items() as $item): ?>
                    <div class="chunk">

                        <!-- If the item has a permalink back to the original post (which 99% of them do), link the item's title to it. -->
                        <h4><?php
                        if ($item->get_permalink()) {
                            echo '<a href="' . $item->get_permalink() . '">';
                        }
                    echo $item->get_title();
                    if ($item->get_permalink()) {
                        echo '</a>';
                    }
                    ?>&nbsp;<span class="footnote"><?php echo $item->get_date('j M Y, g:i a'); ?></span></h4>

                        <!-- Display the item's primary content. -->
                        <?php echo $item->get_content(); ?>

                        <?php
                    // Check for enclosures.  If an item has any, set the first one to the $enclosure variable.
                    if ($enclosure = $item->get_enclosure(0)) {
                        // Use the embed() method to embed the enclosure into the page inline.
                        echo '<div align="center">';
                        echo '<p>' . $enclosure->embed([
                            'audio' => './for_the_demo/place_audio.png',
                            'video' => './for_the_demo/place_video.png',
                            'mediaplayer' => './for_the_demo/mediaplayer.swf',
                            'altclass' => 'download'
                        ]) . '</p>';

                        if ($enclosure->get_link() && $enclosure->get_type()) {
                            echo '<p class="footnote" align="center">(' . $enclosure->get_type();
                            if ($enclosure->get_size()) {
                                echo '; ' . $enclosure->get_size() . ' MB';
                            }
                            echo ')</p>';
                        }
                        if ($enclosure->get_thumbnail()) {
                            echo '<div><img src="' . $enclosure->get_thumbnail() . '" alt="" /></div>';
                        }
                        echo '</div>';
                    }
                    ?>

                    </div>

                <!-- Stop looping through each item once we've gone through all of them. -->
                <?php endforeach; ?>

            <!-- From here on, we're no longer using data from the feed. -->
            <?php endif; ?>

        </div>

        <div>
            <!-- Display how fast the page was rendered. -->
            <p class="footnote">Page processed in <?php echo round(microtime(true) - $starttime, 3); ?> seconds.</p>

            <!-- Display the version of SimplePie being loaded. -->
            <p class="footnote">Powered by <a href="<?php echo \SimplePie\SimplePie::URL; ?>"><?php echo \SimplePie\SimplePie::NAME . ' ' . \SimplePie\SimplePie::VERSION . ', Build ' . \SimplePie\Misc::get_build(); ?></a>.  Run the <a href="../compatibility_test/sp_compatibility_test.php">SimplePie Compatibility Test</a>.  SimplePie is &copy; 2004&ndash;<?php echo date('Y'); ?>, Ryan Parman and Sam Sneddon, and licensed under the <a href="http://www.opensource.org/licenses/bsd-license.php">BSD License</a>.</p>
        </div>

    </div>

</div>

</body>
</html>

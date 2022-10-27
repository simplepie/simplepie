+++
title = "Limit the number of items per feed to be used with Multifeeds"
+++

<div class="warning">

**This tutorial is obsolete. Use the `set_item_limit()` method instead.**

</div>

In SimplePie 1.0, we simplified the process of merging together multiple feeds, sorting them by date, and displaying them. This method allows you to do all of the normal SimplePie stuff without requiring you to do any array hacking or anything. This tutorial will show you how to merge only the first 5 items per feed, and sort those by date and time.

There are a few things to keep in mind about merging multiple feeds:

- When you mash multiple feeds together, how do you know which feed title or favicon to use? You don't. So, the object that gets created when mashing feeds does not have any feed-level data.
- You can still get at an individual item's parent feed data using the `get_feed()` method.
- All feed items MUST have dates or else <abbr title="Hypertext Preprocessor">PHP</abbr> will sort them to the top.

<div class="warning">

**If you're merging multiple feeds together, they need to all have dates for the items or else <abbr title="Hypertext Preprocessor">PHP</abbr> will sort them to the top.** This tutorial assumes that you're already familiar with using SimplePie, including looping through items.

</div>

## Compatibility {#compatibility}

- Supported in SimplePie 1.0
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.
- Code in this tutorial is taken from the multifeeds.php demo page that is included with the SimplePie download in the `/demo/` folder, and has been modified for the purposes of this tutorial.

## Example {#example}

```php
<?php
// Include the SimplePie library
require_once('../simplepie.inc');

// Because we're using multiple feeds, let's just set the headers here.
header('Content-type:text/html; charset=utf-8');

// These are the feeds we want to use
$feeds = array(
    'http://rss.news.yahoo.com/rss/topstories',
    'http://news.google.com/?output=atom',
    'http://rss.cnn.com/rss/cnn_topstories.rss'
);

// This array will hold the items we'll be grabbing.
$first_items = array();

// Let's go through the array, feed by feed, and store the items we want.
foreach ($feeds as $url)
{
    // Use the long syntax
    $feed = new SimplePie();
    $feed->set_feed_url($url);
    $feed->init();

    // How many items per feed should we try to grab?
    $items_per_feed = 5;

    // As long as we're not trying to grab more items than the feed has, go through them one by one and add them to the array.
    for ($x = 0; $x < $feed->get_item_quantity($items_per_feed); $x++)
    {
        $first_items[] = $feed->get_item($x);
    }

    // We're done with this feed, so let's release some memory.
    unset($feed);
}

// We need to sort the items by date with a user-defined sorting function.  Since usort() won't accept "SimplePie::sort_items", we need to wrap it in a new function.
function sort_items($a, $b)
{
    return SimplePie::sort_items($a, $b);
}

// Now we can sort $first_items with our custom sorting function.
usort($first_items, "sort_items");


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
    .clearBoth {
        clear:both;
    }
    </style>
</head>
<body>
<div id="site">

    <div class="chunk">
        <h1>Quick-n-Dirty Multifeeds Demo</a></h1>
    </div>

    <?php
    foreach($first_items as $item):
        $feed = $item->get_feed();
        ?>

        <div class="chunk">
            <h4><a href="<?php echo $item->get_permalink(); ?>"><?php echo html_entity_decode($item->get_title(), ENT_QUOTES, 'UTF-8'); ?></a></h4>

            <?php echo $item->get_content(); ?>

            <?php if ($enclosure = $item->get_enclosure()): ?>
                <div>
                <?php echo $enclosure->native_embed(array(
                    // New 'mediaplayer' attribute shows off Flash-based MP3 and FLV playback.
                    'mediaplayer' => '../demo/for_the_demo/mediaplayer.swf'
                )); ?>
                </div>
            <?php endif; ?>

            <p class="footnote">Source: <a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a> | <?php echo $item->get_date('j M Y | g:i a'); ?></p>
        </div>

    <?php endforeach; ?>

    <p class="footnote">This is a test of the emergency broadcast system.  This is only a test&hellip; beeeeeeeeeeeeeeeeeeeeeeeeeep!</p>

</div>
</body>
</html>
```

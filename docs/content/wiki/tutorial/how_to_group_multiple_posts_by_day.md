+++
title = "How to group multiple posts by day"
+++

For this tutorial, I'll show you how to group posts by date, and inside each of those groups all of the items are sorted by time.

This will ONLY work for feeds where all items have timestamps. This is NOT 100% reliable because some feeds simply don't have timestamps.

<div class="warning">

**This tutorial RELIES on feed items having dates. Ergo, if there are no dates, then this method won't work.** This tutorial assumes that you're already familiar with using SimplePie, including looping through items.

</div>

## Compatibility {#compatibility}

- Supported in SimplePie 1.0 or newer.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Single Feed {#single_feed}

```php
<?php
// Include SimplePie
include('simplepie.inc');

// Initialize SimplePie
$feed = new SimplePie('http://feeds.uneasysilence.com/uneasysilence/blog');

// Make sure that we're sending the right character set headers, etc.
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Group items by date</title>
</head>

<body>
<?php

echo '<h1>' . $feed->get_title() . '</h1>';

// Set up some variables we'll use.
$stored_date = '';
$list_open = false;

// Go through all of the items in the feed
foreach ($feed->get_items() as $item)
{
    // What is the date of the current feed item?
    $item_date = $item->get_date('M jS');

    // Is the item's date the same as what is already stored?
    // - Yes? Don't display it again because we've already displayed it for this date.
    // - No? So we have something different.  We should display that.
    if ($stored_date != $item_date)
    {
        // If there was already a list open from a previous iteration of the loop, close it
        if ($list_open)
        {
            echo '</ol>';
        }

        // Since they're different, let's replace the old stored date with the new one
        $stored_date = $item_date;

        // Display it on the page, and start a new list
        echo '<h2>' . $stored_date . '</h2>';
        echo '<ol>';

        // Let the next loop know that a list is already open, so that it will know to close it.
        $list_open = true;
    }

    // Display the feed item however you want...
    echo '<li><strong><a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a></strong> &mdash; ' . $item->get_date('g:i a') . '</li>';
}
?>
</ol>
</body>
</html>
```

## Merging Multiple Feeds {#merging_multiple_feeds}

```php
<?php
// Include SimplePie
include('simplepie.inc');

// Initialize SimplePie
$feed = new SimplePie(array(
    'http://api.flickr.com/services/feeds/photos_public.gne?id=33495701@N00&lang=en-us&format=rss_200',
    'http://ws.audioscrobbler.com/1.0/user/skyzyx/recenttracks.rss',
    'http://twitter.com/statuses/user_timeline/799525.atom',
    'http://feeds.feedburner.com/simplepie',
    'http://ma.gnolia.com/rss/lite/people/Skyzyx'
));

// Make sure that we're sending the right character set headers, etc.
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Group items by date</title>
</head>

<body>
<?php

echo '<h1>' . $feed->get_title() . '</h1>';

// Set up some variables we'll use.
$stored_date = '';
$list_open = false;

// Go through all of the items in the feed
foreach ($feed->get_items() as $item)
{
    // What is the date of the current feed item?
    $item_date = $item->get_date('M jS');

    // Is the item's date the same as what is already stored?
    // - Yes? Don't display it again because we've already displayed it for this date.
    // - No? So we have something different.  We should display that.
    if ($stored_date != $item_date)
    {
        // If there was already a list open from a previous iteration of the loop, close it
        if ($list_open)
        {
            echo '</ol>' . "\r\n";
        }

        // Since they're different, let's replace the old stored date with the new one
        $stored_date = $item_date;

        // Display it on the page, and start a new list
        echo '<h2>' . $stored_date . '</h2>' . "\r\n";
        echo '<ol>' . "\r\n";

        // Let the next loop know that a list is already open, so that it will know to close it.
        $list_open = true;
    }

    // Display the feed item however you want...
    echo '<li><strong><img src="' . $item->get_feed()->get_favicon() . '" width="16" height="16" /> <a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a></strong> &mdash; ' . $item->get_date('g:i a') . '</li>' . "\r\n";
}
?>
</ol>
</body>
</html>
```

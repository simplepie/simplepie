+++
title = "Only display items from the last 24 hours"
+++

This is a pretty simple way of sorting out the more recent news items from the less recent news items. We simply determine what 24 hours ago was, and then check each item to see if its timestamp is within that timeframe.

This will ONLY work for feeds where all items have timestamps. This is NOT 100% reliable because some feeds simply don't have timestamps.

<div class="warning">

**This tutorial RELIES on feed items having dates. Ergo, if there are no dates, then this method won't work.** This tutorial assumes that you're already familiar with using SimplePie, including looping through items.

</div>

## Compatibility {#compatibility}

- Supported in SimplePie Beta 2 or newer.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Code source {#code_source}

```php
<?php
// Make sure that SimplePie is loaded
require_once('simplepie.inc');

// Initialize new feed
$feed = new SimplePie();
$feed->set_feed_url('feed://www.tuaw.com/rss.xml');
$feed->init();

// Create a new array to hold data in
$new = array();

// Loop through all of the items in the feed
foreach ($feed->get_items() as $item) {

    // Calculate 24 hours ago
    $yesterday = time() - (24*60*60);

    // Compare the timestamp of the feed item with 24 hours ago.
    if ($item->get_date('U') > $yesterday) {

        // If the item was posted within the last 24 hours, store the item in our array we set up.
        $new[] = $item;
    }
}

// Loop through all of the items in the new array and display whatever we want.
foreach($new as $item) {
    echo '<h3>' . $item->get_title() . '</h3>';
    echo '<p>' . $item->get_date('j M Y, H:i:s O') . '</p>';
    echo $item->get_description();
    echo '<hr />';
}
?>
```

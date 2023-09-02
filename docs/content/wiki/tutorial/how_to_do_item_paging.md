+++
title = "How to do item paging"
+++

Although this tutorial doesn't **require** SimplePie (this is just plain ol' <abbr title="Hypertext Preprocessor">PHP</abbr>), there have been a few users who have asked for this. In this tutorial we will merge multiple feeds together, and allow for a variety of paging options (5, 10, or 20 items per page; Previous and Next buttons).

## Compatibility {#compatibility}

- Supported in SimplePie 1.0.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Code source {#code_source}

```php
<?php
require_once('simplepie.inc');

// Set your own configuration options as you see fit.
$feed = new SimplePie();
$feed->set_feed_url(array(
    'http://www.newsvine.com/_feeds/rss2/tag?id=technology',
    'http://uneasysilence.com/feed/',
    'http://www.tuaw.com/rss.xml'
));
$success = $feed->init();

// Make sure the page is being served with the right headers.
$feed->handle_content_type();

// Set our paging values
$start = (isset($_GET['start']) && !empty($_GET['start'])) ? $_GET['start'] : 0; // Where do we start?
$length = (isset($_GET['length']) && !empty($_GET['length'])) ? $_GET['length'] : 5; // How many per page?
$max = $feed->get_item_quantity(); // Where do we end?

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make
// sure that the browser snaps into Standards Mode.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo</title>

<link rel="stylesheet" href="styles.css" type="text/css" media="screen, projector" />

</head>

<body>
<div id="site">
    <?php
    // If we have an error, display it.
    if ($feed->error())
    {
        echo '<div class="sp_errors">' . "\r\n";
        echo '<p>' . htmlspecialchars($feed->error()) . "</p>\r\n";
        echo '</div>' . "\r\n";
    }
    ?>

    <?php if ($success): ?>
        <?php
        // get_items() will accept values from above.
        foreach($feed->get_items($start, $length) as $item):
            $feed = $item->get_feed();
        ?>

            <div class="chunk">

                <h4><?php if ($item->get_permalink()) echo '<a href="' . $item->get_permalink() . '">'; echo $item->get_title(true); if ($item->get_permalink()) echo '</a>'; ?></h4>
                <?php echo $item->get_content(); ?>
                <p class="footnote">Source: <a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a> | <?php echo $item->get_date('j M Y, g:i a'); ?></p>

            </div>

        <?php endforeach; ?>
    <?php endif; ?>

    <?php
    // Let's do our paging controls
    $next = (int) $start + (int) $length;
    $prev = (int) $start - (int) $length;

    // Create the NEXT link
    $nextlink = '<a href="?start=' . $next . '&length=' . $length . '">Next &raquo;</a>';
    if ($next > $max)
    {
        $nextlink = 'Next &raquo;';
    }

    // Create the PREVIOUS link
    $prevlink = '<a href="?start=' . $prev . '&length=' . $length . '">&laquo; Previous</a>';
    if ($prev < 0 && (int) $start > 0)
    {
        $prevlink = '<a href="?start=0&length=' . $length . '">&laquo; Previous</a>';
    }
    else if ($prev < 0)
    {
        $prevlink = '&laquo; Previous';
    }

    // Normalize the numbering for humans
    $begin = (int) $start + 1;
    $end = ($next > $max) ? $max : $next;
    ?>

    <p>Showing <?php echo $begin; ?>&ndash;<?php echo $end; ?> out of <?php echo $max; ?> | <?php echo $prevlink; ?> | <?php echo $nextlink; ?> | <a href="<?php echo '?start=' . $start . '&length=5'; ?>">5</a>, <a href="<?php echo '?start=' . $start . '&length=10'; ?>">10</a>, or <a href="<?php echo '?start=' . $start . '&length=20'; ?>">20</a> at a time.</p>
</div>

</body>
</html>
```

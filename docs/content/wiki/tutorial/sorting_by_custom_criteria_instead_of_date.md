+++
title = "Sorting by custom criteria instead of date"
+++

Sometimes you may want to sort items by custom criteria other than the time/date. In the following example, we're going to sort the Digg feed by the number of diggs instead of by date.

<div class="warning">

This tutorial assumes that you're already familiar with using SimplePie, including looping through items. It also assumes that you know how to use [SimplePie Add-ons](@/wiki/addons/_index.md) (specifically the [Digg RSS](@/wiki/addons/digg.md) Add-on).

</div>

## Compatibility {#compatibility}

- Supported in SimplePie 1.0.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Example {#example}

In this example, we'll use the methods available in the [Digg RSS](@/wiki/addons/digg.md) Add-on to grab extra Digg-specific data, and we'll extend the SimplePie class and override the [sort_items()](@/wiki/reference/simplepie/sort_items.md) method to sort by number of diggs.

```php
<?php
// Include the necessary libraries. Digg Add-on found at http://simplepie.org/wiki/addons/digg
require_once('simplepie.inc');
require_once('simplepie_digg.inc');

// Extend the SimplePie class and override the existing sort_items() function with our own.
class SimplePie_Custom_Sort extends SimplePie
{
    public static function sort_items($a, $b)
    {
        return $a->get_digg_count() <= $b->get_digg_count();
    }
}

// Instantiate a new SimplePie_Custom_Sort class.
$feed = new SimplePie_Custom_Sort();
$feed->set_feed_url('http://digg.com/rss/index.xml');
$feed->set_item_class('SimplePie_Item_Digg'); // Make sure we use the Digg Add-on
$feed->set_cache_duration(300); // 5 minutes
$feed->init();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Digg Test</title>

    <style type="text/css">
    body {
        font:1em/1.3em "Lucida Grande";
    }

    h2 span.diggs {
        background-color:#ff9;
    }
    </style>

</head>
<body>

    <?php foreach ($feed->get_items() as $item): ?>

        <h2><span class="diggs"><?php echo $item->get_digg_count(); ?></span> <a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
        <p><?php echo $item->get_description(); ?></p>
        <p><small>Posted by <a href="http://digg.com/users/<?php echo $item->get_submitter_username(); ?>"><?php echo $item->get_submitter_username(); ?></a> on <?php echo $item->get_date(); ?></small></p>

    <?php endforeach; ?>

</body>
</html>
```

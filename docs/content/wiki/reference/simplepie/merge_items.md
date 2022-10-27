+++
title = "merge_items()"
+++

## Description {#description}

```php
class SimplePie {
    merge_items ( array $objects,  [int $start = 0],  [int $length = 0])
}
```

This method merges the items from multiple [SimplePie](@/wiki/reference/simplepie/_index.md) objects.

<div class="warning">

**If you're merging multiple feeds together, they need to all have dates for the items or else <abbr title="Hypertext Preprocessor">PHP</abbr> will sort them to the top.**

</div>

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### objects (required) {#objects_required}

An array of [SimplePie](@/wiki/reference/simplepie/_index.md) objects.

### start {#start}

The number of the item you want to start at. Remember that arrays begin with `0`, not `1`.

### length {#length}

The number of items to return. `0` will return all. The `start` parameter is required if this is used.

## Examples {#examples}

### Set the feed URL to the SimplePie blog {#set_the_feed_url_to_the_simplepie_blog}

```php
$digg = new SimplePie('http://digg.com/rss/index.xml');

$tuaw = new SimplePie();
$tuaw->set_feed_url('http://feeds.tuaw.com/weblogsinc/tuaw');
$tuaw->set_favicon_handler('handler_image.php');
$tuaw->init();

$uneasy = new SimplePie('http://feeds.uneasysilence.com/uneasysilence/blog');

$merged = SimplePie::merge_items(array($digg, $tuaw, $uneasy));

header('Content-type:text/html; charset=utf-8');

$item = $merged[0];
echo $item->get_title();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [Sort multiple feeds by time and date](@/wiki/tutorial/sort_multiple_feeds_by_time_and_date.md#if_feeds_require_separate_per-feed_settings "tutorial:sort_multiple_feeds_by_time_and_date")

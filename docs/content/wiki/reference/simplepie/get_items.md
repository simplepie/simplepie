+++
title = "get_items()"
+++

## Description {#description}

```php
class SimplePie {
    get_items ( [int $start = 0 [, int $length = 0] ] )
}
```

Returns an array of [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md) references for each item in the feed, which can be looped through.

This is better suited for [foreach()](http://php.net/foreach) loops, whereas [get_item()](@/wiki/reference/simplepie/get_item.md) is better suited for [for()](http://php.net/manual/en/control-structures.for.php) loops.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### start {#start}

The number of the item you want to start at. Remember that arrays begin with `0`, not `1`.

### length {#length}

The number of items to return. `0` will return all. The `start` parameter is required if this is used.

## Examples {#examples}

### Loop through the first 5 itemss and do something with each {#loop_through_the_first_5_itemss_and_do_something_with_each}

```php
<?php
require_once('../simplepie.inc');

$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Sample SimplePie Page</title>
 </head>
<body>

    <div class="header">
        <h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
        <p><?php echo $feed->get_description(); ?></p>
    </div>

    <?php foreach ($feed->get_items(0, 5) as $item): ?>

        <div class="item">
            <h2 class="title"><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
            <?php echo $item->get_description(); ?>
            <p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
        </div>

    <?php endforeach; ?>

</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [get_item()](@/wiki/reference/simplepie/get_item.md)
- [get_item_quantity()](@/wiki/reference/simplepie/get_item_quantity.md)

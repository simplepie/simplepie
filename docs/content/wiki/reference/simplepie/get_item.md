+++
title = "get_item()"
+++

## Description {#description}

```php
class SimplePie {
    get_item ( [int $key = 0] )
}
```

Returns a single array location containing a [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md) reference for an item in the feed.

This is better suited for [for()](http://php.net/manual/en/control-structures.for.php) loops, whereas [get_items()](@/wiki/reference/simplepie/get_items.md) is better suited for [foreach()](http://php.net/foreach) loops.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### key {#key}

The item that you want to return. Remember that arrays begin with `0`, not `1`.

## Examples {#examples}

### Loop through each item and do something with each {#loop_through_each_item_and_do_something_with_each}

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

    <?php
    $max = $feed->get_item_quantity();
    for ($x = 0; $x < $max; $x++):
        $item = $feed->get_item($x);
        ?>

        <div class="item">
            <h2 class="title"><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
            <?php echo $item->get_description(); ?>
            <p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
        </div>

    <?php endfor; ?>

</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [get_items()](@/wiki/reference/simplepie/get_items.md)
- [get_item_quantity()](@/wiki/reference/simplepie/get_item_quantity.md)

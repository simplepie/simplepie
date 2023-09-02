+++
title = "get_item_quantity()"
+++

## Description {#description}

```php
class SimplePie {
    get_item_quantity ( [int $max = 0] )
}
```

Returns the number of items in a feed. This is well-suited for [for()](http://php.net/manual/en/control-structures.for.php) loops.

## Availability {#availability}

- Available since SimplePie 0.8.

## Parameters {#parameters}

### max {#max}

The maximum number of items to return. If there are fewer items in the feed than what `max` is set to, SimplePie will return the lower number. Setting a value of `0` will return the number of items in the feed.

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
    $max = $feed->get_item_quantity(5);
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
- [get_item()](@/wiki/reference/simplepie/get_item.md)

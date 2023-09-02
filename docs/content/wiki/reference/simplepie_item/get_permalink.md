+++
title = "get_permalink()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_permalink ()
}
```

Returns the first link available with a relationship of “alternate”. Identical to passing `0` to [get_link()](@/wiki/reference/simplepie_item/get_link.md).

## Availability {#availability}

- Available since SimplePie 0.8.

## Examples {#examples}

### Loop through each item and do something with each {#loop_through_each_item_and_do_something_with_each}

```php
<?php
require_once('../simplepie.inc');

$feed = new SimplePie('http://simplepie.org/blog/feed/');
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

    <?php foreach ($feed->get_items() as $item): ?>

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
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [get_link()](@/wiki/reference/simplepie_item/get_link.md)
- [get_links()](@/wiki/reference/simplepie_item/get_links.md)

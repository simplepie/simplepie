+++
title = "get_favicon()"
+++

## Description {#description}

```php
class SimplePie {
    get_favicon ()
}
```

Returns the favicon image for the feed's website. These are supposed to be 16×16, although I've seen them be 32×32 in certain browsers (<abbr title="Internet Explorer">IE</abbr>, Safari).

## Availability {#availability}

- Available since SimplePie Beta 3.
- $alternate parameter was removed in 1.0 RC2.

## Examples {#examples}

### Use CSS to add the favicon to each item's title {#use_css_to_add_the_favicon_to_each_item_s_title}

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

    <style type="text/css">
    h2.title {
        padding:0 0 0 20px;
        background:transparent url(<?php echo $feed->get_favicon(); ?>) no-repeat 0 1px;
    }
    </style>

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

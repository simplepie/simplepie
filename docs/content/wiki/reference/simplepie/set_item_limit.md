+++
title = "set_item_limit()"
+++

## Description {#description}

```php
class SimplePie {
    set_item_limit ( [int $limit = 0] )
}
```

Set the maximum number of items to return per feed with Multifeeds. This is NOT for limiting the number of items to loop through in a single feed. For that, you want to pass `$start` and `$length` parameters to [get_items()](@/wiki/reference/simplepie/get_items.md)

## Availability {#availability}

- Available since SimplePie 1.1.

## Parameters {#parameters}

### limit {#limit}

The maximum number of items.

## Examples {#examples}

### Set the max number of items per feed to return with Multifeeds {#set_the_max_number_of_items_per_feed_to_return_with_multifeeds}

```php
$feed = new SimplePie();
$feed->set_feed_url(array('http://simplepie.org/blog/feed/', 'http://images.apple.com/main/rss/hotnews/hotnews.rss'));
$feed->set_item_limit(5);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)
- [Limit the number of items per feed to be used with Multifeeds](@/wiki/tutorial/how_to_limit_the_number_of_items_displayed_per_feed_when_using_multifeeds.php.md)

</div>

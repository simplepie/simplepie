+++
title = "get_authors()"
+++

## Description {#description}

```php
class SimplePie {
    get_authors ( [int $start = 0],  [int $length = 0] )
}
```

Returns an array of [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md) objects that were found for the item, which can be looped through.

## Availability {#availability}

- Available since SimplePie 1.1.

## Parameters {#parameters}

### start {#start}

The number of the item you want to start at. Remember that arrays begin with `0`, not `1`.

### length {#length}

The number of items to return. `0` will return all. The `start` parameter is required if this is used.

## Examples {#examples}

### Loop through each item and do something with each {#loop_through_each_item_and_do_something_with_each}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($item->get_authors() as $author)
{
    echo $author->get_name();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md)
- [get_author()](@/wiki/reference/simplepie/get_author.md)

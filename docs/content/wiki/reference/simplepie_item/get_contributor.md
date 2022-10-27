+++
title = "get_contributor()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_contributor ( [int $key = 0] )
}
```

Returns a single array location containing a [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md) object.

## Availability {#availability}

- Available since SimplePie 1.1.

## Parameters {#parameters}

### key {#key}

The item that you want to return. Remember that arrays begin with `0`, not `1`.

## Examples {#examples}

### Loop through each item and do something with each {#loop_through_each_item_and_do_something_with_each}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    if ($contributor = $item->get_contributor())
    {
        echo $contributor->get_name();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md)
- [get_contributors()](@/wiki/reference/simplepie_item/get_contributors.md)

+++
title = "get_enclosure()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_enclosure ( [int $key = 0] )
}
```

Returns a single array location containing a [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md) object.

## Availability {#availability}

- Available since SimplePie Beta 2.

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
    if ($enclosure = $item->get_enclosure())
    {
        echo $enclosure->embed();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- <a href="@/wiki/reference/simplepie/get_enclosures.md" class="wikilink2">get_enclosures</a>

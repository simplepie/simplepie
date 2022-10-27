+++
title = "get_category()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_category ( [int $key = 0] )
}
```

Returns a single array location containing a [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md) object.

## Availability {#availability}

- Available since SimplePie Beta 3.
- Previously existed as `get_categories()` since SimplePie Beta 2.

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
    if ($category = $item->get_category())
    {
        echo $category->get_label();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md)
- <a href="@/wiki/reference/simplepie/get_categories.md" class="wikilink2">get_categories</a>

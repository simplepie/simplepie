+++
title = "get_label()"
+++

## Description {#description}

```php
class SimplePie_Category {
    get_label()
}
```

Returns the human-readable label for the category.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as the value for [get_category()](@/wiki/reference/simplepie_item/get_category.md).

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    if ($category= $item->get_category())
    {
        echo $category->get_label();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md)

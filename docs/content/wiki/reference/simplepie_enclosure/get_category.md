+++
title = "get_category()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_category ()
}
```

Returns a single category for the enclosure. Returns a [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md) object.

## Availability {#availability}

- Available since SimplePie 1.0.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    if ($enclosure = $item->get_enclosure())
    {
        echo $enclosure->get_category();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md)
- [get_categories()](@/wiki/reference/simplepie_enclosure/get_categories.md)

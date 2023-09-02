+++
title = "get_restriction()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_restriction ()
}
```

Returns a single restriction for the enclosure. Returns a [SimplePie_Restriction](@/wiki/reference/simplepie_restriction/_index.md) object.

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
        if ($restriction = $enclosure->get_restriction())
        {
            echo $restriction->get_value();
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Restriction](@/wiki/reference/simplepie_restriction/_index.md)
- [get_restrictions()](@/wiki/reference/simplepie_enclosure/get_restrictions.md)

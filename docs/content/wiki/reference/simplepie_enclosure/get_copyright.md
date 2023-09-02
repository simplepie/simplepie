+++
title = "get_copyright()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_copyright ()
}
```

Returns the copyright information for the enclosure. This is is specific to `<media:copyright>` data. Returns a [SimplePie_Copyright](@/wiki/reference/simplepie_copyright/_index.md) object.

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
        echo $enclosure->get_copyright();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Copyright](@/wiki/reference/simplepie_copyright/_index.md)

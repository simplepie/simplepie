+++
title = "get_type()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_type()
}
```

Returns the mime type of the enclosure, telling us what kind of file it is.

## Availability {#availability}

- Available since SimplePie Beta 2.

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
        echo $enclosure->get_type();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)

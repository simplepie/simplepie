+++
title = "get_real_type()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_real_type()
}
```

If the file type from [get_type()](@/wiki/reference/simplepie_enclosure/get_type.md) isn't on our list of supported media types, the feed is probably lying to us (which happens from time to time). This will return the file type that the enclosure likely is. If the type isn't on the list, and SimplePie can't guess what it is based on the file extension, SimplePie will return the noted mime type.

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
        echo $enclosure->get_real_type();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)

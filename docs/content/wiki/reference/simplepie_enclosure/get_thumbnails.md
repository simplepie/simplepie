+++
title = "get_thumbnails()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_thumbnails ()
}
```

Returns all available URLs for thumbnails for the enclosure.

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
        foreach ((array) $enclosure->get_thumbnails() as $thumbnail)
        {
            echo $thumbnail;
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [get_thumbnail()](@/wiki/reference/simplepie_enclosure/get_thumbnail.md)

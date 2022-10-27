+++
title = "get_captions()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_captions ()
}
```

Returns all available captions for the enclosure as an array of [SimplePie_Caption](@/wiki/reference/simplepie_caption/_index.md) objects. This is is specific to `<media:text>` data.

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
        foreach ((array) $enclosure->get_captions() as $caption)
        {
            echo $caption->get_text();
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Caption](@/wiki/reference/simplepie_caption/_index.md)
- [get_caption()](@/wiki/reference/simplepie_enclosure/get_caption.md)

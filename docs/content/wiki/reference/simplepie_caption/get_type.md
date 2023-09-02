+++
title = "get_type()"
+++

## Description {#description}

```php
class SimplePie_Caption {
    get_type()
}
```

Returns the type (text or <abbr title="HyperText Markup Language">HTML</abbr>) of the given caption. This mostly has relevance to Media <abbr title="Rich Site Summary">RSS</abbr> content.

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
        if ($caption = $enclosure->get_caption())
        {
            echo '<p>' . $caption->get_text() . ' (' . $caption->get_type() . ')</p>';
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Caption](@/wiki/reference/simplepie_caption/_index.md)

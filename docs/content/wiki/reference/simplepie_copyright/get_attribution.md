+++
title = "get_attribution()"
+++

## Description {#description}

```php
class SimplePie_Copyright {
    get_attribution()
}
```

Returns the attribution for the given copyright. This mostly has relevance to Media <abbr title="Rich Site Summary">RSS</abbr> content.

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
        if ($copyright = $enclosure->get_copyright())
        {
            echo '<p><a href="' . $copyright->get_url() . '">' . $copyright->get_attribution() . '</a></p>';
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Copyright](@/wiki/reference/simplepie_copyright/_index.md)

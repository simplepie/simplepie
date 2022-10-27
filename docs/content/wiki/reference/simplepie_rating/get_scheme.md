+++
title = "get_scheme()"
+++

## Description {#description}

```php
class SimplePie_Rating {
    get_scheme()
}
```

Returns the organizational scheme for the role of the thing receiving the rating. This mostly has relevance to Media <abbr title="Rich Site Summary">RSS</abbr> content.

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
        if ($rating = $enclosure->get_rating())
        {
            echo '<p>' . str_replace('uri:', '', $rating->get_scheme()) . ': ' . $rating->get_value() . '</p>';
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md)

+++
title = "get_rating()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_rating ()
}
```

Returns a single rating for the enclosure. Returns a [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md) object.

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
        echo $enclosure->get_rating();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md)
- [get_ratings()](@/wiki/reference/simplepie_enclosure/get_ratings.md)

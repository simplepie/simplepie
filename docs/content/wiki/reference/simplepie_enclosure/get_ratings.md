+++
title = "get_ratings()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_ratings ()
}
```

Returns all available ratings for the enclosure as an array of [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md) objects.

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
        foreach ((array) $enclosure->get_ratings() as $rating)
        {
            echo $rating->get_value();
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md)
- [get_rating()](@/wiki/reference/simplepie_enclosure/get_rating.md)

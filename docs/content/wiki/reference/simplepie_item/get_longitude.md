+++
title = "get_longitude()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_longitude ()
}
```

Returns the [W3C WGS84 Basic Geo](http://www.w3.org/2003/01/geo/) or [GeoRSS](http://www.georss.org/georss)-compatible longitude coordinates for the item.

## Availability {#availability}

- Available since SimplePie 1.0.

## Examples {#examples}

### Display the coordinates of the feed {#display_the_coordinates_of_the_feed}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $item->get_latitude();
    echo $item->get_longitude();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- \[\[reference:SimplePie_Item:get\_

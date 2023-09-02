+++
title = "get_duration()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_duration ( [(bool) $convert = false] )
}
```

Returns the duration for the enclosure in seconds.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### convert {#convert}

This will take the number of seconds (e.g. 4127) and converts them to `hh:mm:ss` format (e.g. 1:08:47).

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
        echo $enclosure->get_duration(true);
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)

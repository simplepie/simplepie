+++
title = "get_size()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_size()
}
```

Returns the file size of the enclosure in mebibytes (which are frequently confused with megabytes).

## Availability {#availability}

- Available since SimplePie Beta 2.

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
        echo $enclosure->get_size();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)

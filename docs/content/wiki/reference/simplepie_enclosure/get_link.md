+++
title = "get_link()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_link()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> of the enclosure.

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
        echo $enclosure->get_link();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)

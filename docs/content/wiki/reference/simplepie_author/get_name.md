+++
title = "get_name()"
+++

## Description {#description}

```php
class SimplePie_Author {
    get_name()
}
```

Will try to discern the name for the author for the posting and return it.

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
    if ($author = $item->get_author())
    {
        echo $author->get_name();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md)

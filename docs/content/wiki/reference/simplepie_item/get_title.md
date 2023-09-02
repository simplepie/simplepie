+++
title = "get_title()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_title ()
}
```

Returns the title of the posting.

## Availability {#availability}

- Available since SimplePie Beta 2.
- Previously existed as `get_item_title()` since SimplePie 0.8.

## Examples {#examples}

### Display the title {#display_the_title}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $item->get_title();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

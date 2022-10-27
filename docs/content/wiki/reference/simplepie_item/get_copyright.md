+++
title = "get_copyright()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_copyright ()
}
```

Returns the copyright info for the item.

## Availability {#availability}

- Available since SimplePie 1.1.

## Examples {#examples}

### Display the copyright info {#display_the_copyright_info}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $feed->get_copyright();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

+++
title = "get_description()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_description ()
}
```

Returns the description for the item. Prefers summaries over full content, but will return full content if a summary does not exist. To prefer full content instead, use [get_content()](@/wiki/reference/simplepie_item/get_content.md).

## Availability {#availability}

- Available since SimplePie 0.8.

## Examples {#examples}

### Display the description {#display_the_description}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $item->get_description();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [get_content()](@/wiki/reference/simplepie_item/get_content.md)

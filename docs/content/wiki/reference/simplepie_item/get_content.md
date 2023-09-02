+++
title = "get_content()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_content ()
}
```

Returns the content for the item. Prefers full content over summaries, but will return a summary if full content does not exist. To prefer summaries instead, use [get_description()](@/wiki/reference/simplepie_item/get_description.md).

## Availability {#availability}

- Available since SimplePie 1.0.

## Examples {#examples}

### Display the description {#display_the_description}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $item->get_content();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [get_description()](@/wiki/reference/simplepie_item/get_description.md)

+++
title = "get_source()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_source ()
}
```

Returns a [SimplePie_Source](@/wiki/reference/simplepie_source/_index.md) object for the `atom:source` data in the item.

## Availability {#availability}

- Available since SimplePie 1.1

## Examples {#examples}

### Get the title of the parent feed, starting at the item level {#get_the_title_of_the_parent_feed_starting_at_the_item_level}

```php
$feed = new SimplePie();
$feed->set_feed_url(array(
    'http://simplepie.org/blog/feed/',
    'http://feeds.tuaw.com/weblogsinc/tuaw'
));
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    if ($source = $item->get_source())
    {
        echo $source->get_title();
    }
}
```

## See Also {#see_also}

- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Source](@/wiki/reference/simplepie_source/_index.md)

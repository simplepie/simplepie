+++
title = "get_item()"
+++

## Description {#description}

```php
class SimplePie_Source {
    get_item ()
}
```

Returns the parent [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md) object of the source. This works the same way as [get_feed()](@/wiki/reference/simplepie_item/get_feed.md).

## Availability {#availability}

- Available since SimplePie 1.1.

## Examples {#examples}

### Get the title of the parent item, starting at the source level {#get_the_title_of_the_parent_item_starting_at_the_source_level}

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
        echo 'Sourced item is ' . $source->get_item()->get_title();
    }

    echo 'Posted to ' . $item->get_feed()->get_title();
}
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)

</div>

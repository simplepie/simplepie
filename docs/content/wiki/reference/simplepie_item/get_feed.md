+++
title = "get_feed()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_feed ()
}
```

Returns the parent [SimplePie](@/wiki/reference/simplepie/_index.md) object of the item.

<div class="warning">

**Read [Typical Multifeed Gotchas](@/wiki/faq/typical_multifeed_gotchas.md#missing_data_from_feed "faq:typical_multifeed_gotchas") for additional information.**

</div>

## Availability {#availability}

- Available since SimplePie 1.0.

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
    echo $item->get_title();
    echo 'Posted to ' . $item->get_feed()->get_title();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

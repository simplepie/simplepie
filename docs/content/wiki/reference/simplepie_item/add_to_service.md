+++
title = "add_to_service()"
+++

## Description {#description}

```php
class SimplePie_Item {
    add_to_service ( string $item_url, [ string $title_url = null ])
}
```

Generates the proper <abbr title="Uniform Resource Locator">URL</abbr> for adding an item (e.g. posting) to a bookmarking-type service.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### item_url (required) {#item_url_required}

The <abbr title="Uniform Resource Locator">URL</abbr> and querystring up until the item's <abbr title="Uniform Resource Locator">URL</abbr> is required.

### title_url {#title_url}

The querystring parameter key for the title to get passed in.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo '<a href="' . $item->add_to_service('http://del.icio.us/post/?v=4&url=', '&title=') . '">Add to Delicious</a>';
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

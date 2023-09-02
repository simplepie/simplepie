+++
title = "add_to_furl()"
+++

## Description {#description}

```php
class SimplePie_Item {
    add_to_furl ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for posting this particular posting to the [Furl](http://furl.net/) service.

## Availability {#availability}

- Available since SimplePie Beta 1.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo '<a href="' . $item->add_to_furl() . '">Add to Furl</a>';
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

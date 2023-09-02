+++
title = "search_technorati()"
+++

## Description {#description}

```php
class SimplePie_Item {
    search_technorati ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for searching [Technorati](http://technorati.com/) for comments and linkbacks for this posting.

## Availability {#availability}

- Available since SimplePie Preview Release.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo '<a href="' . $item->search_technorati() . '">Search Technorati</a>';
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

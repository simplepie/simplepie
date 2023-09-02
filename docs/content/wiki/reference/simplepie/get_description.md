+++
title = "get_description()"
+++

## Description {#description}

```php
class SimplePie {
    get_description ()
}
```

Returns the description for the feed. If no description is available, SimplePie will look for `<itunes:summary>`, then `<itunes:subtitle>` tags.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as `get_feed_description()` since SimplePie 0.8.

## Examples {#examples}

### Display the description {#display_the_description}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo $feed->get_description();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

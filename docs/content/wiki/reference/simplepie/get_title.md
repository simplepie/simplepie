+++
title = "get_title()"
+++

## Description {#description}

```php
class SimplePie {
    get_title ()
}
```

Returns the title of the feed.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as `get_feed_title()` since SimplePie 0.8.

## Examples {#examples}

### Display the title {#display_the_title}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo $feed->get_title();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

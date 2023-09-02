+++
title = "get_language()"
+++

## Description {#description}

```php
class SimplePie {
    get_language ()
}
```

Returns the language for the feed.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as `get_feed_language()` since SimplePie 0.8.

## Examples {#examples}

### Display the language {#display_the_language}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo $feed->get_language();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

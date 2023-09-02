+++
title = "get_copyright()"
+++

## Description {#description}

```php
class SimplePie {
    get_copyright ()
}
```

Returns the copyright info for the feed.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as `get_feed_copyright()` since SimplePie 0.8.

## Examples {#examples}

### Display the copyright info {#display_the_copyright_info}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo $feed->get_copyright();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

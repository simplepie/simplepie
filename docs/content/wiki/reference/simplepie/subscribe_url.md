+++
title = "subscribe_url()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_url ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for the feed. May or may not be different from the <abbr title="Uniform Resource Locator">URL</abbr> passed to [set_feed_url()](@/wiki/reference/simplepie/set_feed_url.md), depending on whether auto-discovery was used.

## Availability {#availability}

- Available since SimplePie Preview Release.
- Previously existed as `get_feed_url()` since SimplePie 0.8.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_url() . '">Subscribe to this feed</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

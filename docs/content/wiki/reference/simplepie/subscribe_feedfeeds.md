+++
title = "subscribe_feedfeeds()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_feedfeeds ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [FeedFeeds](http://www.feedfeeds.com/) service.

## Availability {#availability}

- Available since SimplePie Beta 3.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_feedfeeds() . '">Subscribe in FeedFeeds</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

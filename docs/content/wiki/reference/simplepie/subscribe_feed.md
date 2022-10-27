+++
title = "subscribe_feed()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_feed ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for the feed, prepended with the `feed: pseudo-protocol. Useful for subscribing with desktop-based aggregators. ===== Availability ===== * Available since SimplePie Preview Release. * Previously existed as `get_feedproto_url()'' since SimplePie 0.8. ===== Examples ===== \<code php\>$feed = new SimplePie(); $feed→set_feed_url('[http://simplepie.org/blog/feed/](/blog/feed/ "http://simplepie.org/blog/feed/")'); $feed→init(); $feed→handle_content_type(); echo '\<a href=”' . $feed→subscribe_feed() . '”\>Subscribe to this feed in your desktop aggregator\</a\>'; \</code\> ===== See Also ===== \* [SimplePie](@/wiki/reference/simplepie/_index.md)

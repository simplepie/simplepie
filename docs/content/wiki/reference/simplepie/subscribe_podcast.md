+++
title = "subscribe_podcast()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_podcast ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for the feed, prepended with the `podcast:'' pseudo-protocol. Useful for subscribing with desktop-based podcast applications. ===== Availability ===== * Available since SimplePie Beta 2. ===== Examples ===== <code php>$feed = new SimplePie(); $feed→set_feed_url('http://simplepie.org/blog/feed/'); $feed→init(); $feed→handle_content_type(); echo '<a href=”' . $feed→subscribe_podcast() . '”>Subscribe to this feed in your desktop podcast application</a>'; </code> ===== See Also ===== * SimplePie`

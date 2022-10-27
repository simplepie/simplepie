+++
title = "subscribe_itunes()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_itunes ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for the feed, prepended with the `itpc:'' pseudo-protocol. Useful for subscribing to podcasts in iTunes. ===== Availability ===== * Available since SimplePie 1.0. ===== Examples ===== <code php>$feed = new SimplePie(); $feed→set_feed_url('http://simplepie.org/blog/feed/'); $feed→init(); $feed→handle_content_type(); echo '<a href=”' . $feed→subscribe_itunes() . '”>Subscribe to this feed in iTunes</a>'; </code> ===== See Also ===== * SimplePie`

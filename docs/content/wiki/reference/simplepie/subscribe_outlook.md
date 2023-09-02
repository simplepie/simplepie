+++
title = "subscribe_outlook()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_outlook ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for the feed, prepended with the `outlook:'' pseudo-protocol. Useful for subscribing with Microsoft Outlook 2007. ===== Availability ===== * Available since SimplePie Beta 3. ===== Examples ===== <code php>$feed = new SimplePie(); $feed→set_feed_url('http://simplepie.org/blog/feed/'); $feed→init(); $feed→handle_content_type(); echo '<a href=”' . $feed→subscribe_outlook() . '”>Subscribe to this feed in Microsoft Outlook 2007</a>'; </code> ===== See Also ===== * SimplePie`

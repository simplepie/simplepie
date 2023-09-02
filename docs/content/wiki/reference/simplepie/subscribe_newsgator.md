+++
title = "subscribe_newsgator()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_newsgator ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [Newsgator](http://newsgator.com/) service. Remember that Newsgator accounts can sync with your [FeedDemon](http://www.newsgator.com/Individuals/FeedDemon/) and [NetNewsWire](http://www.newsgator.com/Individuals/NetNewsWire/) aggregators.

## Availability {#availability}

- Available since SimplePie Preview Release.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_newsgator() . '">Subscribe in Newsgator</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

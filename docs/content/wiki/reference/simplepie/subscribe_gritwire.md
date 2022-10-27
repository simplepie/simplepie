+++
title = "subscribe_gritwire()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_gritwire ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [Gritwire](http://gritwire.com/) service.

## Availability {#availability}

- Available since SimplePie Beta 3.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_gritwire() . '">Subscribe in Gritwire</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

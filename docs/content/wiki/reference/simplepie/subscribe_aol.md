+++
title = "subscribe_aol()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_aol ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [My AOL](http://about.aol.com/myaol) service.

## Availability {#availability}

- Available since SimplePie Beta 1.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_aol() . '">Subscribe in My AOL</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

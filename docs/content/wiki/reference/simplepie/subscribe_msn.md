+++
title = "subscribe_msn()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_msn ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [My MSN](http://my.msn.com/) service.

## Availability {#availability}

- Available since SimplePie Beta 1.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_msn() . '">Subscribe in My MSN</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

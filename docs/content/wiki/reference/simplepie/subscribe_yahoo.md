+++
title = "subscribe_yahoo()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_yahoo ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [My Yahoo!](http://my.yahoo.com/) service.

## Availability {#availability}

- Available since SimplePie Preview Release.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_yahoo() . '">Subscribe in My Yahoo!</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

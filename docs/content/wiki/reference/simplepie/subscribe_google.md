+++
title = "subscribe_google()"
+++

## Description {#description}

```php
class SimplePie {
    subscribe_google ()
}
```

Returns the <abbr title="Uniform Resource Locator">URL</abbr> for adding this particular feed to the [Google Reader](http://reader.google.com/) service.

## Availability {#availability}

- Available since SimplePie Preview Release.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->subscribe_google() . '">Subscribe in Google Reader</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

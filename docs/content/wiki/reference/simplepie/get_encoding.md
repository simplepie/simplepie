+++
title = "get_encoding()"
+++

## Description {#description}

```php
class SimplePie {
    get_encoding ()
}
```

Returns the character encoding that was outputted by SimplePie.

## Availability {#availability}

- Available since SimplePie Preview Release.

## Examples {#examples}

### Display the character encoding {#display_the_character_encoding}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo $feed->get_encoding();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

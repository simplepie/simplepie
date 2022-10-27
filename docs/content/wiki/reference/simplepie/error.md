+++
title = "error()"
+++

## Description {#description}

```php
class SimplePie {
    error ()
}
```

If a SimplePie error was thrown, you can display it here. If there was a <abbr title="Hypertext Preprocessor">PHP</abbr> error, SimplePie doesn't do anything about it.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as `error` (property) since Beta 3.

## Examples {#examples}

### Display the error message if it exists {#display_the_error_message_if_it_exists}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.bob');
$feed->init();
$feed->handle_content_type();

if ($feed->error())
{
    echo $feed->error();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

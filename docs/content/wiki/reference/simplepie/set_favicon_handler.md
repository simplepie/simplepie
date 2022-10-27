+++
title = "set_favicon_handler()"
+++

## Description {#description}

```php
class SimplePie {
    set_favicon_handler ( [str $page = false], [$qs = 'i'] )
}
```

Set the handler to enable the display of cached favicons.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### page {#page}

The file that will handle the rendering of the cached favicon.

### qs {#qs}

The query string that will be used for passing data to the file set in the page parameter.

## Examples {#examples}

### Set up the favicon handler {#set_up_the_favicon_handler}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_favicon_handler('./handler_image.php', 'favicon'); // ./handler_image.php?favicon=/cache/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.spc
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

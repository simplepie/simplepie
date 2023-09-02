+++
title = "set_image_handler()"
+++

## Description {#description}

```php
class SimplePie {
    set_image_handler ( [str $page = false], [$qs = 'i'] )
}
```

Set the handler to enable the display of cached images. Setting <span class="curid">[set_image_handler()](@/wiki/reference/simplepie/set_image_handler.md)</span> tells SimplePie (a) to cache them in the first place, and (b) the file that will be used to read them back from the cache and display them.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### page {#page}

The file that will handle the rendering of the cached images.

### qs {#qs}

The query string that will be used for passing data to the file set in the page parameter.

## Examples {#examples}

### Set up the image handler {#set_up_the_image_handler}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_image_handler('handler_image.php', 'image'); // handler_image.php?image=67d5fa9a87bad230fb03ea68b9f71090
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- <span class="curid">[set_image_handler()](@/wiki/reference/simplepie/set_image_handler.md)</span>
- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

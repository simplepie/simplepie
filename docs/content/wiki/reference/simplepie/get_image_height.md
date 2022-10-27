+++
title = "get_image_height()"
+++

## Description {#description}

```php
class SimplePie {
    get_image_height ()
}
```

<abbr title="Rich Site Summary">RSS</abbr> 2.0 and Atom 1.0 feeds are allowed to have a “feed logo”, which is a single image to represent the feed. This method returns the notated height for that image/logo.

## Availability {#availability}

- Available since SimplePie 0.8.

## Examples {#examples}

### Display the logo {#display_the_logo}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo '<a href="' . $feed->get_image_link() . '" title="' . $feed->get_image_title() . '">';
echo '<img src="' . $feed->get_image_url() . '" width="' . $feed->get_image_width() . '" height="' . $feed->get_image_height() . '" />';
echo '</a>';
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [get_image_link()](@/wiki/reference/simplepie/get_image_link.md)
- [get_image_title()](@/wiki/reference/simplepie/get_image_title.md)
- [get_image_url()](@/wiki/reference/simplepie/get_image_url.md)
- [get_image_width()](@/wiki/reference/simplepie/get_image_width.md)

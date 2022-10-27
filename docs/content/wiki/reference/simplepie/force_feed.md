+++
title = "force_feed()"
+++

## Description {#description}

```php
class SimplePie {
    force_feed ( [bool $enable = false] )
}
```

<abbr title="Rich Site Summary">RSS</abbr> and Atom feeds are supposed to have certain mime types associated with them so that software knows what type of data it is. Some feeds don't follow these rules, and serve feeds with invalid mime types (e.g. `text/plain`). SimplePie follows best practices by default, but you can override this behavior with this option.

## Availability {#availability}

- Available since SimplePie 1.1.

## Parameters {#parameters}

### enable {#enable}

Enable/disable forcing the data to be handled as a feed.

## Examples {#examples}

### Force SimplePie to handle a text/plain document as a feed {#force_simplepie_to_handle_a_textplain_document_as_a_feed}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://youtube.com/rss/global/recently_added.rss');
$feed->force_feed(true);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

<div class="warning">

**Note:** Whereas YouTube feeds used to be served as `text/plain`, we notified them of the issue and they have since changed the mime type to `application/rss+xml`.

</div>

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)

</div>

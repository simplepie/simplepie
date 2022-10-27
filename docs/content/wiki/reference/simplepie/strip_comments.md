+++
title = "strip_comments()"
+++

## Description {#description}

```php
class SimplePie {
    strip_comments ( [ $strip = false] )
}
```

Set whether to strip out <abbr title="HyperText Markup Language">HTML</abbr> comments from an entry's content.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### strip {#strip}

Enable/disable the stripping of <abbr title="HyperText Markup Language">HTML</abbr> comments.

## Examples {#examples}

### Enable comment stripping {#enable_comment_stripping}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_comments(true);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

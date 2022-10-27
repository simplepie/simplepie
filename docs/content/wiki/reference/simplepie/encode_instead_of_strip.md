+++
title = "encode_instead_of_strip()"
+++

## Description {#description}

```php
class SimplePie {
    encode_instead_of_strip ( [bool $enable = true] )
}
```

This works in conjunction with [strip_htmltags()](@/wiki/reference/simplepie/strip_htmltags.md), where instead of stripping the tags, it simply encodes them.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### enable {#enable}

Enable/disable encoding.

## Examples {#examples}

### Enable encoding instead of stripping {#enable_encoding_instead_of_stripping}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->encode_instead_of_strip(true);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)

</div>

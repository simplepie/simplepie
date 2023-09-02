+++
title = "remove_div()"
+++

## Description {#description}

```php
class SimplePie {
    remove_div ( [bool $enable = true] )
}
```

Remove the surrounding `<div>` from <abbr title="Extensible HyperText Markup Language">XHTML</abbr> content in Atom feeds. This doesn't do anything for <abbr title="Rich Site Summary">RSS</abbr> feeds.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### enable {#enable}

Enable/disable stripping of the surrounding \<div\>.

## Examples {#examples}

### Don't strip the \<div\> {#don_t_strip_the_div}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->remove_div(false);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

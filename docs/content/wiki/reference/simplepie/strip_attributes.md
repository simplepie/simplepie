+++
title = "strip_attributes()"
+++

## Description {#description}

```php
class SimplePie {
    strip_attributes ( [$attribs = array('bgsound', 'class', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc')] )
}
```

Set which attributes get stripped from an entry's content.

The default set of attributes is stored in the _property_ SimplePie→strip_attributes, not to be confused with the _method_ SimplePie→strip_attributes(). This way, you can modify the existing list without having to create a whole new one.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### attribs {#attribs}

An array of the attributes you want to strip.

## Examples {#examples}

### Don't strip any attributes (not recommended) {#don_t_strip_any_attributes_not_recommended}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_attributes(false);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Strip only ''src'', ''alt'', and ''title'' {#strip_only_src_alt_and_title}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_attributes(array('src', 'alt', 'title'));
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Add ''src'', ''alt'', and ''title'' to the default list {#add_src_alt_and_title_to_the_default_list}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_attributes(array_merge($feed->strip_attributes, array('src', 'alt', 'title')));
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

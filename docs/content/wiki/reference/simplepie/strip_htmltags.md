+++
title = "strip_htmltags()"
+++

## Description {#description}

```php
class SimplePie {
    strip_htmltags ( [$tags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style')] )
}
```

Set which <abbr title="HyperText Markup Language">HTML</abbr> tags get stripped from an entry's content.

The default set of tags is stored in the _property_ SimplePie→strip_htmltags, not to be confused with the _method_ SimplePie→strip_htmltags(). This way, you can modify the existing list without having to create a whole new one.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### tags {#tags}

An array of the <abbr title="HyperText Markup Language">HTML</abbr> tags you want to strip.

## Examples {#examples}

### Don't strip any tags (not recommended) {#don_t_strip_any_tags_not_recommended}

This code will prevent ANY <abbr title="HyperText Markup Language">HTML</abbr> tags from being stripped from the feed content. This is potentially unsafe, so we do not recommend it.

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_htmltags(false);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Strip only blink, font, and marquee {#strip_only_blink_font_and_marquee}

This will ONLY strip out `blink`, `font`, and `marquee` tags, and will allow all other tags to be displayed.

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_htmltags(array('blink', 'font', 'marquee'));
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Add h1, a, and img to the default list {#add_h1_a_and_img_to_the_default_list}

This will take the existing list of tags to strip out by default (stored in the `$feed→strip_htmltags` variable), and add `h1`, `a`, and `img` to that list so that these tags are also stripped out by default.

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->strip_htmltags(array_merge($feed->strip_htmltags, array('h1', 'a', 'img')));
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Remove object, param, and embed from the default list {#remove_object_param_and_embed_from_the_default_list}

This will take the existing list of tags to strip out by default (stored in the `$feed→strip_htmltags` variable), and remove `object`, `param`, and `embed` from that list so that these tags are NOT stripped out by default.

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');

// Remove these tags from the list
$strip_htmltags = $feed->strip_htmltags;
array_splice($strip_htmltags, array_search('object', $strip_htmltags), 1);
array_splice($strip_htmltags, array_search('param', $strip_htmltags), 1);
array_splice($strip_htmltags, array_search('embed', $strip_htmltags), 1);

$feed->strip_htmltags($strip_htmltags);

$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [encode_instead_of_strip()](@/wiki/reference/simplepie/encode_instead_of_strip.md)
- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

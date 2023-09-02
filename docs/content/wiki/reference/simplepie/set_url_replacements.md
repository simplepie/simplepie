+++
title = "set_url_replacements()"
+++

## Description {#description}

```php
class SimplePie {
    set_url_replacements ( [array $element_attribute = array('blockquote' => 'cite', 'ins' => 'cite', 'del' => 'cite', 'a' => 'href', 'q' => 'cite', 'img' => 'src', 'img' => 'longdesc', 'area' => 'href', 'form' => 'action', 'input' => 'src')] )
}
```

Set element/attribute key/value pairs of <abbr title="HyperText Markup Language">HTML</abbr> attributes containing URLs that need to be resolved relative to the feed.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### element_attribute {#element_attribute}

Element/attribute key/value pairs.

## Examples {#examples}

### Limit the URL fixing to only links and images. {#limit_the_url_fixing_to_only_links_and_images}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_url_replacements(array('a' => 'href', 'img' => 'src'));
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)

</div>

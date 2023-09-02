+++
title = "handle_content_type()"
+++

## Description {#description}

```php
class SimplePie {
    handle_content_type ( [ $mime = 'text/html'] )
}
```

This method ensures that the SimplePie-enabled page is being served with the correct [mime-type](http://www.iana.org/assignments/media-types/) and character encoding <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> headers (character encoding determined by the [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md) config option).

- <span class="curid">[handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md)</span> won't work properly if any content or whitespace has already been sent to the browser, because it relies on <abbr title="Hypertext Preprocessor">PHP</abbr>'s [header()](http://php.net/header) function, and these are the circumstances under which the function works.
- Because it's setting these settings for the entire page (as is the nature of <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> headers), this should only be used once per page (again, at the top).

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### mime {#mime}

The mime-type that the page should be served as.

## Examples {#examples}

### Serve out the correct HTTP headers for the page {#serve_out_the_correct_http_headers_for_the_page}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

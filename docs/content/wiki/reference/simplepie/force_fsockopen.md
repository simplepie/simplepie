+++
title = "force_fsockopen()"
+++

## Description {#description}

```php
class SimplePie {
    force_fsockopen ( [bool $enable = false] )
}
```

If [cURL](http://php.net/curl) is available, SimplePie will use it instead of the built-in [fsockopen](http://php.net/fsockopen) functions for fetching remote feeds. This config option will force SimplePie to use fsockopen even if cURL is installed.

## Availability {#availability}

- Available since SimplePie Beta 3.

## Parameters {#parameters}

### enable {#enable}

Enable/disable forced fsockopen usage.

## Examples {#examples}

### Use fsockopen instead of cURL functions {#use_fsockopen_instead_of_curl_functions}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->force_fsockopen(true);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)

</div>

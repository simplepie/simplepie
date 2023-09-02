+++
title = "enable_cache()"
+++

## Description {#description}

```php
class SimplePie {
    enable_cache ( [bool $enable = true] )
}
```

This option allows you to disable caching all-together in SimplePie. However, disabling the cache can lead to longer load times.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as enable_caching() since SimplePie Preview Release.
- Previously existed as a constructor parameter since SimplePie 0.94.

## Parameters {#parameters}

### enable {#enable}

Set whether caching is enabled or not.

## Examples {#examples}

### Disable caching in SimplePie {#disable_caching_in_simplepie}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->enable_cache(false);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

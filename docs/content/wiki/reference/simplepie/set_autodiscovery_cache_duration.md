+++
title = "set_autodiscovery_cache_duration()"
+++

## Description {#description}

```php
class SimplePie {
    set_autodiscovery_cache_duration ( [int $seconds = 604800] )
}
```

Set the maximum time (in seconds) for which an autodiscovered feed <abbr title="Uniform Resource Locator">URL</abbr> will be cached.

Works with autodiscovery along with [set_autodiscovery_level()](@/wiki/reference/simplepie/set_autodiscovery_level.md) and [set_max_checked_feeds()](@/wiki/reference/simplepie/set_max_checked_feeds.md).

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### seconds {#seconds}

The number of seconds to cache for. Defaults to one week.

## Examples {#examples}

### Change the autodiscovery cache duration (not recommended) {#change_the_autodiscovery_cache_duration_not_recommended}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_autodiscovery_cache_duration(1209600); // 2 weeks
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_autodiscovery_level()](@/wiki/reference/simplepie/set_autodiscovery_level.md)
- [set_max_checked_feeds()](@/wiki/reference/simplepie/set_max_checked_feeds.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

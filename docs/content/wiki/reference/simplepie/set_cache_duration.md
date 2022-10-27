+++
title = "set_cache_duration()"
+++

## Description {#description}

```php
class SimplePie {
    set_cache_duration ( [int $seconds = 3600] )
}
```

Set the minimum time (in seconds) for which a feed will be cached.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as cache_max_minutes() since SimplePie Preview Release.

## Parameters {#parameters}

### seconds {#seconds}

The number of seconds to cache for. `60` is 1 minute, `600` is 10 minutes, `900` is 15 minutes, `1800` is 30 minutes.

## Examples {#examples}

### Change the cache duration {#change_the_cache_duration}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_cache_duration(1800);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [How does SimplePie's caching system work?](@/wiki/faq/how_does_simplepie_s_caching_http_conditional_get_system_work.md)
- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

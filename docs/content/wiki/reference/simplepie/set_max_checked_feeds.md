+++
title = "set_max_checked_feeds()"
+++

## Description {#description}

```php
class SimplePie {
    set_max_checked_feeds ( [int $max = 10] )
}
```

This tells SimplePie's ultra-liberal feed locator how many URLs to check for feeds. If a site is obviously feed-enabled, and SimplePie isn't picking up the feed, you can try increasing this value. On the other hand, keeping this value lower prevents things like a runaway script when it encounters a 404 page with a hundred non-feed links on it.

Works with autodiscovery along with [set_autodiscovery_level()](@/wiki/reference/simplepie/set_autodiscovery_level.md) and [set_autodiscovery_cache_duration()](@/wiki/reference/simplepie/set_autodiscovery_cache_duration.md).

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### max {#max}

The maximum number of URLs to check for feeds.

## Examples {#examples}

### Increase the number of URLs to check {#increase_the_number_of_urls_to_check}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_max_checked_feeds(20);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [set_autodiscovery_cache_duration()](@/wiki/reference/simplepie/set_autodiscovery_cache_duration.md)
- [set_autodiscovery_level()](@/wiki/reference/simplepie/set_autodiscovery_level.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

+++
title = "set_autodiscovery_level()"
+++

## Description {#description}

```php
class SimplePie {
    set_autodiscovery_level ( [int $level = SIMPLEPIE_LOCATOR_ALL] )
}
```

Set how much feed autodiscovery to do. SimplePie's autodiscovery engine takes notes from Mark Pilgrim's [Ultra-liberal RSS Locator](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator), points 1-6. These points are referenced below in the parameter section.

Works with autodiscovery along with [set_max_checked_feeds()](@/wiki/reference/simplepie/set_max_checked_feeds.md) and [set_autodiscovery_cache_duration()](@/wiki/reference/simplepie/set_autodiscovery_cache_duration.md).

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### level {#level}

Feed Autodiscovery Level (level can be a combination of the following constants, see [bitwise OR operator](http://us.php.net/manual/en/language.operators.bitwise.php)).

- `SIMPLEPIE_LOCATOR_ALL`  
  All Feed Autodiscovery ([points 1-6](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator))
- `SIMPLEPIE_LOCATOR_AUTODISCOVERY`  
  Feed Link Element Autodiscovery ([point 2](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator))
- `SIMPLEPIE_LOCATOR_LOCAL_BODY`  
  Local Feed Body Autodiscovery ([point 3](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator))
- `SIMPLEPIE_LOCATOR_LOCAL_EXTENSION`  
  Local Feed Extension Autodiscovery ([points 4, 5](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator))
- `SIMPLEPIE_LOCATOR_REMOTE_BODY`  
  Remote Feed Body Autodiscovery ([point 6](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator))
- `SIMPLEPIE_LOCATOR_REMOTE_EXTENSION`  
  Remote Feed Extension Autodiscovery ([point 6](http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator))
- `SIMPLEPIE_LOCATOR_NONE`  
  No Autodiscovery

## Examples {#examples}

### Disable feed autodiscovery {#disable_feed_autodiscovery}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_autodiscovery_level(SIMPLEPIE_LOCATOR_NONE);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [set_autodiscovery_cache_duration()](@/wiki/reference/simplepie/set_autodiscovery_cache_duration.md)
- [set_max_checked_feeds()](@/wiki/reference/simplepie/set_max_checked_feeds.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

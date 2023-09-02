+++
title = "set_feed_url()"
+++

## Description {#description}

```php
class SimplePie {
    set_feed_url ( mixed $feed_url )
}
```

This sets the <abbr title="Uniform Resource Locator">URL</abbr> (or an array of URLs) that you want to parse. If there is not a feed at this location, auto-discovery is used unless it is disabled. Note that if you've already loaded the raw <abbr title="Rich Site Summary">RSS</abbr> data, you should use [set_raw_data()](@/wiki/reference/simplepie/set_raw_data.md).

<div class="warning">

**There are differences between handling a single feed and merging feeds together with Multifeeds. Read [Typical Multifeed Gotchas](@/wiki/faq/typical_multifeed_gotchas.md) for notes on common issues.**

</div>

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as feed_url() since SimplePie Preview Release.

## Parameters {#parameters}

### feed_url (required) {#feed_url_required}

Set the feed <abbr title="Uniform Resource Locator">URL</abbr>(s).

## Examples {#examples}

### Set the feed URL to the SimplePie blog {#set_the_feed_url_to_the_simplepie_blog}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Merge multiple feeds with the same config settings {#merge_multiple_feeds_with_the_same_config_settings}

```php
$feed = new SimplePie();
$feed->set_feed_url(array(
    'http://newsrss.bbc.co.uk/rss/newsonline_world_edition/front_page/rss.xml',
    'http://rss.news.yahoo.com/rss/topstories',
    'http://news.google.com/?output=atom',
    'http://rss.slashdot.org/Slashdot/slashdot',
    'http://rss.cnn.com/rss/cnn_topstories.rss',
    'http://www.newsvine.com/_feeds/rss2/index'
));
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

There is also an alternate syntax discussed in [SimplePie](@/wiki/reference/simplepie/_index.md).

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [subscribe_url()](@/wiki/reference/simplepie/subscribe_url.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

+++
title = "SimplePie"
+++

## Description {#description}

```php
class SimplePie {
    SimplePie ([string $feed_url], [string $cache_location], [int $cache_duration])
}
```

Creates a new SimplePie object, optionally setting various settings (see their specific pages for more detail).

<div class="warning">

**There are differences between handling a single feed and merging feeds together with Multifeeds. Read [Typical Multifeed Gotchas](@/wiki/faq/typical_multifeed_gotchas.md) for notes on common issues.**

</div>

## Parameters {#parameters}

### SimplePie \<1.3 {#simplepie_13}

#### feed_url {#feed_url}

Set the feed <abbr title="Uniform Resource Locator">URL</abbr>(s) (like calling [set_feed_url()](@/wiki/reference/simplepie/set_feed_url.md)), and initialise the feed (like [init()](@/wiki/reference/simplepie/init.md)). Deprecated.

#### cache_location {#cache_location}

Set the cache location (like calling [set_cache_location()](@/wiki/reference/simplepie/set_cache_location.md)). Deprecated.

#### cache_duration {#cache_duration}

Set the cache duration (like calling [set_cache_duration()](@/wiki/reference/simplepie/set_cache_duration.md)). Deprecated.

### SimplePie 1.3+ {#simplepie_131}

None. Parameters were removed to avoid common support issues.

## Examples {#examples}

### Shorthand syntax {#shorthand_syntax}

The following is the shorthand syntax, which is geared for the quick setting of url and cache settings with minimal code. Most people never configure much further than this, which is why we have it. Passing values this way automatically calls [init()](@/wiki/reference/simplepie/init.md) for you. **This is no longer available from SimplePie 1.3. The following applies to SimplePie \<1.3 only.**

The first example is using one feed, while the second shows how to merge multiple feeds together.

```php
// Single feed
$feed = new SimplePie('http://simplepie.org/blog/feed/', $_SERVER['DOCUMENT_ROOT'] . '/cache');
echo $feed->get_title();
```

```php
// Multiple feeds
$feed = new SimplePie(array(
    'http://simplepie.org/blog/feed/',
    'http://digg.com'
), $_SERVER['DOCUMENT_ROOT'] . '/cache');
echo $feed->get_title();
```

### Standard syntax {#standard_syntax}

Next is the standard (long) syntax, which is geared for setting any of the numerous available configuration options for maximum tweaking value. Make sure you follow up your config options by calling [init()](@/wiki/reference/simplepie/init.md) (like in the example) so that SimplePie knows you're done setting options and are ready to get to business.

Again, the first example is using one feed, while the second shows how to merge multiple feeds together.

```php
// Single feed
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->enable_order_by_date(false);
$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/cache');
$feed->init();
echo $feed->get_title();
```

```php
// Multiple feeds
$feed = new SimplePie();
$feed->set_feed_url(array(
    'http://simplepie.org/blog/feed/',
    'http://digg.com'
));
$feed->enable_order_by_date(false);
$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/cache');
$feed->init();
echo $feed->get_title();
```

### Absolutely, totally, and completely wrong under any and all circumstances {#absolutely_totally_and_completely_wrong_under_any_and_all_circumstances}

(We've gotten lots of support questions recently regarding problems when using SimplePie, and most of them stem from the following.)

If you pass a <abbr title="Uniform Resource Locator">URL</abbr> into the `SimplePie()` constructor, it automatically calls [init()](@/wiki/reference/simplepie/init.md). Once init() has been called, SimplePie will ignore any new configuration options (because you've already told it that you were done setting them). There are two lessons to learn from this:

1.  Don't mix-and-match shorthand syntax with standard/long syntax because it won't do what you want.
2.  If you want to use additional config options, DO NOT USE THE SHORTHAND SYNTAX.

```php
$feed = new SimplePie('http://simplepie.org/blog/feed/'); // This calls init() automatically, and ignores all additional config options.
$feed->enable_cache(false); // Ignored.
$feed->enable_order_by_date(false); // Ignored.

echo $feed->get_title();
```

<div id="alphaindex">

---

## Index {#index}

### \_ {#section}

- [\_\_destruct()](@/wiki/reference/simplepie/destruct.md)

### E {#e}

- [Enable_cache()](@/wiki/reference/simplepie/enable_cache.md)
- [Enable_order_by_date()](@/wiki/reference/simplepie/enable_order_by_date.md)
- [Enable_xml_dump()](@/wiki/reference/simplepie/enable_xml_dump.md)
- [Encode_instead_of_strip()](@/wiki/reference/simplepie/encode_instead_of_strip.md)
- [Error()](@/wiki/reference/simplepie/error.md)
- [Extending the SimplePie class](@/wiki/reference/simplepie/extending_the_simplepie_class.md)

### F {#f}

- [Force_feed()](@/wiki/reference/simplepie/force_feed.md)
- [Force_fsockopen()](@/wiki/reference/simplepie/force_fsockopen.md)

### G {#g}

- [Get_all_discovered_feeds()](@/wiki/reference/simplepie/get_all_discovered_feeds.md)
- [Get_author()](@/wiki/reference/simplepie/get_author.md)
- [Get_authors()](@/wiki/reference/simplepie/get_authors.md)
- [Get_base()](@/wiki/reference/simplepie/get_base.md)
- [Get_channel_tags()](@/wiki/reference/simplepie/get_channel_tags.md)
- [Get_contributor()](@/wiki/reference/simplepie/get_contributor.md)
- [Get_contributors()](@/wiki/reference/simplepie/get_contributors.md)
- [Get_copyright()](@/wiki/reference/simplepie/get_copyright.md)
- [Get_description()](@/wiki/reference/simplepie/get_description.md)
- [Get_encoding()](@/wiki/reference/simplepie/get_encoding.md)
- [Get_favicon()](@/wiki/reference/simplepie/get_favicon.md)
- [Get_feed_tags()](@/wiki/reference/simplepie/get_feed_tags.md)
- [Get_image_height()](@/wiki/reference/simplepie/get_image_height.md)
- [Get_image_link()](@/wiki/reference/simplepie/get_image_link.md)
- [Get_image_tags()](@/wiki/reference/simplepie/get_image_tags.md)
- [Get_image_title()](@/wiki/reference/simplepie/get_image_title.md)
- [Get_image_url()](@/wiki/reference/simplepie/get_image_url.md)
- [Get_image_width()](@/wiki/reference/simplepie/get_image_width.md)
- [Get_item()](@/wiki/reference/simplepie/get_item.md)
- [Get_items()](@/wiki/reference/simplepie/get_items.md)
- [Get_item_quantity()](@/wiki/reference/simplepie/get_item_quantity.md)
- [Get_language()](@/wiki/reference/simplepie/get_language.md)
- [Get_latitude()](@/wiki/reference/simplepie/get_latitude.md)
- [Get_link()](@/wiki/reference/simplepie/get_link.md)
- [Get_links()](@/wiki/reference/simplepie/get_links.md)
- [Get_longitude()](@/wiki/reference/simplepie/get_longitude.md)
- [Get_permalink()](@/wiki/reference/simplepie/get_permalink.md)
- [Get_title()](@/wiki/reference/simplepie/get_title.md)
- [Get_type()](@/wiki/reference/simplepie/get_type.md)

### H {#h}

- [Handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md)

### I {#i}

- [Init()](@/wiki/reference/simplepie/init.md)

### M {#m}

- [Merge_items()](@/wiki/reference/simplepie/merge_items.md)

### R {#r}

- [Remove_div()](@/wiki/reference/simplepie/remove_div.md)

### S {#s}

- [Sanitize()](@/wiki/reference/simplepie/sanitize.md)
- [Set_author_class()](@/wiki/reference/simplepie/set_author_class.md)
- [Set_autodiscovery_cache_duration()](@/wiki/reference/simplepie/set_autodiscovery_cache_duration.md)
- [Set_autodiscovery_level()](@/wiki/reference/simplepie/set_autodiscovery_level.md)
- [Set_cache_class()](@/wiki/reference/simplepie/set_cache_class.md)
- [Set_cache_duration()](@/wiki/reference/simplepie/set_cache_duration.md)
- [Set_cache_location()](@/wiki/reference/simplepie/set_cache_location.md)
- [Set_cache_name_function()](@/wiki/reference/simplepie/set_cache_name_function.md)
- [Set_caption_class()](@/wiki/reference/simplepie/set_caption_class.md)
- [Set_category_class()](@/wiki/reference/simplepie/set_category_class.md)
- [Set_content_type_sniffer_class()](@/wiki/reference/simplepie/set_content_type_sniffer_class.md)
- [Set_copyright_class()](@/wiki/reference/simplepie/set_copyright_class.md)
- [Set_credit_class()](@/wiki/reference/simplepie/set_credit_class.md)
- [Set_enclosure_class()](@/wiki/reference/simplepie/set_enclosure_class.md)
- [Set_favicon_handler()](@/wiki/reference/simplepie/set_favicon_handler.md)
- [Set_feed_url()](@/wiki/reference/simplepie/set_feed_url.md)
- [Set_file()](@/wiki/reference/simplepie/set_file.md)
- [Set_file_class()](@/wiki/reference/simplepie/set_file_class.md)
- [Set_image_handler()](@/wiki/reference/simplepie/set_image_handler.md)
- [Set_input_encoding()](@/wiki/reference/simplepie/set_input_encoding.md)
- [Set_item_class()](@/wiki/reference/simplepie/set_item_class.md)
- [Set_item_limit()](@/wiki/reference/simplepie/set_item_limit.md)
- [Set_javascript()](@/wiki/reference/simplepie/set_javascript.md)
- [Set_locator_class()](@/wiki/reference/simplepie/set_locator_class.md)
- [Set_max_checked_feeds()](@/wiki/reference/simplepie/set_max_checked_feeds.md)
- [Set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md)
- [Set_parser_class()](@/wiki/reference/simplepie/set_parser_class.md)
- [Set_rating_class()](@/wiki/reference/simplepie/set_rating_class.md)
- [Set_raw_data()](@/wiki/reference/simplepie/set_raw_data.md)
- [Set_restriction_class()](@/wiki/reference/simplepie/set_restriction_class.md)
- [Set_sanitize_class()](@/wiki/reference/simplepie/set_sanitize_class.md)
- [Set_source_class()](@/wiki/reference/simplepie/set_source_class.md)
- [Set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [Set_timeout()](@/wiki/reference/simplepie/set_timeout.md)
- [Set_url_replacements()](@/wiki/reference/simplepie/set_url_replacements.md)
- [Set_useragent()](@/wiki/reference/simplepie/set_useragent.md)
- [SIMPLEPIE_BUILD](@/wiki/reference/simplepie/simplepie_build.md)
- [SIMPLEPIE_LINKBACK](@/wiki/reference/simplepie/simplepie_linkback.md)
- [SIMPLEPIE_NAME](@/wiki/reference/simplepie/simplepie_name.md)
- [SIMPLEPIE_URL](@/wiki/reference/simplepie/simplepie_url.md)
- [SIMPLEPIE_USERAGENT](@/wiki/reference/simplepie/simplepie_useragent.md)
- [SIMPLEPIE_VERSION](@/wiki/reference/simplepie/simplepie_version.md)
- [Sort_items()](@/wiki/reference/simplepie/sort_items.md)
- [Strip_attributes()](@/wiki/reference/simplepie/strip_attributes.md)
- [Strip_comments()](@/wiki/reference/simplepie/strip_comments.md)
- [Strip_htmltags()](@/wiki/reference/simplepie/strip_htmltags.md)
- [Subscribe_aol()](@/wiki/reference/simplepie/subscribe_aol.md)
- [Subscribe_bloglines()](@/wiki/reference/simplepie/subscribe_bloglines.md)
- [Subscribe_eskobo()](@/wiki/reference/simplepie/subscribe_eskobo.md)
- [Subscribe_feed()](@/wiki/reference/simplepie/subscribe_feed.md)
- [Subscribe_feedfeeds()](@/wiki/reference/simplepie/subscribe_feedfeeds.md)
- [Subscribe_feedster()](@/wiki/reference/simplepie/subscribe_feedster.md)
- [Subscribe_google()](@/wiki/reference/simplepie/subscribe_google.md)
- [Subscribe_gritwire()](@/wiki/reference/simplepie/subscribe_gritwire.md)
- [Subscribe_itunes()](@/wiki/reference/simplepie/subscribe_itunes.md)
- [Subscribe_msn()](@/wiki/reference/simplepie/subscribe_msn.md)
- [Subscribe_netvibes()](@/wiki/reference/simplepie/subscribe_netvibes.md)
- [Subscribe_newsburst()](@/wiki/reference/simplepie/subscribe_newsburst.md)
- [Subscribe_newsgator()](@/wiki/reference/simplepie/subscribe_newsgator.md)
- [Subscribe_odeo()](@/wiki/reference/simplepie/subscribe_odeo.md)
- [Subscribe_outlook()](@/wiki/reference/simplepie/subscribe_outlook.md)
- [Subscribe_podcast()](@/wiki/reference/simplepie/subscribe_podcast.md)
- [Subscribe_podnova()](@/wiki/reference/simplepie/subscribe_podnova.md)
- [Subscribe_rojo()](@/wiki/reference/simplepie/subscribe_rojo.md)
- [Subscribe_url()](@/wiki/reference/simplepie/subscribe_url.md)
- [Subscribe_yahoo()](@/wiki/reference/simplepie/subscribe_yahoo.md)

</div>

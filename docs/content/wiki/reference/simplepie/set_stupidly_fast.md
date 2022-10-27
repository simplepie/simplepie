+++
title = "set_stupidly_fast()"
+++

## Description {#description}

```php
class SimplePie {
    set_stupidly_fast ( [bool $set = false] )
}
```

Set options to make SimplePie as fast as possible. Forgoes a substantial amount of data sanitization in favor of speed, namely disabling [enable_order_by_date()](@/wiki/reference/simplepie/enable_order_by_date.md), [remove_div()](@/wiki/reference/simplepie/remove_div.md), [strip_comments()](@/wiki/reference/simplepie/strip_comments.md), [strip_htmltags()](@/wiki/reference/simplepie/strip_htmltags.md), [strip_attributes()](@/wiki/reference/simplepie/strip_attributes.md), and [set_image_handler()](@/wiki/reference/simplepie/set_image_handler.md).

<div class="warning">

SimplePie protects against malicious feeds by sanitizing the data. If you don't trust the feeds that you're parsing, you should do your own data sanitization to avoid security issues. If you DO trust the feeds you're parsing, this shouldn't be an issue.

</div>

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### set {#set}

Whether to trade data cleanliness for raw speed.

## Examples {#examples}

### Enable "Stupidly Fast" mode {#enable_stupidly_fast_mode}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_stupidly_fast(true);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Equivalent individual settings as set_stupidly_fast() {#equivalent_individual_settings_as_set_stupidly_fast}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');

// All of the things that set_stupidly_fast() sets automatically.
$feed->enable_order_by_date(false);
$feed->remove_div(false);
$feed->strip_comments(false);
$feed->strip_htmltags(false);
$feed->strip_attributes(false);
$feed->set_image_handler(false);

$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Override a specific setting from set_stupidly_fast() {#override_a_specific_setting_from_set_stupidly_fast}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');

// Set set_stupidly_fast(), then override one of the settings.
$feed->set_stupidly_fast(true);
$feed->enable_order_by_date(true);

$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [Why would I use SimplePie over something else?](@/wiki/faq/why_would_i_use_simplepie_over_something_else.md)
- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

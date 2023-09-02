+++
title = "set_useragent()"
+++

## Description {#description}

```php
class SimplePie {
    set_useragent ( [string $ua = SIMPLEPIE_USERAGENT] )
}
```

Allows you to override the [user agent string](http://en.wikipedia.org/wiki/User_agent) that SimplePie sends to the remote server. This value is passed directly to [SimplePie_File](@/wiki/reference/simplepie_file/_index.md).

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### ua {#ua}

A new user agent string for SimplePie to use. Defaults to [SIMPLEPIE_USERAGENT](@/wiki/reference/simplepie/simplepie_useragent.md).

## Examples {#examples}

### Prepend 'Mozilla/4.0' to the existing user agent string {#prepend_mozilla40_to_the_existing_user_agent_string}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_useragent('Mozilla/4.0 '.SIMPLEPIE_USERAGENT);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [Known Problematic Feeds](@/wiki/faq/problematic_feeds.md)
- [SIMPLEPIE_USERAGENT](@/wiki/reference/simplepie/simplepie_useragent.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

+++
title = "set_input_encoding()"
+++

## Description {#description}

```php
class SimplePie {
    set_input_encoding ( [string $encoding = false] )
}
```

Allows you to override the character encoding of the feed. This is only useful for times when the feed is reporting an incorrect character encoding (as per [RFC 3023](http://www.faqs.org/rfcs/rfc3023.html) and [Determining the character encoding of a feed](http://diveintomark.org/archives/2004/02/13/xml-media-types)). This setting is similar to [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md).

The number of supported character encodings depends on whether your web host supports [mbstring](http://php.net/mbstring), [iconv](http://php.net/iconv), or both. See [Supported Character Encodings](@/wiki/faq/supported_character_encodings.md) for more information.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as input_encoding() since Beta 3.

## Parameters {#parameters}

### encoding {#encoding}

The character encoding to use instead of allowing SimplePie to auto-detect it.

## Examples {#examples}

### Override a feed's input {#override_a_feed_s_input}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://nurapt.kaist.ac.kr/~jamaica/htmls/blog/rss.php');
$feed->set_input_encoding('EUC-KR');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

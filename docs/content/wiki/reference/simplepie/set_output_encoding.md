+++
title = "set_output_encoding()"
+++

## Description {#description}

```php
class SimplePie {
    set_output_encoding ( [string $encoding = 'UTF-8'] )
}
```

Allows you to override SimplePie's output to match that of your webpage. This is useful for times when your webpages are not being served as `UTF-8`. This setting will be obeyed by [handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md), and is similar to [set_input_encoding()](@/wiki/reference/simplepie/set_input_encoding.md).

It should be noted, however, that not all character encodings can support all characters. If your page is being served as `ISO-8859-1` and you try to display a Japanese feed, you'll likely see garbled characters. Because of this, it is highly recommended to ensure that your webpages are served as `UTF-8`.

The number of supported character encodings depends on whether your web host supports [mbstring](http://php.net/mbstring), [iconv](http://php.net/iconv), or both. See [Supported Character Encodings](@/wiki/faq/supported_character_encodings.md) for more information.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as output_encoding() since Beta 3.

## Parameters {#parameters}

### encoding {#encoding}

The character encoding to serve SimplePie's output as.

## Examples {#examples}

### Override SimplePie's output {#override_simplepie_s_output}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_output_encoding('Windows-1252');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [I'm seeing weird characters](@/wiki/faq/i_m_seeing_weird_characters.md)
- [handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md)
- [set_input_encoding()](@/wiki/reference/simplepie/set_input_encoding.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

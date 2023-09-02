+++
title = "enable_xml_dump()"
+++

## Description {#description}

```php
class SimplePie {
    enable_xml_dump ( [bool $enable = false] )
}
```

Outputs the raw <abbr title="Extensible Markup Language">XML</abbr> content of the feed, after it has gone through SimplePie's filters.

Used only for debugging, this function will output the <abbr title="Extensible Markup Language">XML</abbr> content as text/xml. When SimplePie reads in a feed, it does a bit of cleaning up before trying to parse it. Many parts of the feed are re-written in memory, and in the end, you have a parsable feed. XMLdump shows you the actual <abbr title="Extensible Markup Language">XML</abbr> that SimplePie tries to parse, which may or may not be very different from the original feed.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as enable_xmldump() since SimplePie Preview Release.
- Previously existed as a constructor parameter since SimplePie 0.91.

## Parameters {#parameters}

### enable {#enable}

Enable/disable XMLdump mode.

## Examples {#examples}

### Enable XMLdump {#enable_xmldump}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->enable_xml_dump(true);
$feed->init();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

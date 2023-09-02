+++
title = "enable_order_by_date()"
+++

## Description {#description}

```php
class SimplePie {
    enable_order_by_date ( [bool $enable = true] )
}
```

Sometimes feeds don't have their items in chronological order. By default, SimplePie will re-order them to be in such an order. With this option, you can enable/disable the reordering of items into reverse chronological order if you don't want it.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as order_by_date() since SimplePie Beta 2.

## Parameters {#parameters}

### enable {#enable}

Set whether items should be re-ordered. Defaults to true.

## Examples {#examples}

### Disable re-ordering chronologically {#disable_re-ordering_chronologically}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->enable_order_by_date(false);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

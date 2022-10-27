+++
title = "get_scheme()"
+++

## Description {#description}

```php
class SimplePie_Credit {
    get_scheme()
}
```

Returns the organizational scheme for the role of the person or entity receiving the given credit. This mostly has relevance to Media <abbr title="Rich Site Summary">RSS</abbr> content.

## Availability {#availability}

- Available since SimplePie 1.0.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    if ($enclosure = $item->get_enclosure())
    {
        if ($credit = $enclosure->get_credit())
        {
            echo '<p><span title="' . $credit->get_scheme() . '">' . $credit->get_role() . '</span>: ' . $credit->get_name() . '</p>';
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Credit](@/wiki/reference/simplepie_credit/_index.md)

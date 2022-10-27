+++
title = "get_value()"
+++

## Description {#description}

```php
class SimplePie_Restriction {
    get_value()
}
```

Returns the value of the restriction. This mostly has relevance to Media <abbr title="Rich Site Summary">RSS</abbr> content.

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
        if ($restriction = $enclosure->get_restriction())
        {
            echo '<p>We are to ' . $restriction->get_relationship() . ' ' . $restriction->get_value() . ', which is of type ' . $restriction->get_type() . '</p>';
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Restriction](@/wiki/reference/simplepie_restriction/_index.md)

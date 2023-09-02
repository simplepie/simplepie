+++
title = "get_credits()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_credits ()
}
```

Returns all available credits for the enclosure as an array of [SimplePie_Credit](@/wiki/reference/simplepie_credit/_index.md) objects. This is is specific to `<media:credit>` data.

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
        foreach ((array) $enclosure->get_credits() as $credit)
        {
            echo $credit->get_name();
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [SimplePie_Credit](@/wiki/reference/simplepie_credit/_index.md)
- [get_credit()](@/wiki/reference/simplepie_enclosure/get_credit.md)

+++
title = "get_hashes()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    get_hashes ()
}
```

Returns all available file hashes for the enclosure as an array. This is is specific to `<media:hash>` data.

Hashes are returned formatted as `md5:0123456789abcdef0123456789abcdef`.

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
        foreach ((array) $enclosure->get_hashes() as $hash)
        {
            echo $hash;
        }
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [get_hash()](@/wiki/reference/simplepie_enclosure/get_hash.md)

+++
title = "get_id()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_id ( [(bool) $hash = false] )
}
```

Returns the unique identifier for the posting. This is most helpful in writing code to check for new items in a feed.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### hash {#hash}

If set to true, SimplePie will return a unique [MD5](http://id.php.net/manual/en/function.md5.php) hash for the item. If set to false, it will check `<guid>`, `<link>`, and `<title>` before defaulting to the hash.

## Examples {#examples}

### Checking the ID of the posting against a list {#checking_the_id_of_the_posting_against_a_list}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    $prev_ids = array('guid1', 'guid2', 'guid3', 'guid4');
    if (in_array($item->get_id(true), $prev_ids))
    {
        echo "This item is already stored.";
    }
    else
    {
        echo "This is a new item!";
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

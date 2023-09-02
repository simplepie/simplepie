+++
title = "get_contributor()"
+++

## Description {#description}

```php
class SimplePie {
    get_contributor ( [int $key = 0] )
}
```

Returns a single array location containing a [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md) object.

## Availability {#availability}

- Available since SimplePie 1.1.

## Parameters {#parameters}

### key {#key}

The item that you want to return. Remember that arrays begin with `0`, not `1`.

## Examples {#examples}

### Get a contributor for the feed. {#get_a_contributor_for_the_feed}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

if ($contributor = $feed->get_contributor())
{
    echo $contributor->get_name();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md)
- [get_contributors()](@/wiki/reference/simplepie/get_contributors.md)

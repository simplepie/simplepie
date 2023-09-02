+++
title = "get_author()"
+++

## Description {#description}

```php
class SimplePie {
    get_author ( [int $key = 0] )
}
```

Returns a single array location containing a [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md) object.

## Availability {#availability}

- Available since SimplePie 1.1.

## Parameters {#parameters}

### key {#key}

The item that you want to return. Remember that arrays begin with `0`, not `1`.

## Examples {#examples}

### Get an author for the feed. {#get_an_author_for_the_feed}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

if ($author = $feed->get_author())
{
    echo $author->get_name();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md)
- [get_authors()](@/wiki/reference/simplepie/get_authors.md)

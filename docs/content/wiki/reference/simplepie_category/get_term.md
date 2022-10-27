+++
title = "get_term()"
+++

## Description {#description}

```php
class SimplePie_Category {
    get_term()
}
```

Returns the “term” for the category. This mostly has relevance to Atom feeds and Media <abbr title="Rich Site Summary">RSS</abbr> content.

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
    if ($category= $item->get_category())
    {
        echo $category->get_term();
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md)

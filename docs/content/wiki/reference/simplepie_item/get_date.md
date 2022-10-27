+++
title = "get_date()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_date ( [$date_format = 'j F Y, g:i a'] )
}
```

Returns the date/timestamp of the posting. Date format supports anything that works with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [date()](http://php.net/date) function. Only supports the English language.

## Availability {#availability}

- Available since SimplePie Beta 2.
- Previously existed as `get_item_date()` since SimplePie 0.8.

## Parameters {#parameters}

### date_format {#date_format}

Accepts any value allowed by [date()](http://php.net/date).

## Examples {#examples}

### Display the date {#display_the_date}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $item->get_date();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [get_local_date()](@/wiki/reference/simplepie_item/get_local_date.md)

+++
title = "get_local_date()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_local_date ( [$date_format = '%c'] )
}
```

Returns the date/timestamp of the posting in the localized language. Date format supports anything that works with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [strftime()](http://php.net/strftime) function. To display in other languages, you need to change the locale with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [setlocale()](http://php.net/setlocale) function. The available localizations depend on which ones are installed on your web server.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### date_format {#date_format}

Accepts any value allowed by [strftime()](http://php.net/strftime).

## Examples {#examples}

### Display the date {#display_the_date}

```php
// Set the region/language to Canadian French
setlocale(LC_TIME, 'fr_CA');

$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    echo $item->get_local_date('%A %e %B %Y');
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [get_date()](@/wiki/reference/simplepie_item/get_date.md)
- [Translate timestamps into another language](@/wiki/tutorial/translate_timestamps_into_another_language.md)

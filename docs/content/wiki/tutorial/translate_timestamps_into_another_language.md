+++
title = "Translate timestamps into another language"
+++

By default, <abbr title="Hypertext Preprocessor">PHP</abbr> displays timestamps in English. Since SimplePie's [get_date()](@/wiki/reference/simplepie_item/get_date.md) method relies on <abbr title="Hypertext Preprocessor">PHP</abbr>'s [date()](http://php.net/date) function, get_date() is English-only. However, in SimplePie 1.0 we introduced [get_local_date()](@/wiki/reference/simplepie_item/get_local_date.md) which leverages <abbr title="Hypertext Preprocessor">PHP</abbr>'s [strftime()](http://php.net/strftime) function which is designed to translate timestamps into other languages.

[get_local_date()](@/wiki/reference/simplepie_item/get_local_date.md) accepts values that are accepted by [strftime()](http://php.net/strftime). We also need to call <abbr title="Hypertext Preprocessor">PHP</abbr>'s [setlocale()](http://php.net/setlocale) function prior to using this method. setlocale() has it's own set of issues with region/language codes. It only supports whatever is installed in your <abbr title="Hypertext Preprocessor">PHP</abbr> installation, and some servers require two or three-letter codes.

- [Sample language codes](http://ltru.generic-nic.net/registries/lsr-language.txt)
- [Sample region codes](http://ltru.generic-nic.net/registries/lsr-region.txt)
- <http://www.iana.org/assignments/language-subtag-registry>
- <http://en.wikipedia.org/wiki/List_of_ISO_639-2_codes>
- <http://www.google.com/search?q=RFC4646>

This will ONLY work for items that have timestamps.

## Compatibility {#compatibility}

- Supported in SimplePie 1.0.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Code source {#code_source}

```php
// Set the region/language to Canadian French
setlocale(LC_TIME, 'fr_CA');

// As we loop through items, display the formatted, localized date.
foreach($feed->get_items() as $item) {
    echo '<p>' . $item->get_title() . ' ' . $item->get_local_date('%A %e %B %Y') . '</p>';
}
```

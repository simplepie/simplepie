+++
title = "set_cache_name_function()"
+++

## Description {#description}

```php
class SimplePie {
    set_cache_name_function ( [mixed $function = 'md5'] )
}
```

Set the callback function to create cache filename with.

Some operating systems (namely Windows) have filename length caps, and some feeds have a <abbr title="Uniform Resource Locator">URL</abbr> that is longer than that (eBay feeds, for example). By generating a shorter name, we not only protect the original <abbr title="Uniform Resource Locator">URL</abbr>, but we also avoid these types of filename errors.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as set_cache_name_type() since SimplePie Beta 3.

## Parameters {#parameters}

### function {#function}

Callback function for naming cache files. The following is a list of built-in <abbr title="Hypertext Preprocessor">PHP</abbr> functions suited for this, although you are free to write your own and use it here.

- **[sha1](http://php.net/sha1)** – Calculates the SHA1 hash using the [US Secure Hash Algorithm 1](http://www.faqs.org/rfcs/rfc3174). The hash is a 40-character hexadecimal number.
- **[md5](http://php.net/md5)** – Calculates the MD5 hash using the [MD5 Message-Digest Algorithm](http://www.faqs.org/rfcs/rfc1321). The hash is a 32-character hexadecimal number.
- **[crc32](http://php.net/crc32)** – Generates the cyclic redundancy checksum polynomial of 32-bit lengths.
- **[rawurlencode](http://php.net/rawurlencode)** – Encodes the given string according to [RFC 1738](http://www.faqs.org/rfcs/rfc1738).
- **[urlencode](http://php.net/urlencode)** – Returns a string in which all non-alphanumeric characters except -\_. have been replaced with a percent (%) sign followed by two hex digits and spaces encoded as plus (+) signs.

## Examples {#examples}

### Use SHA-1 to create cache filenames {#use_sha-1_to_create_cache_filenames}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_cache_name_function('sha1');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Use custom function to create cache filenames {#use_custom_function_to_create_cache_filenames}

```php
function pig_latin($string)
{
    $piglatin = '';
    // Code to convert string to Pig Latin...
    return $piglatin;
}

$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_cache_name_function('pig_latin');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

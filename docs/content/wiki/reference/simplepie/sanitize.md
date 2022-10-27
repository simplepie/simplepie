+++
title = "sanitize()"
+++

## Description {#description}

```php
class SimplePie {
    sanitize ( mixed $data, integer $type, [ string $base = '' ] )
}
```

Sanitizes the incoming data to ensure that it matches the type of data expected. Also absolutizes relative URLs, and a few other things to ensure the data is of the best quality.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### data {#data}

The data that needs to be sanitized.

### type {#type}

The type of data that it's supposed to be.

- `SIMPLEPIE_CONSTRUCT_NONE`  
  No construct (<img src="/wiki/lib/images/smileys/icon_question.gif" class="middle" alt=":?:" /> This could use a better description)
- `SIMPLEPIE_CONSTRUCT_TEXT`  
  Plain text content
- `SIMPLEPIE_CONSTRUCT_HTML`  
  <abbr title="HyperText Markup Language">HTML</abbr> content
- `SIMPLEPIE_CONSTRUCT_XHTML`  
  <abbr title="Extensible HyperText Markup Language">XHTML</abbr> content
- `SIMPLEPIE_CONSTRUCT_BASE64`  
  Base64 content
- `SIMPLEPIE_CONSTRUCT_IRI`  
  IRI content (e.g. URLs, URIs, etc.)
- `SIMPLEPIE_CONSTRUCT_MAYBE_HTML`  
  Might be <abbr title="HyperText Markup Language">HTML</abbr>, so let's treat it as such.
- `SIMPLEPIE_CONSTRUCT_ALL`  
  All types of content

### base {#base}

The `xml:base` value to use when converting relative URLs to absolute ones.

## Examples {#examples}

### Sanitize the data as a URL {#sanitize_the_data_as_a_url}

```php
$data = $feed->sanitize('http://simplepie.org/wiki/', SIMPLEPIE_CONSTRUCT_IRI);
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

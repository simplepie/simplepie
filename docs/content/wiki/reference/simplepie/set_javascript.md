+++
title = "set_javascript()"
+++

## Description {#description}

```php
class SimplePie {
    set_javascript ( [mixed $get = 'js'] )
}
```

Set the query string that triggers SimplePie to generate the JavaScript code for embedding media files.

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### get {#get}

The query string to use.

## Examples {#examples}

### Change the query string {#change_the_query_string}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_javascript('embed'); // Will load <script src="?embed" type="text/javascript"></script> when $enclosure->embed() is called.
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [SimplePie 1.0 "Razzleberry"](@/wiki/misc/release_notes/simplepie_1.0.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

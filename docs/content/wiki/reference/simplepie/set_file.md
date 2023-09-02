+++
title = "set_file()"
+++

## Description {#description}

```php
class SimplePie {
    set_file ( object &$file )
}
```

Allows you to use [SimplePie_File](@/wiki/reference/simplepie_file/_index.md) in a custom way, then use <span class="curid">[set_file()](@/wiki/reference/simplepie/set_file.md)</span> to tell SimplePie to use it.

<div class="warning">

**NOTE:** If you pass a feed to SimplePie this way, SimplePie doesn't do any caching. You'll need to manage caching yourself.

</div>

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### file {#file}

An instance of the [SimplePie_File](@/wiki/reference/simplepie_file/_index.md) object.

## Examples {#examples}

### Use a custom instance of the SimplePie_File object {#use_a_custom_instance_of_the_simplepie_file_object}

```php
$file = new SimplePie_File('http://simplepie.org/blog/feed/');

$feed = new SimplePie();
$feed->set_file($file);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- <span class="curid">[set_file()](@/wiki/reference/simplepie/set_file.md)</span>
- [API Reference](@/wiki/reference/_index.md)

</div>

+++
title = "get_links()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_links ( [$rel = 'alternate'] )
}
```

Returns an array of links that were found for the feed which can be looped through.

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### relation {#relation}

The relationship of links to return.

## Examples {#examples}

### Loop through each item and do something with each {#loop_through_each_item_and_do_something_with_each}

```php
<?php
require_once('../simplepie.inc');

$feed = new SimplePie('http://simplepie.org/blog/feed/');
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Sample SimplePie Page</title>
</head>
<body>

<?php
foreach ($feed->get_items() as $item)
{
    foreach ($item->get_links() as $link)
    {
        echo $link . "<br />";
    }
}
?>
</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [get_link()](@/wiki/reference/simplepie_item/get_link.md)

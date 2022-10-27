+++
title = "get_all_discovered_feeds()"
+++

## Description {#description}

```php
class SimplePie {
    get_all_discovered_feeds ()
}
```

Returns an array of SimplePie_File objects, pointing to feeds found during the autodiscovery process.

## Availability {#availability}

- Available since SimplePie 1.2.
- Available since [r1051](http://bugs.simplepie.org/repositories/revision/sp1/1051)

## Examples {#examples}

### Loop through each item and do something with each {#loop_through_each_item_and_do_something_with_each}

```php
<?php
require_once('../simplepie.inc');

$feed = new SimplePie('http://simplepie.org/wiki/reference/simplepie/get_all_discovered_feeds');

foreach ($feed->get_all_discovered_feeds() as $link)
{
    echo $link->url . "<br />";
}
?>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [subscribe_url()](@/wiki/reference/simplepie/subscribe_url.md)

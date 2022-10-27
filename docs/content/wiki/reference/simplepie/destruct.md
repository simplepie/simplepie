+++
title = "__destruct()"
+++

## Description {#description}

```php
class SimplePie {
    __destruct ()
}
```

There is a bug in versions of <abbr title="Hypertext Preprocessor">PHP</abbr> older than 5.3 where <abbr title="Hypertext Preprocessor">PHP</abbr> doesn't release memory properly in certain cases. This issue is discussed further in the [I'm getting memory leaks!](@/wiki/faq/i_m_getting_memory_leaks.md) page.

## Availability {#availability}

- Available since SimplePie 1.1.

## Examples {#examples}

### Calling the destructor before unsetting the object reference {#calling_the_destructor_before_unsetting_the_object_reference}

```php
<?php
for ($i = 1; $i < 10; $i++)
{
    $feed = new SimplePie();
    $feed->set_feed_url($url);
    $feed->init();
    $feed->handle_content_type();
    $item = $feed->get_item(0);

    $feed->__destruct(); // Do what PHP should be doing on it's own.
    unset($feed);

    echo "Memory usage: " . number_format(memory_get_usage());
}
?>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

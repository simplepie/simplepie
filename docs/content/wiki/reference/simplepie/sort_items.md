+++
title = "sort_items()"
+++

## Description {#description}

```php
class SimplePie {
    sort_items ( mixed $a, mixed $b)
}
```

This method is used exclusively as the user-defined function for <abbr title="Hypertext Preprocessor">PHP</abbr>'s usort() function. This is used for sorting items by a certain criteria, namely by date. If you would prefer to change the sorting criteria, you can simply extend the [SimplePie](@/wiki/reference/simplepie/_index.md) class and override this method. You should never need to call this function directly.

Learn more about extending classes in <abbr title="Hypertext Preprocessor">PHP</abbr>:

- **<abbr title="Hypertext Preprocessor">PHP</abbr> 4:** <http://php.net/manual/en/keyword.extends.php>
- **<abbr title="Hypertext Preprocessor">PHP</abbr> 5:** <http://php.net/manual/en/language.oop5.basic.php#language.oop5.basic.extends>

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### a {#a}

A reference to the first item to sort.

### b {#b}

A reference to the second item to sort.

## Examples {#examples}

### Sort items by number of characters in the title, shortest first {#sort_items_by_number_of_characters_in_the_title_shortest_first}

```php
<?php
require_once('../simplepie.inc');

// Create a new class that extends an existing class
class SimplePie_Custom_Sort extends SimplePie {

    function sort_items($a, $b)
    {
        return strlen($a->get_title()) >= strlen($b->get_title());
    }
}

// Let's do our standard SimplePie thing.
$feed = new SimplePie_Custom_Sort();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();
?>

<html>
<body>

<?php foreach ($feed->get_items(0,5) as $item): ?>

    <h4><a href="<?php echo $item->get_permalink()?>"><?php echo $item->get_title()?></a></h4>
    <p><small><?php echo $item->get_date('j F Y, g:i a')?></small></p>
    <p><?php echo $item->get_description()?></p>

    <hr />

<?php endforeach; ?>

</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

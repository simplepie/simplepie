+++
title = "set_category_class()"
+++

## Description {#description}

```php
class SimplePie {
    set_category_class ( [string $class = 'SimplePie_Category'] )
}
```

Allows you to add new methods or replace existing methods in the [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md) class.

Learn more about extending classes in <abbr title="Hypertext Preprocessor">PHP</abbr>:

- **<abbr title="Hypertext Preprocessor">PHP</abbr> 4:** <http://php.net/manual/en/keyword.extends.php>
- **<abbr title="Hypertext Preprocessor">PHP</abbr> 5:** <http://php.net/manual/en/language.oop5.basic.php#language.oop5.basic.extends>

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### class {#class}

The new class for SimplePie to use.

## Examples {#examples}

### Replace a method and add a method {#replace_a_method_and_add_a_method}

```php
<?php
require_once('../simplepie.inc');

// Create a new class that extends an existing class
class SimplePie_Category_Extras extends SimplePie_Category {

    /**
    This is an example of adding a new method to an existing class.
     */

    function get_label_backwards()
    {
        return strrev($this->get_label());
    }
}

// Let's do our standard SimplePie thing.
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_category_class('SimplePie_Category_Extras');
$feed->init();
$feed->handle_content_type();
?>

<html>
<body>

<?php foreach ($feed->get_items(0,5) as $item): ?>

    <h4><a href="<?php echo $item->get_permalink()?>"><?php echo $item->get_title()?></a></h4>
    <p><small><?php echo $item->get_date('j F Y, g:i a')?></small></p>
    <p><?php echo $item->get_description()?></p>

    <p><small>Category:
    <?php

    if ($category = $item->get_category())
    {
        echo $category->get_label_backwards();
    }

    ?>
    </small></p>

    <hr />

<?php endforeach; ?>

</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md)

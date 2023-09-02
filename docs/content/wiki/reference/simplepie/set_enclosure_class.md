+++
title = "set_enclosure_class()"
+++

## Description {#description}

```php
class SimplePie {
    set_enclosure_class ( [string $class = 'SimplePie_Enclosure'] )
}
```

Allows you to add new methods or replace existing methods in the [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md) class.

Learn more about extending classes in <abbr title="Hypertext Preprocessor">PHP</abbr>:

- **<abbr title="Hypertext Preprocessor">PHP</abbr> 4:** <http://php.net/manual/en/keyword.extends.php>
- **<abbr title="Hypertext Preprocessor">PHP</abbr> 5:** <http://php.net/manual/en/language.oop5.basic.php#language.oop5.basic.extends>

## Availability {#availability}

- Available since SimplePie Beta 3.

## Parameters {#parameters}

### class {#class}

The new class for SimplePie to use.

## Examples {#examples}

### Replace a method and add a method {#replace_a_method_and_add_a_method}

```php
<?php
require_once('../simplepie.inc');

// Create a new class that extends an existing class
class SimplePie_Enclosure_Extras extends SimplePie_Enclosure {

    /**
    This is an example of adding a new method to an existing class.
     */

    // Return the file's size in GB's.
    function get_size_gb()
    {
        $length = $this->get_length();
        if (!empty($length))
        {
            return round($length/1073741824, 2);
        }
        else
        {
            return null;
        }
    }
}

// Let's do our standard SimplePie thing.
$feed = new SimplePie();
$feed->set_feed_url('http://revision3.com/diggnation/feed/quicktime-large');
$feed->set_enclosure_class('SimplePie_Enclosure_Extras');
$feed->init();
$feed->handle_content_type();
?>

<html>
<body>

<?php foreach ($feed->get_items(0,5) as $item): ?>

    <h4><a href="<?php echo $item->get_permalink()?>"><?php echo $item->get_title()?></a></h4>
    <p><small><?php echo $item->get_date('j F Y, g:i a')?></small></p>
    <p><?php echo $item->get_description()?></p>

    <div align="center">
    <?php

    if ($enclosure = $item->get_enclosure())
    {
        echo $enclosure->native_embed();
        echo '<p><small>Size is ' . $enclosure->get_size_gb() . ' GB</small></p>';
    }

    ?>
    </div>

    <hr />

<?php endforeach; ?>

</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)

+++
title = "set_item_class()"
+++

## Description {#description}

```php
class SimplePie {
    set_item_class ( [string $class = 'SimplePie_Item'] )
}
```

Allows you to add new methods or replace existing methods in the [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md) class.

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
class SimplePie_Item_Extras extends SimplePie_Item {

    /**
    This is an example of adding a new method to an existing class.
     */

    // Retrieve the <gd:when startTime="" /> value.
    function get_gcal_starttime($format = false)
    {
        // We want to grab the Google-namespaced <gd:when> tag.
        // http://simplepie.org/wiki/tutorial/grab_custom_tags_or_attributes
        $when = $this->get_item_tags('http://schemas.google.com/g/2005', 'when');

        // Once we grab the tag, let's grab the startTime attribute
        $date = $when[0]['attribs']['']['startTime'];

        if ($format)
        {
            // Let's pass it through strtotime() and then format it with date(). This will be the date we display.
            return date($format, strtotime($date));
        }
        else
        {
            // Otherwise we'll return it as-is with no modifications.
            return $date;
        }
    }

    /**
    This is an example of modifying an existing method of an existing class.
     */

    function get_id()
    {
        return $this->__toString();
    }

}

// Let's do our standard SimplePie thing.
$feed = new SimplePie();
$feed->set_feed_url('http://www.google.com/calendar/feeds/eventi%40emmealcubo.com/public/full');
$feed->set_item_class('SimplePie_Item_Extras');
$feed->init();
$feed->handle_content_type();
?>

<html>
<body>

<?php foreach ($feed->get_items(0,5) as $item): ?>

    <h4><a href="<?php echo $item->get_permalink()?>"><?php echo $item->get_title()?></a></h4>
    <p><small><?php echo $item->get_date('j F Y, g:i a')?></small></p>
    <p><?php echo $item->get_description()?></p>
    <p>Starts on <?php echo $item->get_gcal_starttime('j F Y')?></p>
    <p>GUID: <?php echo $item->get_id()?></p>
    <hr />

<?php endforeach; ?>

</body>
</html>
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)

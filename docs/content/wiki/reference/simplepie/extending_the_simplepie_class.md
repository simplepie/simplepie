+++
title = "Extending the SimplePie class"
+++

## Description {#description}

Whereas other classes can be extended with specific methods (listed below in the [API Reference](@/wiki/reference/_index.md)), SimplePie can be overloaded directly.

Learn more about extending classes in <abbr title="Hypertext Preprocessor">PHP</abbr>:

- **<abbr title="Hypertext Preprocessor">PHP</abbr> 4:** <http://php.net/manual/en/keyword.extends.php>
- **<abbr title="Hypertext Preprocessor">PHP</abbr> 5:** <http://php.net/manual/en/language.oop5.basic.php#language.oop5.basic.extends>

## Availability {#availability}

- Available since SimplePie Preview Release.

## Examples {#examples}

### Replace a method and add a method {#replace_a_method_and_add_a_method}

```php
<?php
require_once('../simplepie.inc');

// Create a new class that extends an existing class
class SimplePie_Extras extends SimplePie {

    /**
    These are examples of adding new methods to an existing class.
     */

    function read_in_simplereader_mobile()
    {
        return $this->subscribe_service('http://mobile.simplereader.com/?feed=');
    }

    function get_feed_title()
    {
        return $this->get_title();
    }

}

// Let's do our standard SimplePie thing, except that we call SimplePie_Extras instead of SimplePie.
$feed = new SimplePie_Extras();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();
?>

<html>
<body>

<h1><?php echo $feed->get_feed_title(); ?></h1>
<p><small><a href="<?php echo $feed->read_in_simplereader_mobile(); ?>">Read in SimpleReader Mobile!</a></small></p>
<hr />

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

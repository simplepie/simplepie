+++
title = "del.icio.us RSS"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Author</th>
<td><a href="http://beta.sneakerpeet.com">Peet 'Sneaker Peet' Sneekes</a></td>
</tr>
<tr>
<th>Revision</th>
<td>1</td>
</tr>
<tr>
<th>SimplePie version</th>
<td>1.0</td>
</tr>
<tr>
<th>Classes Extended</th>
<td><a href="@/wiki/reference/simplepie_item/_index.md">SimplePie_Item</a></td>
</tr>
</tbody>
</table>

### About the Add-on {#about_the_add-on}

This Add-on does not really extend the functionality of SimplePie, but it does extend the get_categories() function. In the del.icio.us- <abbr title="Rich Site Summary">RSS</abbr> there are only spaces to seperate the 'Tags'. This is not handy when you want to iterate over them to give them a certain markup. This extention explodes the one category-element and inserts them into the SimplePie_Item like the rest of them. Also, it's got a 'is_delicious' variable to base diverting mark up on.

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_delicious.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
/**
 * SimplePie Add-on for Delicious tags
 *
 * Copyright (c) 2004-2007, Peet Sneekes
 * All rights reserved. License matches the current SimplePie license.
 */

if (!defined('SIMPLEPIE_NAMESPACE_DELICIOUS'))
{
    define('SIMPLEPIE_NAMESPACE_DELICIOUS', 'http://purl.org/dc/elements/1.1/');
}

class SimplePie_Item_Delicious extends SimplePie_Item
{

    /**
     * @var bool is this a del.icio.us item?
     * @access private
     */
    var $is_delicious = true;

    // Overloading an existing method.

    function get_categories()
    {
        $categories = array();

        foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'category') as $category)
        {
            $term = null;
            $scheme = null;
            $label = null;
            if (isset($category['attribs']['']['term']))
            {
                $term = $this->sanitize($category['attribs']['']['term'], SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if (isset($category['attribs']['']['scheme']))
            {
                $scheme = $this->sanitize($category['attribs']['']['scheme'], SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if (isset($category['attribs']['']['label']))
            {
                $label = $this->sanitize($category['attribs']['']['label'], SIMPLEPIE_CONSTRUCT_TEXT);
            }
            $categories[] =& new $this->feed->category_class($term, $scheme, $label);
        }
        foreach ((array) $this->get_item_tags('', 'category') as $category)
        {
            $categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
        }
        foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_DC_11, 'subject') as $category)
        {
            $exploded_categories = explode(' ', $this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT));
            foreach ((array) $exploded_categories as $exploded_category) {
                $categories[] =& new $this->feed->category_class($exploded_category, null, null);
            }

        }
        foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_DC_10, 'subject') as $category)
        {
            $categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
        }

        if (!empty($categories))
        {
            return SimplePie_Misc::array_unique($categories);
        }
        else
        {
            return null;
        }
    }
}

?>
```

## Using the Add-on {#using_the_add-on}

### Methods {#methods}

- `get_categories()`  
  Now returns separate tags in stead of one line.

### Example Code {#example_code}

N.A.

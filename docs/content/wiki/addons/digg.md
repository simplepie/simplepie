+++
title = "Digg RSS"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Author</th>
<td><a href="http://simplepie.org">Ryan Parman</a></td>
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

This add-on makes it very easy to get access to Digg's custom <abbr title="Rich Site Summary">RSS</abbr> tags known as Digg <abbr title="Rich Site Summary">RSS</abbr>. Data includes the submitter, the submitter's avatar, the number of diggs, number of comments, and the Digg category. There is a screencast available that shows how this Add-on was created: [Creating the Digg SimplePie Add-on](/tutorials/simplepie_digg_addon.mov "http://simplepie.org/tutorials/simplepie_digg_addon.mov").

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_digg.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
/**
 * SimplePie Add-on for Digg
 *
 * Copyright (c) 2004-2007, Ryan Parman and Geoffrey Sneddon
 * All rights reserved. License matches the current SimplePie license.
 */

if (!defined('SIMPLEPIE_NAMESPACE_DIGG'))
{
    define('SIMPLEPIE_NAMESPACE_DIGG', 'http://digg.com/docs/diggrss/');
}

class SimplePie_Item_Digg extends SimplePie_Item
{
    // New method
    function get_digg_count()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'diggCount');
        return $data[0]['data'];
    }

    // New method
    function get_submitter_username()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'submitter');
        $data = $data[0]['child'][SIMPLEPIE_NAMESPACE_DIGG]['username'];
        return $data[0]['data'];
    }

    // New method
    function get_submitter_image()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'submitter');
        $data = $data[0]['child'][SIMPLEPIE_NAMESPACE_DIGG]['userimage'];
        return $data[0]['data'];
    }

    // New method
    function get_comment_count()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'commentCount');
        return $data[0]['data'];
    }

    // Overloading an existing method.
    function get_categories()
    {
        $categories = array();

        foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'category') as $category)
        {
            $categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
        }
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
            $categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
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

- `get_digg_count()`  
  This returns the number of Diggs the article has received.
- `get_submitter_username()`  
  The username of the person who submitted the article.
- `get_submitter_image()`  
  The avatar of the person who submitted the article.
- `get_comment_count()`  
  The number of comments this article has received.
- `get_categories()`  
  Same as the normal [get_categories()](@/wiki/reference/simplepie_item/get_categories.md), except that we've added the Digg category as the first item returned. Returns a [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md) object.

### Example Code {#example_code}

```php
<?php
require_once('simplepie.inc');
require_once('simplepie_digg.inc');

$feed = new SimplePie();
$feed->set_feed_url('http://digg.com/rss/index.xml');
$feed->set_item_class('SimplePie_Item_Digg');
$feed->init();
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Sample Page to test SimplePie add-on for Digg.com</title>
</head>

<body>
    <h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>

    <?php foreach($feed->get_items() as $item): ?>

    <h3><img src="<?php echo $item->get_submitter_image(); ?>" alt="<?php echo $item->get_submitter_username(); ?>" title="<?php echo $item->get_submitter_username(); ?>" width="16" height="16" /> <a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h3>
    <p><?php echo $item->get_description(); ?></p>
    <p><small>Diggs: <?php echo $item->get_digg_count(); ?> | Submitted by: <?php echo $item->get_submitter_username(); ?> | Comments: <?php echo $item->get_comment_count(); ?> | Category: <?php $category = $item->get_category(0); echo $category->get_label(); ?> | <?php echo $item->get_date('l, F jS Y, g:i a'); ?></small></p>
    <hr />

    <?php endforeach; ?>

</body>
</html>
```

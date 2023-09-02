+++
title = "YouTube RSS"
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

This add-on makes it very easy to get access to YouTube's custom <abbr title="Rich Site Summary">RSS</abbr> tags known as Yahoo Media <abbr title="Rich Site Summary">RSS</abbr>. Data includes the player, thumbnail, title, author and alternate categories. Also there is a 'is_youtube' available in every item, so you can base format behavior on that. There is a screencast available that shows how a simelar Add-on was created: [Creating the Digg SimplePie Add-on](/tutorials/simplepie_digg_addon.mov "http://simplepie.org/tutorials/simplepie_digg_addon.mov").

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_youtube.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
/**
 * SimplePie Add-on for YouTube
 *
 * Copyright (c) 2004-2007, Peet Sneekes
 * All rights reserved. License matches the current SimplePie license.
 */

if (!defined('SIMPLEPIE_NAMESPACE_YOUTUBE'))
{
    define('SIMPLEPIE_NAMESPACE_YOUTUBE', 'http://search.yahoo.com/mrss/');
}

class SimplePie_Item_YouTube extends SimplePie_Item
{

    /**
     * @var bool is this a youtube item?
     * @access private
     */
    var $is_youtube = true;


    // New method
    function get_youtube_player_url()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'player');
        return $data[0]['attribs']['']['url'];
    }

    // New method
    function get_youtube_thumbnail_url()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'thumbnail');
        return $data[0]['attribs']['']['url'];
    }

    // New method
    function get_youtube_thumbnail_width()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'thumbnail');
        return $data[0]['attribs']['']['width'];
    }

    // New method
    function get_youtube_thumbnail_height()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'thumbnail');
        return $data[0]['attribs']['']['height'];
    }

    // New method
    function get_youtube_title()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'title');
        return $data[0]['date'];
    }

    // New method
    function get_youtube_author()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'credit');
        return $data[0]['data'];
    }

    // Overloading the categories method
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
        foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'category') as $category)
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

- `get_youtube_player_url()`  
  This returns the player <abbr title="Uniform Resource Locator">URL</abbr> (the YouTube page).
- `get_youtube_thumbnail_url()`  
  This returns the thumbnail <abbr title="Uniform Resource Locator">URL</abbr>.
- `get_youtube_thumbnail_width()`  
  This returns the thumbnail width.
- `get_youtube_thumbnail_height()`  
  This returns the thumbnail height.
- `get_youtube_title()`  
  This returns the alternate title of the movie.
- `get_youtube_author()`  
  This returns the author name of the movie (no email, no, uri).
- `get_categories()`  
  This is extended to get the tags from the special media namespace and explode them accordingly.

### Example Code {#example_code}

N.A.

### External Link {#external_link}

The plugin Listed was not working when Playlist Rss feed is suplied to i am modifying the code, its listed here.

SimplePie Youtube Addon - <http://code.google.com/p/simplepie-youtube-addon>

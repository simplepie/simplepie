+++
title = "Jaiku RSS"
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
<td><a href="@/wiki/reference/simplepie/_index.md">SimplePie</a> <a href="@/wiki/reference/simplepie_item/_index.md">SimplePie_Item</a></td>
</tr>
</tbody>
</table>

### About the Add-on {#about_the_add-on}

This add-on makes it very easy to get access to Jaiku's custom <abbr title="Rich Site Summary">RSS</abbr> tags known as Jaiku <abbr title="Rich Site Summary">RSS</abbr>. Data includes the comment count, user nick, first name, last name, avatar, time since. Also there is a 'is_jaiku' available in every item, so you can base format behavior on that. The SimplePie Object is also extended. This was done to filter out the jaikus from the other feeds in the Jaiku <abbr title="Rich Site Summary">RSS</abbr>. There is a screencast available that shows how a simelar Add-on was created: [Creating the Digg SimplePie Add-on](/tutorials/simplepie_digg_addon.mov "http://simplepie.org/tutorials/simplepie_digg_addon.mov").

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_jaiku.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
/**
 * SimplePie Add-on for Jaiku Messages
 *
 * Copyright (c) 2004-2007, Peet Sneekes
 * All rights reserved. License matches the current SimplePie license.
 */

if (!defined('SIMPLEPIE_NAMESPACE_JAIKUS'))
{
    define('SIMPLEPIE_NAMESPACE_JAIKUS', 'http://jaiku.com/ns');
}

class SimplePie_Jaikus extends SimplePie
{
    /**
     * @var bool get only the jaikus
     * @see SimplePie::enable_only_jaikus()
     * @access private
     */
    var $only_jaikus = true;

    // Overloading an existing method.
    function get_items($start = 0, $end = 0)
    {
        if (!empty($this->multifeed_objects))
        {
            return SimplePie::merge_items($this->multifeed_objects, $start, $end);
        }
        elseif (!isset($this->data['items']))
        {
            if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'entry'))
            {
                $keys = array_keys($items);
                foreach ($keys as $key)
                {
                    $this->data['items'][] =& new $this->item_class($this, $items[$key]);
                }
            }
            if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'entry'))
            {
                $keys = array_keys($items);
                foreach ($keys as $key)
                {
                    $this->data['items'][] =& new $this->item_class($this, $items[$key]);
                }
            }
            if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'item'))
            {
                $keys = array_keys($items);
                foreach ($keys as $key)
                {
                    $this->data['items'][] =& new $this->item_class($this, $items[$key]);
                }
            }
            if ($items = $this->get_feed_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'item'))
            {
                $keys = array_keys($items);
                foreach ($keys as $key)
                {
                    $this->data['items'][] =& new $this->item_class($this, $items[$key]);
                }
            }
            if ($items = $this->get_channel_tags('', 'item'))
            {
                $keys = array_keys($items);
                foreach ($keys as $key)
                {
                    $this->data['items'][] =& new $this->item_class($this, $items[$key]);
                }
            }
        }
        if (!empty($this->data['items']))
        {
            // If we want to order it by date, check if all items have a date, and then sort it
            if ($this->order_by_date)
            {
                if (!isset($this->data['ordered_items']))
                {
                    $do_sort = true;
                    foreach ($this->data['items'] as $item)
                    {
                        if (!$item->get_date('U'))
                        {
                            $do_sort = false;
                            break;
                        }
                    }
                    $item = null;
                    $this->data['ordered_items'] = $this->data['items'];
                    if ($do_sort)
                    {
                        usort($this->data['ordered_items'], array(&$this, 'sort_items'));
                    }
                }
                $items = $this->data['ordered_items'];
            }
            else
            {
                $items = $this->data['items'];
            }
            if ($this->only_jaikus) {

                $tmp_items = array();
                foreach ($items as $item)
                {
                    if (strstr($item->get_link(), 'jaiku.com')!=false)
                    {
                        array_push($tmp_items,$item);
                    }
                }
                $items = $tmp_items;
            }


            // Slice the data as desired
            if ($end == 0)
            {
                return array_slice($items, $start);
            }
            else
            {
                return array_slice($items, $start, $end);
            }
        }
        else
        {
            return array();
        }
    }
}
class SimplePie_Item_Jaiku extends SimplePie_Item
{
    /**
     * @var bool is this a jaiku item?
     * @access private
     */
    var $is_jaiku = true;

    // New method
    function get_comment_count()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'comment');
        return $data[0]['attribs']['']['count'];
    }

    // New method
    function get_user_nick()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'user');
        return $data[0]['attribs']['']['nick'];
    }

    // New method
    function get_user_first_name()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'user');
        return $data[0]['attribs']['']['first_name'];
    }

    // New method
    function get_user_last_name()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'user');
        return $data[0]['attribs']['']['last_name'];
    }

    // New method
    function get_user_avatar()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'user');
        return $data[0]['attribs']['']['avatar'];
    }

    // New method
    function get_user_url()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'user');
        return $data[0]['attribs']['']['url'];
    }

    // New method
    function get_time_since()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_JAIKUS, 'timesince');
        return $data[0]['data'];
    }
}
?>
```

## Using the Add-on {#using_the_add-on}

### Methods {#methods}

- `get_comment_count()`  
  This returns the number of comments the jaiku has received.
- `get_user_nick()`  
  The users nick name who submitted the article.
- `get_user_first_name()`  
  The first name of the person who submitted the article.
- `get_user_last_name()`  
  The last name of the person who submitted the article.
- `get_user_avatar()`  
  The uri to the avatar image of the person who submitted the article.
- `get_user_url()`  
  The uri to the jaiku-page of the person who submitted the article.
- `get_time_since()`  
  The time elapsed since the post was made

### Example Code {#example_code}

```php
<?php
require_once('simplepie.inc');
require_once('simplepie_jaiku.inc');

$jaikus = new SimplePie_Jaikus();
$jaikus->set_feed_url ( 'http://sneakerpeet.jaiku.com/feed/rss');
$jaikus->set_item_class('SimplePie_Item_Jaiku');
$jaikus->init();
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Sample Page to test SimplePie add-on for Jaiku.com</title>
</head>

<body>
        <!-- not really finished here -->

    <h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>

    <?php foreach($feed->get_items() as $item): ?>

    <h3><img src="<?php echo $item->get_submitter_image(); ?>" alt="<?php echo $item->get_submitter_username(); ?>" title="<?php echo $item->get_submitter_username(); ?>" width="16" height="16" /> <a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h3>
    <p><?php echo $item->get_description(); ?></p>
    <p><small>Comments: <?php echo $item->get_comment_count(); ?> | Submitted by: <?php echo $item->get_user_nick(); ?>  | <?php echo $item->get_date('l, F jS Y, g:i a'); ?></small></p>
    <hr />

    <?php endforeach; ?>

</body>
</html>
```

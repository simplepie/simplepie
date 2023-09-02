+++
title = "Cache Extras"
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
<td>1.0 (not 1.1)</td>
</tr>
<tr>
<th>Classes Extended</th>
<td><a href="@/wiki/reference/simplepie/_index.md">SimplePie</a></td>
</tr>
</tbody>
</table>

### About the Add-on {#about_the_add-on}

This add-on adds additional cache-related methods to the SimplePie object such as cache file name, cache timestamp, and cache time remaining.

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_cache_extras.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
class SimplePie_Cache_Extras extends SimplePie
{
    function get_cache_object()
    {
        $cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $this->feed_url), 'spc');
        return $cache;
    }

    function get_cache_filename()
    {
        $cache = $this->get_cache_object();
        return $cache->name;
    }

    function get_cache_timestamp()
    {
        $cache = $this->get_cache_object();
        return $cache->mtime();
    }

    function get_cache_time_remaining($format = false)
    {
        $cache = $this->get_cache_object();
        $remaining = ($cache->mtime() + $this->cache_duration) - time();

        if ($format)
        {
            return SimplePie_Misc::time_hms($remaining);
        }
        else
        {
            return $remaining;
        }
    }
}
?>
```

## Using the Add-on {#using_the_add-on}

### Methods {#methods}

- `get_cache_object()`  
  Returns the [SimplePie_Cache](@/wiki/reference/simplepie_cache/_index.md) object that SimplePie is using. This is used by the other methods to return their data.
- `get_cache_filename()`  
  Returns the path and filename of the cache file for this feed.
- `get_cache_timestamp()`  
  Returns a UNIX timestamp for the time when the feed was cached.
- `get_cache_time_remaining()`  
  Returns the remaining time (in seconds) until the cache is considered stale, and SimplePie will re-check the feed for freshness. Optionally, you can pass `true` as the parameter, and it will return the remaining time in a `hh:mm:ss` format instead.

### Example Code {#example_code}

```php
<?php
require_once('simplepie.inc');
require_once('simplepie_cache_extras.inc');

// Instead of a new SimplePie(), we'll do a new SimplePie_Cache_Extras() since we extended the SimplePie class.
$feed = new SimplePie_Cache_Extras('http://digg.com/rss/index.xml');
$feed->handle_content_type();

// Let's display the filename of the cached feed.
echo 'Cached file name: ' . $feed->get_cache_filename() . '<br />';

// When was this cache file created?
echo 'File was cached at: ' . $feed->get_cache_timestamp() . ' (' . date('j F Y, g:i a', $feed->get_cache_timestamp()) . ')<br />';

// How long until the cache expires?
echo 'Time remaining until next cache check: ' . $feed->get_cache_time_remaining() . ' seconds (' . $feed->get_cache_time_remaining(true) . ' hh:mm:ss)<br />';

echo '<hr />';

foreach ($feed->get_items() as $item)
{
    echo '<a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a><br />';
}
?>
```

### Add-on Source Code (Modified - Sunday 6th June 2010 by Mark Bowen {#add-on_source_code_modified\_-_sunday_6th_june_2010_by_mark_bowen}

For anyone who can't get this to work I managed to get it to work by doing the following below. I commented out the main line in the get_cache_object() function and added in the line as shown below which I found in the main simplepie.inc file.

This worked right away and allowed all the cache functions to start working. Hopefully I've not done anything silly here though?

```php
<?php
class SimplePie_Cache_Extras extends SimplePie
{
    function get_cache_object()
    {
//        $cache =& new $this->cache_class($this->cache_location, call_user_func($this->cache_name_function, $this->feed_url), 'spc');
        $cache = call_user_func(array($this->cache_class, 'create'), $this->cache_location, call_user_func($this->cache_name_function, $this->feed_url), 'spc');
        return $cache;
    }

    function get_cache_filename()
    {
        $cache = $this->get_cache_object();
        return $cache->name;
    }

    function get_cache_timestamp()
    {
        $cache = $this->get_cache_object();
        return $cache->mtime();
    }

    function get_cache_time_remaining($format = false)
    {
        $cache = $this->get_cache_object();
        $remaining = ($cache->mtime() + $this->cache_duration) - time();

        if ($format)
        {
            return SimplePie_Misc::time_hms($remaining);
        }
        else
        {
            return $remaining;
        }
    }
}
?>
```

+++
title = "I'm getting memory leaks!"
+++

When processing a large number of feeds, a memory leak can occur causing <abbr title="Hypertext Preprocessor">PHP</abbr> to run out of memory. This is due to [PHP Bug \#33595](http://bugs.php.net/bug.php?id=33595) where <abbr title="Hypertext Preprocessor">PHP</abbr> doesn't release memory when making recursive (i.e. self-referential) object calls. The problem is due to recursive references within SimplePie (and <abbr title="Hypertext Preprocessor">PHP</abbr>'s poor handling of said references). This issue affects all versions of <abbr title="Hypertext Preprocessor">PHP</abbr> earlier than 5.3.

In SimplePie 1.1 and above, you simply need to call the destructor method before unsetting the `$feed` and `$item` variables:

```php
<?php
for ($i = 1; $i < 10; $i++)
{
    $feed = new SimplePie();
    $feed->set_feed_url($url);
    $feed->init();
    $feed->handle_content_type();
    $item = $feed->get_item(0);

    $feed->__destruct(); // Do what PHP should be doing on it's own.
    unset($item);
    unset($feed);

    echo "Memory usage: " . number_format(memory_get_usage());
}
?>
```

## Other Notes {#other_notes}

- SimplePie 1.2 has made many improvements in memory handling, so make sure you're running SimplePie 1.2 or newer to improve memory consumption.
- This <abbr title="Hypertext Preprocessor">PHP</abbr> bug has been fixed in <abbr title="Hypertext Preprocessor">PHP</abbr> 5.3. Upgrade if you can.
- Retrieving feeds from the cache uses less memory than pulling them down and parsing them in the first place.
- Pull fewer feeds all at once. This can be accomplished with a cron job and careful planning. Pull a smaller set of feeds first so that they can cache. Then pull another set. Then another. Let your pages pull directly from the cache, which uses less memory.
- If you have control over your php.ini file, allocate more system memory to <abbr title="Hypertext Preprocessor">PHP</abbr>. This will give you more buffer.
- Many shared hosting plans have limited memory available to <abbr title="Hypertext Preprocessor">PHP</abbr> per user anyway. You can't expect to parse 1000 feeds with 8 <abbr title="Megabyte">MB</abbr> of RAM allocated. Take this into account. Perhaps a VPS would be better, or perhaps a cloud computing service like [Amazon EC2](http://aws.amazon.com/ec2/) or [Rackspace Cloud Servers](http://www.rackspacecloud.com/cloud_hosting_products/servers).

## See Also {#see_also}

- <http://bugs.php.net/bug.php?id=33595>
- <http://groups.drupal.org/node/5066#comment-14927>

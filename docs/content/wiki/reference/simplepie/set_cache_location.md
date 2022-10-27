+++
title = "set_cache_location()"
+++

## Description {#description}

```php
class SimplePie {
    set_cache_location ( [string $location = './cache'] )
}
```

Set the file system location (not <abbr title="World Wide Web">WWW</abbr> location) where the cache files should be written.

## Availability {#availability}

- Available since SimplePie 1.0.
- Previously existed as cache_location() since SimplePie Preview Release.

## Parameters {#parameters}

### location {#location}

Set where the cache files should be stored.

## Examples {#examples}

### Change the cache location to http://domain.com/app/cache_files/ {#change_the_cache_location_to_httpdomaincomappcache_files}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/app/cache_files');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

### Set a database location {#set_a_database_location}

<div class="warning">

**Unsupported!** We've enabled MySQL caching in an [experimental branch](http://svn.simplepie.org/simplepie/branches/db_caching/) that will be integrated into a future SimplePie release. If you're using that experimental branch, you can enable database caching as follows:

</div>

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_cache_location('mysql://username:password@hostname:port/database');
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [How do I do database caching?](@/wiki/faq/how_do_i_do_database_caching.md)
- [I'm getting cache error messages](@/wiki/faq/i_m_getting_cache_error_messages.md)
- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [API Reference](@/wiki/reference/_index.md)
- [Upgrading from Beta 2, 3, 3.1, or 3.2](@/wiki/setup/upgrade.md)

</div>

+++
title = "Caching and You!"
+++

To maximise performance, SimplePie includes a caching system which can be used with a file-based cache, database cache or a Memcache-backed cache system.

## Built-in backends {#built-in_backends}

### File-based {#file-based}

File-based caching is the easiest way to set up caching for SimplePie. All you need is a server-writable directory (we usually call it `cache/`)!

For example, let's say your script is at `/var/www/script.php`. To use file-based caching, you first need to make a new directory at `/var/www/cache`. Make sure this directory can be written to by <abbr title="Hypertext Preprocessor">PHP</abbr>. If you're using `cache/`, there's nothing else to set up, as SimplePie defaults to this directory.

If you want to store your cache somewhere else, say `/var/www/somewhereelse`, you'll need to tell SimplePie to do that. Don't worry, it's super easy!

```php
$feed->set_cache_location('/var/www/somewhereelse');
```

<div class="warning">

If you use relative paths (i.e. they don't start with `/`, be aware that these are relative to where **your script** is, [not where SimplePie is](@/wiki/faq/i_m_getting_cache_error_messages.md).

</div>

### MySQL {#mysql}

SimplePie also supports using MySQL as a database store for the cache.

Before you get started, you'll need to create the correct schema for SimplePie. In your copy of SimplePie, find the file called `db.sql` and run the commands under the MySQL section on your database.

Once you've done that, setting up SimplePie is easy as pie!

```php
$feed->set_cache_location('mysql://username:password@hostname:port/database');
```

Replace those placeholders with your actual values, and you're good to go!

<div class="warning">

By default, the database tables are not prefixed. To set the prefix, add `?prefix=sp_` to your cache location (where `sp_` is your desired prefix).

</div>

### Memcache {#memcache}

As of SimplePie 1.3, Memcache databases are supported right out of the box.

To use Memcache for SimplePie's cache, simply set your cache location with a `memcache:` prefix:

```php
$feed->set_cache_location('memcache://hostname:port/?timeout=3600&prefix=sp_');
```

Replace the above placeholders as needed. The `timeout` value is how long you want the Memcache values to last for. We recommend setting this to the same as your value for `$feed→set_cache_duration()`, which defaults to 3600.

## Custom backend {#custom_backend}

SimplePie also makes it absurdly easy to write your own cache handler. To start, take a look at the Memcache handler (<a href="/api/SimplePie_Cache_Memcache" class="interwiki iw_api" title="http://simplepie.org/api/SimplePie_Cache_Memcache">''SimplePie_Cache_Memcache''</a>) as it's one of the easiest to understand.

In a nutshell, here's what you need to do:

### Implement the caching interface {#implement_the_caching_interface}

<a href="/api/SimplePie_Cache_Base" class="interwiki iw_api" title="http://simplepie.org/api/SimplePie_Cache_Base">This interface</a> is your gateway to writing your own caching system. Follow the hints in the PHPDoc comments to ensure that you implement these methods correctly.

### Pick a prefix {#pick_a_prefix}

Every caching system has options given by a <abbr title="Uniform Resource Locator">URL</abbr>-style location. Your cache handler needs to have a distinctive and unique (for your system) prefix, which looks like a <abbr title="Uniform Resource Locator">URL</abbr> scheme. For example, the Memcache handler uses `memcache`, which means Memcache locations always start with `memcache://`.

### Register your handler {#register_your_handler}

Next, you need to let SimplePie know about your handler. Simply call `SimplePie_Cache::register()` (pretending that we picked `example` as a prefix, and our handler class is `ExampleCacheHandler`)

```php
SimplePie_Cache::register('example', 'ExampleCacheHandler');
```

### Use it {#use_it}

Finally, tell SimplePie to use your cache handler. This is as easy as setting the cache location when you're using SimplePie.

```php
$feed->set_cache_location('example://myhost/example');
```

## See Also {#see_also}

- [How does SimplePie's caching system work?](@/wiki/faq/how_does_simplepie_s_caching_http_conditional_get_system_work.md)
- [I'm getting cache error messages](@/wiki/faq/i_m_getting_cache_error_messages.md)

+++
title = "How do I do database caching?"
+++

## Official Support {#official_support}

As of version 1.1, SimplePie only officially supports file system caching. However, we have integrated [support for MySQL caching into the trunk](http://svn.simplepie.org/simplepie/trunk/) which is available via Subversion, and will be included as a standard part of the 1.2 release.

If you simply want to cache to a database, the aforementioned development build is the way to go. By helping us work out the remaining bugs, we can get official database support integrated sooner. The important part to know is that the database location is set just like a normal <abbr title="Uniform Resource Locator">URL</abbr>:

```php
$feed->set_cache_location('mysql://username:password@hostname:port/database');
```

## Hacking Custom Support {#hacking_custom_support}

If you're going to hack in your own database support, I would wholeheartedly recommend extending and overloading the [SimplePie_Cache](@/wiki/reference/simplepie_cache/_index.md) class to do it. SimplePie calls on methods in SimplePie_Cache for saving, loading, and checking the freshness of cached data. By overloading this class, you can have SimplePie do all of the things it needs to do while using your custom class.

Check out the following links for tips on extending and overloading the SimplePie_Cache class:

- [set_cache_location()](@/wiki/reference/simplepie/set_cache_location.md)
- [set_cache_class()](@/wiki/reference/simplepie/set_cache_class.md)

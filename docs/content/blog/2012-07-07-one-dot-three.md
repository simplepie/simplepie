+++
title = "SimplePie 1.3 “Boysenberry” is now available!"
date = 2012-07-07T03:57:00Z

[extra]
author = "Ryan McCue"
+++

SimplePie 1.3 is [now available](/downloads/)! This release is our first to be PHP 5-only, and this brings with it a strengthened code base. A huge number of bugs have been fixed, along with plenty of new features. SimplePie 1.3 is almost completely backwards compatible with 1.2, so you have no excuse not to use it!

One of the biggest changes with this release is the dropping of legacy support for PHP 4. SimplePie 1.3 requires at least PHP 5.2.0 to run, and we recommend 5.3+ (as some versions of 5.2 are known to be buggy).

## API Changes

With a new version comes some changes to the API, with features being added and legacy items being removed.

One of the most important changes is that the `SimplePie` constructor no longer supports arguments. In the past, we’ve run in to a lot of issues with this feature, so we’ve decided to remove it. This may cause some breakages in your code, so watch out for this.

When using multifeeds with SimplePie, the `SimplePie::error()` method now returns an array (indexed by the number URL which failed). This should make working with invalid feeds easier.

If you’re using a custom caching system, it’s now much easier to use. Rather than overriding `SimplePie_Cache`, you can now [register your handler](/api/class-SimplePie_Cache.html#_register) and use the cache location option to pass options in. We’ve also bundled a Memcache-based cache handler with SimplePie (thanks to Matt Robenolt) to make it even easier to get SimplePie up and running.

This is just a summary of the changes we’ve made to SimplePie. To look at a full list of changes, head on over to [the wiki](/wiki/misc/release_notes/simplepie_1.3) or for the full change list, check out [GitHub’s comparison view](https://github.com/simplepie/simplepie/compare/1.2...1.3).

## Rearchitecture of the Codebase

For anyone who has worked with the SimplePie codebase in the past, you’ll know it was a huge pain due to the entire project being in one file. With 1.3, we’ve split SimplePie up into one-class-per-file, enabling easy autoloading of the classes you need without needing to load them all. This means easier developing for us, and faster loading for you. A huge thanks must go to Drak from the [Zikula project](http://zikula.org/) for the work on this.

If you’re one of the people who loved the monolithic file, don’t worry! We’ve baked a special compiled release which includes all the classes you need in a single file. If the compiled release is too big for you to handle, we’ve also baked a minified release which strips all the comments.

## API Documentation Changes

We’ve always prided ourselves on providing stellar documentation, and 1.3 is no different. Previously, an API reference was provided on the wiki, however this had occasionally fallen out of date, or not actually matched the code. With 1.3, we’re now generating this documentation directly from the PHPDoc comments in the code.

[Head on over to the API documentation](/api/) right now to see it! You can also use PHP-style URLs, so `http://simplepie.org/api/SimplePie_Item` will redirect you to the correct page.

## Looking Forward

SimplePie 1.4 will focus on slimming down by removing legacy support for several features.

In SimplePie 1.2, due to PHP 4 support class properties were declared with the `var` keyword, and access was restricted via the `@access` keyword. With 1.3 came the move to PHP 5 and strict properties, however for backwards compatibility, these properties were left as `var`. From 1.4 onwards, properties and methods with an `@access private` tag will have their visibility changed to `protected`. If you’re using any of these internal APIs, be aware that they will cease to be available. Proper methods are available for all pieces of data that you need to access, and we encourage you to move to those instead.

1.4 will also involve the splitting off of the HTTP handling. SimplePie will bundle [Requests](http://requests.ryanmccue.info/), however will have a clearly defined interface to implement your own HTTP handler.

We’ll also be attempting to increase our test coverage, with the aim to get up to at least 80% of the code covered by a test by 1.4.

With the release of 1.3 also begins our new release schedule. A new major version of SimplePie is planned to be released every 6 months, with 1.4 to be released in January 2013. This is a schedule we’ll be trying extremely hard to stick to, and we’d love to get your help in doing so. Pull requests on GitHub will always be welcomed with open arms, as are bug reports and feature requests.

---

Finally, I’d just like to personally thank all of you for using SimplePie. It’s a pleasure working on the project knowing that so many of you out there are using it. By far my favourite moment was when I accidentally pushed a piece of broken code up to GitHub, only to be alerted to it by a new issue on GitHub within minutes. You all make it worth every minute of my time.

So, thanks to everyone, and I’ll see you all here for a new release in 6 months!

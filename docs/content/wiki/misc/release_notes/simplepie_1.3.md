+++
title = "SimplePie 1.3 \"Boysenberry\""
+++

- 1.3 released on 7 July 2012

This version was our first release to drop support for <abbr title="Hypertext Preprocessor">PHP</abbr> 4. For this release, `simplepie.inc` was split into separate files, with one-class-per-file to enable autoloading. We've added a cache interface to make it much easier to implement your own cache backend.

## New Features {#new_features}

- [Commit 8aba553](https://github.com/simplepie/simplepie/commit/8aba553): Each class is now split into separate files. To autoload SimplePie, simply include or require `autoloader.php` in your project. You can also run `build/compile.php` to create a combined file much like `simplepie.inc`
- [Commit bbc83bd](https://github.com/simplepie/simplepie/commit/bbc83bd): We now use interfaces and abstract classes for caching classes. To add your own caching method, use `SimplePie_Cache::register()` and implement the `SimplePie_Cache_Base` interface.
- We [now support Memcache-based](https://github.com/simplepie/simplepie/pull/147) caching via `SimplePie_Cache_Memcache`. To use this, set your cache location to `memcache://localhost:11211/?timeout=3600&prefix=sp_` (for `localhost` on port 11211. All tables will be prefixed with `sp_` and data will expire after 3600 seconds).
- `SimplePie::error()` now returns an array if an error occurs while using multifeeds. The index of the array elements can be used to match up with the <abbr title="Uniform Resource Locator">URL</abbr> you passed in.
- `SimplePie_Item` now has `get_gmdate()` to get a date independent of your server's timezone.
- `SimplePie_Item` [now has a ''get_updated_date()'' method](https://github.com/simplepie/simplepie/pull/134) (there is also a corresponding `get_updated_gmdate()` method).
- `SimplePie_Item::get_description()` now has a new parameter: set `$description_only` (the first parameter) to true to avoid falling back to the content.
- Class overrides are now managed by a central registry. The old `set_*_class()` methods are still available, however new code is encouraged to use `$feed->get_registry()->register()` (see <a href="/api/SimplePie_Registry#_register" class="interwiki iw_api" title="http://simplepie.org/api/SimplePie_Registry#_register">''SimplePie_Registry::register()''</a> for details)

## Changes in this Release {#changes_in_this_release}

- The ability to pass parameters into the `SimplePie` constructor has been removed. Use the `SimplePie::set_feed_url()` method instead.
- The `SimplePie::get_favicon()` and `SimplePie::set_favicon_handler()` methods have been removed.
- `SimplePie::subscribe_*()` methods have also been removed (with the exception of `SimplePie::subscribe_url()`).
- [Commit d025026](https://github.com/simplepie/simplepie/commit/d025026): `SimplePie::enable_xml_dump()` has been removed and replaced with `SimplePie::get_raw_data()`. This new method is always available, and you can now continue to use SimplePie as normal.
- [Bug \#37](https://github.com/simplepie/simplepie/issues/37): We now use `DOMDocument` internally to parse <abbr title="HyperText Markup Language">HTML</abbr> documents for autodiscovery. This may mean that sites which previously failed autodiscovery will work.
- We now use PHPUnit-style tests for all the new tests. Old-style tests have not been converted fully, but are still run via PHPUnit. All testing is now also automatically run by [Travis CI](http://travis-ci.org/#!/simplepie/simplepie) on push, on the latest versions of <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2, 5.3 and 5.4.

## Fixes in this Release {#fixes_in_this_release}

See [commit log](https://github.com/simplepie/simplepie/compare/1.2...1.3) and [issues closed](https://github.com/simplepie/simplepie/issues?milestone=5&state=closed) for the full list.

- [Bug \#1](https://github.com/simplepie/simplepie/issues/1): Only Final Content-Type Should Be Used
- [Bug \#5](https://github.com/simplepie/simplepie/issues/5): Use strict-comparison where possible
- [Bug \#11](https://github.com/simplepie/simplepie/issues/11): Support Content-Encoding: chunked
- [Bug \#14](https://github.com/simplepie/simplepie/issues/14): can't override sort_items in multifeed + merge_items can't be overridden
- [Bug \#20](https://github.com/simplepie/simplepie/issues/20): Send Accept header
- [Bug \#26](https://github.com/simplepie/simplepie/issues/26): Quotes are removed from ETag headers
- [Bug \#31](https://github.com/simplepie/simplepie/issues/31): Warning: error_log() has been disabled for security reasons
- [Bug \#32](https://github.com/simplepie/simplepie/issues/32): Array element test needed
- [Bug \#33](https://github.com/simplepie/simplepie/issues/33): Latitude and longitude are not parsed if excess whitespace exists in the element data
- [Bug \#34](https://github.com/simplepie/simplepie/issues/34): <abbr title="Extensible Markup Language">XML</abbr> declaration parsing bug
- [Bug \#36](https://github.com/simplepie/simplepie/issues/36): SimplePie_Sanitize::sanitize does not strip attributes correctly.
- [Bug \#48](https://github.com/simplepie/simplepie/issues/48): Fails Strict Standards - Multiple Errors
- [Bug \#60](https://github.com/simplepie/simplepie/issues/60): Fatal error: Call to undefined method SimplePie_File::SimplePie_File()
- [Bug \#62](https://github.com/simplepie/simplepie/issues/62): Option to force summary only in get_description()
- [Bug \#75](https://github.com/simplepie/simplepie/issues/75): patches for a couple of problems
- [Bug \#78](https://github.com/simplepie/simplepie/issues/78): set_cache_location - MySQL Cache string broken (url encode/decode)
- [Bug \#81](https://github.com/simplepie/simplepie/issues/81): \[BUG\] SimplePie\_<abbr title="Uniform Resource Identifier">URI</abbr>
- [Bug \#92](https://github.com/simplepie/simplepie/issues/92): Non-static method should not be called statically errors
- [Bug \#129](https://github.com/simplepie/simplepie/issues/129): javascript output trigger is flawed and can break page views
- [Bug \#141](https://github.com/simplepie/simplepie/issues/141): <abbr title="Rich Site Summary">RSS</abbr> 1.0 miss some unique identifier
- [Bug \#145](https://github.com/simplepie/simplepie/issues/145): rowCount is a method of PDO, not property
- [Bug \#152](https://github.com/simplepie/simplepie/issues/152): <abbr title="Hypertext Preprocessor">PHP</abbr> Parse error
- [Bug \#156](https://github.com/simplepie/simplepie/issues/156): SimplePie::merge_items should be a static method
- [Bug \#169](https://github.com/simplepie/simplepie/pull/169): Fix Strict errors shown by removing deprecated is_a()
- [Bug \#170](https://github.com/simplepie/simplepie/issues/170): Links to wrong version of BSD license
- [Bug \#175](https://github.com/simplepie/simplepie/issues/175): ATOM “updated”
- [Bug \#183](https://github.com/simplepie/simplepie/pull/183): Updated deflator, fixes “data error” (improved)
- [Bug \#195](https://github.com/simplepie/simplepie/issues/195): Testsuite broken

## Fixes in SimplePie 1.3.1 {#fixes_in_simplepie_131}

- [Bug \#214](https://github.com/simplepie/simplepie/issues/214): Call to a member function get_uri() on a non-object in simplepie/library/SimplePie/Misc.php on line 83
- [Bug \#219](https://github.com/simplepie/simplepie/issues/219): Well, it happened
- [Bug \#241](https://github.com/simplepie/simplepie/issues/241): DOMDocument can be disabled
- [Bug \#243](https://github.com/simplepie/simplepie/pull/243): Fix backwards compatibility with cache subclasses

## Known Issues {#known_issues}

- All known issues are tracked in our [Bug Tracker](https://github.com/simplepie/simplepie/issues?milestone=9&state=open).

## Announcement {#announcement}

- [http://simplepie.org/blog/2012/07/07/one-dot-three/](/blog/2012/07/07/one-dot-three/ "http://simplepie.org/blog/2012/07/07/one-dot-three/")

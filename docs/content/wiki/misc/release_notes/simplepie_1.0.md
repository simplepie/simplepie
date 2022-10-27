+++
title = "SimplePie 1.0 \"Razzleberry\""
+++

- RC1 released on 23 June 2007.
- RC2 released on 1 July 2007.
- RC3 released on 10 July 2007.
- Final released on 15 July 2007.
- 1.0.1 released on 23 July 2007.

## New Features {#new_features}

- New BSD Licensing. This license lets you pretty much do whatever you want, as long as you give us appropriate credit and leave all notices in-place. (RC1)
- Added the following constants: `SIMPLEPIE_BUILD`, `SIMPLEPIE_LINKBACK`, `SIMPLEPIE_NAME`, `SIMPLEPIE_URL`, `SIMPLEPIE_USERAGENT`, and `SIMPLEPIE_VERSION`. (RC1)
- Added `set_favicon_handler()` to enable the caching and displaying of favicons via `get_favicon()`. (RC1)
- Added `set_image_handler()` to enable the caching and displaying of images in a way that is much safer than the old `bypass_image_hotlink()` functionality. (RC1)
- `set_javascript()` enables you to change the JavaScript query string used in `embed()`. (RC1)
- Added `strip_comments()` to remove <abbr title="HyperText Markup Language">HTML</abbr>/<abbr title="Extensible Markup Language">XML</abbr> comments from feeds as they're being read. (RC1)
- Added `set_stupidly_fast()` which disables most of SimplePie's data sanitization, putting it roughly on par with [MagpieRSS](http://magpierss.sf.net)'s data sanitization (and therefore speed!). (RC1)
- Added `get_local_date()` that is capable of displaying a locale-specific time/datestamp. (RC1)
- Added support for [W3C WGS84 Basic Geo](http://www.w3.org/2003/01/geo/) and [GeoRSS](http://www.georss.org/georss). (RC1)
- Added support for accessing _ANY_ element or attribute in the feed via `get_channel_tags()`, `get_feed_tags()`, `get_image_tags()` and `get_item_tags()`. (RC1)
- Added the `SimplePie_Category` class which adds new methods to `get_category()` and `get_categories()`. (RC1)
- Added support for Flash Video enclosures, and began including the [JW Media Player](http://www.jeroenwijering.com/?item=JW_Media_Player) (formerly _Flash Media Player_). (RC1)
- Multifeeds support has been integrated directly into the core of SimplePie! (RC1)
- Faster-loading Flash-based <abbr title="Motion Picture Experts Group Layer 3">MP3</abbr> playback. Falls back to QuickTime. (RC1)
- Better compliance and support for feed auto-discovery. (RC1)
- More accurate support for <abbr title="Extensible Markup Language">XML</abbr> mime types (RFC 3023). (RC1)
- Full support of the date/time parts of <abbr title="International Organization for Standardization">ISO</abbr>-8601. (RC1)
- Added support for the “Content-Language” <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> header (RC1)
- Added the ability to get an item's parent feed via `get_feed()`. (RC1)
- Improved Base64 support. (RC1)
- Complete support for [Media RSS](http://search.yahoo.com/mrss) (RC1)
- Partial support for [iTunes RSS](http://www.apple.com/itunes/store/podcaststechspecs.html). We support everything that is relevant to feed management, but there are other things that are simply iTunes specific, and can't be normalized with anything. (RC1)
- New “widescreen” (16:9) preference for video podcast sizing. Defaults to 480×270. (RC1)
- Added `subscribe_itunes()`, which allows for automatic subscribing to podcasts in iTunes. (RC1)
- Support for as far back as <abbr title="Hypertext Preprocessor">PHP</abbr> 4.1!
- Improved support for detecting if content is <abbr title="HyperText Markup Language">HTML</abbr> or plain text. (RC2)
- More liberal <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> header parser. Likely to now work in all circumstances rather than just most. (RC2)
- Added support for non-standard, relative <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> “Location” headers (1.0.1)

## Changes in this Release {#changes_in_this_release}

- SimplePie's core has been re-written completely from scratch. (RC1)
- Changed the method names of several configuration options to match the verb-based names of many of the methods beginning with `get_`. (RC1)
- Removed the `bypass_image_hotlink()`, and replaced it with the much safer and more efficient image caching functionality. (RC1)
- `set_cache_duration()` (formerly `cache_max_minutes()`) now processes in seconds instead of minutes. (RC1)
- The amount of autodiscovery that SimplePie does can be configured using `set_autodiscovery_level()`. (RC1)
- The number of URLs that SimplePie looks at during the autodiscovery process can be configured using `set_max_checked_feeds()`. (RC1)
- Removed `feed_` from the feed-level methods, so that `get_feed_title()` becomes `get_title()`. (RC1)
- `get_description()` now prefers summaries, while the new `get_content()` prefers full content. (RC1)
- Improved the efficiency of the [IDN](http://en.wikipedia.org/wiki/Internationalized_domain_name) code. (RC1)
- Increased the default size of 4:3 video podcasts to 480×360. (RC1)
- Improved `xml:base` and <abbr title="Extensible HyperText Markup Language">XHTML</abbr> support. (RC1)
- Improved <abbr title="Hyper Text Transfer Protocol">HTTP</abbr>/1.1 Status Code support (eg. when we have a bogus status code) (RC1)
- Removed `subscribe_pluck()`, as Pluck ended all <abbr title="Rich Site Summary">RSS</abbr> services in January 2007. (RC1)
- Removed `subscribe_feedlounge()` as they also have ended services. (RC1)
- Removed `add_to_smarking()` as they have also ended services. (RC1)
- Multiple improvements to `parse_date()`. (RC1)
- Improved support for <abbr title="Hyper Text Transfer Protocol">HTTP</abbr>/1.1 status codes. (RC1)
- Removed the `strip_ads()` functionality, as it really isn't appropriate for Core. (RC1)
- Significantly improved unit tests. Over 99% compliant on the things we're testing. (RC1)
- `get_id()` now always returns a value even if one wasn't in the feed. (RC1)
- Removed the `alternate` parameter for `get_favicon()`. Now, if a favicon isn't found in the default location, we return false. Speeds things up a bit. (RC2)
- Everything that used to be `sha1` hashed is now `md5` hashed by default for <abbr title="Hypertext Preprocessor">PHP</abbr> 4.2 compliance. Users can opt to use `sha1` instead if they prefer. (RC2)

## Fixes in this Release {#fixes_in_this_release}

- [Bug 270](/support/viewtopic.php?id=270 "http://simplepie.org/support/viewtopic.php?id=270") - Missing CDATA opener (RC1)
- [Bug 403](/support/viewtopic.php?id=403 "http://simplepie.org/support/viewtopic.php?id=403") - PHP4 chokes on invalid characters, while PHP5 passes them. (RC1)
- [Bug 431](/support/viewtopic.php?id=431 "http://simplepie.org/support/viewtopic.php?id=431") - Feed image title in every item is confusing get_title(). (RC1)
- [Bug 483](/support/viewtopic.php?id=483 "http://simplepie.org/support/viewtopic.php?id=483") - Hanging on 404 page. <abbr title="Rich Site Summary">RSS</abbr> Locator getting invoked? (RC1)
- [Bug 501](/support/viewtopic.php?id=501 "http://simplepie.org/support/viewtopic.php?id=501") - MSN Spaces Live feeds are really slow. Horrid <abbr title="HyperText Markup Language">HTML</abbr>. Tag stripping engine? (RC1)
- [Bug 542](/support/viewtopic.php?id=542 "http://simplepie.org/support/viewtopic.php?id=542") - When feed retrieval times out, SP should use the previously cached version instead. (RC1)
- [Bug 567](/support/viewtopic.php?id=567 "http://simplepie.org/support/viewtopic.php?id=567") - Fatal error in <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2 (RC1)
- [Bug 587](/support/viewtopic.php?id=587 "http://simplepie.org/support/viewtopic.php?id=587") - Regression. SP Hangs. (RC1)
- [Bug/Patch 853](/support/viewtopic.php?id=853 "http://simplepie.org/support/viewtopic.php?id=853") - fsockopen code problems. (RC1)
- [Bug 859](/support/viewtopic.php?id=859 "http://simplepie.org/support/viewtopic.php?id=859") - Regression on content encoding? (RC1)
- Fixed \<base\> for autodiscovery (RC1)
- Fixed a minor glitch with embedding <abbr title="Motion Picture Experts Group Layer 3">MP3</abbr> files via Flash Media Player (RC2)
- Improved date handling across the board (RC3)
- Fixed a number of cURL-specific issues (RC3)
- Fixed some caching issues for Windows (RC3)
- Fixed bug introduced with RC3 where favicon URLs were being incorrectly handled when favicon cache file exists but no favicon handler is set (Final)
- Fixed issues when the <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> “Location” header is (incorrectly) a relative <abbr title="Uniform Resource Identifier">URI</abbr> instead of an absolute <abbr title="Uniform Resource Identifier">URI</abbr> (Final)
- Fixed issues with get_id() generating inconsistent hash values from refresh to refresh (Final)
- Fixed some issues where Media <abbr title="Rich Site Summary">RSS</abbr> support was broken in some circumstances (1.0.1)
- Fixed the parsing of local feeds (1.0.1)
- Literally _hundreds of other bugs_ that we failed to document…

## Announcement {#announcement}

- [http://simplepie.org/blog/2007/06/23/simplepie-10-release-candidate-is-here/](/blog/2007/06/23/simplepie-10-release-candidate-is-here/ "http://simplepie.org/blog/2007/06/23/simplepie-10-release-candidate-is-here/")
- [http://simplepie.org/blog/2007/07/01/simplepie-10-release-candidate-2/](/blog/2007/07/01/simplepie-10-release-candidate-2/ "http://simplepie.org/blog/2007/07/01/simplepie-10-release-candidate-2/")
- [http://simplepie.org/blog/2007/07/10/simplepie-10-release-candidate-3/](/blog/2007/07/10/simplepie-10-release-candidate-3/ "http://simplepie.org/blog/2007/07/10/simplepie-10-release-candidate-3/")
- [http://simplepie.org/blog/2007/07/15/simplepie-10-is-here/](/blog/2007/07/15/simplepie-10-is-here/ "http://simplepie.org/blog/2007/07/15/simplepie-10-is-here/")

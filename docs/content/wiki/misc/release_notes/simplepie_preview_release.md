+++
title = "SimplePie Preview Release"
+++

Released on 10 January 2006. Was known as 0.97 during development.

## New Features {#new_features}

- Added support for Atom 1.0.
- Added support for [cURL](http://php.net/curl) for webhosts which have `allow_url_fopen` disabled.
- Added a timeout for remote feeds, so that slow servers don't hold up the page load for too long…
- Added support for <abbr title="Hypertext Preprocessor">PHP</abbr> 5.x.
- Added support for one-click subscribing to several online aggregators.
- Added support for one-click adding to [del.icio.us](http://del.icio.us) and [Newsvine](http://newsvine.com).
- Added support for one-click searching for linkbacks on Technorati.

## Changes in this Release {#changes_in_this_release}

- The User-Agent has changed: `SimplePie/1.0PR (Feed Parser; http://www.simplepie.org) Build/20060108`
- Re-wrote the <abbr title="Extensible Markup Language">XML</abbr> parsing core. No longer relies on [XMLize](http://hansanderson.com/php/xml/). This significantly helps with feed processing.
- Revamped the caching system to use serialized caching.
- SimplePie is now object-oriented. This will make it easier to implement, and have fewer conflicts with other software.

## Fixes in this Release {#fixes_in_this_release}

- Line breaks in `<pre>` tags are respected.
- You can leave opened tags open in “example”-type tags like `<code>` and `<pre>`.
- Caching can be disabled.
- Resolved an issue with feeds being cached for any amount of time other than 60 minutes.
- Resolved an issue where <abbr title="Hypertext Preprocessor">PHP</abbr> could potentially go into an infinite loop if the cache file either can't be opened or is empty.

## Announcement {#announcement}

- [http://simplepie.org/blog/2006/01/10/version-10-preview-release-bugfix-1/](/blog/2006/01/10/version-10-preview-release-bugfix-1/ "http://simplepie.org/blog/2006/01/10/version-10-preview-release-bugfix-1/")

+++
title = "SimplePie Beta 3 \"Lemon Meringue\""
+++

Released on 1 November 2006. Beta 3.1 released on 14 November 2006. Beta 3.2 released on 24 November 2006.

## New Features {#new_features}

- Support for Internationalized Domain Names (IDN)
- Vastly improved character set detection (<abbr title="Hyper Text Transfer Protocol">HTTP</abbr> Headers, Unicode BOM, Prologue, default to UTF-8)
- Support for `outlookfeed:` for Outlook 2007
- Support for <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> Conditional Get
- Support for GZIP-encoded feeds
- Override the input encoding
- Allow custom output encoding
- Expose all data that we use for items and feeds. These should be accessible directly as `$item→data['summary']`, etc.
- Implemented get_favicon()
- One-click Bookmarks: Wists, Simpy, Blogmarks, Smarking, Segnalo
- One-click subscriptions: Feedlounge, Feedster, Feedfeeds, Gritwire, Eskobo
- Strip attributes: `bgsound`, `expr`, `onfinish`, `onerror`
- `$feed→errors` also catches errors about lots of other things.
- When embedding A/V podcasts, if the content type doesn't exist in our list of supported mime-types, check the file extension and make an educated guess before giving up.
- Atom 1.0 Categories
- [native_embed()](@/wiki/reference/simplepie_enclosure/native_embed.md) which uses the (invalid) embed-only method of embedding multimedia content, which bypasses issues with the object tag in <abbr title="Internet Explorer">IE</abbr>.

## Changes in this Release {#changes_in_this_release}

- Cached filenames as SHA1 hashes.
- Change `fix_protocol()` to replace any scheme which is not http or https with http (of course keeping current checks to allow local URLs)
- `bypass_image_hotlink()` is disabled by default due to security and compatibility issues.
- Rewrote external JavaScript code for embedded podcasts using the more efficient [heredoc](http://php.net/heredoc) syntax
- To fetch remote files, we now try [cURL](http://php.net/curl), then [fsockopen()](http://php.net/fsockopen).

## Fixes in this Release {#fixes_in_this_release}

- Fixed a bug where if an item had a tag with a value, and there was a sub-element containing the same tag with a different value, the second tag would replace the value of the first (Beta 3.2)
- Fixed an issue where <abbr title="Hypertext Preprocessor">PHP</abbr> 4's expat <abbr title="Extensible Markup Language">XML</abbr> parser would hang on invalid characters even if <abbr title="Hypertext Preprocessor">PHP</abbr> 5's parser would pass those same characters (Beta 3.2)
- Fixed some issues with handling gzipped feeds (Beta 3.1)
- Feeds where the items either don't have a datestamp or the datestamp is not understood now sort by newest to oldest.
- Problems with self-closing author tag
- Unable to modify `ini_set` for user agent string
- Various issues with relative links
- Problems with <a href="@/wiki/reference/simplepie/get_version.md" class="wikilink2">get_version</a>
- Rewritten image URLs for bypassing image hotlink blocks
- <abbr title="Rich Site Summary">RSS</abbr> 0.9 namespace
- Invalid dates should return false
- <abbr title="Scalable Vector Graphics">SVG</abbr> issues
- Issues with `strip_ads()`
- Superfluous spaces in prologue
- _TRANSLIT patch \* Multiple link tags in Atom feed. \* strtotime() RFC822 inconsistency. \* Various issues with tbray.org \* Base64 encoding in Atom 1.0 (patch by Peter Janes) \* Fix some of the quirks in the [embed()](@/wiki/reference/simplepie_enclosure/embed.md) function \* Improved support for more specific ISO8601 datestamps (tested with Blogger Beta feeds). \* Lots and lots and lots of Beta 3-specific, pre-release bugs. :) ===== Known Issues ===== \* Bug 270 - Under certain circumstances, SimplePie may throw an error when encountering an unclosed CDATA block inside a feed. \* <s>Bug 403 - Occassionally, PHP4's <abbr title="Extensible Markup Language">XML</abbr> parser will choke on characters that are not part of the current character set, while PHP5's <abbr title="Extensible Markup Language">XML</abbr> parser will pass them as question marks.</s> **Fixed in Beta 3.2** \* <s>Bug 431 - If a title tag is embedded inside another title tag, or if there are multiple title tags inside of a feed item, SimplePie will use the latter of the two.</s> **Fixed in Beta 3.2** \* Bug 454 - SimplePie does not properly handle custom DOCTYPEs in <abbr title="Resource Description Framework">RDF</abbr>/<abbr title="Rich Site Summary">RSS</abbr> 1.0 feeds. \* Bug 483 - It is possible for SimplePie to hang on 404 pages if the <abbr title="Rich Site Summary">RSS</abbr> Locator gets invoked and has to go through lots of links. \* <s>Bug 494 - Errors while decoding gzipped feeds with fsockopen().</s> **Fixed in Beta 3.1** \* <s>Bug 503 - Errors while decoding gzipped feeds with cURL.</s> **Fixed in Beta 3.1** \* Bug 528 - Over-zealous attribute stripping when post contains example (X)<abbr title="HyperText Markup Language">HTML</abbr>. \* Bug 542 - When feed retrieval times out, SP should use the previously cached version instead. \* Bug 567 - Fatal error in <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2 ===== Announcement ===== \* [http://simplepie.org/blog/2006/11/01/simplepie-beta-3-is-now-available/](/blog/2006/11/01/simplepie-beta-3-is-now-available/ "http://simplepie.org/blog/2006/11/01/simplepie-beta-3-is-now-available/")_

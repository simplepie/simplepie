+++
title = "SimplePie 1.1 \"Blackberry\""
+++

- 1.1 released on 2 January 2008.
- 1.1.1 released on 15 March 2008.
- 1.1.2 released on 16 November 2008.
- 1.1.3 released on 20 December 2008.

This version is primarily made up of enhancements and minor bug fixes that didn't make the 1.0 release schedule. This is what 1.0 was intended to be. We also sat on this release for an additional 4 months to try to catch as many bugs as possible before releasing.

## New Features {#new_features}

- Support for feed-level authors.
- Support for item-level authors inheriting from the feed-level.
- Support for item-level copyright.
- Support for feed- and item-level contributors.
- Support for the `atom:source` element.
- Support for limiting the number of items returned per feed with Multifeeds.
- Support for [HTML 5 Content-Type Sniffing](http://www.whatwg.org/specs/web-apps/current-work/#content-type-sniffing).

## Changes in this Release {#changes_in_this_release}

- Improved <abbr title="Extensible Markup Language">XML</abbr> declaration parsing.
- Improved character set detection.
- Improved date handling, including supporting dates in a variety of western european languages (i.e. English, Dutch, French, German, Italian, Spanish, Finnish, Hungarian, and Greek).
- Improved <abbr title="HyperText Markup Language">HTML</abbr> entity handling.
- Caching system has become more modular, paving the way for more caching options in the future.
- [Bug \#49](http://bugs.simplepie.org/issues/show/49): text/plain should not be an allowed <abbr title="Multipurpose Internet Mail Extension">MIME</abbr> type. (1.1.2)
- [Bug \#64](http://bugs.simplepie.org/issues/show/64): Support flv-application/octet-stream as a valid Flash Video mime type. (1.1.2)
- [Bug \#102](http://bugs.simplepie.org/issues/show/102): Support the “text/rdf” content-type. (1.1.2)

## Fixes in this Release {#fixes_in_this_release}

- A number of bugs related to feed detection and date parsing.
- Bugs revolving around some non-typical uses of Media <abbr title="Rich Site Summary">RSS</abbr> and iTunes <abbr title="Rich Site Summary">RSS</abbr>.
- [PHP memory leak](@/wiki/faq/i_m_getting_memory_leaks.md) caused by <abbr title="Hypertext Preprocessor">PHP</abbr> objects with recursive references.
- [Bug \#2](http://bugs.simplepie.org/issues/show/2): Blank enclosures. (1.1.1)
- [Bug \#5](http://bugs.simplepie.org/issues/show/5): Feeds can't be found. (1.1.1)
- [Bug \#20](http://bugs.simplepie.org/issues/show/20): SimplePie::set_raw_data() fails with UTF-16LE data. (1.1.1)
- [Bug \#30](http://bugs.simplepie.org/issues/show/30): add_to_digg() needs an update. (1.1.1)
- [Bug \#26](http://bugs.simplepie.org/issues/show/26): GB2312 must be treated as GB18030. (1.1.2)
- [Bug \#58](http://bugs.simplepie.org/issues/show/58): Compressed fsockopen data stream not decoding. (1.1.2)
- [Bug \#75](http://bugs.simplepie.org/issues/show/75): Work-around bug in libxml 2.7.0/2.7.1 of parsing of predefined entities. (1.1.2)
- [Bug \#109](http://bugs.simplepie.org/issues/show/109): Extend libxml workaround to other versions. (1.1.3)
- [Bug \#110](http://bugs.simplepie.org/issues/show/110): Wrong decoding of gzip compressed data when using fsockopen. (1.1.3)

## Known Issues {#known_issues}

- All known issues are tracked in our [Bug Tracker](http://bugs.simplepie.org/projects/sp1/issues?query_id=1).

## Announcement {#announcement}

- [http://simplepie.org/blog/2008/01/02/simplepie-11-is-now-available/](/blog/2008/01/02/simplepie-11-is-now-available/ "http://simplepie.org/blog/2008/01/02/simplepie-11-is-now-available/")
- [http://simplepie.org/blog/2008/03/15/simplepie-111-is-now-available/](/blog/2008/03/15/simplepie-111-is-now-available/ "http://simplepie.org/blog/2008/03/15/simplepie-111-is-now-available/")
- [http://simplepie.org/blog/2008/11/16/simplepie-112-is-now-available/](/blog/2008/11/16/simplepie-112-is-now-available/ "http://simplepie.org/blog/2008/11/16/simplepie-112-is-now-available/")
- [http://simplepie.org/blog/2008/12/20/simplepie-113-is-now-available/](/blog/2008/12/20/simplepie-113-is-now-available/ "http://simplepie.org/blog/2008/12/20/simplepie-113-is-now-available/")

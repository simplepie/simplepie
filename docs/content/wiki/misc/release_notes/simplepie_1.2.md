+++
title = "SimplePie 1.2 \"Pecan\""
+++

- 1.2 released on 11 July 2009
- 1.2.1 released on 15 October 2011

This version was originally intended to finish 1.x development, adding in the remaining features that were intended after 1.0 (1.1 having mainly been taken up with bug fixes and other comparatively small features which could be done fairly quickly after 1.0). As it turned out, 1.1 was good enough for most, and 1.2 development stagnated, leaving it with a lot less new features than originally intended. Eventually it was decided the best course of action was simply to ship 1.2, as what code there was was well-tested, and move almost all development to SimplePie 2.

## New Features {#new_features}

- [Bug \#7](http://bugs.simplepie.org/issues/show/7): SimplePie_Locator should be able to return all available feeds.
- [Bug \#18](http://bugs.simplepie.org/issues/show/18): MySQL caching.
- [Bug \#125](http://bugs.simplepie.org/issues/show/125): Parse <abbr title="Rich Site Summary">RSS</abbr> 2.0 category 'domain' attribute.

## Changes in this Release {#changes_in_this_release}

- [Bug \#25](http://bugs.simplepie.org/issues/show/25): <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> status code is now checked, and we fail on <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> errors.
- [Bug \#43](http://bugs.simplepie.org/issues/show/43): Pay attention to error_reporting settings in SimplePie_Misc::error().
- [Bug \#83](http://bugs.simplepie.org/issues/show/83): Test suite now runs on <abbr title="Hypertext Preprocessor">PHP</abbr> 5.3.0.
- [Bug \#88](http://bugs.simplepie.org/issues/show/88): Always treat \<description\> in <abbr title="Rich Site Summary">RSS</abbr> 2.0 as <abbr title="HyperText Markup Language">HTML</abbr>.
- [Bug \#120](http://bugs.simplepie.org/issues/show/120): Remove previous libxml2/<abbr title="Hypertext Preprocessor">PHP</abbr> bug workaround, as it broke test cases, and use XMLReader instead.
- [Bug \#135](http://bugs.simplepie.org/issues/show/135): Allow SimplePie to work with zend.ze1_compatibility_mode=On.

## Fixes in this Release {#fixes_in_this_release}

- [Bug \#22](http://bugs.simplepie.org/issues/show/22): Numeric entity causes issues when at end of string.
- [Bug \#24](http://bugs.simplepie.org/issues/show/24): Subscribe methods break on non-US-<abbr title="American Standard Code for Information Interchange">ASCII</abbr> supersets.
- [Bug \#100](http://bugs.simplepie.org/issues/show/100): Passwords lowercased when normalizing URLs.
- [Bug \#115](http://bugs.simplepie.org/issues/show/115): Fatal error caused by call to a member function get_error_string() on a non-object.
- [Bug \#116](http://bugs.simplepie.org/issues/show/116): Incorrect encoding used on certain feeds.
- [Bug \#122](http://bugs.simplepie.org/issues/show/122): gzinflate() error on valid Content-Encoding: gzip response.
- [Bug \#124](http://bugs.simplepie.org/issues/show/124): SimplePie_Misc::normalize_url() causes <abbr title="Hypertext Preprocessor">PHP</abbr> to crash on preg_replace_callback().

## Fixes in SimplePie 1.2.1 {#fixes_in_simplepie_121}

See [commit log](https://github.com/simplepie/simplepie/compare/1.2...1.2.1) and [issues closed](https://github.com/simplepie/simplepie/issues?milestone=4&state=closed).

- [Issue \#112](https://github.com/simplepie/simplepie/issues/112): SimplePie_IRI::set_query() improperly decodes URLs passed in query string values. (See also [issue \#108](https://github.com/simplepie/simplepie/issues/108) and [issue \#58](https://github.com/simplepie/simplepie/issues/58))
- [Issue \#51](https://github.com/simplepie/simplepie/issues/51): change_encoding function has wrong case in string comparison
- [Issue \#23](https://github.com/simplepie/simplepie/issues/23): SimplePie does not find description tags in <abbr title="Rich Site Summary">RSS</abbr> 0.90 feeds
- [Issue \#28](https://github.com/simplepie/simplepie/issues/28): get_date() can returns false on failure, get_local_date() doesn't cope with this
- [Issue \#38](https://github.com/simplepie/simplepie/issues/38): Wrong encoding returned for EUC-JP.
- [Issue \#117](https://github.com/simplepie/simplepie/issues/117): Don't leak fsockopen's special HTTPS host in request headers.
- [Issue \#149](https://github.com/simplepie/simplepie/issues/149): SimplePie_gzdecode Code Typo

## Known Issues {#known_issues}

- All known issues are tracked in our [Bug Tracker](http://bugs.simplepie.org/projects/sp1/issues?query_id=2).

## Announcement {#announcement}

- [http://simplepie.org/blog/2009/07/11/simplepie-1-2-now-available/](/blog/2009/07/11/simplepie-1-2-now-available/ "http://simplepie.org/blog/2009/07/11/simplepie-1-2-now-available/")

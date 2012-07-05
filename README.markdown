SimplePie
=========

SimplePie is a very fast and easy-to-use class, written in PHP, that puts the
'simple' back into 'really simple syndication'.  Flexible enough to suit
beginners and veterans alike, SimplePie is focused on [speed, ease of use,
compatibility and standards compliance][what_is].

[what_is]: http://simplepie.org/wiki/faq/what_is_simplepie


Authors and contributors
------------------------
### Current
* [Ryan McCue][] (Maintainer, support)

### Alumni
* [Ryan Parman][] (Creator, developer, evangelism, support)
* [Geoffrey Sneddon][] (Lead developer)
* [Michael Shipley][] (Submitter of patches, support)
* [Steve Minutillo][] (Submitter of patches)

[Ryan McCue]: http://ryanmccue.info
[Ryan Parman]: http://ryanparman.com
[Geoffrey Sneddon]: http://gsnedders.com
[Michael Shipley]: http://michaelpshipley.com
[Steve Minutillo]: http://minutillo.com/steve/


### Contributors
For a complete list of contributors:

1. Pull down the latest SimplePie code
2. In the `simplepie` directory, run `git shortlog -ns`


Requirements
------------
* PHP 5.2.0 or newer
* libxml2 (certain 2.7.x releases are too buggy for words, and will crash)
* Either the iconv or mbstring extension
* cURL or fsockopen()
* PCRE support

If you're looking for PHP 4.x support, pull the "one-dot-two" branch, as that's
the last version to support PHP 4.x.


License
-------
[New BSD license](http://www.opensource.org/licenses/BSD-3-Clause)


Project status
--------------
SimplePie is currently maintained by Ryan McCue.

SimplePie is currently in "low-power mode." If the community decides that
SimplePie is a valuable tool, then the community will come together to maintain
it into the future.

If you're interested in getting involved with SimplePie, please get in touch
with Ryan McCue.


Roadmap
-------
SimplePie 1.3 should be a thoughtful reduction of features. Remove some bloat,
slim it down, and break it into smaller, more manageable chunks.

Removing PHP 4.x support will certainly help with the slimming. It will also
help avoid certain issues that frequently crop up with PHP 4.x. The PHP5-only
migration is underway, but there is still quite a bit of work before
it's "clean."


What comes in the package?
--------------------------
1. `SimplePie.compiled.php` - The SimplePie library in one file.  This is all
   that's required for your pages.
   Either run `php build/compile.php` to generate this, or grab a copy from [dev.simplepie.org](http://dev.simplepie.org/SimplePie.compiled.php)
2. `autoloader.php` - The SimplePie Autoloader if you want to use the separate
   file version.
3. `library/` - SimplePie classes for use with the autoloader
4. `README.markdown` - This document.
5. `LICENSE.txt` - A copy of the BSD license.
6. `compatibility_test/` - The SimplePie compatibility test that checks your
   server for required settings.
7. `demo/` - A basic feed reader demo that shows off some of SimplePie's more
   noticeable features.
8. `idn/` - A third-party library that SimplePie can optionally use to
   understand Internationalized Domain Names (IDNs).
9. `test/` - SimplePie's unit test suite.


To start the demo
-----------------
1. Upload this package to your webserver.
2. Make sure that the cache folder inside of the demo folder is server-writable.
3. Navigate your browser to the demo folder.


Need support?
-------------
For further setup and install documentation, function references, etc., visit
[the wiki][wiki]. If you're using the latest version off GitHub, you can also
check out the [API documentation][].

If you can't find an answer to your question in the documentation, head on over
to one of our [support channels][]. For bug reports and feature requests, visit
the [issue tracker][].

[API documentation]: http://dev.simplepie.org/api/
[wiki]: http://simplepie.org/wiki/
[support channels]: http://simplepie.org/support/
[issue tracker]: http://github.com/simplepie/simplepie/issues


API changes since 1.2
---------------------
### Recently removed
The following have recently been removed:

* Parameters for SimplePie::__construct()
* `add_to_*`
* `display_cached_file`
* `enable_xml_dump`
* `get_favicon`
* `set_favicon_handler`
* `subscribe_*` (except `subscribe_url`)
* `utf8_bad_replace`
* `set_javascript` (See `SimplePie_Misc::output_javascript()`)
* Support for Odeo

### Deprecated
The following have recently been deprecated:

* `SimplePie_Enclosure::native_embed` (use `SimplePie_Enclosure::embed(..., true)` instead)
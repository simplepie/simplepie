+++
title = "SimplePie 0.93"
+++

Released on 2 September 2004

## Changes {#changes}

- \[New\] Added `sp_build()` to expose the build date, and `sp_useragent()` to expose the user agent string.
- \[New\] A debug toggle in `simplepie()` that controls whether caching is used. Defaults to true.
- \[New\] Transforms relative-to-the-root <abbr title="Uniform Resource Locator">URL</abbr>'s (/archives/) into absolute <abbr title="Uniform Resource Locator">URL</abbr>'s. Web browsers do this, and now SimplePie does too for links and images in the content.
- \[New\] Support for `<content:encoded>` in <abbr title="Rich Site Summary">RSS</abbr> feeds.
- \[New\] Support for the auto-discovery of <abbr title="Rich Site Summary">RSS</abbr> and Atom feeds. SimplePie will load whichever is the first feed listed (for sites who offer multiple feeds).
- \[Changed\] The project build date is now in the user agent string: `SimplePie/0.93 (RSS Parser; http://www.skyzyx.com/projects/simplepie/) Build/20040902`
- \[Changed\] Changed `fix_protocol()` to allow <abbr title="Uniform Resource Locator">URL</abbr>'s with no protocol to be handled as absolute <abbr title="Uniform Resource Locator">URL</abbr>'s provided that they begin with `www.`.
- \[Changed\] Local (relative <abbr title="Uniform Resource Locator">URL</abbr>) files are no longer cached, since cache files and local files are essentially the same thing. There's no sense in having two copies of the same file on the same server now, is there?
- \[Fixed\] Improved support for certain types of poorly formatted <abbr title="Rich Site Summary">RSS</abbr> feeds.

## Announcement {#announcement}

- <http://blog.skyzyx.com/2004/09/02/wait-didnt-he-just/>

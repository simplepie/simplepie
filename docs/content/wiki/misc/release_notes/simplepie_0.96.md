+++
title = "SimplePie 0.96"
+++

Released on 8 January 2005

## Changes {#changes}

- \[New\] The `<dc:description>` and `<longdesc>` tags are now supported in `get_item_description()` (although I know that `<longdesc>` isn't actually a valid tag.).
- \[New\] Many more tags now get `CDATA` wrapped around them, including tags that SimplePie doesn't even parse. This aids compatibility in reading malformed feeds.
- \[Changed\] Changed how the <abbr title="Extensible Markup Language">XML</abbr> Dump features works. Rather than dump the processed <abbr title="Extensible Markup Language">XML</abbr> at the top of the source code, it now dumps the <abbr title="Extensible Markup Language">XML</abbr> to the page and quits. Serves the <abbr title="Extensible Markup Language">XML</abbr> as `text/xml`.
- \[Changed\] SimplePie now tries to grab data at 2kb at a time (the recommended size), rather 1MB at a time.
- \[Changed\] SimplePie will now clear the cache folder after 1 day by default, rather than after 7 days. This can still be changed using the appropriate `simplepie()` parameter.
- \[Changed\] Rather than convert all `&`, `<`, `>`, and other characters automatically before the feed gets parsed, this is now handled by <abbr title="Hypertext Preprocessor">PHP</abbr>'s `html_entity_encode()` function in the `get_item_description()` function.
- \[Changed\] Changed the process by which `CDATA` sections are (re-)applied to tags.
- \[Fixed\] Resolved a glitch in how certain dates are handled.
- \[Fixed\] Resolved an issue with having `&copy;` inside a `<copyright>` tag.
- \[Fixed\] Resolved an issue where encoded angle brackets were being resolved as tag endings.
- \[Fixed\] SimplePie now wraps `CDATA` around ALL of the elements that it tries to parse, rather than just a select few.

## Known Issues {#known_issues}

- Line breaks in `<pre>` tags are no longer respected.
- You can't leave opened tags open in “example”-type tags like `<code>` and `<pre>`.

## Announcement {#announcement}

- <http://blog.skyzyx.com/2005/01/14/simplepie-096-now-available/>

+++
title = "SimplePie 0.94"
+++

Released on 23 September 2004

## Changes {#changes}

- \[New\] Implemented much better code for parsing and displaying non-English characters in feeds.
- \[New\] Support for automatically deleting cache files that have been unused for 7 days (can be changed via a parameter in the `simplepie()` function).
- \[New\] `application/xml` is now in the auto-discovery list (as this is what Mozilla.org uses).
- \[Changed\] As per [Mark Pilgrim's suggestions](http://diveintomark.org/archives/2003/06/12/how_to_consume_rss_safely) on how to improve the security of <abbr title="Rich Site Summary">RSS</abbr>, SimplePie now strips out the following tags prior to parsing: `!doctype`, `html`, `body`, `meta`, `style`, `script`, `noscript`, `embed`, `object`, `param`, `blink`, `marquee`, `frameset`, `frame`, `iframe`, `form`, `input,` and `font`
- \[Changed\] It also takes the time to remove the following attributes from all tags: `style`, `class`, and `id`
- \[Fixed\] Made significant improvements in parsing not-well-formed <abbr title="Rich Site Summary">RSS</abbr> feeds by rewriting `CDATA` sections in feeds.

## Announcement {#announcement}

- <http://blog.skyzyx.com/2004/09/24/it-took-me-long-enough/>

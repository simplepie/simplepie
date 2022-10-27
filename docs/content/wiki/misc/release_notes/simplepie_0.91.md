+++
title = "SimplePie 0.91"
+++

Released on 28 August 2004

## Changes {#changes}

- \[New\] Added support for reading local (relative <abbr title="Uniform Resource Locator">URL</abbr>) files.
- \[Changed\] Now wraps a CDATA section around \<title\>, \<link\>, and \<description\> values.
- \[Fixed\] v0.9 processed feeds so fast that it didn't give itself a chance to completely read the <abbr title="Extensible Markup Language">XML</abbr> file prior to parsing. This would frequently cause errors to occur. v0.91 makes a local copy of the feed before trying to parse it, but also slows it down a tad.

## Announcement {#announcement}

- <http://blog.skyzyx.com/2004/08/28/newer-better-simpler/>

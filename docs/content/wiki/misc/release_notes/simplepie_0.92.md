+++
title = "SimplePie 0.92"
+++

Released on 29 August 2004

## Changes {#changes}

- \[New\] Implemented a simple caching system that refreshes feeds older than 1 hour. Initial loads are about as fast as v0.91 speeds, while subsequent loads are as fast as v0.9 speeds (100-200 times faster than v0.8).
- \[New\] The project name, version, and <abbr title="Uniform Resource Locator">URL</abbr> can all be displayed through functions. This is useful for auto-updating “Powered by…” messages.
- \[New\] Better support for characters that are not part of the Latin-based alphabet.
- \[New\] A User Agent: `SimplePie/0.92 (RSS Parser; http://www.skyzyx.com/projects/simplepie/)`
- \[New\] A debug toggle in `simplepie()` that dumps the feed contents to the screen. Known as “XMLdump”. Defaults to false.
- \[Changed\] Removed functionality where SimplePie wrapped a CDATA section around \<title\>, \<link\>, and \<description\> values.
- \[Changed\] Swaps out certain “smart” characters for their safer <abbr title="American Standard Code for Information Interchange">ASCII</abbr> counterparts. This seems to resolve [The Dunstan Issue](http://blog.skyzyx.com/2004/08/29/the-battle-of-dunstan-vs-andrei-vs-mark/).

## Announcement {#announcement}

- <http://blog.skyzyx.com/2004/08/29/newer-er-better-er-simpler-er/>

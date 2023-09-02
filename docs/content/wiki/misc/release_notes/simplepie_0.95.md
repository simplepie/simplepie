+++
title = "SimplePie 0.95"
+++

Released on 10 October 2004

## Changes {#changes}

- \[New\] Item/Entry dates (`<pubDate>`, `<dc:date>`, `<issued>`) can now be formatted using standard <abbr title="Hypertext Preprocessor">PHP</abbr> [date()](http://php.net/date) values via a new parameter in the `get_item_date()` function.
- \[Fixed\] Got the speed back to normal.
- \[Fixed\] Resolved glitches in the “bad feed compatibility mode” so that it doesn't jack up valid feeds.
- \[Fixed\] All markup inside `<code>` tags now displays properly. For various other compatibility reasons, all `&lt;`, `&gt;`, `&quot;`, and `&amp;` entities are converted to their real values. Entities inside `<code>` tags are now re-converted back to entities.
- \[Fixed\] Content inside `<pre>` tags now obeys linebreaks, rather than displaying everything on a single line.
- \[Fixed\] The “Byte Order Mark” prelude in UTF-8 documents now gets stripped out when parsing feeds, which significantly improves feed compatibility.

## Announcement {#announcement}

- <http://blog.skyzyx.com/2004/10/10/simplepie-095/>

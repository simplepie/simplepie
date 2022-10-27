+++
title = "Updates to WordPress and MediaWiki plugins"
date = 2006-06-09T12:06:00Z

[extra]
author = "Ryan Parman"
+++

We’ve gotten some feedback on our new [WordPress](/docs/installation/wordpress/) and [Mediawiki](/docs/installation/mediawiki/) plugins, so we’ve made a couple of updates.

First is that both of these are better at handling things when a feed is unavailable or unparsable… essentially, it’s better contingency design. The second part is that they both now take an “error” keyword/attribute. This is a plain text error message to display when the error occurs. If you leave it out, it will simply use SimplePie’s built-in messages.

Upgrade now!

+++
title = "Twitter Bug"
date = 2008-08-16T13:00:00Z

[extra]
author = "Ryan Parman"
+++

Just a heads-up for anyone noticing problems parsing Twitter feeds:

SimplePie supports something called [HTTP Conditional Get](http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers/), which is the process of asking a feed if it has changed before we re-download a fresh copy of the feed. Over the past couple of weeks, I’ve been noticing a problem with my Twitter status on my personal website, and finally had some time to run a test today to see if my instinct was correct. It was.

When SimplePie asks Twitter for a feed the first time, everything works as expected. However, at the moment, when SimplePie asks Twitter if a feed \*has changed\*, Twitter says “yes” (whether it has or not), and then sends us a fresh copy of the feed that has \*no items in it.\*

_\[Technical: This only seems to be a problem if we send the Last-Modified header as the value for If-Modified-Since in the request. If-None-Match and ETag seem to give the correct response\]._

I’ve notified Twitter of the issue, so hopefully it will be fixed soon. In the meantime, if Twitter support is critical between now and whenever they fix this bug, you can temporarily workaround this issue. See http://simplepie.org/wiki/faq/problematic_feeds for more information.

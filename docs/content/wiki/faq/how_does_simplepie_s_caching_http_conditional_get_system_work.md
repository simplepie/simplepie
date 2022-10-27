+++
title = "How does SimplePie's caching system work?"
+++

SimplePie uses a combination of “<abbr title="Hyper Text Transfer Protocol">HTTP</abbr> Conditional Get” (hereafter known as “HTTPCG”) and caching for optimal efficiency. You can learn more about _<abbr title="Hyper Text Transfer Protocol">HTTP</abbr> Conditional Get_ at [The Fishbowl](http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers).

## Process {#process}

1.  You tell SimplePie what feed you want to get and where to cache it.
2.  SimplePie looks to see if the feed is already cached:
    1.  If the cache is fresh use that.
    2.  If there is no cached copy at all, SimplePie will grab and cache the feed.
    3.  If the cache is there but it's old (SimplePie defaults to 60 minutes; configurable with [set_cache_duration()](@/wiki/reference/simplepie/set_cache_duration.md)), then SimplePie will ask the feed if it has changed since the last time we grabbed it (this is the HTTPCG part).
        1.  If it hasn't changed, we reset the timer on the cache's freshness and keep it for another 60 minutes before checking again.
        2.  If the cache _has_ changed, SimplePie dumps the existing cache (since the cache is just a copy of the data object based on the feed), and grabs a new copy of the feed and uses it.

## About HTTPCG {#about_httpcg}

HTTPCG is a two-part process:

1.  First, SimplePie knows how to handle HTTPCG-aware feeds. We've got you covered here.
2.  Secondly, the software that generates the feed needs to be configured to produce HTTPCG-aware feeds. If the software does not understand HTTPCG, then it effectively negates the benefits.

We **know** that the following software is HTTPCG-aware:

- [WordPress](http://wordpress.org)

We have _absolutely no idea_ if the following software is HTTPCG-aware: <img src="/wiki/lib/images/smileys/fixme.gif" class="middle" alt="FIXME" />

- [Drupal](http://drupal.org)
- [Textpattern](http://textpattern.com)
- [Movable Type](http://movabletype.org)

## Notes {#notes}

If you want to utilize the HTTPCG support, but don't want a ton of caching, then set the caching down to 1 minute or a fraction thereof. SimplePie's cache will expire after that minute, and then begin asking the server for a fresh copy every minute from them on.

It takes longer to ask if the feed has changed than it does to simply using the existing (fresh) cache, but it takes less time than fetching the entire feed from scratch. Although most feeds are updated a few times a day, once a day, once a week, or once a month, there are some feeds (such as [Digg.com](http://digg.com)) that update several times an hour. You can set the duration of the cache by using the [set_cache_duration()](@/wiki/reference/simplepie/set_cache_duration.md) configuration option.

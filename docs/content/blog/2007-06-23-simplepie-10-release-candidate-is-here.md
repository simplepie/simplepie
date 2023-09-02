+++
title = "SimplePie 1.0 Release Candidate is here!"
date = 2007-06-23T18:39:00Z

[extra]
author = "Ryan Parman"
+++

It brings me great pleasure to announce that SimplePie 1.0 Release Candidate is now available! We’re calling this a “Release Candidate” because there are a couple more minor niggles to work out still, but we’ll be doing new release candidates every weekend for the next 2-3 weeks until we get the last of the (minor) issues worked out.

There are a number of new things to talk about for [this release](/wiki/misc/release_notes/simplepie_1.0):

- **A refresh of the website** — The homepage was completely revamped and the old WordPress-based documentation has been moved into a new wiki so that we can all contribute valuable information to the community. All of the other pages got a subtle facelift.
- **More ways to keep track of development** — For the many of you on the bleeding edge, we’re adding [Twitter updates](http://twitter.com/simplepie) to our Subversion notification methods, and we’re also generating a downloadable snapshot of the very latest revision for those who don’t use Subversion tools.
- **Integrated “Multifeeds” support** — Now, it’s as easy to mash feeds together as it is to parse a single feed. All of SimplePie’s native methods can be used instead of having to hack data arrays together.
- **Access ALL tags and attributes in the feed** — This was probably the most requested feature of all time. Not only do we make all of the data available, but we have a handful of methods available for easily getting to that data.
- **BSD-Licensed** — We now have a license that is about as non-restrictive as it gets. You can pretty much do whatever you want with SimplePie — commercial or otherwise — as long as you leave all copyright notices in place.
- **Media RSS and iTunes RSS support** — We have a 100% complete Media RSS implementation (which I believe is the first one… am I right?), and an 80% complete iTunes RSS implementation.
- **Better Podcast/Vidcast/Enclosure support** — We’ve added a “widescreen” configuration for video enclosures, as well as a handful of additional methods for better enclosure handling. We’ve also added support for the popular Flash Video format and faster-loading MP3 playback.
- **Image and Favicon caching** — This feature still needs a tad more polish, but SimplePie now sports improved favicon detection, and caching for both images and favicons using an XSS-safe method.
- **Performance Enhancements!** — We’ve spent a lot of time fine-tuning our performance by targetting high-cost function calls. And if that wasn’t enough, we’ve added the new `set_stupidly_fast()` configuration option which trades data cleaning for pure speed. The result is that SimplePie is the fastest it’s ever been, and gives everyone else a run for their money.
- **Lots o’ Configurability** — We’ve really listened to our hard-core power users, and we’ve implemented more customization than ever before to really allow savvy developers to take their feed-related apps to the next level!
- **Add-ons Galore!** — Over the next several weeks we’re going to begin seeing lots and lots of SimplePie Add-ons that take advantage of the extensible, configurable nature of SimplePie to allow people to do things they’ve never been able to (easily) do before! The first few will come from the SimplePie team, then I expect to see a number of Add-ons being developed by people like you! Feeds won’t know what hit them!

I’ll be sending emails to a number of plugin developers shortly so that they can get started on updating their SimplePie plugins for use with SimplePie 1.0. We ourselves have not yet updated our own plugins, but we’ll be releasing a 1.2.1 update in the next few days to address this update. If you do decide to upgrade, we changed a handful of method names, so please look over the [Upgrade Guidelines](/wiki/setup/upgrade) as you update SimplePie.

Enjoy! We’ll be fixing bugs this week, and will release the next release candidate this upcoming weekend.

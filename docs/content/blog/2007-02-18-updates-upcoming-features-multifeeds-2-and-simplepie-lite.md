+++
title = "Updates: Upcoming features, Multifeeds 2, and SimplePie Lite"
date = 2007-02-18T14:32:00Z

[extra]
author = "Ryan Parman"
cover_image = "/images/128/simplepie.png"
cover_image_alt = "SimplePie"
+++

I just realized how long it’s been since we’ve had a real blog posting here. Work on 1.0 is coming along, albeit a bit slower than with previous releases. But that’s mostly been an issue of time available, rather than any particular technical challenges.

Geoffrey has been hard at work with re-writing SimplePie’s core engine, and that’s been available in the trunk builds for several weeks now. Among other things, it includes the MagpieRSS-like ability to parse out ALL elements within the feed into a huge data array. Because of that, we now have access to things like `geo:`, `media:` and `itunes:` data, although we haven’t yet built any easy-to-use API functions for them yet.

Geoffrey has also been working hard on improved standards-compliance within SimplePie. In addition to going over more bug reports, RFCs and specification documents than I care to count, he’s also been working on our [automated testing system](http://php5.simplepie.org/trunk/test2/test.php), which significantly helps with things like regression testing and proper support for third-party testing suites (like [Mark Pligrim’s](http://diveintomark.org/) [Universal Feed Parser](http://feedparser.org/) [unit tests](http://feedparser.org/tests/)). This system has already been immensely helpful, and will really help us move forward into awesomeness in 2007.

I (Ryan) have been working on a number of consumer-oriented functions, such as one that will allow us to shorten descriptions by character or word while maintaining existing HTML. I’ve also been working on code for ‘Multifeeds 2’, which will allow feed mashing in a cleaner and simpler manner than the current Multifeeds code. I’m also in the process of refreshing and realigning the SimplePie website. After going through the statistics provided from [Mint](http://haveamint.com/) and [Google Analytics](http://www.google.com/analytics/), we’ve decided to make some adjustments to several areas of the site in an effort to improve the overall usefulness. Expect to see those changes with the release of our 1.0 Release Candidate.

Lastly, we’re getting ready to release a preview of what we’re calling _SimplePie Lite_. SimplePie Lite is a web service providing a JavaScript interface for SimplePie. Here are a few features and advantages:

- It is a hosted service. There is nothing to install, and no futzing with installing missing PHP extensions. Everything runs on [Dreamhost](http://dreamhost.com/r.cgi?skyzyx) servers, which have everything installed.
- When passed a feed, SimplePie Lite returns a gzip-compressed [JSON](http://en.wikipedia.org/wiki/JSON) object, which is perfect for integrating into your AJAX apps. On average, the gzipped data is anywhere from 70–90% smaller than the uncompressed data. Couple that with SimplePie’s caching and ‘HTTP conditional get’ support, and you’re looking at some very small, very fast downloads.
- ALL of the relevant SimplePie PHP functions have been made available in SimplePie Lite, albeit _JavaScriptized_. Where SimplePie has `$item->get_permalink()`, SimplePie Lite has `item.getPermalink()`. All of the relevant configuration options are also available, the only exceptions being those which need to be static for optimal efficiency for the server.
- After the guts are finished, we’ll be building a user interface which allows people to enter a few bits of information, click a few checkboxes, and generate code that can be copy-pasted into webpage or profile where JavaScript is allowed.
- This also means that SimplePie is no longer solely available to those building with PHP. SimplePie Lite can be used with Ruby (on Rails), Java, ASP/ASP.Net, Coldfusion, and virtually any other web programming language.

The preview will be available in the coming weeks, and will be formally launched sometime after SimplePie 1.0 goes gold.

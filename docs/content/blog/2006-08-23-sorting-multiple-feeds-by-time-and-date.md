+++
title = "Sorting multiple feeds by time and date"
date = 2006-08-23T09:20:00Z

[extra]
author = "Ryan Parman"
+++

<div class="chunk">

**\*Update:** With the release of SimplePie 1.0, this tutorial became obsolete. [Please check out the new tutorial instead](/wiki/tutorial/sort_multiple_feeds_by_time_and_date).\*

In this demo, I will show you how to parse multiple feeds and sort all of the posts from all feeds in reverse-chronological order (newest to oldest).

</div>

<div class="chunk">

#### What you’ll need for this demo

- The Multifeeds package
- And, of course, the latest [SimplePie](http://www.simplepie.org/downloads/) for the RSS parsing (1.0 Beta 2 or later)

</div>

<div class="chunk">

#### What you need to do

1. Unzip the `multifeeds.zip` file.
2. Drop the latest version of `simplepie.inc` into the resulting folder.
3. Edit — or don’t edit — the index.php file to your heart’s delight. (Maybe you should just let it run untouched the first time.)
4. Upload the whole `multifeed` folder to your webserver (or your localhost)
5. Set the cache folder to server-writable.
6. Load the `index.php` into your web browser, and voila!

</div>

<div class="chunk">

#### Notes

1. The very first time you load the page will take more time than the subsequent load will because SimplePie needs to cache all of the feeds for the first time.
2. In the feeds you use, make sure that the items in that feed have a published or last modified date associated with them. If not, then those feed items will be shuffled out of order.
3. Because SimplePie Beta 3 has support for something called HTTP Conditional Get, cache handling is much improved over Beta 2, leading to better overall performance.

</div>

#### Live Demo

→ [Multiple Feeds Demo](/demo/demos/multifeed/)

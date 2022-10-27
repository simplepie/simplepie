+++
title = "Known Problematic Feeds"
+++

This is a listing of all major services with feeds that SimplePie has a problem with for one reason or another, including any workarounds or status that we're aware of. Please keep this listing in alphabetical order.

## Blogspot {#blogspot}

### Problem {#problem}

Some images and links and such are being displayed as plain text because the `<` and `>` brackets are being stripped from the output.

### What's Happening? {#what_s_happening}

As of early November 2008, a change was made by the Blogspot team that changed how feeds are created. This isn't a big deal in-and-of itself as the changes still produced valid feeds. But what causes the angle brackets in these Blogspot feeds to vanish is a known bug in the `libxml` extension (versions 2.7.0 – 2.7.2) where certain entities are stripped by the <abbr title="Extensible Markup Language">XML</abbr> parsing extension itself – outside of SimplePie. SimplePie uses the `libxml` extension for parsing <abbr title="Extensible Markup Language">XML</abbr> because of it's <abbr title="Hypertext Preprocessor">PHP</abbr> 4.x support. You can read more in the following threads:

- <http://bugs.simplepie.org/issues/show/101>
- <http://bugs.php.net/bug.php?id=45996>

### Solution {#solution}

A patch was applied to SimplePie 1.1.2 that resolved this issue for hosts with `libxml` 2.7.0 and 2.7.1. Shortly afterwards, it was discovered that this same issue also appeared to be affecting hosts with `libxml` 2.7.2 as well. A new patch is currently being tested for this last group of users. This issue should not affect users with previous versions of `libxml`.

## FeedBurner {#feedburner}

### Problem {#problem1}

FeedBurner feeds are returning old/outdated versions of feeds that do not contain the latest items.

### What's Happening? {#what_s_happening1}

Because too many SimplePie users started fetching FeedBurner feeds with caching disabled, FeedBurner's Operations Team has decided to block any SimplePie user that isn't using caching. Unfortunately their logic is a bit backwards. They require SimplePie to send a request using an `ETag` and `LastModified` value ([How does SimplePie's caching system work?](@/wiki/faq/how_does_simplepie_s_caching_http_conditional_get_system_work.md)) before they'll send back up-to-date content. The problem is that SimplePie sends this back once it's already been cached (to ask if it has changed). It's a “cart before the horse before the cart” kind of situation. You can read more in the following threads:

- <http://groups.google.com/group/feedburner-for-developers/browse_thread/thread/aa193c2e1ed07f51?fwc=1>
- <http://groups.google.com/group/feedburner-for-developers/browse_thread/thread/b042416861f89721>
- <http://drupal.org/node/307686>

### Solution/Workaround {#solutionworkaround}

We've been told that one or more of the following methods might work.

- Fetching the “raw <abbr title="Extensible Markup Language">XML</abbr>” version of the FeedBurner feed by appending `?format=xml` to the end of the feed <abbr title="Uniform Resource Locator">URL</abbr>.
- Changing SimplePie's user-agent string to something that doesn't have the word “SimplePie” in it. Use [set_useragent()](@/wiki/reference/simplepie/set_useragent.md) to change the user-agent string.
- Another solution that I've heard works is forcing SimplePie to send `ETag` and `LastModified` headers before we even have them by sending fake data in the correct format. We've not yet verified this method, nor have we fleshed it out, but it might be worth rummaging around inside the [SimplePie_File](@/wiki/reference/simplepie_file/_index.md) class.

## Twitter {#twitter}

### Problem {#problem2}

Twitter feeds are just fine the first time they're loaded and cached, but are missing some/all items when the cache expires and SimplePie tries to re-fetch the feed.

### What's Happening? {#what_s_happening2}

”[How does SimplePie's caching system work?](@/wiki/faq/how_does_simplepie_s_caching_http_conditional_get_system_work.md)” describes the process that SimplePie uses to ask the server if a feed has been updated or not, before re-downloading the whole thing. [This process is described in detail](http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers/), and is used by several feed readers and other types of software as the standard by which the process should be followed. Over the summer '08, a bug was introduced in Twitter's feed system where when SimplePie asks Twitter if an updated feed is available, Twitter incorrectly responds with a feed with no items in it.

### Solution/Workaround {#solutionworkaround1}

Since Twitter gets confused when we send the Last-Modified header (and they've still not responded to my bug report), we need to comment out the portion that sends back the header. Look for this chunk of code:

```php
if (isset($this->data['headers']['last-modified']))
{
    $headers['if-modified-since'] = $this->data['headers']['last-modified'];
}
```

In SimplePie 1.1.3, it starts around line 1587. Later 1.1.x versions will probably be nearby, so look for the code instead of explicitly trying to comment out specific lines.

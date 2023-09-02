+++
title = "Syntax Notes"
+++

[SimplePie Live!](http://live.simplepie.org) aims to be near-syntax-compatible with SimplePie, but there are two additional considerations to take into account:

1.  SimplePie Live is a JavaScript service, and should feel like JavaScript.
2.  Since SimplePie Live downloads and runs in the browser, file size is a major issue to take into account.

Because of these considerations, we've made some simple but significant changes to the syntax and <abbr title="Application Programming Interface">API</abbr> in SimplePie Live!

1.  The constructor feels more like you're using [Ajax.Request()](http://prototypejs.org/api/ajax/request) than calling a <abbr title="Hypertext Preprocessor">PHP</abbr> constructor.
2.  There are different configuration options than the <abbr title="Hypertext Preprocessor">PHP</abbr> version.
3.  The <abbr title="Application Programming Interface">API</abbr> contains NO methods… everything is a property.
4.  The `get_` has been removed from all names, and what's left has been camelCased.
5.  All of the subscribing, bookmarking, data hacking, and data sanitizing methods have been removed (except for `feed.subscribeUrl`).
6.  All singular methods have been removed; use the plural ones instead (as they're arrays).

## Example Differences {#example_differences}

See the following examples to see some of the differences:

**Getting the title of the feed**

```php
// SimplePie under PHP
$feed->get_title();

// SimplePie Live!
feed.title;
```

**Storing the first item's title in a 'title' variable**

```php
// SimplePie under PHP 4.x
$item = $feed->get_item(0);
$title = $item->get_title();

// SimplePie under PHP 5.x
$title = $feed->get_item(0)->get_title();

// SimplePie Live!
var title = feed.items[0].title;
```

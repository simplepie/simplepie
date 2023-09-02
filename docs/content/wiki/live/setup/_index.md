+++
title = "Requirements and Getting Started"
+++

This section contains the first steps for getting started with SimplePie Live! Ready to get started?

## Requirements {#requirements}

1.  A fundamental understanding of JavaScript is required, and an understanding of _JavaScript Object Notation_ (aka [JSON](http://json.org/js.html)) is highly recommended.
2.  It would also be valuable to know how to generate <abbr title="HyperText Markup Language">HTML</abbr> via JavaScript using <abbr title="Document Object Model">DOM</abbr> manipulation methods (so that you can dynamically add the feeds to your pages).
3.  Lastly, it would be valuable for you to have the latest version of [Firefox](http://getfirefox.com) installed along with the [Firebug](http://getfirebug.com) extension. Firebug is **the best** JavaScript debugging tool on the face of the entire planet… and it's easy to use. Even if you're a hard-core user of another browser, you should still install this combination of tools to that you can more easily dig through the data.

## Web Browsers {#web_browsers}

Because SimplePie Live simply returns a JSON object of data, it is generally expected to work in ANY modern web browser. However, as we move forward, we will be following Yahoo's [Graded Browser Support](http://developer.yahoo.com/yui/articles/gbs/) in supporting A-grade web browsers.

Older versions of these browsers may also work as well, but we're pretty sure that these versions DO. In truth, you're more likely to be restricted by the minimum requirements of any JavaScript Framework than you are by SimplePie Live!

## Getting Started {#getting_started}

SimplePie Live doesn't require you to download any packages or configure any installs. It pulls straight from our servers and runs entirely within your web browser. That being said, there are two steps:

### Step 1: Load the base library {#step_1load_the_base_library}

First, you need to load the `base.js` file from the server by adding it to the `<head>` section of your page.

```html
<script type="text/javascript" src="http://live.simplepie.org/app/0.5/base.js"></script>
```

This file is less than 1k and includes the base functionality for requesting feeds and handling callbacks. Besides gzipping it (to make it super small), we've also resisted the temptation to add non-critical code to it, so this file should always remain very small (our goal is to always stay at or below 1k).

### Step 2: Call the function {#step_2call_the_function}

Secondly, you can request a feed and define callback functions for successful and failed requests. If you've ever worked with a modern JavaScript framework like [Prototype](http://prototypejs.org), [jQuery](http://jquery.com), or [MooTools](http://mootools.net) this will look pretty familiar. I should also note that you don't need to use one of these frameworks to use SimplePie Live – you're free to use plain ol' JavaScript if you want.

```javascript
var feed = new SimplePie(feedUrl, jsonOptions);
```

Or, if you're looking for a more realistic example:

```javascript
var feed = new SimplePie('http://feeds.feedburner.com/simplepie', {

    // Set one configuration option
    setTimeout: 30,

    // Set up a handler for a successful response
    onSuccess: function(feed) {
        alert(feed.title.toUpperCase() + "\n" + feed.description);
    },

    // Do this if we encounter an error
    onFailure: function(feed) {
        alert(feed.error);
    }
});
```

That's basically the gist of it. If you need help on what configuration options are available, or what properties are available in the <abbr title="Application Programming Interface">API</abbr>, check out [API Reference](@/wiki/live/reference/_index.md).

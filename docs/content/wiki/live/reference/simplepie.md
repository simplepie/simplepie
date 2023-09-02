+++
title = "SimplePie"
+++

## Description {#description}

Creates a new SimplePie object, optionally setting various settings (see their specific pages for more detail).

<div class="warning">

**If you're merging multiple feeds together, they need to all have dates for the items or else <abbr title="Hypertext Preprocessor">PHP</abbr> will sort them to the top.**

</div>

## Parameters {#parameters}

### feedUrl {#feedurl}

Set the feed <abbr title="Uniform Resource Locator">URL</abbr>(s) that you want to use. Can either be a single `String` <abbr title="Uniform Resource Locator">URL</abbr>, or an `Array` of URLs.

### options {#options}

This is a JSON-formatted object that should contain configuration options and callback handlers.

## Returns {#returns}

Returns a handle for the SimplePie object.

## Examples {#examples}

Assuming you've already included the `base.js` file as noted in [Requirements and Getting Started](@/wiki/live/setup/_index.md)…

```javascript
<script type="application/javascript">

var feed = new SimplePie('http://feeds.feedburner.com/simplepie', {

    // Set some configuration options.
    enableOrderByDate: false,
    setTimeout: 30,

    // Handle a successful response.
    onSuccess: function(feed) {

        // Do something simple for this example code.
        if (feed.title) {
            window.alert(feed.title);
        }
    },

    // Handle a failed response.
    onFailure: function(feed) {

        // The error message is always in the error property.
        window.alert(feed.error);
    }
});

</script>
```

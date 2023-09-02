+++
title = "feed.title"
+++

## Description {#description}

Returns the title of the feed. Returns `NULL` when you're merging multiple feeds, so use <a href="@/wiki/live/reference/feed.item.feed.title.md" class="wikilink2">feed.item.feed.title</a> instead.

<div class="warning">

Note that this object can only be accessed with `feed` when `feed` is set as the parameter in the <a href="@/wiki/live/reference/onsuccess.md" class="wikilink2">onsuccess</a> callback function. We're using `feed` generically in this reference to refer to the feed's data.

</div>

## Availability {#availability}

- Available in the SimplePie Live public beta.

## Examples {#examples}

Assuming you've already included the `base.js` file as noted in [Requirements and Getting Started](@/wiki/live/setup/_index.md)…

```javascript
<script type="application/javascript">

var feed = new SimplePie('http://feeds.feedburner.com/simplepie', {

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

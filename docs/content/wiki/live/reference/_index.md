+++
title = "API Reference"
+++

These are all of the properties available for [SimplePie Live!](http://live.simplepie.org) This discusses the JSON object that is returned with an `api` response, not a `json` response. If you are an existing SimplePie user, and simply want to understand the syntax differences between SimplePie and SimplePie Live, check out the [Syntax Notes](@/wiki/live/reference/syntax_notes.md).

<div class="warning">

**Although this listing is complete, the documentation isn't. We're working on adding docs as fast as we can type. Until then, simply remember that these properties map directly to methods in SimplePie, so if you're halfway intelligent you can likely figure out which property does what.**

</div>

## Documentation {#documentation}

### Constructor {#constructor}

- [SimplePie](@/wiki/live/reference/simplepie.md) – Construct a new `SimplePie` object.

### Configuration Options {#configuration_options}

These are passed in as part of the `jsonOptions` parameter as discussed in the [Getting Started](@/wiki/live/setup/_index.md#step_2call_the_function) documentation.

- <a href="@/wiki/live/reference/enableorderbydate.md" class="wikilink2">enableOrderByDate</a> – Toggle the reordering of items into reverse chronological order.
- <a href="@/wiki/live/reference/response.md" class="wikilink2">response</a> – Determines which type of data response is sent back from the server. Defaults to `api` (which is what is being documented on this page).
- <a href="@/wiki/live/reference/setinputencoding.md" class="wikilink2">setInputEncoding</a> – Override the character set within the feed.
- <a href="@/wiki/live/reference/setoutputencoding.md" class="wikilink2">setOutputEncoding</a> – Set the output character set.
- <a href="@/wiki/live/reference/settimeout.md" class="wikilink2">setTimeout</a> – Timeout for fetching remote files.
- <a href="@/wiki/live/reference/simpleresponse.md" class="wikilink2">simpleResponse</a> – Toggle whether the response contains a complete response or a simple response.

### Callback Functions {#callback_functions}

These are passed in as part of the `jsonOptions` parameter as discussed in the [Getting Started](@/wiki/live/setup/_index.md#step_2call_the_function) documentation.

- <a href="@/wiki/live/reference/onfailure.md" class="wikilink2">onFailure</a> – The callback function that handles a failed request.
- <a href="@/wiki/live/reference/onsuccess.md" class="wikilink2">onSuccess</a> – The callback function that handles a successful request.

### Methods {#methods}

- <a href="@/wiki/live/reference/cleanup.md" class="wikilink2">cleanup</a> – This method will cleanup after the script runs, and remove the no-longer-needed `<script>` tag from the `<head>` section of the page.

### Response Properties {#response_properties}

The top-most `feed` object may actually be named something else, and will equate to the name of the parameter you choose when setting up your callback functions.

- <a href="@/wiki/live/reference/feed.copyright.md" class="wikilink2">feed.copyright</a> – Get the feed copyright information. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.description.md" class="wikilink2">feed.description</a> – Get the feed description. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.encoding.md" class="wikilink2">feed.encoding</a> – Get the character set for the returned values. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.favicon.md" class="wikilink2">feed.favicon</a> – Get the <abbr title="Uniform Resource Locator">URL</abbr> for the favicon of the feed's website. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.imageheight.md" class="wikilink2">feed.imageHeight</a> – Get the logo/image height. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.imagelink.md" class="wikilink2">feed.imageLink</a> – Get the logo/image linkback <abbr title="Uniform Resource Locator">URL</abbr>. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.imagetitle.md" class="wikilink2">feed.imageTitle</a> – Get the logo/image title. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.imageurl.md" class="wikilink2">feed.imageUrl</a> – Get the logo/image <abbr title="Uniform Resource Locator">URL</abbr>. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.imagewidth.md" class="wikilink2">feed.imageWidth</a> – Get the logo/image width. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.itemquantity.md" class="wikilink2">feed.itemQuantity</a> – Get the number of items in the feed. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.language.md" class="wikilink2">feed.language</a> – Get the feed language. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.latitude.md" class="wikilink2">feed.latitude</a> – Get the feed latitude. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.links.md" class="wikilink2">feed.links</a> – Get all the links of a specific relation. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.longitude.md" class="wikilink2">feed.longitude</a> – Get all the links of a specific relation. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.permalink.md" class="wikilink2">feed.permalink</a> – Get the first feed link (i.e. the permalink). Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.subscribeurl.md" class="wikilink2">feed.subscribeURL</a> – The actual feed <abbr title="Uniform Resource Locator">URL</abbr>. Returns `NULL` in Multifeeds mode.
- [feed.title](@/wiki/live/reference/feed.title.md) – Get the feed title. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.type.md" class="wikilink2">feed.type</a> – Get the type of feed. Returns `NULL` in Multifeeds mode.
- <a href="@/wiki/live/reference/feed.items.md" class="wikilink2">feed.items</a> – Returns a collection of items.
  - <a href="@/wiki/live/reference/feed.items.content.md" class="wikilink2">feed.items.content</a> – Get the content of the post (prefers full-content).
  - <a href="@/wiki/live/reference/feed.items.date.md" class="wikilink2">feed.items.date</a> – Get the date for the post.
  - <a href="@/wiki/live/reference/feed.items.description.md" class="wikilink2">feed.items.description</a> – Get the content of the post (prefers summaries).
  - <a href="@/wiki/live/reference/feed.items.id.md" class="wikilink2">feed.items.id</a> – Get the identifier for the post.
  - <a href="@/wiki/live/reference/feed.items.latitude.md" class="wikilink2">feed.items.latitude</a> – Get the post latitude.
  - <a href="@/wiki/live/reference/feed.items.links.md" class="wikilink2">feed.items.links</a> – Get all links for the post of a specific relation.
  - <a href="@/wiki/live/reference/feed.items.longitude.md" class="wikilink2">feed.items.longitude</a> – Get the post longitude.
  - <a href="@/wiki/live/reference/feed.items.permalink.md" class="wikilink2">feed.items.permalink</a> – Get the first link for the post (i.e. the permalink).
  - <a href="@/wiki/live/reference/feed.items.title.md" class="wikilink2">feed.items.title</a> – Get the title for the post.
  - <a href="@/wiki/live/reference/feed.items.uuid.md" class="wikilink2">feed.items.uuid</a> – Get a unique SHA-1 hash identifier for the post.
  - <a href="@/wiki/live/reference/feed.items.feed.md" class="wikilink2">feed.items.feed</a> – Get access to information about the parent feed object. Returns `NULL` if only parsing one feed. Populated when in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.copyright.md" class="wikilink2">feed.items.feed.copyright</a> – Get the feed copyright information. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.description.md" class="wikilink2">feed.items.feed.description</a> – Get the feed description. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.encoding.md" class="wikilink2">feed.items.feed.encoding</a> – Get the character set for the returned values. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.favicon.md" class="wikilink2">feed.items.feed.favicon</a> – Get the <abbr title="Uniform Resource Locator">URL</abbr> for the favicon of the feed's website. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.imageheight.md" class="wikilink2">feed.items.feed.imageHeight</a> – Get the logo/image height. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.imagelink.md" class="wikilink2">feed.items.feed.imageLink</a> – Get the logo/image linkback <abbr title="Uniform Resource Locator">URL</abbr>. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.imagetitle.md" class="wikilink2">feed.items.feed.imageTitle</a> – Get the logo/image title. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.imageurl.md" class="wikilink2">feed.items.feed.imageUrl</a> – Get the logo/image <abbr title="Uniform Resource Locator">URL</abbr>. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.imagewidth.md" class="wikilink2">feed.items.feed.imageWidth</a> – Get the logo/image width. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.itemquantity.md" class="wikilink2">feed.items.feed.itemQuantity</a> – Get the number of items in the feed. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.language.md" class="wikilink2">feed.items.feed.language</a> – Get the feed language. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.latitude.md" class="wikilink2">feed.items.feed.latitude</a> – Get the feed latitude. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.links.md" class="wikilink2">feed.items.feed.links</a> – Get all the links of a specific relation. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.longitude.md" class="wikilink2">feed.items.feed.longitude</a> – Get all the links of a specific relation. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.permalink.md" class="wikilink2">feed.items.feed.permalink</a> – Get the first feed link (i.e. the permalink). Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.subscribeurl.md" class="wikilink2">feed.items.feed.subscribeURL</a> – The actual feed <abbr title="Uniform Resource Locator">URL</abbr>. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.title.md" class="wikilink2">feed.items.feed.title</a> – Get the feed title. Only available in Multifeeds mode.
    - <a href="@/wiki/live/reference/feed.items.feed.type.md" class="wikilink2">feed.items.feed.type</a> – Get the type of feed. Only available in Multifeeds mode.
  - <a href="@/wiki/live/reference/feed.items.authors.md" class="wikilink2">feed.items.authors</a> – Returns a collection of authors.
    - <a href="@/wiki/live/reference/feed.items.authors.email.md" class="wikilink2">feed.items.authors.email</a> – Get the author's email address.
    - <a href="@/wiki/live/reference/feed.items.authors.link.md" class="wikilink2">feed.items.authors.link</a> – Get the author's link.
    - <a href="@/wiki/live/reference/feed.items.authors.name.md" class="wikilink2">feed.items.authors.name</a> – Get the author's name.
  - <a href="@/wiki/live/reference/feed.items.categories.md" class="wikilink2">feed.items.categories</a> – Returns a collection of categories.
    - <a href="@/wiki/live/reference/feed.items.categories.term.md" class="wikilink2">feed.items.categories.term</a> – Get the category's identifier.
    - <a href="@/wiki/live/reference/feed.items.categories.scheme.md" class="wikilink2">feed.items.categories.scheme</a> – Get the category's categorization scheme identifier.
    - <a href="@/wiki/live/reference/feed.items.categories.label.md" class="wikilink2">feed.items.categories.label</a> – Get the category's human-readable label.
  - <a href="@/wiki/live/reference/feed.items.enclosures.md" class="wikilink2">feed.items.enclosures</a> – Returns a collection of enclosures.
    - <a href="@/wiki/live/reference/feed.items.enclosures.bitrate.md" class="wikilink2">feed.items.enclosures.bitrate</a> – Get the bitrate of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.channels.md" class="wikilink2">feed.items.enclosures.channels</a> – Get the number of audio channels for the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.description.md" class="wikilink2">feed.items.enclosures.description</a> – Get the description of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.duration.md" class="wikilink2">feed.items.enclosures.duration</a> – Get the duration (in seconds) of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.expression.md" class="wikilink2">feed.items.enclosures.expression</a> – Get the expression of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.extension.md" class="wikilink2">feed.items.enclosures.extension</a> – Get the file extension of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.framerate.md" class="wikilink2">feed.items.enclosures.framerate</a> – Get the framerate of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.handler.md" class="wikilink2">feed.items.enclosures.handler</a> – Get the preferred plugin handler for this content.
    - <a href="@/wiki/live/reference/feed.items.enclosures.hashes.md" class="wikilink2">feed.items.enclosures.hashes</a> – Get all hashes for the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.height.md" class="wikilink2">feed.items.enclosures.height</a> – Get the height of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.keywords.md" class="wikilink2">feed.items.enclosures.keywords</a> – Get all keywords for the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.language.md" class="wikilink2">feed.items.enclosures.language</a> – Get the language of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.length.md" class="wikilink2">feed.items.enclosures.length</a> – Get the file size (in bytes) of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.link.md" class="wikilink2">feed.items.enclosures.link</a> – Get the <abbr title="Uniform Resource Locator">URL</abbr> of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.medium.md" class="wikilink2">feed.items.enclosures.medium</a> – Get the medium of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.player.md" class="wikilink2">feed.items.enclosures.player</a> – Get the player page for the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.realtype.md" class="wikilink2">feed.items.enclosures.realType</a> – Get the mime type that the enclosure likely is (despite the `feed.items.enclosures.type` setting)
    - <a href="@/wiki/live/reference/feed.items.enclosures.samplingrate.md" class="wikilink2">feed.items.enclosures.samplingRate</a> – Get the sampling rate of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.size.md" class="wikilink2">feed.items.enclosures.size</a> – Get the file size (in Mebibytes) of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.thumbnails.md" class="wikilink2">feed.items.enclosures.thumbnails</a> – Get all thumbnails for the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.title.md" class="wikilink2">feed.items.enclosures.title</a> – Get the title of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.type.md" class="wikilink2">feed.items.enclosures.type</a> – Get the mime type of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.width.md" class="wikilink2">feed.items.enclosures.width</a> – Get the width of the enclosure.
    - <a href="@/wiki/live/reference/feed.items.enclosures.captions.md" class="wikilink2">feed.items.enclosures.captions</a> – Returns a collection of enclosure caption objects.
      - <a href="@/wiki/live/reference/feed.items.enclosures.captions.endtime.md" class="wikilink2">feed.items.enclosures.captions.endTime</a> – Get the time that a caption should end.
      - <a href="@/wiki/live/reference/feed.items.enclosures.captions.language.md" class="wikilink2">feed.items.enclosures.captions.language</a> – Get the language of the caption.
      - <a href="@/wiki/live/reference/feed.items.enclosures.captions.starttime.md" class="wikilink2">feed.items.enclosures.captions.startTime</a> – Get the time that a caption should start.
      - <a href="@/wiki/live/reference/feed.items.enclosures.captions.text.md" class="wikilink2">feed.items.enclosures.captions.text</a> – Get the text to display.
      - <a href="@/wiki/live/reference/feed.items.enclosures.captions.type.md" class="wikilink2">feed.items.enclosures.captions.type</a> – Get the type of the caption (`text` or `html`).
    - <a href="@/wiki/live/reference/feed.items.enclosures.categories.md" class="wikilink2">feed.items.enclosures.categories</a> – Returns a collection of enclosure category objects.
      - <a href="@/wiki/live/reference/feed.items.enclosures.categories.term.md" class="wikilink2">feed.items.enclosures.categories.term</a> – Get the category's identifier.
      - <a href="@/wiki/live/reference/feed.items.enclosures.categories.scheme.md" class="wikilink2">feed.items.enclosures.categories.scheme</a> – Get the category's categorization scheme identifier.
      - <a href="@/wiki/live/reference/feed.items.enclosures.categories.label.md" class="wikilink2">feed.items.enclosures.categories.label</a> – Get the category's human-readable label.
    - <a href="@/wiki/live/reference/feed.items.enclosures.copyright.md" class="wikilink2">feed.items.enclosures.copyright</a> – Returns a single (i.e. the only) enclosure copyright object.
      - <a href="@/wiki/live/reference/feed.items.enclosures.copyright.attribution.md" class="wikilink2">feed.items.enclosures.copyright.attribution</a> – Get the copyright attribution.
      - <a href="@/wiki/live/reference/feed.items.enclosures.copyright.url.md" class="wikilink2">feed.items.enclosures.copyright.url</a> – Get the <abbr title="Uniform Resource Locator">URL</abbr> containing more information.
    - <a href="@/wiki/live/reference/feed.items.enclosures.credits.md" class="wikilink2">feed.items.enclosures.credits</a> – Returns a collection of enclosure credits objects.
      - <a href="@/wiki/live/reference/feed.items.enclosures.credits.name.md" class="wikilink2">feed.items.enclosures.credits.name</a> – Get the credited person/entity's name.
      - <a href="@/wiki/live/reference/feed.items.enclosures.credits.role.md" class="wikilink2">feed.items.enclosures.credits.role</a> – Get the credited role.
      - <a href="@/wiki/live/reference/feed.items.enclosures.credits.scheme.md" class="wikilink2">feed.items.enclosures.credits.scheme</a> – Get the organizational scheme for the credit.
    - <a href="@/wiki/live/reference/feed.items.enclosures.ratings.md" class="wikilink2">feed.items.enclosures.ratings</a> – Returns a collection of enclosure rating objects.
      - <a href="@/wiki/live/reference/feed.items.enclosures.ratings.value.md" class="wikilink2">feed.items.enclosures.ratings.value</a> – Get the rating itself.
      - <a href="@/wiki/live/reference/feed.items.enclosures.ratings.scheme.md" class="wikilink2">feed.items.enclosures.ratings.scheme</a> – Get the organizational scheme for the rating.
    - <a href="@/wiki/live/reference/feed.items.enclosures.restrictions.md" class="wikilink2">feed.items.enclosures.restrictions</a> – Returns a collection of enclosure restriction objects.
      - <a href="@/wiki/live/reference/feed.items.enclosures.restrictions.relationship.md" class="wikilink2">feed.items.enclosures.restrictions.relationship</a> – Get whether it's `allow` or `deny`.
      - <a href="@/wiki/live/reference/feed.items.enclosures.restrictions.value.md" class="wikilink2">feed.items.enclosures.restrictions.value</a> – Get the list of things that are restricted.
      - <a href="@/wiki/live/reference/feed.items.enclosures.restrictions.type.md" class="wikilink2">feed.items.enclosures.restrictions.type</a> – Get the type of restriction.

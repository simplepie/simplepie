+++
title = "Technical Details"
+++

Here are some of the technical details that discuss how [SimplePie Live!](http://live.simplepie.org) works.

- SimplePie Live! is a closed-source web application built on a custom MySQL-enabled branch of SimplePie. The MySQL functionality that we're using will be released as part of SimplePie 1.2.
- Currently, everything runs directly from our Dreamhost web hosting that has everything installed to run SimplePie optimally. ([Compatibility Test](http://live.simplepie.org/test.php))
- Our asynchronous (<abbr title="Asynchronous JavaScript and XML">AJAX</abbr>/AJAJ) functionality is not based on [XMLHTTPRequest](http://www.google.com/search?q=xmlhttprequest) but rather on the [JSONP](http://bob.pythonmac.org/archives/2005/12/05/remote-json-jsonp/) concept, which enables this service to bypass cross-domain scripting prevention in the browser, allowing it to run exclusively in the browser. This is the same process that is used by Google in pretty much all of their <abbr title="Asynchronous JavaScript and XML">AJAX</abbr>-style services.
- We are using all default configuration settings for SimplePie, with the exception of the config options we allow to be changed via SimplePie Live, we have a 30 minute cache duration, and we have a custom MySQL caching location. We may tweak and modify these settings from time to time to improve performance and handling. This also specifically means:
  - A 10-second timeout for fetching feeds (we may increase this to 30 seconds)
  - A cache time of 30 minutes
- All output is UTF-8 by default, so it is recommended that you serve your pages as UTF-8.

## How does the JSONP-based AJAX system work? {#how_does_the_jsonp-based_ajax_system_work}

As mentioned before, SimplePie Live doesn't rely on [XMLHTTPRequest](http://www.google.com/search?q=xmlhttprequest) but rather on [JSONP](http://bob.pythonmac.org/archives/2005/12/05/remote-json-jsonp/). Here's a walkthrough for how it all comes together.

1.  We set up a global array called `_callback` because it needs to be accessible to the entire page.
2.  When you initialize the `SimplePie()` constructor, you pass in a feed <abbr title="Uniform Resource Locator">URL</abbr> (or array of feed URLs), and a series of options including a callback handler for successful and failed responses.
3.  A (hopefully) unique GUID is generated based on the timestamp
4.  The `onSuccess()` and `onFailure()` callbacks are saved inside the global `_callback` array (indexed by the GUID), and are then set to `NULL` inside the SimplePie instance.
5.  A query string is generated from all of the config options and the guid, and a `<script>` tag is created and added to the page's `<head>` section.
6.  The server accepts all of this data from the query string, parses it, and uses it to generate the appropriate JSON object.
7.  After constructing the JSON object, it looks at the GUID that was passed in from the browser. Since the `onSuccess()` callback function is stored inside the `_callback` array and indexed by the GUID, the server passes the JSON data as a parameter to the `_callback` function call.
8.  When the browser downloads this `<script>` file, the `_callback` function will execute with all of the JSON-formatted feed data passed in.

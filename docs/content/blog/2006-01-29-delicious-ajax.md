+++
title = "Del.icio.us AJAX"
date = 2006-01-29T15:20:00Z

[extra]
author = "Ryan Parman"
+++

<div class="chunk">

In this demo, I will show you how to use the Ajax capabilities of Moo.ajax with Prototype Lite in conjunction with SimplePie and del.icio.us.

</div>

<div class="chunk">

#### What you’ll need for this demo

- A [del.icio.us](http://del.icio.us) account (preferably with bookmarks already in it)
- The [delicious-ajax](/downloads/delicious-ajax.zip) package
- And, of course, the latest [SimplePie](http://www.simplepie.org/downloads/) for the RSS parsing (1.0PR or later)

</div>

<div class="chunk">

#### What you need to do

1.  Unzip the `delicious-ajax.zip` file.
2.  In the resulting package is a PHP folder. Drop the latest version of `simplepie.inc` into that folder.
3.  Edit the parameters in the JavaScript function near the bottom of the `demo.php` source to list your own del.icio.us feed URL and number of entries to show.
4.  Upload the whole `delicious` folder to your webserver (or your localhost)
5.  Set the cache folder to server-writable.
6.  Load the `demo.php` into your web browser, and voila!

</div>

<div class="chunk">

#### Live Demo

→ [Del.icio.us AJAX Demo](/demo/demos/delicious-ajax/)

</div>

#### Use it in your own site

I suppose I should also mention that this exact same code can be used for any feed — not just delicious feeds. Of course, you might want to fine-tune it for services like [Last.fm](http://www.last.fm) and [Flickr](http://www.flickr.com), but that shouldn’t be too hard.

I made it a point to keep all of the various code languages as separate as possible. This should make it simple to bring this demo into your own webpages.

The only things that are required for this to work are: (1) simplepie.inc, (2) process.php, (3) prototype.lite.js, (4) moo.ajax.js, and (5) delicious-ajax.js. These five files bring the backend and frontend pieces together so that all you have to worry about is coding a `<div>` with an `id` and calling the `process(id, url, qty)` function either at the end of the page’s source code, or have it fire on body onload.

As simple as pie!

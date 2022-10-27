+++
title = "Display non-english feeds correctly (PR/Beta 1)"
date = 2006-01-29T23:46:00Z

[extra]
author = "Ryan Parman"
+++

**Requirements:** SimplePie 1.0 Preview Release (or newer)

<div class="chunk noborder">

_This tutorial has been superceded by [a newer version](/blog/2006/06/03/display-non-english-feeds-correctly-beta-2/)._

Have you ever had problems displaying feeds properly on your pages? I ran into an issue a few times when I was trying to display an iTunes Music Store feed, and Beyoncé kept coming out as Beyonc\[enter-garbled-text-here\]. I soon realized that the problem occurred because my pages were being served as ISO-8859-1, and the iTMS feed was being sent as UTF-8.

The solution is really quite simple.

All you have to do is make sure that the page is being served and handled in the same character set that the feed is. Fortunately, SimplePie has a built-in function that lets you determine what the feed is being served in: `get_encoding()`.

Ideally, when you’re loading a page with SimplePie in it, you’ll do that part at the very beginning of the page. Doing so will help you serve the page correctly.

```php
<?php
// Start counting time for loading...
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include('../simplepie.inc');

// Parse it
$feed = new SimplePie();
if (!empty($_GET['feed'])) {
    $feed->feed_url($_GET['feed']);
    if (isset($_GET['xmldump'])) {
        $feed->enable_xmldump($_GET['xmldump']);
    }
    $feed->init();

 // This is the part to pay attention to
    if (!headers_sent() && $feed->get_encoding()) {
        header('Content-type: text/html; charset=' . $feed->get_encoding());
    }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
```

We specifically want to focus in on this chunk:

```php
if (!headers_sent() && $feed->get_encoding()) {
    header('Content-type: text/html; charset=' . $feed->get_encoding());
}
```

The logic here is simple:

1.  As long as page headers haven’t been sent yet
2.  And the feed encoding has been detected
3.  Then add the encoding to the headers and send them to the browser

Make sense? Hopefully so, because it can’t get too much simpler. 🙂

</div>

There’s another part of this that is also important: the `<meta>` tag. All we have to do is make sure that the right encoding is set in the right meta tag. Let’s take a look:

```php
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $feed->get_encoding(); ?>" />
```

Just make sure that this meta tag is included in your SimplePie-enabled pages, and your page will always be served with the correct character encoding for the page (as long as the character encoding is supported by SimplePie, and as of 1.0 Beta, a large number are).

If you’re loading a feed into a page dynamically (like in our [Delicious AJAX](/ideas/demo/delicious-ajax/) demo), your best bet is to serve the page as UTF-8, since most languages are translated into UTF-8 inside SimplePie anyways. “When in doubt, serve as UTF-8.”

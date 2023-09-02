+++
title = "Display non-english feeds correctly (Beta 2)"
date = 2006-06-03T09:59:00Z

[extra]
author = "Ryan Parman"
+++

**Requirements:** SimplePie 1.0 Beta 2 (or newer)

<div class="chunk noborder">

Have you ever had problems displaying feeds properly on your pages? I ran into an issue a few times when I was trying to display an iTunes Music Store feed, and Beyoncé kept coming out as Beyonc\[enter-garbled-text-here\]. I soon realized that the problem occurred because my pages were being served as ISO-8859-1, and the iTMS feed was being sent as UTF-8.

The solution is really quite simple.

All you have to do is make sure that the page is being served and handled in the same character set that the feed is. Fortunately, SimplePie has a built-in function that handles this for you: `handle_content_type()`.

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
    $feed->init();
}

// This is the part to pay attention to
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
```

We specifically want to focus in on this chunk:

```php
$feed->handle_content_type();
```

What this does is:

1. Checks to see if any content has been sent to the browser yet.
2. If not, it checks SimplePie’s output encoding (which as of this release is always UTF-8).
3. Creates the proper HTTP Headers that tell the browser to handle this page as UTF-8 and `text/html`.

</div>

You can also set the `<meta>` tag if you’d like, although the HTTP specification says that the information that gets sent by the server will override any `<meta>` tags that try to do the same thing.

```php
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $feed->get_encoding(); ?>" />
```

If you’re loading a feed into a page dynamically (like in our [Delicious AJAX](/ideas/demo/delicious-ajax/) demo), your best bet is to serve the page as UTF-8, since all languages are translated into UTF-8 inside SimplePie anyways.

+++
title = "Bypass “hotlink blocking” when displaying a feed (Beta 1)"
date = 2006-01-29T23:46:00Z

[extra]
author = "Ryan Parman"
+++

**Requirements:** SimplePie 1.0 Beta 1

<div class="chunk noborder">

_This tutorial has been superceded by [a newer version](/blog/2006/06/03/bypass-hotlink-blocking-when-displaying-a-feed-beta-2/)._

In my quest for making a feed parser that is intelligent, simple, and graceful, one thing that has always bugged me about online feed readers is that some people disable the ability to hotlink images.

Now, I understand why they do this, because I do it too. You don’t want a bunch of your bandwidth sucked up by people who are stealing your images for their own nefarious purposes (mwah-hah-hah!). Rather, you’d prefer to keep the images for _your readers who are reading your content_. Well, that’s exactly what a feed parser is for, right?

Desktop aggregators like [Feed Demon](http://www.feeddemon.com) and [NetNewsWire](http://ranchero.com/netnewswire/) are always able to just load up the images in context with the post that they’re reading, and it all makes sense. The only reason why online feed readers have a problem is because the browsers that run them respect the hotlinking rules—even if the reasons don’t make sense for the context (like trying to apply laws about CD’s to MP3’s—although they’re related, they’re different, and the rules need to be modified for the new medium).

So, we’ve decided to solve the problem in our latest release. Here’s how to bypass hotlink protection for feeds that you’re trying to read online. We’ve added a new function called `display_image()` that will take the URL of the image and display it—blocked or not.

Here’s how it’s done. First we want to take our page (I’ll be using the demo page that is included with the SimplePie download), and make a small modification to the head of the page. We’re going to take the source code, and add the bolded part below:

```php
<?php
// Start counting time for loading...
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include('simplepie.inc');

// Parse it
$feed = new SimplePie();
if (!empty($_GET['feed'])) {
    $feed->feed_url($_GET['feed']);
    $feed->init();
    if (!headers_sent() && $feed->get_encoding()) {
        header('Content-type: text/html; charset=' . $feed->get_encoding());
    }
}
else if (!empty($_GET['i'])) {
    $feed->display_image($_GET['i']);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo
What did we just do?  We told the page that:

If we're not passing the feed parameter to the page (like index.php?feed=url_goes_here), then check for the i parameter.  (I chose i because it's short for "image".  You can choose anything you want.)
If the i parameter exists, pass it to the display_image() function.

The display_image() function is an exception to standard SimplePie processing in that it doesn't return any value.  It automatically echo's the image content to the page.  So, if load up our page like index.php?i=url_of_image, we should see the image— and only the image—on the page.
Now, we just need to modify the value of all the <img src="" /> tags on the page, so that they all get passed through our new script.  Specifically, we're looking for all off-site images, not our own local ones, so let's make sure to target those.
The simplest way is with JavaScript, although you're free to use other languages if you prefer.  I wrote something that looks like this (I assumed an XHTML page, and I'm using an anonymous function):

<script type="text/javascript">
//<![CDATA[

(function(){

    // Get an array of all of the <img> tags in the page
    var img = document.getElementsByTagName('img');

    // Count how many there are, and store that number for faster processing
    var imgLength = img.length;

    // Loop through all of the images.  Unfortuately, JavaScript doesn't have a foreach() function.
    for (var x=0; x<imgLength; x++) {

        // Check to make sure that the image we have is off-site
        if (img[x].src.substring(0,4) == 'http') {

            // Pass the URL as the value for the 'i' parameter.
            img[x].src = '?i=' + img[x].src;
        }
    }
})();

//]]>
</script>
```

If you place this script at the very bottom of your page, right above the closing `</body>` tag, the script will re-write your external image URL's to have them pass through our function, and they'll all show up on your feed reader page, just like they do in the desktop aggregators.

Have fun! This code has been implemented in the demo that comes with the [SimplePie 1.0 Beta download](/downloads/).

</div>

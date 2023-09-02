+++
title = "Bypass “hotlink blocking” when displaying a feed (Beta 2)"
date = 2006-06-03T10:15:00Z

[extra]
author = "Ryan Parman"
+++

**Requirements:** SimplePie 1.0 Beta 2

<div class="chunk noborder">

In my quest for making a feed parser that is intelligent, simple, and graceful, one thing that has always bugged me about online feed readers is that some people disable the ability to hotlink images.

Now, I understand why they do this, because I do it too. You don’t want a bunch of your bandwidth sucked up by people who are stealing your images for their own nefarious purposes (mwah-hah-hah!). Rather, you’d prefer to keep the images for _your readers who are reading your content_. Well, that’s exactly what a feed parser is for, right?

Desktop aggregators like [Feed Demon](http://www.feeddemon.com) and [NetNewsWire](http://ranchero.com/netnewswire/) are always able to just load up the images in context with the post that they’re reading, and it all makes sense. The only reason why online feed readers have a problem is because the browsers that run them respect the hotlinking rules—even if the reasons don’t make sense for the context (like trying to apply laws about CD’s to MP3’s—although they’re related, they’re different, and the rules need to be modified for the new medium).

So, we’ve decided to solve the problem in our latest release. We’ve added functionality that allows you to bypass hotlink protection for feeds that you’re trying to read online. But that isn’t what’s important. What’s important is that it’s been built in as a configuration option that is enabled by default. You don’t need to do anything to get this to work (and actually, if you’re using the JavaScript from the old version of the article, it may mess this up so be sure to remove it).

However, if you want to make sure it’s working, or otherwise force it to be on, take a look at the following code:

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
    $feed->bypass_image_hotlink();
    $feed->init();
}
$feed->handle_content_type();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo
Have fun!  This code has been implemented in the demo that comes with the SimplePie Beta 2 download.
```

</div>

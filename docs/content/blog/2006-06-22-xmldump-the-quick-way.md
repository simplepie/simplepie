+++
title = "XMLdump the Quick Way (Beta 2)"
date = 2006-06-22T13:55:00Z

[extra]
author = "Ryan Parman"
+++

**Requirements:** SimplePie 1.0 Beta 2

<div class="chunk noborder">

Early in the days of SimplePie development, I built-in functionality that I called “XMLdump” that would dump the post-processed, pre-cached XML to the screen as XML. When a feed is read, there is a certain amount of pre-cleaning we do to make sure that what we’re parsing more closely resembled valid RSS (or Atom). After this pre-cleaning is done, you can invoke XMLdump to see the XML that SimplePie will actually be parsing, just before it’s parsed.

The only currently documented way is to use the [enable_xmldump()](/docs/reference/config/enable_xmldump/) configuration option. There is another way (as of Beta 2) to quickly snap your SimplePie-enabled pages into XMLdump mode. If the page’s URL already has a querystring appended to it (page.php?keyword=value&keyword2=value2), you’d append `&xmldump=true` to the end of the URL. If it’s a normal page with no querystring, append `?xmldump=true` to snap it into XMLdump mode.

This only works under two conditions:

1.  The first thing in the source code must be a PHP block where SimplePie is being initialized. There cannot be any spaces or linebreaks, because that would throw a warning.
2.  The second is that this was designed for a single feed per page. As such, if you have multiple feeds on a page, this will only display the first one. This is true for the whole XMLdump mode, not just this little trick.

How do the SimplePie plugins work with this? Let’s see. Testing version 1.2 of the plugins:

- **Textpattern:** Perfect
- **WordPress:** Kicks in after content has already been sent to the browser. As such, you get an XML error, but if you dig into the source, you can see the feed contents.
- **Mediawiki:** Doesn’t even try to do anything (at least with the non-clean URLs).

We’ll be looking into working this out in an upcoming version of our plugins.

So there you go. XMLdump has been a very handy debugging tool for us, and hopefully it can help you too.

</div>

+++
title = "Coming in Beta 2: Embedded Enclosures"
date = 2006-04-12T13:25:00Z

[extra]
author = "Ryan Parman"
cover_image = "/images/128/loop.png"
cover_image_alt = "Music"
+++

One of the new features coming in SimplePie 1.0 Beta 2 is embedded enclosures. What are embedded enclosures, you ask? Simple. When people publish podcasts and videocasts, they do so by adding an enclosure tag to their feed that tells the feed reader where to find the podcast.

The next release of SimplePie will be able to handle these podcasts in two different ways. The first is the way that it currently handles them — it produces a URL that points to the podcast so that you can create a link with it and whatnot. The other way is to embed them directly into the page, so that people can listen to them without having to download and load into a separate player.

Currently, we have support for all filetypes supported by QuickTime and Flash (which should cover most types of enclosures), as well as an integrated Odeo Player for Odeo RSS feeds. You can check out some [screenshots](http://flickr.com/photos/skyzyx/sets/72057594100877522/) whenever you get a chance. What we haven’t yet added (but is on the list) is support for Windows Media files. This support will be added as soon as I can find a feed with Windows Media enclosures to test with. 🙂

We’re also aware of the update that Microsoft pushed out yesterday for Internet Explorer that implements the changes required by the [Eolas lawsuit](http://www.devx.com/webdev/Article/30154?trk=DXRSS_WEBDEV). Our current embedded enclosures support is affected by this change, so we’re working to update the code to bypass the warning for the benefit of Internet Explorer users everywhere.

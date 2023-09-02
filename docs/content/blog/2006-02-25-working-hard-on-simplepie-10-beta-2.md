+++
title = "Working hard on SimplePie 1.0 Beta 2"
date = 2006-02-25T23:41:00Z

[extra]
author = "Ryan Parman"
+++

It’s still in development, but we’re working hard on Beta 2. At the moment, Geoffrey is stripping out what little remaining “Parman code” is left from the 0.9x releases, and replacing it with all kinds of pure OO goodness. This will definitely mean some syntax changes when the release becomes available, but we believe that these are necessary changes that need to be made in order to preserve the longetivity of SimplePie.

Our focuses are still speed and ease of use, but things like improved compatibility are also high on the priority list. One of the big pushes for this release is improved Atom 1.0 support. There are some parts of the Atom 1.0 spec that are more complicated to implement, so it’s taking a bit more time to make sure it all works as expected, but we want to make sure that we do it right. If you come across any feeds that are rendering funky with SimplePie, please let us know about it at the forums.

SimplePie is not a validating feed parser, meaning that it doesn’t care if your feed follows the spec or not. We more-or-less subscribe to the Mark Pilgrim school of thought that feeds should be parsed at all costs—to a reasonable extent. It’s not the reader’s fault if the publisher is a moron and can’t put a feed together properly. Generally, if the feed resembles valid XML, we’ll do our best to parse out the feeds we support (we never had the intention of supporting ALL elements either—just the most commonly used ones, although that seems to be changing with these 1.0 pre-releases). The only reason we wouldn’t is if the feed is so bad that making the changes to SimplePie in order to parse out the feed would be unreasonable. I know this kinda follows the way Internet Explorer has traditionally handled HTML (which is generally regarded as a bad, bad, very bad thing), but it’s the publisher that should be educated—not the reader who should be punished. Maybe we’ll change our “damage control” handling so that it only kicks in if an error was encountered on the first pass of the feed… we’ll see.

Additionally, one of our desires is to add developer hooks into SimplePie that will allow people like you to add support for elements and microformats that go beyond RSS 0.9x/1.0/2.0x and Atom 0.3/1.0. Custom namespaces like media:, dc:, sy:, and the iTunes podcast stuff are things that will be left up to extensions, so that we can focus on improving things like parsing, caching, speed, feed detection, and RSS/Atom specs. Again, this functionality is still on the drawing board and may or may not ever make it into SimplePie, but that’s something we really want to add as soon as we can figure out the best way to go about it.

Be sure to visit the support forums if you have bugs, feature requests, or just have an opinion about SimplePie—positive or negative. We want SimplePie to be the best software in it’s genre, but we can’t do that without feedback. If you’re a blogger, keep blogging about it. We also keep track of what people are saying through services like del.icio.us, Technorati, and our stats-tracking software, so please keep talking. We’re listening.

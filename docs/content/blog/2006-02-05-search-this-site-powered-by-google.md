+++
title = "Search this site, powered by Google"
date = 2006-02-05T08:59:00Z

[extra]
author = "Ryan Parman"
cover_image = "/images/128/search.png"
cover_image_alt = "Search"
+++

I decided to try my hand at adding a way to [search this site](/search/). The two that I really took a look at were [Yahoo](http://search.yahoo.com) and [Google](http://google.com). I decided to start with Yahoo, since they have an HTTP GET [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) interface that’s easy to work with, and the resulting XML can be easily parsed with [XMLize](http://hansanderson.com/php/xml/), my favorite software for XML parsing.

I was able to get the Yahoo site search up, running, and fine-tuned in just a couple of hours (got it functional in 20 minutes, and spent the rest of the time tweaking it). That was great and all, but it seems that Yahoo only has about 3 pages of [SimplePie.org](http://simplepie.org) indexed. I went ahead and submitted this site so that it would be indexed, and decided to just wait. That was 2 weeks ago.

So yesterday, I decided to take a look at Google’s search. At first, I was hesitant because Google uses a [SOAP](http://en.wikipedia.org/wiki/SOAP) interface which always seemed like a pain to use, so I always shyed away from it and went for REST interfaces instead. I took a brief look at MSN search as well, but they also use SOAP, so I figured I’d stick with the lesser of the two evils, and go with Google.

I had some problems initially because I just switched SimplePie.org from PHP 4.4.1 to 5.0.4 yesterday, and apparently the PEAR extensions (that handle SOAP requests) are in a different spot than they were for PHP 4.x. To make a long story short (or ‘shorter’, rather), I found some software called [NuSOAP](http://sourceforge.net/projects/nusoap) that makes SOAP requests easy. Coupled with that, I also came across an article on Stylegala entitled [“Making a google search engine with standards”](http://stylegala.com/articles/making_a_google_search_engine_with_standards.htm) which uses NuSOAP in its example.

So now, you can search this site for content the same as you would in the real Google, and it’s all powered by the NuSOAP library and a heavily modified version of the script available from Stylegala. It’s still a \*little\* buggy, but I’ll be working to fine-tune it a bit better over the coming weeks. Happy searching!

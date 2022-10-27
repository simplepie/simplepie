+++
title = "How can SimplePie’s API improve?"
date = 2008-03-14T17:21:00Z

[extra]
author = "Ryan Parman"
cover_image = "/images/128/xcode.png"
cover_image_alt = "[Development]"
+++

SimplePie is a tool that I use nearly every single day, in nearly every single project I work on. I use it partially because I work on it, and partially because I really believe that it’s the best tool for the job (when that job is RSS/Atom parsing). At the same time I know that there are things that I do that are very different from what other people are doing with SimplePie, such as processing thousands of feeds at a time, building web-based aggregators, building start pages (a la PopURLs, Original Signal, and others), and doing all sorts of other things that I may or may not even know about.

I know that Geoffrey has talked a bit about SimplePie 2.0’s planned modularity (keeping the fetching, parsing, caching, and API components separate but being able to load them when necessary, or even be able to swap in your own components), and we’d like to see SimplePie 2.0 be better commented and slimmer code-wise, opting to move some of the more superfluous functionality into helpers and other outside classes.

So my big question is: what can we do to make your job easier as it pertains to SimplePie? I know that there are some cool things that we’ve talked about for SimplePie 2.0, but there also things coming in SimplePie 1.2 that are cool. I’ve been thinking about the kinds of things that would make things easier for me and how we could bundle them as on-demand “helpers” instead of necessarily building them into the core (like how our Internationalized Domain Name support is separate).

The first (very simple) thing that comes to mind is a function that that shortens text (e.g. titles and descriptions). This is something that has been asked for hundreds of times and we’ve got some sample code in the wiki for it, but what if we could bundle helpers like this in an on-the-side fashion? What kinds of things would you like to see? What kinds of tasks do you find yourself doing over and over that the community might be able to benefit from?

Perhaps people parsing thousands of feeds might like to have (or contribute) their parsing scripts and/or cron jobs? Perhaps people building feed aggregators would like to see improved HTTP status code messages to know whether they should update a feed URL in a database? Perhaps it’d be nice to have some software-specific helpers for Drupal or CodeIgniter?

Fire away! 🙂

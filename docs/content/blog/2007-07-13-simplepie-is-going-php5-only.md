+++
title = "SimplePie is going PHP5-only!"
date = 2007-07-13T09:15:00Z

[extra]
author = "Ryan Parman"
+++

We’ve had this noted in our [Development Roadmap](/development/) for about 6 months now, but since many people don’t read the roadmap, I want to announce this officially: _SimplePie 1.5 will require PHP 5.2!_ There are a few reasons for this:

1. **Bigger and better things:** There are lots of new things that we want to build to make SimplePie far better than it is today, but we can only do some of those things if we have a reliable codebase to build from. PHP 5.2 is that codebase. We want to be able to reliably strip out potentially dangerous tags and attributes, and we want the good tags to be whitelisted (which is much easier for all of us than the current blacklisting). We want to be able to support new and emerging technologies like [Microformats](http://microformats.org/). We want to be able to reliably shorten titles and descriptions in feeds, while maintaining HTML tags. We could either do a ton of hacking now, or we can move to a codebase that will enable us to do these things “the right way.” We’re opting for the right way.
2. **PHP 4.x End-of-Life:** Today, the PHP team [announced the End-of-Life for PHP 4.x as of the end of the year](http://www.php.net/archive/2007.php#2007-07-13-1). They want everybody to move over to the PHP5 codebase, and what better version of PHP5 to move to than one of the more recent ones.
3. **Go PHP5!** [GoPHP5.org](http://gophp5.org/) points out a number of things about PHP 4 and 5, specifically in the way of encouraging people to drop support for PHP 4.x so that better things can be built with PHP 5 and the upcoming PHP 6. Trying to support 2 platforms is difficult enough, but supporting 3 would be a nightmare. PHP 4.x is old, and we need to look to the future. Kinda like making the move to Web Standards for some people. It was tough to get away from those FONT tags and TABLEs for layout, but once you moved to CSS-based layouts, you realized that the doors just got blown open with all of that potential. Same thing here with us moving to PHP 5.2 and newer.

We’re in the process of fixing the last few bugs in 1.0, and we’ve still got 1.1 and 1.2 releases scheduled. We don’t anticipate having SimplePie 1.5 out before the end of the year anyways, but I wanted to let you all know — several months in advance — that we’re going to be making a move, so everyone should start planning ahead for it. The stuff that we’re wanting to do, and the places we want to take this API are going to be very, very cool, and we want everybody to be able to come with us!

_(One of the requirements of being listed on the GoPHP5! website is state our intention to stop supporting PHP versions less than 5.2 starting February 5th, 2008. While this hard-stop date is a bit silly, we are fully supporting the spirit of this initiative. We will not suddenly strip out support for PHP 4.x in whatever the official release is at the time, but we do expect a PHP5-only release of SimplePie 1.5 in early 2008.)_

It’s a brave new world out there! 🙂

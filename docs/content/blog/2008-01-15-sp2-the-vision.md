+++
title = "SP2: The Vision"
date = 2008-01-15T08:29:00Z

[extra]
author = "Geoffrey Sneddon"
+++

I’m sure that many of you will have by now heard me talking about SP2, whether in the context of how PHP4 is holding us back, or why SimplePie lacks modularity. But what is the idea of SP2? What will it actually have?

- **Modularity**: I made brief mention of this in my previous post, but to go into more detail here: have each and every process in SimplePie properly seperated out (the main reason why this is not the case in SimplePie 1 is that it was never foreseen that we’d ever be trying to parse documents multiple times, or with different parsers. SimplePie 1’s design would make it hard to use different classes for different data formats (be it RSS or Atom feeds; or Atom feed or Atom entry ? the reason why we don’t support Atom entry documents). SimplePie 1 is hacked together in all sorts of places to try and get around limitations caused by this lack of modularity ? the entire options system is a good example (which, ideally, would be on a seperate object that could just be passed around by reference).
- **Expandability**: Adding anything to SimplePie 1 is very complex, in part due to the insane number of circular dependancies within the code-base. It is also difficult to add implementation specific functionality into SimplePie itself, as the only solution is to override classes/methods, which are often very large on their own. A likely solution to this would be some sort of plugin system.
- **Resource Efficiency**: While any feature will have a computational cost, this cost should be kept to the minimum possible. This should mean caching as much data as possible, as processed as possible.

##### Implementation

A question just a vital as what to actually have is how to implement it ? I would like to propose to have a core that did nothing but call plugins ? a core that was nothing more than a framework to call everything else. The details of the implementation will undoubtedly need to be very well thought out to overcome the short-comings of SimplePie 1 (for example, preferring content from an RSS element in an RSS feed ? something more complex than you might expect to implement if you want to avoid duplicating vast amounts of code). The modularity will also allow the parser to be truly used on its own, something that could never be done with SimplePie 1.

The details of the implementation inevitably run on to the question of _who_ is going to implement it ? because of the modularity there is far less need for a single person to deal with a monolithic beast (like SimplePie 1), and different people can work on different parts. I, myself, will likely keep up the [XML5](http://annevankesteren.nl/2007/10/xml5) and [HTML5](http://www.whatwg.org/specs/web-apps/current-work/) parsers, as well as Unicode (including decoding non-Unicode formats) and IRI support (which will probably just map IRIs to URIs on PHP5, and store IRIs natively on PHP6). This means that undertaking any work on SP2 doesn’t mean making such a big commitment as that of undertaking any work on SimplePie 1 (though, inevitably, help with the either is warmly welcomed).

##### My Involvement

A lot of people have questioned what exactly my role will be within SimplePie, and part of the issue was some of the finer details weren’t finalised as of my previous post. So:

- **SimplePie 1** maintenance was taken over by Ryan following the release of SimplePie 1.1, though there will likely be a second developer leading development of SimplePie 1. I, myself, will continue to make occasional small bug-fixes, though little more (as the case has been for several months now).
- **SP2** will initially be developed by me, though I expect to leave the role of lead developer after the core is done (though it will not have reached feature-parity with SimplePie 1). SP2 will be developed from a [distributed version control system](http://betterexplained.com/articles/intro-to-distributed-version-control-illustrated/) ? most likely [Mercurial](http://www.selenic.com/mercurial/), though [git](http://git.or.cz/) is also an option if people would prefer to use that. The current intention is that I will maintain the authoritative tree while all my minions do the coding for me.

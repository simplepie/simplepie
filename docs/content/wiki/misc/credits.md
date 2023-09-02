+++
title = "SimplePie Credits"
+++

SimplePie would never have become a reality if it wasn't for the fantastic work, feedback, and overall fanaticism of our users!

## Development Team Bios {#development_team_bios}

### Ryan Parman (Skyzyx) {#ryan_parman_skyzyx}

Ryan is the creator, co-developer, and evangelist for the SimplePie project. After Geoffrey came on board in June 2005, Ryan began to shift from a development-focused role to a people-focused role, where he currently works to ensure that people are aware of, and can easily understand and use SimplePie through support, documentation, tutorials, plugins, and evangelism.

He is also the co-founder of LifeNexus Digital, a startup in the digital media space that is developing a new service called [WarpShare](http://warpshare.com/) — a viable commercial solution that solves the ever-increasing rift between labels, studios, advertisers, and digital media consumers like you and me.

Besides SimplePie and WarpShare, Ryan was the lead front-end developer for the Spring '08 re-launch of the [Yahoo! Messenger](http://messenger.yahoo.com/) website. He also had his 15 minutes of web developer fame as the guy who packaged the [standalone versions of Internet Explorer](http://en.wikipedia.org/wiki/Internet_explorer#.22Standalone.22_Internet_Explorer) into easy-to-use bundles and made them available on his website before handing them over to [Evolt's browser archive](http://browsers.evolt.org/?ie/32bit/standalone), [Quirksmode](http://www.quirksmode.org/browsers/multipleie.html), and [Tredosoft](http://tredosoft.com/Multiple_IE) to distribute.

Ryan's background is as a front-end web developer with substantial experience with web standards, layered semantic markup, working with <abbr title="Extensible Markup Language">XML</abbr>/JSON/<abbr title="Hypertext Preprocessor">PHP</abbr>/REST-based web services, and content syndication and aggregation. He is experienced with organic SEO methods, front-end performance tuning, and usability and user-centered design principles. Ryan is participating in the [W3C HTML5 Working Group](http://www.w3.org/html/wg/), as well as the discussion lists for the [RSS Advisory Board](http://www.rssboard.org/), the [Data Portability](http://www.dataportability.org/) initiative, [Microformats.org](http://microformats.org/), and other industry groups. Ryan is a vocal and financial supporter of the [Electronic Frontier Foundation](http://eff.org/) and [Creative Commons](http://creativecommons.org/).

Ryan lives in California's [Silicon Valley](http://maps.google.com/?ie=UTF8&ll=37.463959,-121.966095&spn=0.770644,1.661682&z=10) with his wife and kids, is a Christian and a [prefectionist](http://www.thinkgeek.com/tshirts/generic/894a/), has a very snarky and sarcastic sense of humor, has a technically-oriented [INFJ](http://www.typelogic.com/infj.html) personality type, and doesn't vote down party lines.

You can find more about Ryan at <http://ryanparman.com/>.

### Geoffrey Sneddon (gsnedders, Error 404) {#geoffrey_sneddon_gsnedders_error_404}

Geoffrey joined development of SimplePie in June 2005 to help with the development of SimplePie 0.97 (later renamed “1.0 Preview Release”). Geoffrey pretty much drove nearly all the development of that release and continued to do so until the release of SimplePie 1.1, after which he [stepped down](/blog/2007/12/28/byepie/ "http://simplepie.org/blog/2007/12/28/byepie/") from development of SimplePie 1, moving on to focus on SimplePie 2, the first complete rewrite of SimplePie since 0.90 was released in 2004. Geoffrey is a <abbr title="Hypertext Preprocessor">PHP</abbr> wizz-kid who has really focused on ensuring that SimplePie is fully standards compliant, does what it's supposed to do, is relevant in the real world, and is as fast as it can possibly be.

Geoffrey is 15 and lives in Scotland with his parents, and often ends up doing [the fish slapping dance](http://en.wikipedia.org/wiki/The_Fish_slapping_dance) with Ryan in <abbr title="Internet Relay Chat">IRC</abbr>. He is unbelievably witty, has an [INTJ personality type](http://www.typelogic.com/intj.html), and is Hixie's protégé <sup><a href="#fn__1" id="fnt__1" class="fn_top">1)</a></sup>, spending his spare time making standards suck less.

You can find out more about Geoffrey at <http://gsnedders.com/>.

### Steve Minutillo {#steve_minutillo}

Steve joined development of SimplePie in January 2008 shortly after Geoffrey left development of SimplePie 1. He had previously provided a whole manner of bug reports and patches and generally been a useful guy. Nobody seems to know much about him, though you can find a little more about him at <http://minutillo.com/steve/>.

### Michael Shipley {#michael_shipley}

You can find out more about Michael at <http://www.michaelpshipley.com>

### Ryan McCue {#ryan_mccue}

You can find out more about Ryan M. at <http://cubegames.net/>

## Feedback, Suggestions, and Patches {#feedback_suggestions_and_patches}

- [Bob Aman](http://sporkmonger.com/articles/2006/02/27/directory-of-feed-parsers), [Phil Ringnalda](http://weblog.philringnalda.com/2006/01/09/another-google-loser-heard-from#comments), [Bruce McKenzie](http://www.bioneural.net/), [Peter Janes](http://peterjanes.ca/), [Bert Garcia](http://hcgtv.com/), [Steve Minutillo](http://minutillo.com/steve/), Ivo Beckers, “internet_star”, Mark IJbema, Alexander Turcic and others I've forgotten over the years.

## Code/Software {#codesoftware}

- **[MagpieRSS](http://magpierss.sf.net/):**  
  SimplePie started out as a set of functions that sat on top of Magpie. SimplePie would never have been created without it.
- **[IDNA Convert Library](http://phlymail.de/en/downloads/idna/download/):**  
  This library by phlyLabs enables SimplePie to handle Internationalized Domain Names, and it was super-easy to implement. Thanks!
- **[reWork](http://osteele.com/tools/rework/):**  
  This tool has been invaluable in testing regular expressions. Nearly all of the regex code was rewritten to be more efficient by using this tool. Five stars!
- **[Ultra-Liberal Feed Locator](http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator):**  
  The usability concepts in this rant are what drove the development of the ultra-liberal feed locator that we developed for 1.0 Beta.
- **[RSS Auto-Discovery](http://keithdevens.com/weblog/archive/2002/Jun/03/RSSAuto-DiscoveryPHP):**  
  Auto-discovery was a major feature that SimplePie was lacking until I came across this. I hacked in support for discovering Atom and <abbr title="Rich Site Summary">RSS</abbr> 1.0 feeds, but the rest of the software works brilliantly as-is. This piece of software was abandoned in 1.0 Beta, when we replaced it with the ultra-liberal feed locator.
- **[XMLize](http://www.hansanderson.com/php/xml/):**  
  This brilliant piece of software handled all of the <abbr title="Extensible Markup Language">XML</abbr> parsing in SimplePie 0.9–0.96. Instead of breaking down the <abbr title="Extensible Markup Language">XML</abbr> file into a typical array like everyone else, XMLize has some very well thought-out syntax that makes it easy to read attributes, nodes, and subelements.

<div class="footnotes">

<div class="fn">

<sup><a href="#fnt__1" id="fn__1" class="fn_bot">1)</a></sup> No, please don't take this seriously. I have free will from the benevolent dictator Hixie. Sometimes, at least.

</div>

</div>

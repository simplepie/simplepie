+++
title = "Why would I use SimplePie over something else?"
+++

We've spent a tremendous amount of time trying to make SimplePie the best software in its field. Feed syndication is also significantly more complex than some people seem to understand.

There are a variety of competing products out there, but we'll just focus on the ones that we hear the most about.

## MagpieRSS {#magpierss}

Most frequently, we get compared to the current market leader: [MagpieRSS](http://magpierss.sf.net). MagpieRSS came around about 2 years before SimplePie, and was far and away the best thing at the time (for <abbr title="Hypertext Preprocessor">PHP</abbr>). Ryan has also exchanged emails with Kellan (of MagpieRSS) two or three times in the past, and he seems like a nice enough guy. Nothing here is intended to reflect poorly on him, however, if you pit MagpieRSS against SimplePie, SimplePie has a number of distinct advantages:

- **SimplePie is being actively developed.**  
  The most recent development release of MagpieRSS was 2.0-alpha-alpha-alpha back in October 2006. The last stable release was in November 2005.
- **SimplePie doesn't require you to understand the <abbr title="Extensible Markup Language">XML</abbr> guts.**  
  MagpieRSS offers you ONLY a data array based on the guts.
- **SimplePie fully supports AND normalizes all documented versions of <abbr title="Rich Site Summary">RSS</abbr>, and all popular versions of Atom.**  
  MagpieRSS has very limited Atom support, and doesn't do much normalizing.
- **SimplePie can correctly parse Tim Bray's Atom 1.0 feed.**  
  MagpieRSS doesn't come close.
- **SimplePie has a well-trafficked support forum, public SVN repository, and a TON of unit tests.**  
  Does ANYONE know what's going on with MagpieRSS?
- **SimplePie sanitizes the content of the feed to ensure safety against malicious feeds.**  
  MagpieRSS doesn't implement any kind of data sanitization.
- **SimplePie has a less restrictive license than MagpieRSS.**  
  MagpieRSS is licensed under the <abbr title="GNU General Public License">GPL</abbr> which is more restrictive than SimplePie's BSD licensing.
- **SimplePie is contained in a single file for easier portability.**  
  MagpieRSS comes in 4 separate files making it harder to move around without issues.
- **SimplePie supports the detection and embedding of audio and video podcasts including the popular Media <abbr title="Rich Site Summary">RSS</abbr> and iTunes <abbr title="Rich Site Summary">RSS</abbr> elements.**  
  MagpieRSS has no explicit enclosure support.
- **SimplePie supports per-feed settings.**  
  The current MagpieRSS release version does not. [Magpie 2.0-alpha-alpha-alpha](http://magpiephp.com/blog/2006/10/17/magpie-20-alpha-alpha-alpha/) does.

On the flip side, MagpieRSS is a bit faster than SimplePie – that's the trade off. MagpieRSS is faster because it doesn't do as much. According to our internal tests MagpieRSS 0.72 rocks the pants off of everything, but good luck finding out if your data is good. [Magpie 2.0-alpha-alpha-alpha](http://magpiephp.com/blog/2006/10/17/magpie-20-alpha-alpha-alpha/) does more in the way of flexibility and is therefore slower than MagpieRSS 0.72. SimplePie 1.0 already implements pretty much everything that is mentioned in the MP 2.0 blog posting already. In addition, SimplePie does more data sanitization to make sure your data is good to go, and we believe that better data is worth the cost against pure speed. If you don't care about sanitization and just want pure speed from SimplePie, you can use SimplePie's `set_stupidly_fast()` configuration option to skip the cleaning and achieve speeds that are on-par with Magpie 2.0. Our internal tests show SimplePie 1.0 and Magpie 2.0 clocking in neck-and-neck on a variety of feeds.

## SimpleXML {#simplexml}

[SimpleXML](http://php.net/simplexml) is a PHP5 extension that makes it easy to parse <abbr title="Extensible Markup Language">XML</abbr> documents. Unfortunately, <abbr title="Rich Site Summary">RSS</abbr> and Atom feeds are rarely, if ever, correct <abbr title="Extensible Markup Language">XML</abbr> documents. It doesn't do anything other than parse, and it doesn't normalize anything. SimplePie wails on this one:

- **SimplePie intelligently switches between fsockopen() to cURL to fetch feed data.**  
  SimpleXML can't retrieve files.
- **SimplePie utilizes <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> Conditional Get and data serialization for an optimal caching system.**  
  SimpleXML can't cache.
- **SimplePie can locate feeds for websites with its ultra liberal feed locator.**  
  SimpleXML can't locate anything.
- **SimplePie can parse imperfect <abbr title="Rich Site Summary">RSS</abbr> and Atom feeds.**  
  SimpleXML can't parse anything that isn't perfect <abbr title="Extensible Markup Language">XML</abbr>.
- **SimplePie sanitizes the content of the feed to ensure safety against malicious feeds.**  
  SimpleXML can't sanitize anything.
- **SimplePie works well under <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 and newer.**  
  SimpleXML requires PHP5 to function.

Need I go on?

## Universal Feed Parser {#universal_feed_parser}

[Universal Feed Parser](http://feedparser.org) is pure awesomeness… but it's written in Python so if you're writing a site in <abbr title="Hypertext Preprocessor">PHP</abbr> it isn't that much use.

## Google AJAX Feed API {#google_ajax_feed_api}

- [Why should I use SimplePie Live! over something else?](@/wiki/live/faq/why_should_i_use_simplepie_live_over_something_else.md)

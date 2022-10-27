+++
title = "Goals for SimplePie 2"
+++

Over the past four years or so, SimplePie has grown from a completely unknown set of functions sitting on top of MagpieRSS to one of the world's most popular feed parsers with thousands and thousands of users all over the world. Also in that time, SimplePie has started to outgrow its architecture. People use SimplePie for all sorts of tasks that we never really anticipated, so we believe we've now reached a point where it's time for a reset.

SimplePie 2 is currently in the planning stages, and is both a fork and a ground-up re-write of SimplePie. The intention is to enhance the performance by trimming the fat, to build something more extensible, to make it easier to contribute, and to optimize for the kinds of tasks that we see people wanting to do frequently. The purpose of this document is to put together a list of goals for SimplePie 2 that will improve the overall project as a whole, and unshackle some of the early design decisions which now seem to be holding us back.

That being said, I took some time to write down some thoughts about what should go into SimplePie 2, and I would really like to get your thoughts as well. Are there things that SP2 should do that SP1 doesn't? Would you like to use SimplePie in ways that are currently more difficult than they should be? Are you somebody who has a different design philosophy and you think we should pay better attention to certain things? This is your chance to weigh in with your thoughts, opinions, comments, and other feedback.

We encourage **everyone** in the SimplePie community to weigh in with their opinions on the next version of SimplePie so that we can make this software by the people, for the people. Feel free to edit, change, and improve what's there. Feel free to argue with what I've written. Please mark your contributions with ”~~ wiki-username” so that we know who to ask if we need clarification on any of the ideas. Just because it's on the list doesn't guarantee it'll get done, but we want to collaboratively share ideas and pick out the best ones.

## The Vision {#the_vision}

The vision of SimplePie 2 is to provide a solid, reliable **platform** for building feed-related tools. This will include not only a robust standard package, but will include the tools and documentation necessary for building industrial-strength functionality on top of the SimplePie platform making it easier for developers to create either standalone web pages or fully-integrated web applications. This will help create a healthy ecosystem for managing syndication in <abbr title="Hypertext Preprocessor">PHP</abbr> with open-source tools.

## Important Areas of Focus {#important_areas_of_focus}

There have been some issues that we've seen over and over again that we want to focus on improving in SP2. These are things that we know that we want to put a lot of focus into for the next version. **If we want a better SimplePie, we need to do it together. The more community effort we get, the better this will be.**

- Continue to provide a simple method for newcomers to simply embed feeds into their websites. However, under the hood, the “ComplexPie” core should be focused on high-performance, individual components that SimplePie pulls together.
- Paying much closer attention to releasing memory when we're done with objects, how that relates to circular references, and if there are better ways of doing the things that we use circular references for (e.g. $feed→get_item(0)→get_feed()→get_item(0)→get_feed()→get_item(0)).
- Focus on improved embed-ability. This means providing loosely-coupled components that developers can integrate separately into their apps (e.g. the parser).
- Developing applications and PopURLs clones requires (a) a need for identifying duplicate content (this is a bit tricky, however), and (b) processing feeds behind the scenes via cron job so that end-users don't feel the hit of a fresh download.
- Providing a solid, well-documented base that allows for extending SimplePie with custom modules. There should be standards and documentation about how to allow custom modules to hook into SimplePie. ALL modules will work this way.

## Functionality {#functionality}

### Base Functionality (i.e. the core package will have this) {#base_functionality_ie_the_core_package_will_have_this}

- **Modular design:** We want to take a Firefox-like approach to this. The most important, most used functionality will be part of the core package, and everything else can be added a là carte (like Firefox extensions). This allows for a clearer separation of components, as well as the ability to write plugins and other custom modules. Because of this design, ALL functionality is comprised of separate modules, but a small group of modules will make up the “standard package.” ~~ skyzyx
  - The “standard package” is a minimal collection of fundamental modules that a person would get if they clicked the download link. ~~ skyzyx
- **Core Module:** This will include important, re-usable stuff that is shared among the core package modules. It will also manage dependencies for new modules. ~~ skyzyx
  - The “Core Module” is the core of SimplePie 2 and is nothing more than a loader for other modules. \*Everything\* else is a module. The Core Module should also manage dependencies and version requirements. “Probably doing a reverse, post-ordered, depth-first search” ~~ gsnedders/skyzyx
- **Configuration Module:** Manages the setting/getting of configuration options. Extensible so that third-party modules can have custom settings set this way. ~~ skyzyx
  - This should be relatively simple to have, but something I think we should have. The question if nothing else is if we it accessible from, say, an item level, does changing options there have an effect elsewhere, or just on that item? ~~ gsnedders
  - Is there a use-case where something like this might be valuable? ~~ skyzyx
- **IRI Module:** We need to cope with converting Internationalized Resource Identifiers (IRIs) to their absolute counterparts as well as mapping IRIs to URIs for the sake of <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> (e.g. möbius.com). ~~ skyzyx/gsnedders (Currently in development: <http://hg.gsnedders.com/iri/>)
- **Character Transcoding Module:** Handles on-the-fly conversions between character encodings. Will continue to use UTF-8 internally. Uses the built-in `iconv` support by default, but will be enhanced by `mbstring` support. ~~ skyzyx
  - On the whole I don't like iconv because we can't guarantee we'll comply to <abbr title="Extensible Markup Language">XML</abbr> (behaviour is system dependent); mbstring is better because it is only dependant on <abbr title="Hypertext Preprocessor">PHP</abbr> version; but what is better still is \<<http://hg.gsnedders.com/Unicode/>\>. :) Hopefully, that'll be able to cope with virtually anything of sufficient complexity to not be able to be done from a UCM/CharMapML file at reasonable expense, and use a UCM/CharMapML file otherwise. ~~ gsnedders
  - I suggest `iconv` because it's built into PHP5, and `mbstring` as an enhancement because it's not. If we can provide the same functionality without the extension dependencies and not take a large performance hit, I think this is a good idea. ~~ skyzyx
- **Parsing Module:** Parses conformant feeds into a standard internal data structure. Uses the same namespace-based organization as SP 1.0. ~~ skyzyx

<!-- -->

- That's very inefficient. What we ought to do, now we can on PHP5, is use the <abbr title="Document Object Model">DOM</abbr> extension. Also, I think we should go beyond conformant feeds, and use XML5 to parse anything (we should be able to use libxml's <abbr title="Extensible Markup Language">XML</abbr> 1 parser first and fallback to our XML5 parser, as the libxml parser be quicker), though the XML5 <abbr title="specification">spec</abbr> needs to be more written. ~~ gsnedders
- We should definitely use <abbr title="Document Object Model">DOM</abbr>. For <abbr title="Rich Site Summary">RSS</abbr> feeds, I think it would do a better job with oft-ill-formed <abbr title="Extensible Markup Language">XML</abbr> than SimpleXML (which I prefer when I know the data is clean). In regard to XML5, my understanding is that it still has a ways to go. I understand the <abbr title="World Wide Web Consortium">W3C</abbr> process enough to know that there should be some solid implementations in place, but I'm not aware of how far along the path the <abbr title="specification">spec</abbr> is. ~~ skyzyx
- **Core <abbr title="Application Programming Interface">API</abbr> Layer Module:** Translates the internal data structure into logical <abbr title="Application Programming Interface">API</abbr> methods that third-party developers interact with. This “core” module will cover the normalization of various <abbr title="Rich Site Summary">RSS</abbr>/Atom data types, [hAtom](http://microformats.org/wiki/hatom), and should include all supported data types. ~~ skyzyx
- I, as part of having everything as a module, would prefer that Atom and <abbr title="Rich Site Summary">RSS</abbr> were different modules (maybe to the extreme of Atom 0.3, Atom 1.0, <abbr title="Rich Site Summary">RSS</abbr> 0.90, <abbr title="Rich Site Summary">RSS</abbr> 1, and <abbr title="Rich Site Summary">RSS</abbr> 2 all being different modules). Then we can have the fun of having it all coming together in one <abbr title="Application Programming Interface">API</abbr>. Also, I'd rather almost anything returned an object with several methods, dependant on the loaded modules, giving methods like ::get_xhtml(), ::get_html(), and ::get_text(). ~~ gsnedders
- That's an interesting way to solve a problem such as whether titles should be text or <abbr title="HyperText Markup Language">HTML</abbr>, but I fear the added complexity another layer of subclasses would provide. I'm wondering if there's value in using something like `__toString()` to provide a default value along with subclasses.

### Extended Functionality (i.e. non-standard, optional modules) {#extended_functionality_ie_non-standard_optional_modules}

- **<abbr title="Hyper Text Transfer Protocol">HTTP</abbr> Module:** Handles requesting data over <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> (with proper <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> 1.1 support), and can understand and format the response into something more usable. Based on cURL, and supports curl_multi_exec() for parallel fetching of feeds. Should also have support for proxies, <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> basic auth, and <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> digest auth. ~~ skyzyx (Will be based on RequestCore: <http://requestcore.googlecode.com/svn/trunk/>)
  - I'd rather not use cURL. I've had too much bad experience with it. That <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> class is also rather useless in the real world, and doesn't really even work well for some stuff valid per <abbr title="Hyper Text Transfer Protocol">HTTP</abbr>/1.1. ~~ gsnedders
  - I'd much prefer to use cURL. Leveraging `curl_multi_exec()` will substantially improve the fetch times for MultiFeed users because it can fetch in parallel. I'm hoping that we can determine the issues it has with <abbr title="Hyper Text Transfer Protocol">HTTP</abbr>/1.1 and improve it to make a more robust standalone fetching class. Although cURL seems to be fairly widely supported, I'm certainly interested in including baseline fetching support using another method. It's just that using `fsockopen()` has caused increased maintenance that I'd prefer to avoid moving forward. ~~ skyzyx
  - I've moved these to “Extended” instead of “Standard” as our focus should be on the parsing instead of fetching the data. Fetches should be manual.
- **Caching Module:** Extensible caching system that manages functionality, along with an actual caching plugin (file-based). ~~ skyzyx (File-based, APC, Memcache, MySQL, PostgreSQL, and SQLite caching will be based on CacheCore: <http://cachecore.googlecode.com/svn/trunk/>)
  - This for the most part looks fine. However, how are we going to cache? Using the <abbr title="Document Object Model">DOM</abbr> extension we have cheap enough <abbr title="Extensible Markup Language">XML</abbr> parsing to just save <abbr title="Extensible Markup Language">XML</abbr>, but then do we cache processed content (like sanitized <abbr title="HyperText Markup Language">HTML</abbr> content)? ~~ gsnedders
  - Provide separate cache files for each feed item, much like how we do for MySQL caching in the trunk. We would still need a way to keep track of which items are in the feed though. This is easy with a <abbr title="Structured Query Language">SQL</abbr> system, but a bit more challenging with a flat cache (File, APC, Memcache). Alternatively, flat caches are better for storing large chunks of data for the long term. We need to find the proper balance between the two and make sure they're well supported.
  - It will be great to have control over caching, lets say option to re-cache or completely remove it. ~~lev
    - Re-caching would simply be a matter of providing a method to delete the existing cache. When the page loaded, the feed would automatically re-cache as long as caching is enabled. Deleting the cache is exactly the same process.
  - I've moved these to “Extended” instead of “Standard” as our focus should be on the parsing instead of caching the data. Caches should be manual.
- PDO-based <abbr title="Structured Query Language">SQL</abbr> caching module, <abbr title="Structured Query Language">SQL</abbr>/Hybrid caching module (higher performing than pure <abbr title="Structured Query Language">SQL</abbr> caching, but more complex), APC caching module, Memcache caching module (?). Will sit on top of the core Caching module. ~~ skyzyx (See “Caching Module” above for details.)
  - By “<abbr title="Structured Query Language">SQL</abbr>/Hybrid” I mean a more scalable <abbr title="Structured Query Language">SQL</abbr>-based cache where BLOBs are stored as files and pointers are stored in <abbr title="Structured Query Language">SQL</abbr>. For small-scale aggregation, pure <abbr title="Structured Query Language">SQL</abbr> is fine. But where scalability matters, a hybrid approach will perform much better. ~~ skyzyx
- Ultra-Liberal Feed Locator. Will support a variety of methods above and beyond simple auto-discovery for discovering feeds. ~~ skyzyx
  - I'm in favour of dropping entirely the ultra-liberal feed locator, and just follow <abbr title="HyperText Markup Language">HTML</abbr> 5 (i.e., a link (which can be either an a or link element), with a relationship of “feed” (which is also implied by a relation of “alternate” with @type='application/atom+xml' or @type='application/rss+xml')). (Disclaimer: that is a summary of <abbr title="HyperText Markup Language">HTML</abbr> 5 from memory, and may be wrong.) ~~ gsnedders
- Media <abbr title="Rich Site Summary">RSS</abbr> <abbr title="Application Programming Interface">API</abbr> layer, iTunes <abbr title="Rich Site Summary">RSS</abbr> <abbr title="Application Programming Interface">API</abbr> layer, GeoRSS <abbr title="Application Programming Interface">API</abbr> layer, hAtom <abbr title="Application Programming Interface">API</abbr> layer, Digg <abbr title="Application Programming Interface">API</abbr> layer, Y! Weather <abbr title="Application Programming Interface">API</abbr> layer, Google Calendar <abbr title="Application Programming Interface">API</abbr> layer, and others. ~~ skyzyx
  - These will NOT all be first-party modules. We will need to rely on third-party contributors for many of these. We plan to provide a straightforward <abbr title="Application Programming Interface">API</abbr> for doing so. ~~ skyzyx
- Data Sanitization module. Strips potentially dangerous content, resolves relative paths/URLs, etc. ~~ skyzyx
  - This has to be core, even if it all it does by default is convert relative IRIs to absolute ones. ~~ gsnedders
- Content munging modules such as text shortening, extracting images, and other related things. Caching content images. Finding and caching favicons. ~~ skyzyx
  - These are oft-requested bits of functionality, but have no place in the standard package. These should by developed (by someone) as purely optional modules. ~~ skyzyx
  - Fetching favicons is harder than people realize. <http://nick.typepad.com/blog/2008/11/favicon-hell-sm.html>
- JSON Web Service module that translates the internal data structure into JSON and can serve it efficiently using REST-style methods (same as SimplePie Live!) ~~ skyzyx
  - If we're just using <abbr title="Document Object Model">DOM</abbr> as the internal data structure, what's the diff. from just using x-domain XHR? Really a ECMAScript implementation of a feed reader should be entirely separate, which would allow you to do cool ECMAScript stuff, and not have something <abbr title="Hypertext Preprocessor">PHP</abbr>-like (though admittedly you'd need a proxy to circumvent same origin restrictions on XHR, unless all feeds are served with whatever the suitable Access Control header is (which is also going to be used by XDR, as well as XHR Level 2). ~~ gsnedders
  - I've been keeping a close eye on the X-Domain XHR developments, but browser implementations are nowhere near where they should be. SimplePie should be used to parse on the backend, and if we can generate JSON from the backend, then the data exposure method is less important. It would still allow us to provide a SimplePie Live-like service, but in a much cleaner way. I'd like to move the hosting for this to something more reliable like Mosso or Amazon EC2, but we'll need to be able to generate some sort of revenue before we can afford the move. (Is it worth taking a look at text-only ads to offset the cost of such hosting?) ~~ skyzyx
- I would like to be able to add/remove tags (e.g. add “en” for feeds in english, add “twitter” for feeds coming for twitter), and to filter according to them (retrieve post with “en” but not “twitter”). ~~ ofaurax

### Other Cool Ideas {#other_cool_ideas}

- (I'm not sure where this should go, as I'm a first timer here, but ..) Really looking for good Atompub (Atom Publishing Protcol) support … an <abbr title="Application Programming Interface">API</abbr> for building entries and POST, PUT, DELETing them from collections. – lewen7er9
- Ability to cache favicons and content images to a third-party CDN service such as [Amazon S3](http://aws.amazon.com/s3) (leveraging the third-party [Tarzan](http://tarzan-aws.com) toolkit for example). ~~ skyzyx
  - I don't think something like this should be included at all. It simply requires far too much code to bundle. ~~ gsnedders
  - Perhaps as a non-standard module. If we have an (optional) module for parsing out images and favicons, caching them to S3 would be a simple matter of binding the two. ~~ skyzyx
- I would love to somehow see accurate filtering of duplicates for aggregated feeds ~~ rrhobbs
- I would love to see a module that helps you update a database with feed items based on a set of feed urls (making sure that you are not entering the same items etc. I guess its similar to a database caching ~~ eb
- I'd love for Simplepie to be able to parse larger <abbr title="Rich Site Summary">RSS</abbr> files than currently possible (larger than my memory). I understand this will mean it can't use a method that loads the whole <abbr title="Document Object Model">DOM</abbr> in memory. I however don't fully know the consequences of this. ~~PanMan
- I'd like to see a way of differentiating which entries come from which feed when aggregating feeds. Say if I had an array with appropriate keys eg: `$feeds['twitter'] = “http://twitter.com/username/rss”;` etc.. then I could access that `$key` in the loop to use as a <abbr title="Cascading Style Sheets">CSS</abbr> class name or to do some custom parsing/display of the feed item. ~~ sanchothefat
- It would be great to have support for <abbr title="Cascading Style Sheets">CSS</abbr>-sprites, e.g. for the favicons. If you have a site with, let's say, 90 feeds, there are a lot of <abbr title="Hyper Text Transfer Protocol">HTTP</abbr>-requests decreasing load-time. ~~ marcfalk
  - I understand the performance implications (i.e. [CSS Sprites](http://developer.yahoo.com/performance/rules.html#opt_sprites)). However you can't do spriting on the fly, which means you'd have to pull the favicons and create a sprite ahead of time. You'd have to add this to your <abbr title="Cascading Style Sheets">CSS</abbr>/<abbr title="HyperText Markup Language">HTML</abbr> manually, so I'm not sure how this relates to SimplePie. Clarification?
  - No I see. Well, I just need an opportunity to implement it, right now I cannot? You could add favposition to the array, so that when I e.g. call 'favicon' ⇒ '../images/source.png', I could also specify 'favposition' ⇒ '0px,-52px' … I don't know. Anyway, as you say it probably doesn't relate that much to SimplePie, and it IS possible without integrating it.
  - Oh, you're talking about NewsBlocks. That is a completely separate demo from the SimplePie 2.0 core.

## Module Development {#module_development}

We've had a fairly difficult time finding new developers to help grow this project. The (relatively) recent additions of Michael Shipley and Ryan McCue have been great, but we'd like to grow the team even more to spread the development load (since this a part-time project for everyone involved). I (Ryan P.) think that part of the problem is a 10,000-line <abbr title="Hypertext Preprocessor">PHP</abbr> file. I also think it's due to a lack of complete, in-code documentation.

My suggestion is that, during development, we break out individual modules and work on them independently (I'm definitely open to better ideas about this structure). Modules will need to be included one-by-one, but we could also have a “core” identifier that would load ALL core modules (which should be good for most users, most of the time). Hopefully this development approach would be less intimating to would-be contributors, so people can ease-in a little better.

- SimplePie folder
  - `simplepie.inc.php` (yes, with a `.php` file extension ;) )
  - modules
    - `core.php`
    - `core.api.php`
    - `core.api.rss09x.php`
    - `core.api.rss10.php`
    - `core.api.rss20.php`
    - `core.api.atom03.php`
    - `core.api.atom10.php`
    - `core.api.hatom.php`
    - `core.cache.php`
    - `core.cache.file.php`
    - `core.cache.pdo.php`
    - `core.configuration.php`
    - `core.http.php`
    - `core.interface.php`
    - `core.iri.php`
    - `core.parser.php`
    - `core.unicode.php`
    - `gsnedders.api.cdf.php`
    - `gsnedders.parser.favicons.php`
    - `rparman.api.gcalendar.php`
    - `rparman.api.mediarss.php`
    - `rparman.api.yweather.php`
    - `rparman.cache.apc.php`
    - `rparman.cache.memcache.php`
    - `rparman.cache.s3.php`
    - `rparman.interface.json.php`
    - `rparman.interface.wordpress.php`

## Requirements {#requirements}

- <abbr title="Hypertext Preprocessor">PHP</abbr> 5.1.x (which includes [iconv](http://php.net/iconv))
  - <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2, please! What I was planning on doing would be very hard without <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2, and <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2 is _already_ wide-spread enough (heck, <abbr title="Hypertext Preprocessor">PHP</abbr> 5.3 may be possible as a realistic requirement when SP2 ships). ~~ gsnedders
- [PCRE](http://php.net/pcre) (regular expression support)
  - I'd rather require PCRE with Unicode support compiled in (which it has had by default for several years now). ~~ gsnedders
- [DOMDocument](http://php.net/domdocument) (better than SimpleXML at handling malformed <abbr title="HyperText Markup Language">HTML</abbr>/<abbr title="Extensible Markup Language">XML</abbr> markup)
  - No, it's no better in terms of parsing stuff that isn't well-formed. They use the same parser. The issue is that SimpleXML has had behaviour changes within <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2, and also (used to?) vary on Windows/\*nix OSes. ~~ gsnedders
- Raise the knowledge requirement to something sensible. People should already be able to know how to write and call simple functions, jump in-and-out of <abbr title="Hypertext Preprocessor">PHP</abbr> blocks, write to the page (i.e. output buffer), define simple arrays (indexed and associative), know how to utilize existing constants, and understand the basic parent-child nature of objects and methods/properties. SimplePie is a toolkit for <abbr title="Hypertext Preprocessor">PHP</abbr> developers. It needs to start acting like one.

+++
title = "Internationalized Domain Name support on the trunk"
date = 2006-06-14T21:52:00Z

[extra]
author = "Ryan Parman"
+++

[Bob Aman](http://sporkmonger.com) did a [review of SimplePie](http://sporkmonger.com/articles/2006/02/27/directory-of-feed-parsers) and several other feed parsers a while back. The version of SimplePie he reviewed was Beta 1. Bob’s comments were very helpful in letting us know what was important from software in SimplePie’s genre, and we were able to go back and improve SimplePie Beta 2 significantly because of his feedback.

When we released Beta 2, I sent Bob an email asking him to take another look at SimplePie. Here was my message:

> Bob,
>
> I’d invite you to check out and evaluate the latest version of SimplePie, Beta 2. (<http://simplepie.org>)
>
> We’ve gone back and added support for most of the things you mentioned in the comments from <http://sporkmonger.com/articles/2006/02/27/directory-of-feed-parsers> (among many other things). We’re still going through the feedparser.org unit tests though, but we’d be interested in your thoughts as a critic.
>
> Thanks!

Shortly after I sent him the message, he replied with:

> Heh, I pwned it on my first try:
>
> <http://www.???.com/feed>
>
> 🙂
>
> I tried it on less scary feeds though, it looks like you guys have made a lot of improvements. Good job. Much appreciated.
>
> Cheers,  
> Bob Aman

Bob additionally had this to say on his blog:

> “It’s probably one of the best choices for PHP-based parsers.”

Thanks Bob! But I digress…

Ah boy. [Internationalized Domain Names](http://en.wikipedia.org/wiki/Internationalized_domain_names) (IDN). When I first saw this, I realized it would be an important feature, but knew that for the kind of work that’d take, we would probably have to push it off to SimplePie 1.1. After Googling around a bit, I found a [PHP library that can translate IDN’s into friendlier domain names](http://idnaconv.phlymail.de/) that SimplePie (and more specifically, the CURL extension) can handle.

I decided that with the size of the library, it probably wasn’t something that we’d build directly into SimplePie (especially considering how few people are likely to use it), but if you download and include the library, and enable the `enable_idn()` configuration option, the latest SimplePie trunk build will utilize the functionality without a hitch.

The necessary files are being bundled with the SimplePie trunk build. We’ve also added Bob’s “scary” feed to the demo page for you to check out. As usual, we test the bleeding edge trunk and branch releases for [PHP 4](http://php4.skyzyx.net/simplepie/demo/) and [PHP 5](http://php5.skyzyx.net/simplepie/demo/) on our development domain. For all you bleeding edge folks, happy IDNing!

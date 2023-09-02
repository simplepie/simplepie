+++
title = "Trunk Problems with PHP 4.4.6, 4.4.7, and 5.2.2"
date = 2007-05-10T18:24:00Z

[extra]
author = "Ryan Parman"
+++

**\*Update:** This issue has been worked-around in r706.\*

For anyone who has recently upgraded to PHP versions 4.4.6, 4.4.7, or 5.2.2 (including pretty much everybody on Dreamhost), running the trunk/development version of SimplePie causes something called a “segmentation fault”, which essentially means that PHP crashes when running the trunk/dev version. This does not appear to affect the current stable release (Beta 3.2), nor does it seem to affect any other versions of PHP. If you’re running a different version of PHP and this is happening, please let us know in the “Bug Reports – Trunk” forum.

For those who care about the nitty-gritty details, it seems that these versions of PHP include a new version of PCRE — the Perl-compatible regular expression engine that is used by SimplePie, and some of the regular exressions (particularly the ones that strip RFC822 comments) are causing servers to return an HTTP 500 error.

We’ve filed a bug report to PHP, and we’ll be working on some sort of workaround for this, however in the meantime you can make the following change to the simplepie.inc file. You’ll find it near line 50.

```php
//define('SIMPLEPIE_BUILD', gmdate('YmdHis', SimplePie_Misc::parse_date('$Date: 2007-02-22 14:03:17 -0800 (Thu, 22 Feb 2007) $')));
define('SIMPLEPIE_BUILD', 12345678901234);
```

Apologies to everyone who has been affected by this (ourselves included), and we hope to have this worked out ASAP.

+++
title = "4000 Downloads of Beta 2, Hours Away From Beta 3 Release, More On 1.0"
date = 2006-10-31T16:00:00Z

[extra]
author = "Geoffrey Sneddon"
+++

With Beta 3 just hours away, Beta 2 has reached a mammoth 4000 downloads since June — that’s _over 25 downloads per day_. Not bad for any product, yet alone something with such a limited scope as a PHP library. With such a huge rate of increase of number of downloads, and with Beta 3 coming _very_ soon, we can only hope that that trend continues right up to 1.0 and beyond.

As for Beta 3, there’s very little API breakage, as most of the changes are under-the-hood, so unless you’re modifying SimplePie itself, nothing should be that chaotic. The [release notes](/docs/misc/release-notes/beta3/) give an idea of what the more major changes are.

As was mentioned in the previous post, the Trunk (1.0 “Razzleberry”) has introduced some major API changes, so those of you following trunk — be careful! Some of the methods names may well be changed again before release! As was also mentioned, once 1.0 is out, there will be no API breakage until SimplePie 2.0, and there will be at the very least one minor release on the 1.x branch, and more than likely more. See our [plans for versioning](/blog/2006/06/19/how-dowill-simplepie-version-numbers-work/).

Lastly, for those of you wanting to add new methods to trunk and send in patches (preferably via the forums), [phpDocumentor](http://phpdoc.org/) comments have started to be added to the existing codebase (you can see the [automatically generated documentation for trunk](http://php5.simplepie.org/phpDoc/)), and we won’t be allowing any patches from here on in that add members/methods if they do not have phpDocumentor comments for them.

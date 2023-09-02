+++
title = "SimplePie Beta 3.2: The Return of the Bugfix Release"
date = 2006-11-24T16:29:00Z

[extra]
author = "Ryan Parman"
+++

Following quickly after Beta 3.1 comes our 3.2 release. Bugfix releases are coming more quickly these days so that people like you and me don’t have to wait 5 months for the next release to fix a bug that was discovered the day after the current release came out (we ended up doing that for Beta 2, and it sucked).

Beta 3.2 fixes two bugs in the current Beta 3 release:

1. [Bug 403](/support/viewtopic.php?id=403) – Occassionally, PHP4’s XML parser will choke on characters that are not part of the current character set, while PHP5’s XML parser will pass them as question marks.
2. [Bug 431](/support/viewtopic.php?id=431) – If a title tag is embedded inside another title tag, or if there are multiple title tags inside of a feed item, SimplePie will use the latter of the two.

Meanwhile, one of the coolest features of Beta 3 is the ability to extend and override the built-in SimplePie classes (parsing, auto-discovery, feed cleaning, etc.). Documentation for those should come shortly. 🙂

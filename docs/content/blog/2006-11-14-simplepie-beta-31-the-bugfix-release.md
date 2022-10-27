+++
title = "SimplePie Beta 3.1: The Bugfix Release"
date = 2006-11-14T15:26:00Z

[extra]
author = "Ryan Parman"
+++

We’re very happy about how few bugs have been reported about our recent Beta 3 release! There have been a few, however, so we wanted to fix them and get them out to you before too long. As we learn about new bugs that can be reasonably fixed on the current branch code, we’ll get bugfix releases out to resolve them in regular intervals. Some issues are a bit bigger and will be fixed in our 1.0 release.

What was fixed here? Mostly just two bugs — both related to our gzip support. One was an issue related to how `fsockopen()` handles gzipped data, the other was how cURL handles gzipped data. There was also some tweaking to improve support for handling a bug in how Microsoft IIS/6.0 sends gzipped data. This isn’t a MUST HAVE update, but if you’ve been encountering issues with gzipped feeds or “incorrect headers”, this should squash those issues.

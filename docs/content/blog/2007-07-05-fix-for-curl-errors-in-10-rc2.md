+++
title = "Fix for cURL errors in 1.0 RC2"
date = 2007-07-05T13:45:00Z

[extra]
author = "Ryan Parman"
+++

A number of people (myself included) have suddenly started having problems with cURL errors when trying to fetch certain feeds. There weren’t any changes to the cURL code between RC1 and RC2, so we’re trying to track down where the issue is coming from. Until then, you can force SimplePie to use fsockopen() instead of cURL by setting the [force_fsockopen(true)](/wiki/reference/simplepie/force_fsockopen) configuration option.

We’ll post an update as soon as we track down the source of the issue.

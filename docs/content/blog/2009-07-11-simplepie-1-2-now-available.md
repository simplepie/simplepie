+++
title = "SimplePie 1.2 now available!"
date = 2009-07-11T02:06:00Z

[extra]
author = "Geoffrey Sneddon"
+++

[SimplePie 1.2 is now available](/downloads/). This release adds a few features that have been requested often, especially caching in MySQL (instead of on the filesystem) and the ability to autodetect more than one feed. Furthermore, a large number of bugs have been fixed, a mixture of low-priority bugs found throughout 1.1’s release-cycle, and a few larger bugs found after 1.1.3’s release.

However, it removes support for hosts that were affected by the libxml2 issue in SimplePie 1.1.1 and below that run PHP versions prior to 5.1.0 (this is as we have a new workaround, which does not subtly change the feed). As a result, any host with a version of libxml2 of 2.7.0 or above with less than PHP 5.1.0 will be broken by this release (however, I expect this accounts for around zero hosts, as I expect those with an up-to-date libxml2 release will equally have an up-to-date PHP release). This leaves our support at better than SimplePie 1.1.1, and (theoretically, at least) worse than 1.1.2 and 1.1.3. Needless to say, this release is API-compatible with previous 1.x releases, so it should be as simple as a drop-in replacement. Feel free to check out the [release notes](/wiki/misc/release_notes/simplepie_1.2) for more details.

The intention after 1.2’s release is to move almost all development work to SimplePie 2 (an announcement concerning that is forthcoming), and as such, lower-priority bug fixes will be accepted into future 1.2.x releases. However, as is the final non-bugfix release of SimplePie 1, regressions are unacceptable, so all patches will have be reviewed by at least one release manager (as of writing, myself and Ryan Parman) and one developer (as of writing, the two RMs and Ryan McCue). One person cannot fulfil both roles for one patch.

Finally, as has been previously announced, SimplePie 2 will require (some as-of-yet undecided version of) PHP 5, so SimplePie 1.2 forms the final feature-release with support for PHP 4. PHP 4, has, however, been unsupported since 2007, so please encourage your host to upgrade (likewise, PHP 5 versions prior to PHP 5.2.10 are unsupported)!

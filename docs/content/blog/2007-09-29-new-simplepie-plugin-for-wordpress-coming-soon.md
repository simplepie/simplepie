+++
title = "New SimplePie Plugin for WordPress coming soon!"
date = 2007-09-29T23:03:00Z

[extra]
author = "Ryan Parman"
+++

There are a TON of people currently using the SimplePie Plugin for WordPress. It is _by far_ the most popular plugin we’ve developed, but it’s also the one that has been most complained about. When we first created the plugin back in the Beta 2 days, I put something together that was simple, basic, and got the job done. If you wanted to do something more complex, you were free to use the normal SimplePie API in your WordPress blogs and templates.

What we’ve learned, however, is that although many people like the hand-holding of this plugin, they want more flexibility as well. There are also a number of features that have been requested that we haven’t been able to integrate without a complete re-write of the plugin. I’ve spent my entire day working on just such a re-write.

Coming soon will be the all-new SimplePie Plugin for WordPress 2.0!

There are several things that this new version addresses:

- A configuration pane under the Options tab in the WordPress software.
- “Multifeeds” support.
- MUCH better control over the plugin’s output. Supports a simple templating system that allows:
  - Simple, easy-to-use tags for nearly every piece of data that SimplePie can output.
  - Support for multiple templates.
  - Global configuration of default values for several configuration options.
  - Ability to override the defaults for any given feed — including giving a feed it’s own output template.
- No need to manually set up cache folders.
- Support for internationalized domain names.
- Support for short descriptions is configurable.
- And more!

While we believe that the long-awaited new version of this plugin is going to be fantastic for WordPress users, we are also announcing today that we will no longer be updating the plugins for Mediawiki and Textpattern. Why? Mostly because we don’t use Mediawiki and Textpattern. There are lots of intricate details about both pieces of software that need to be known and understood in order to make them compelling plugins. We believe that the people who use those software packages are the ones who could do a far better job than we ever could creating plugins for them.

We’re sorry if you’ve been a happy user of either of these plugins and see this as disappointing. There are a few options available: (a) one SimplePie user has manually updated the Mediawiki plugin to support SimplePie 1.0. Since we’ve promised no API breakage for the entire series of 1.x releases, this version of the plugin should be in good shape until SimplePie 2.0 rolls around. (b) There is more than one plugin available for both of these software packages. Take a look at some of the other plugins available, and see if one of them does a better job. It probably will as these plugins were intentionally meant to be very basic. (c) Take over development yourself. I’d be happy to coordinate the hand-off of the plugins to a developer who wants to take the reins. We encourage it, actually! If you’re interested in such a thing, email me, post something here, or post something to the support forums, and we’ll get them handed off to new maintainers.

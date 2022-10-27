+++
title = "Can SimplePie parse microformats like hAtom?"
+++

Although [hAtom](http://microformats.org/wiki/hatom) is designed to allow webpages to be syndicated, parsing <abbr title="Rich Site Summary">RSS</abbr> and Atom data out of <abbr title="Extensible Markup Language">XML</abbr> documents is fundamentally very different from parsing microformats from <abbr title="HyperText Markup Language">HTML</abbr>/<abbr title="Extensible HyperText Markup Language">XHTML</abbr> webpages.

There have been discussions between the SimplePie team, [Alex Hillman](http://dangerouslyawesome.com/) and [Chris Messina](http://factoryjoe.com/blog/) about bringing microformats to SimplePie, but the limitations of parsing <abbr title="Extensible HyperText Markup Language">XHTML</abbr> pages as <abbr title="Extensible Markup Language">XML</abbr> have put those ambitions on hold for the time being.

There are some things on the roadmap for SimplePie 2 that may allow for things like microformats, but we need to take the time to build the proper tools to enable them instead of just trying to hack stuff together.

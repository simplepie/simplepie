+++
title = "Can SimplePie parse raw XML feeds?"
+++

SimplePie is designed to specifically parse <abbr title="Rich Site Summary">RSS</abbr> and Atom feeds, not raw <abbr title="Extensible Markup Language">XML</abbr>. I know that there are popular services like [Last.fm](http://last.fm) and [Amazon](http://amazon.com) that offer data as <abbr title="Extensible Markup Language">XML</abbr> web services, but these data feeds aren't <abbr title="Rich Site Summary">RSS</abbr> or Atom, and therefore SimplePie isn't the right tool for the job. In these cases, we highly recommend a piece of software called [XMLize](http://cvs.moodle.org/moodle/lib/xmlize.php?view=co) that is great at parsing out raw <abbr title="Extensible Markup Language">XML</abbr> in an easy-to-use fashion.

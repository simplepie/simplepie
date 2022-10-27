+++
title = "SimplePie 1.2.1 is Now Available!"
date = 2011-10-14T20:22:00Z

[extra]
author = "Ryan McCue"
cover_image = "/images/128/simplepie.png"
cover_image_alt = "SimplePie"
+++

I’m excited to finally announce the immediate availability of [SimplePie 1.2.1](/downloads/). This release fixes a few bugs, including a major URL parsing bug, where [URLs with query strings were parsed incorrectly](https://github.com/simplepie/simplepie/commit/76b5fd632f40c4516d68f3f1bdabcd76829117cc). For a full list of what has been changed in this version, see [the commits since 1.2](https://github.com/simplepie/simplepie/compare/1.2...1.2.1), and [the issues closed in 1.2.1](https://github.com/simplepie/simplepie/issues?state=closed&milestone=4). This is a recommended upgrade for all users.

[Grab it now to upgrade!](/downloads/)

So now, a quick status update on the project. Our last blog post noted that we were ceasing development, mainly due to the lack of time we had to devote to the project. However, I am pleased to report that [development has been continuing on GitHub](https://github.com/simplepie/simplepie). With the help of users and other developers, hacking has been taking place on our two main upcoming versions (1.2.1 and 1.3), with occasional development on [ComplexPie](https://github.com/gsnedders/complexpie), the future base of SimplePie 2.0.

The major version undergoing changes is the `master` branch [(1.3-dev)](https://github.com/simplepie/simplepie/tree/master). The major change so far is the restructuring of SimplePie into a more maintainable structure, with one file per class. Major thanks goes to [Drak](https://github.com/drak) from the Zikula Foundation for undertaking the main body of work. All the classes have also been changed to use PHP 5 code, including proper visibility for methods and properties, and dropping any deprecated code. There are also a lot more unit tests, with more to come before release.

In addition, the `one-dot-two` [branch](https://github.com/simplepie/simplepie/tree/one-dot-two) continues as the legacy PHP 4-compatible branch, with 1.2.1 hopefully our final release on the branch. Occasional bugfix releases will be made on this branch, but no major development is occurring here. [New issues are always welcome](https://github.com/simplepie/simplepie/issues?milestone=8&state=open)!

Finally, if you’re reading this, the site has finally been migrated to a new server (thanks to [Matt](http://ma.tt/) for hosting!). If any brokenness is noticed, please feel free to file a [bug on the website bug tracker](https://github.com/simplepie/simplepie/issues?milestone=7&state=open). That’s all for now, look forward to the release of 1.2.1 in the upcoming future, and thanks for using SimplePie!

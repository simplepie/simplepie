+++
title = "How do SimplePie version numbers work?"
date = 2006-06-19T12:15:00Z

[extra]
author = "Ryan Parman"
cover_image = "/images/128/xcode.png"
cover_image_alt = "XCode"
+++

We’ve gotten a handful of questions about how SimplePie version numbers have worked in the past, and how we plan to manage them in the future, so let’s go into it. There’s a geek in all of us, I suppose.

- **SimplePie 0.8:** I thought I was almost done with it, so I released a Public Beta. People said that it was easy, but very slow. Need to rewrite parts of it to be faster.
- **SimplePie 0.9-0.96:** What SimplePie 0.1 – 0.7 should have been in the first place. This was just a matter of not understanding what I was getting into before I jumped in head-first with my eyes closed.
- **SimplePie 1.0 Preview Release:** We completely rewrote the entire parsing core for this release. While we were working on it, we were calling it 0.97. We moved from 0.8 to 0.9 when I rewrote the parsing core, so by the same logic we should have moved to 0.10 when we rewrote the core again. But 0.10 is a really ugly version number. We we decided to release it as a pre-beta beta… a preview release.
- **SimplePie 1.0 Betas:** These are pretty straightforward. They’re public betas that are mature, and getting better and better with each release. We’ve already had a Beta 1 and 2, and Beta 3 is coming shortly.
- **SimplePie 1.0 (RC1, RC2, etc.):** This is a release that we would consider fully production-ready. At this point, we will freeze the feature set. We will release it as RC1, and then fix bugs that get reported, and release an RC2 (if necessary). Once we’re pretty bug-free (from what we can tell), we’ll release 1.0 final.
- **SimplePie 1.0.1, 1.0.2, etc.:** These are what we call “point-point releases”, and will exclusively be bug fix releases. In development terms, we will create a 1.0 “branch” and apply all bug fixes to both the branch (which is otherwise unchanged) and the trunk (which is where all new development will happen). No new features or functionality will be added in these releases.
- **SimplePie 1.1, 1.2, etc.:** These are what we call “point releases”, and will be new features and additional functionality. In development terms, this will be the cumulation of all of the work that has happened on the trunk since the last release. All bug fixes that get put into the point-point releases will also end up here.

Hopefully this answers any questions anybody has about our planned versioning for post-1.0 releases. It mostly follows the Mac OS X style (sticks to the v10, each new release is a point release, and bugfixes are point-point releases), and is similar to the [Linux kernel style](http://en.wikipedia.org/wiki/Linux_kernel#Versions), except that we don’t have alternating point-releases for stable and development releases.

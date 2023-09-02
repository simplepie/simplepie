+++
title = "What is SimplePie?"
+++

<div class="warning">

**This page talks about the core SimplePie library, not necessarily our other SimplePie-based products and services.**

</div>

## Setting your expectations properly {#setting_your_expectations_properly}

### SimplePie IS: {#simplepie_is}

- A code library, written in <abbr title="Hypertext Preprocessor">PHP</abbr>, intended to make it ridiculously easy for people to manage.
- An easy to use <abbr title="Application Programming Interface">API</abbr> that handles all of the dirty work when it comes to fetching, caching, parsing, normalizing data structures between formats, handling character encoding translation, and sanitizing the resulting data.
- Free (i.e. no cost) open-source software, with a license more liberal than the <abbr title="GNU General Public License">GPL</abbr>, that was built and improved over the course of years by people who have a passion for good software that makes people's lives easier
- Well documented with a complete <abbr title="Application Programming Interface">API</abbr> reference, tutorials and screencasts for popularly requested uses, and details about the inner workings of the library.
- Always looking for more people to contribute to the project in terms of code, patches, support, and evangelism.
- A solution where we've worked very hard to keep the bar as low as possible for people who want to use it, but at the same time you MUST have a fundamental grasp of the <abbr title="Hypertext Preprocessor">PHP</abbr> language. If you don't know <abbr title="Hypertext Preprocessor">PHP</abbr>, and are interested in getting a handle on the basics, we recommend <abbr title="Hypertext Preprocessor">PHP</abbr> For the Absolute Beginner (begin with parts 1-3, then move onto parts 4-7 making sure you actually \*understand\* them).

### SimplePie is NOT: {#simplepie_is_not}

- A magical solution that will just “do it for you.”
- A copy-paste, “no code required” solution.
- A full-blown feed aggregator like Google Reader, NewsGator Online, Bloglines, and the like.

If you don't know <abbr title="Hypertext Preprocessor">PHP</abbr>, or are not willing to learn <abbr title="Hypertext Preprocessor">PHP</abbr>, SimplePie (the core <abbr title="Application Programming Interface">API</abbr> library) is NOT the right solution for you.

However, SimplePie integrates well with a variety of blogging systems, wikis, forums, and code frameworks. Many of these third-party software packages are more end-user focused, and require less (if any) actual programming. Check out our [SimplePie Plugins and Integration](@/wiki/plugins/_index.md) page to see if SimplePie integrates with software you already use, in a way that doesn't require much programming (if at all).

## SimplePie's Goals {#simplepie_s_goals}

### Be as fast as possible {#be_as_fast_as_possible}

Speed is a big focus for us. The longer something takes, the less likely people are to use it – whether it's the developers using the library, or the end-users using the developer's product. The faster it all runs, the better it is for everybody.

We don't claim to be _the fastest_ (although we certainly strive to be), but rather as fast as possible while balancing the needs of the other three goals.

### Be as easy to use as possible {#be_as_easy_to_use_as_possible}

Just like with speed, the harder something is to use, the less likely people are to use it. For us this extends not only to the programming <abbr title="Application Programming Interface">API</abbr>, but also to our website, our documentation, our code samples, our support forums, and every other aspect of this project. We strive to be as user-friendly as possible in _every_ aspect of working with us.

Specifically in terms of the programming <abbr title="Application Programming Interface">API</abbr>, we've spent a lot of time thinking about the most _useful_ ways to handle blogs, news sites, and podcasts. We've chosen our function and method names very carefully, the order of the parameters very carefully, and made it a point to choose the most intelligent and/or useful defaults so that SimplePie will be “just right” out-of-the-box for 80% of our developers. For the other 20%, we have numerous configuration options available designed to allow you to fine-tune and hack away to your heart's content.

### Be as compatible as possible {#be_as_compatible_as_possible}

Just like <abbr title="HyperText Markup Language">HTML</abbr>, the world of <abbr title="Rich Site Summary">RSS</abbr> and Atom is an imperfect one. If we only handled perfect feeds, we would be completely worthless because we wouldn't be able to handle most of the world's feeds. At the same time, we saw how bad the <abbr title="HyperText Markup Language">HTML</abbr> world got when Microsoft Internet Explorer began accepting anything that even remotely resembled <abbr title="HyperText Markup Language">HTML</abbr> – no matter how horrible or incorrect it was. We don't want to repeat Microsoft's mistake, but at the same time, we can't expect perfection from feeds.

There's also a common misunderstanding among those who build tools for <abbr title="Rich Site Summary">RSS</abbr>: If a feed is imperfect and we throw an error without even _trying_, we're not punishing the feed publisher (like we want to)… we're punishing the person who just wants to read their favorite blog posts or news items. Why do we insist on punishing these people?

So what do we do? SimplePie makes a _reasonable_ effort to correct imperfections in the feed while processing it. If it's too broken, we have no choice but to fail it. But if we can put forth reasonable effort and have it work, The only time when this is an issue is when it's a matter of compatibility vs. standards compliance.

### Be as standards compliant as possible {#be_as_standards_compliant_as_possible}

Much time has been spent on reading specification documents and writing unit tests to ensure that we live up to the goals that the standards bodies have set for us. Whether it's any of the 8 or so versions of <abbr title="Rich Site Summary">RSS</abbr>, or the two major versions of Atom, RFC 822, <abbr title="International Organization for Standardization">ISO</abbr> 8601, RFC 3023 (and more), and we're focused on delivering the most standards-compliant feed-related software available.

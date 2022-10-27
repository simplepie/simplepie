+++
title = "NewsBlocks Demo 2.0"
+++

Recently, websites like [infonary](http://www.infonary.com/), [PopURLs](http://popurls.com/), [1-TM](http://www.1-tm.com/), [TheWebList](http://theweblist.net/), [Miniboxs](http://www.miniboxs.com/), and [Original Signal](http://buzz.originalsignal.com/) have become all the rage. Generally, these sites consist of multiple feeds – each it it's own block on the page. These sites typically consist of a relatively wide range of topics from news to media to technology to whatever else.

<div class="warning">

This tutorial assumes that you're already familiar with using SimplePie, including looping through items.

</div>

## Compatibility {#compatibility}

- Supported in SimplePie 1.1.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 5.0 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## The Code {#the_code}

We're going to create a simplified clone of these kinds of sites that we're calling “NewsBlocks”. This demo leverages the entire front-end development stack (<abbr title="Extensible HyperText Markup Language">XHTML</abbr>, <abbr title="Cascading Style Sheets">CSS</abbr>, JavaScript, <abbr title="Hypertext Preprocessor">PHP</abbr>) and utilizes the [MooTools](http://mootools.net) JavaScript library. You'll need to make sure the enclosed `cache` directory is writable, and you should copy the latest version of simplepie.inc into the enclosed `php` directory.

We've created this demo properly by separating types of code from each other, and we've included an `.htaccess` file along with a small <abbr title="Hypertext Preprocessor">PHP</abbr> document that will gzip-compress the JavaScript libraries before serving them to the browser. This demo includes the latest versions of the aforementioned library.

Besides being relatively simple, the organization, code, and methods used in the demo below should be production-ready.

- [Live Newsblocks Demo](/demo/newsblocks/ "http://simplepie.org/demo/newsblocks/")
- [newsblocks_demo_2.0.zip](/downloads/newsblocks_demo_2.0.zip "http://simplepie.org/downloads/newsblocks_demo_2.0.zip")

## Expectations {#expectations}

This is not, and will not ever be a perfect replacement for the services that it imitates unless YOU do the work to get it there. This is a DEMO that gives you a head-start, but it's up to you to figure out and write the custom code for connecting to databases and enabling cron jobs and the like. Those things will likely never be included because they're complicated and we don't want to get stuck supporting them.

## What are all these files? {#what_are_all_these_files}

In the end, the NewsBlocks Demo only loads `newsblocks.css` and `newsblocks.js`… that's it. These files have been compressed by [YUI Compressor](http://developer.yahoo.com/yui/compressor/) to make them as small and fast as possible. The other files that are in the `/css/` and `/scripts/` directories are generally editable versions of these files. There is also a `build_prep.sh` file which is a shell script I use to copy the editable files, merge them, and compress them into a single, smaller file.

For best performance on the front-end, you should make sure that your edited files are compressed in the same way. If you're not comfortable with doing this, you can always edit the <abbr title="HyperText Markup Language">HTML</abbr> to load the uncompressed versions of the files instead.

## Troubleshooting, Bugs, and Feature Requests {#troubleshooting_bugs_and_feature_requests}

1.  **Missing styles, broken scripts, and 500 errors** - If you're seeing these things, it's likely that your server doesn't like the gzip settings we're using. The simplest solution would be to remove the `.htaccess` files in the `/css/` and `/scripts/` directories. Also make sure that you're not using a web hosting provider that sucks. :)
2.  **Bugs and Feature Requests** - If there's something broken, or if you'd like to see a new feature, let us know about it by filing an issue over at our [bug tracker](http://bugs.simplepie.org).

## Render Options {#render_options}

<table class="inline">
<thead>
<tr>
<th>OPTION</th>
<th>DATATYPE</th>
<th>DESCRIPTION</th>
</tr>
</thead>
<tbody>
<tr>
<th>classname</th>
<td>string</td>
<td>The classname that the <code>&lt;div&gt;</code> surrounding the feed should have. Defaults to <code>nb-list</code> for <code>newsblocks::listing()</code> and <code>nb-wide</code> for <code>newsblocks::wide()</code>.</td>
</tr>
<tr>
<th>copyright</th>
<td>string</td>
<td>The copyright string to use for a feed. Not part of the standard output, but it's available if you want to use it. Defaults to NULL with multifeeds; Use <code>$item→get_feed()→get_copyright()</code> instead.</td>
</tr>
<tr>
<th>date_format</th>
<td>string</td>
<td>The format to use when displaying dates on items. Uses values from <a href="http://php.net/strftime">strftime()</a>, NOT <a href="http://php.net/date">date()</a>.</td>
</tr>
<tr>
<th>description</th>
<td>string</td>
<td>The description for the feed (not the item). Not part of the standard output, but it's available if you want to use it. Defaults to <code>NULL</code> with multifeeds; Use <code>$item→get_feed()→get_description()</code> instead.</td>
</tr>
<tr>
<th>direction</th>
<td>string</td>
<td>The direction of the text. Valid values are “ltr” and “rtl”. Defaults to “ltr”.</td>
</tr>
<tr>
<th>favicon</th>
<td>string</td>
<td>The favicon <abbr title="Uniform Resource Locator">URL</abbr> to use for the feed. Since favicon URLs aren't actually located in feeds, SimplePie guesses. Sometimes that guess is wrong. Give it the correct favicon with this option. Defaults to <code>NULL</code> with multifeeds; Use <code>$item→get_feed()→get_favicon()</code> instead.</td>
</tr>
<tr>
<th>id</th>
<td>string</td>
<td>The ID attribute that the <code>&lt;div&gt;</code> surrounding the feed should have. This value should be unique per feed. Defaults to a SHA1 hash value based on the <abbr title="Uniform Resource Locator">URL</abbr>(s).</td>
</tr>
<tr>
<th>item_classname</th>
<td>string</td>
<td>The classname for the items. Useful for styling with <abbr title="Cascading Style Sheets">CSS</abbr>. Also useful for JavaScript in creating custom tooltips for a feed. Defaults to “tips”.</td>
</tr>
<tr>
<th>items</th>
<td>integer</td>
<td>The number of items to show (the rest are hidden until “More” is clicked). Defaults to 10.</td>
</tr>
<tr>
<th>language</th>
<td>string</td>
<td>The language of the feed. Not part of the standard output, but it's available if you want to use it. Defaults to <code>NULL</code> with multifeeds; Use <code>$item→get_feed()→get_language()</code> instead.</td>
</tr>
<tr>
<th>length</th>
<td>integer</td>
<td>The maximum character length of the item description in the tooltip. Defaults to 200.</td>
</tr>
<tr>
<th>more</th>
<td>string</td>
<td>The text to use for the “More” link. Defaults to “More &amp;raquo;”</td>
</tr>
<tr>
<th>more_move</th>
<td>boolean</td>
<td>Whether the “More” link should move when it's clicked. Defaults to <code>FALSE</code> (i.e. stays in the same place).</td>
</tr>
<tr>
<th>more_fx</th>
<td>boolean</td>
<td>Whether the secondary list should slide or simply appear/disappear when the “More” link is clicked. Defaults to <code>TRUE</code> (i.e. slides).</td>
</tr>
<tr>
<th>permalink</th>
<td>string</td>
<td>The permalink for the feed (not the item). Defaults to <code>NULL</code> with multifeeds; Use <code>$item→get_feed()→get_permalink()</code> instead.</td>
</tr>
<tr>
<th>show_title</th>
<td>boolean</td>
<td>Whether to show the title of the feed. Defaults to <code>TRUE</code>.</td>
</tr>
<tr>
<th>since</th>
<td>integer</td>
<td>A Unix timestamp. Anything posted more recently than this timestamp will get the “New” image applied to it. Defaults to 24 hours ago.</td>
</tr>
<tr>
<th>title</th>
<td>string</td>
<td>The title for the feed (not the item). Defaults to multiple titles with multifeeds, so you should manually set it in that case.</td>
</tr>
</tbody>
</table>

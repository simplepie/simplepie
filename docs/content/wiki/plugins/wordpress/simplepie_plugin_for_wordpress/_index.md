+++
title = "SimplePie Plugin for WordPress"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">SimplePie Plugin for WordPress</a></td>
</tr>
<tr>
<th>Author</th>
<td><a href="http://simplepie.org">Ryan Parman</a></td>
</tr>
<tr>
<th>Plugin Version</th>
<td>2.2.1</td>
</tr>
<tr>
<th>Compatible WordPress version</th>
<td>2.x (2.5 recommended)</td>
</tr>
<tr>
<th>Download</th>
<td><a href="http://wordpress.org/extend/plugins/simplepie-plugin-for-wordpress/">Download</a></td>
</tr>
<tr>
<th>Required SimplePie version</th>
<td>1.1.1</td>
</tr>
<tr>
<th>Leverages <a href="@/wiki/plugins/wordpress/simplepie_core.md">SimplePie Core</a></th>
<td>Yes</td>
</tr>
<tr>
<th>Optional Helpers</th>
<td><a href="http://wordpress.org/extend/plugins/exec-php/">Exec-PHP</a>, <a href="http://wordpress.org/extend/plugins/php-code-widget/">PHP Code Widget</a></td>
</tr>
<tr>
<th>Plugin Support</th>
<td><a href="http://tech.groups.yahoo.com/group/simplepie-support/">http://tech.groups.yahoo.com/group/simplepie-support/</a></td>
</tr>
<tr>
<th>Bugs and Feature Requests</th>
<td><a href="http://github.com/simplepie/wordpress/issues">http://github.com/simplepie/wordpress/issues</a></td>
</tr>
</tbody>
</table>

## Navigation {#navigation}

<table class="inline">
<tbody>
<tr>
<th>→</th>
<td><span class="curid"><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">Overview</a></span></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/installation.md">Installation</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md">Getting Started</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md">Customization</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/processing.md">Post-Processing</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md">Troubleshooting</a></td>
</tr>
</tbody>
</table>

## About the Plugin {#about_the_plugin}

This plugin has just about everything you'd need for working with feeds in WordPress, and has a TON of features including:

- A configuration pane under the Options tab in the WordPress software.
- “Multifeeds” support.
- MUCH better control over the plugin's output. Supports a simple templating system that allows:
  - Simple, easy-to-use tags for nearly every piece of data that SimplePie can output.
  - Support for multiple templates.
  - Global configuration of default values for several configuration options.
  - Ability to override the defaults for any given feed – including giving a feed it's own output template.
  - Ability to post-process feed data (e.g. stripping out all content except for images).
- No need to manually set up cache folders.
- Support for internationalized domain names.
- Support for short descriptions is configurable.
- And more!

## Brief Version History {#brief_version_history}

- 2.2: Added support for setting your preferred cache location, improvements to error handling, support for more Media <abbr title="Rich Site Summary">RSS</abbr> data, support for new SimplePie 1.1 methods, and stopped bundling the SimplePie <abbr title="Application Programming Interface">API</abbr> in favor of relying on the [SimplePie Core](http://wordpress.org/extend/plugins/simplepie-core/) extension.
- 2.1: Added support for feed post-processing, better error handling, and fixed issues with installing in the wrong location.
- 2.0: Complete re-write from scratch. Now a full-fledged WordPress plugin complete with control panel.
- 1.2: Added support for the 'showtitle' and 'alttitle' keywords.
- 1.1: Better error handling, and support for the 'error' keyword.
- 1.0: First release.

## What Do I Need To Know? {#what_do_i_need_to_know}

These instructions assume that you have a basic familiarity with <abbr title="Hypertext Preprocessor">PHP</abbr> and know how to add a line of <abbr title="Hypertext Preprocessor">PHP</abbr> code to your own WordPress templates. If you don't, and you're just getting started, we would suggest you take a look at the following documentation and tutorials:

- [PHP 101: PHP For the Absolute Beginner](http://devzone.zend.com/node/view/id/627)
- [Introduction to PHP tutorial](http://www.php.net/manual/en/tutorial.php)
- [WordPress: Blog Design and Layout](http://codex.wordpress.org/Blog_Design_and_Layout)
- [WordPress: Theme Development](http://codex.wordpress.org/Theme_Development)
- [WordPress: Customizing your Sidebar](http://codex.wordpress.org/Customizing_Your_Sidebar)

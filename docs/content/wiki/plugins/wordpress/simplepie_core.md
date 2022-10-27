+++
title = "SimplePie Core"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><a href="http://wordpress.org/extend/plugins/simplepie-core">SimplePie Core</a></td>
</tr>
<tr>
<th>Author</th>
<td><a href="http://simplepie.org">Ryan Parman</a>, <a href="http://gsnedders.com">Geoffrey Sneddon</a>, and contributors</td>
</tr>
<tr>
<th>Plugin Version</th>
<td>1.1.1</td>
</tr>
<tr>
<th>Compatible WordPress version</th>
<td>2.x</td>
</tr>
<tr>
<th>Download</th>
<td><a href="http://wordpress.org/extend/plugins/simplepie-core/download/">Download</a></td>
</tr>
<tr>
<th>Plugin Support</th>
<td><a href="http://tech.groups.yahoo.com/group/simplepie-support/">http://tech.groups.yahoo.com/group/simplepie-support/</a></td>
</tr>
</tbody>
</table>

## About SimplePie Core {#about_simplepie_core}

From time to time, we get messages in support about people using multiple WordPress plugins that utilize SimplePie, and sometimes they cause collisions because each plugin is bundling their own copy of SimplePie. In an effort to make things easier, we've released a new WordPress plugin that does absolutely nothing but load the latest version of SimplePie and the International Domain Names (IDN) library that we bundle. This plugin is called **[SimplePie Core](http://wordpress.org/extend/plugins/simplepie-core)**.

### Why? {#why}

There are a couple of reasons:

1.  To eliminate conflicts between multiple SimplePie-based plugins installed at the same time.
2.  To make it easier for people to get the latest SimplePie enhancements without requiring a new release from WordPress plugin developers.
3.  And stuff.

### How does this affect me, a WordPress plugin developer? {#how_does_this_affect_me_a_wordpress_plugin_developer}

The advantage to you is that future SimplePie releases can be easily installed by users, and that there is no risk of conflicts between SimplePie-based plugins.

However, this also means that you likely need to make a few small updates to your plugins.

- Don't load SimplePie manually by including/requiring `simplepie.inc` or `idna.class.php`. Instead, check to see if the SimplePie class is defined. If it is, you'll know that SimplePie is available to be used.
- If SimplePie is not available, you should display some sort of error message instructing people to download, install, and activate the SimplePie Core plugin from <http://wordpress.org/extend/plugins/simplepie-core> (this should be a friendly message, not a crash-and-burn message). If they've already installed a SimplePie Core-aware plugin, they'll likely already have it installed and it won't even be an issue. (The [SimplePie Plugin for WordPress](@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md) began doing this starting with version 2.2.)
- If you require a minimum version of SimplePie (such as you use some of the new features of 1.1), check that the `SIMPLEPIE_BUILD` value of the loaded SimplePie class is equal-to or greater-than that of the SimplePie release that you need. If not, display another friendly message.

It's also possible that some plugin authors haven't updated their plugins to be SimplePie Core-aware yet, and may have an older version of SimplePie bundled with their plugin that loads before yours or even SimplePie Core. If SimplePie Core detects that the SimplePie class has already been loaded by another plugin, SimplePie Core will gracefully disable itself to avoid conflicts and fatal <abbr title="Hypertext Preprocessor">PHP</abbr> errors. As long as you check that the minimum SimplePie build has been met, you can avoid fatal errors too.

Of course, that also means that we need to pummel that lazy developer with emails and blog comments until he/she upgrades the plugin to be SimplePie Core-aware. :)

### Sample Code {#sample_code}

```php
<?php

if (class_exists('SimplePie'))
{
    if (SIMPLEPIE_BUILD >= 20080102221556) // SimplePie 1.1
    {
        echo 'Everything is A-OK! Rock on!';
    }
    else
    {
        echo 'This plugin requires a newer version of the <a href="http://wordpress.org/extend/plugins/simplepie-core">SimplePie Core</a> plugin to enable important functionality. Please upgrade the plugin to the latest version.';
    }
}
else
{
    echo 'This plugin relies on the <a href="http://wordpress.org/extend/plugins/simplepie-core">SimplePie Core</a> plugin to enable important functionality. Please download, install, and activate it, or upgrade the plugin if you\'re not using the latest version.';
}

?>
```

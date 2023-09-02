+++
title = "Troubleshooting"
+++

These are the major issues we've been made aware of. Feel free to add issues that you run into along with solutions for them.

## Navigation {#navigation}

<table class="inline">
<tbody>
<tr>
<th>→</th>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">Overview</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/installation.md">Installation</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md">Getting Started</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md">Customization</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/processing.md">Post-Processing</a></td>
<td><span class="curid"><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md">Troubleshooting</a></span></td>
</tr>
</tbody>
</table>

## Cache Error {#cache_error}

As it turns out, some people have a `cache` directory inside their `wp-content` directory, while others don't. By default, SimplePie sets the cache location as your `wp-content/cache` directory and assumes that is writable (which it normally is, if it exists). If this directory doesn't exist, you'll need to either create it (using your preferred <abbr title="File Transfer Protocol">FTP</abbr> or <abbr title="Secure Shell">SSH</abbr> tool) or change the cache location in the `SimplePie for WP` tab of the WordPress Plugins control panel. If this directory isn't writable by the server, you'll need to change the file permissions for your cache directory to be server-writable.

This setting varies from web host to web host. In the past, I've used [iPowerWeb](http://ipowerweb.com/), and they required file permissions of `777` in order to be server-writable. Currently, I use [Dreamhost](http://dreamhost.com/r.cgi?skyzyx), and they need permissions to be set to `755` to be server-writable. Again, if you're not sure, either go ask your host or you can try various settings yourself. The three to try are `755`, `775`, or `777`.

The specific process of _how_ you change your file permissions differs from <abbr title="File Transfer Protocol">FTP</abbr> application to <abbr title="File Transfer Protocol">FTP</abbr> application. On Windows I use [FlashFXP](http://flashfxp.com), where you find the remote file or folder that you want to change the permissions of, you right-click on it, and choose _Attributes (CHMOD)_. On Mac <abbr title="Operating System">OS</abbr> X I use [Transmit](http://panic.com/transmit/), where you find the remote file or folder that you want to change the permissions of, you right-click (or ctrl-click for you one-button-mousers) on it, and choose _Get Info_. Your specific <abbr title="File Transfer Protocol">FTP</abbr> application will most likely be something similar.

## Plugin could not be activated because it triggered a fatal error. {#plugin_could_not_be_activated_because_it_triggered_a_fatal_error}

According to [this post](http://wordpress.org/support/topic/128698?replies=3), some <abbr title="Hypertext Preprocessor">PHP</abbr> installs might have to bump up their memory in <abbr title="Hypertext Preprocessor">PHP</abbr>.

> <div class="no">
>
> “Simply increase the php.ini memory allocation. It is set at 8MB by default. I upped mine to 32MB and I was up and running.”
>
> </div>

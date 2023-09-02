+++
title = "Installation"
+++

## Navigation {#navigation}

<table class="inline">
<tbody>
<tr>
<th>→</th>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">Overview</a></td>
<td><span class="curid"><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/installation.md">Installation</a></span></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md">Getting Started</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md">Customization</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/processing.md">Post-Processing</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md">Troubleshooting</a></td>
</tr>
</tbody>
</table>

## Upgrading from an older version? {#upgrading_from_an_older_version}

### From 2.2.x {#from_22x}

1.  Backup any custom templates and post-processing files you might have.
2.  Replace the old plugin folder with the new one.
3.  Re-add your custom templates and post-processing files.

### From 2.0.x through 2.1.x {#from_20x_through_21x}

1.  Install the [SimplePie Core](http://wordpress.org/extend/plugins/simplepie-core/) plugin, and activate it.
2.  Backup any custom templates and post-processing files you might have.
3.  Replace the old plugin folder with the new one.
4.  Re-add your custom templates and post-processing files.
5.  Make sure that you go into the Options panel, and click “update options” to ensure that new data is entered into the database.

### From 1.x {#from_1x}

1.  Delete all traces of the previous version of the plugin (specifically deleting `simplepie_wordpress.php`).
2.  Wherever you've called `SimplePieWP()`, you'll likely end up deleting the options you've already set, or converting them to the updated array syntax for setting per-feed options. These new options are discussed below.

## Fresh Installation {#fresh_installation}

### Step 0: SimplePie Core {#step_0simplepie_core}

This plugin relies on another WordPress plugin called [SimplePie Core](http://wordpress.org/extend/plugins/simplepie-core/). This plugin is shared by other plugins that integrate with SimplePie, so check to see if you already have it. If you're using WordPress 2.3 or newer, the WordPress Plugins control panel will tell you if you need to update to a newer version.

If you don't already have it, follow steps 1-3 for both [SimplePie Core](http://wordpress.org/extend/plugins/simplepie-core/) and [SimplePie Plugin for WordPress](http://wordpress.org/extend/plugins/simplepie-plugin-for-wordpress/).

### Step 1: Download the plugin {#step_1download_the_plugin}

There's a link above to download the [SimplePie Plugin for WordPress](http://wordpress.org/extend/plugins/simplepie-plugin-for-wordpress/) (make sure you know where you've downloaded them to). Once you've done that, unzip it.

### Step 2: Upload the plugin folder {#step_2upload_the_plugin_folder}

The entire plugin folder should be uploaded as-is to your WordPress installation, so that it ends up as `wp-content/plugins/simplepie-plugin-for-wordpress`.

### Step 3: Enable the plugin {#step_3enable_the_plugin}

Log into your WordPress control panel, go to “plugins”, and enable the _SimplePie Plugin for WordPress_ plugin. If you need more help installing WordPress plugins, check out the [WordPress plugin installation instructions](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins). From there, you can go to the new `Options → SimplePie for WP` panel and configure your default settings.

The SimplePie Plugin for WordPress is now installed!

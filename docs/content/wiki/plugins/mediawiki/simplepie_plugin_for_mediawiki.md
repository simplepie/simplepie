+++
title = "SimplePie Plugin for Mediawiki"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><span class="curid"><a href="@/wiki/plugins/mediawiki/simplepie_plugin_for_mediawiki.md">SimplePie Plugin for Mediawiki</a></span></td>
</tr>
<tr>
<th>Author</th>
<td><a href="http://simplepie.org">Ryan Parman</a> (Original)</td>
</tr>
<tr>
<th>Plugin Version</th>
<td>1.2.1 (Discontinued)</td>
</tr>
<tr>
<th>Compatible Mediawiki version</th>
<td>1.7.x and newer</td>
</tr>
<tr>
<th>Download</th>
<td><a href="http://www.jujunie.com/downloads/simplepie_mediawiki.zip">Download</a></td>
</tr>
<tr>
<th>Required SimplePie version</th>
<td>1.0.x</td>
</tr>
<tr>
<th>Optional Helpers</th>
<td>None</td>
</tr>
<tr>
<th>Plugin Support</th>
<td><a href="/support/viewforum.php?id=17" title="http://simplepie.org/support/viewforum.php?id=17">http://simplepie.org/support/viewforum.php?id=17</a></td>
</tr>
</tbody>
</table>

<div class="warning">

**Because I don't use Mediawiki anymore, I'm discontinuing development on this plugin.** If you are interested in taking over development, please let me know at the forums. Alternatively, there are other [Mediawiki](@/wiki/plugins/mediawiki/_index.md) plugins that you can use instead of this one.

</div>

### About the Plugin {#about_the_plugin}

This plugin adds a `<feed>` tag to Mediawiki that allows you to display feeds in your wiki.

## Installation {#installation}

### Upgrading from an older version? {#upgrading_from_an_older_version}

Replace the old `simplepie_mediawiki.php` with the new one.

### Fresh Installation {#fresh_installation}

For the purposes of these instructions, we're going to make a few assumptions. We're going to assume that you have installed MediaWiki to `http://wiki.example.com`, which would mean that the MediaWiki extensions folder lives at `http://wiki.example.com/extensions/`, and that your MediaWiki settings file lives at `http://wiki.example.com/LocalSettings.php`.

#### Step 1: Download both the required files above {#step_1download_both_the_required_files_above}

When you download them, make sure you know where you've downloaded them to. Once you've done that, unzip them. The full SimplePie library is what powers everything, and the Mediawiki plugin simply makes it available to your wiki pages.

#### Step 2: Upload both simplepie.inc and simplepie_mediawiki.php to your MediaWiki extensions folder {#step_2upload_both_simplepieinc_and_simplepie_mediawikiphp_to_your_mediawiki_extensions_folder}

This means that these two files will be uploaded to `http://wiki.example.com/extensions/`.

#### Step 3: Create a cache folder inside MediaWiki's extensions folder {#step_3create_a_cache_folder_inside_mediawiki_s_extensions_folder}

This means that after you create the cache folder, it will live at `http://wiki.example.com/extensions/cache/`.

#### Step 4: Change the file permissions for the cache directory to be server-writable {#step_4change_the_file_permissions_for_the_cache_directory_to_be_server-writable}

This setting varies from webhost to webhost. In the past, I've used [iPowerWeb](http://ipowerweb.com/), and they required file permissions of `777` in order to be server-writable. Currently, I use [Dreamhost](http://dreamhost.com/r.cgi?skyzyx), and they need permissions to be set to `755` to be server-writable. Again, if you're not sure, either go ask your host or you can try various settings yourself. The three to try are `755`, `775`, or `777`.

The specific process of _how_ you change your file permissions differs from <abbr title="File Transfer Protocol">FTP</abbr> application to <abbr title="File Transfer Protocol">FTP</abbr> application. On Windows I use [FlashFXP](http://flashfxp.com), where you find the remote file or folder that you want to change the permissions of, you right-click on it, and choose _Attributes (CHMOD)_. On Mac <abbr title="Operating System">OS</abbr> X I use [Transmit](http://panic.com/transmit/), where you find the remote file or folder that you want to change the permissions of, you right-click (or ctrl-click for you one-button-mousers) on it, and choose _Get Info_. Your specific <abbr title="File Transfer Protocol">FTP</abbr> application will most likely be something similar.

#### Step 5: Add the extension to your MediaWiki settings file {#step_5add_the_extension_to_your_mediawiki_settings_file}

Open up your `LocalSettings.php` file which lives at `http://wiki.example.com/LocalSettings.php`. At the very bottom of the file, but above the closing <abbr title="Hypertext Preprocessor">PHP</abbr> tag (?\>), add this line:

```php
include("./extensions/simplepie_mediawiki.php");
```

SimplePie and the SimplePie Plugin for Mediawiki are now installed.

## Usage {#usage}

### How to use it {#how_to_use_it}

SimplePie Plugin for MediaWiki adds one tag to your MediaWiki installation: the `<feed>` tag. Here's how you use it:

1.  `<feed>http://example.com/feed.xml</feed>`  
    To load a feed on your MediaWiki pages, simply wrap the feed <abbr title="Uniform Resource Locator">URL</abbr> with `<feed>` tags. Doing this with no attributes will display the default way:
    - An \<h3\> containing the feed's title, linked back to the originating site.
    - An ordered list, containing all of the news items in the feed.
    - The news item's title, linked back to the originating post.
    - The full <abbr title="HyperText Markup Language">HTML</abbr> description for each news item.
2.  `items` attribute  
    Limits the number of items returned. If you set this value to 5, then you'll get back the 5 most recent posts. If there's a feed with fewer than 5 posts, SimplePie will return all of them. Defaults to all.
3.  `showdesc` attribute  
    Determines whether the description should be shown or not. If set to false, descriptions are omitted, and the ordered list will display only the linked item titles with no special formatting. Defaults to true.
4.  `showdate` attribute  
    Displays the date of the news item. Accepts anything that's allowed in <abbr title="Hypertext Preprocessor">PHP</abbr>'s date() function. Defaults to blank.
5.  `shortdesc` attribute  
    Strips all tags from the item's description and limits the number of characters that are displayed. Accepts any numeric value. If more characters are allowed than are in the description, the entire description will be displayed. If the text wasn't cut at the end of a sentence (ending with a period, exclamation point, or question mark), an ellipsis will be added to the end of the text. Defaults to all characters.
6.  `showtitle` attribute  
    Determines whether the built-in feed title is displayed or not. Defaults to true.
7.  `alttitle` attribute  
    Displays a custom title in place of the feed's built-in title. Defaults to blank.
8.  `error` attribute  
    Displays a custom error message for when there is a problem retrieving the feed. Defaults to the standard error messages.

If you want to apply special <abbr title="Cascading Style Sheets">CSS</abbr> styles to the feed display, here's some basic markup that represents what is generated.

```html
<div class="simplepie">
    <h3><a href="http://example.com">Example Site</a></h3>
    <ol>
        <li><strong><a href="...">Item Title 1</a> <span class="date">29 May 2006</span></strong><br />
        The description for the item.</li>

        <li><strong><a href="...">Item Title 2</a> <span class="date">28 May 2006</span></strong><br />
        The description for the item.</li>

        <li><strong><a href="...">Item Title 3</a> <span class="date">27 May 2006</span></strong><br />
        The description for the item.</li>
    </ol>
</div>
```

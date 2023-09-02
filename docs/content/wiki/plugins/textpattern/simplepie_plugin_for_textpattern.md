+++
title = "SimplePie Plugin for Textpattern"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><span class="curid"><a href="@/wiki/plugins/textpattern/simplepie_plugin_for_textpattern.md">SimplePie Plugin for Textpattern</a></span></td>
</tr>
<tr>
<th>Author</th>
<td>Mike Small (formerly Ryan Parman)</td>
</tr>
<tr>
<th>Plugin Version</th>
<td>1.2.2</td>
</tr>
<tr>
<th>Compatible Textpattern version</th>
<td>4.x</td>
</tr>
<tr>
<th>Download</th>
<td><a href="/downloads/simplepie_textpattern_1.2.2.zip" title="http://simplepie.org/downloads/simplepie_textpattern_1.2.2.zip">Download</a></td>
</tr>
<tr>
<th>Required SimplePie version</th>
<td>1.x</td>
</tr>
<tr>
<th>Optional Helpers</th>
<td>None</td>
</tr>
<tr>
<th>Plugin Support</th>
<td>None</td>
</tr>
</tbody>
</table>

### About the Plugin {#about_the_plugin}

This plugin adds a `<txp:feed>` tag to Textpattern that allows you to display feeds in your wiki.

## Installation {#installation}

### Upgrading from an older version? {#upgrading_from_an_older_version}

Replace the old `simplepie.inc` with the latest one downloaded from [http://simplepie.org/downloads/downloads](/downloads/downloads "http://simplepie.org/downloads/downloads"). Uninstall the old plugin and reinstall the latest version via the link above.

### Fresh Installation {#fresh_installation}

For the purposes of these instructions, we're going to make a few assumptions. We're going to assume that you have installed Textpattern to `http://blog.example.com`, which would mean that the Textpattern administration folder lives at `http://blog.example.com/textpattern/`, and that your Textpattern `lib` folder lives at `http://blog.example.com/textpattern/lib/`.

#### Step 1: Download the latest simplepie.inc and the plugin file {#step_1download_the_latest_simplepieinc_and_the_plugin_file}

1.  simplepie.inc is the main directory of the SimplePie package available here: [http://simplepie.org/downloads/](/downloads/ "http://simplepie.org/downloads/").
2.  The Textpattern plugin [simplepie_textpattern_1.2.2.zip](/downloads/simplepie_textpattern_1.2.2.zip)

When you download them, make sure you know where you've downloaded them to. Once you've done that, unzip them. The full SimplePie library is what powers everything, and the Textpattern plugin simply makes it available to your blog pages.

#### Step 2: Upload simplepie.inc to your Textpattern 'lib' folder {#step_2upload_simplepieinc_to_your_textpattern_lib_folder}

This means that this file will be uploaded to `http://blog.example.com/textpattern/lib/`.

#### Step 3: Create a simplepie_cache folder inside your Textpattern 'lib' folder {#step_3create_a_simplepie_cache_folder_inside_your_textpattern_lib_folder}

This means that after you create the `simplepie_cache` folder, it will live at `http://blog.example.com/textpattern/lib/simplepie_cache/`.

#### Step 4: Change the file permissions for the cache directory to be server-writable {#step_4change_the_file_permissions_for_the_cache_directory_to_be_server-writable}

This setting varies from webhost to webhost. In the past, I've used [iPowerWeb](http://ipowerweb.com/), and they required file permissions of `777` in order to be server-writable. Currently, I use [Dreamhost](http://dreamhost.com/r.cgi?skyzyx), and they need permissions to be set to `755` to be server-writable. Again, if you're not sure, either go ask your host or you can try various settings yourself. The three to try are `755`, `775`, or `777`.

The specific process of _how_ you change your file permissions differs from <abbr title="File Transfer Protocol">FTP</abbr> application to <abbr title="File Transfer Protocol">FTP</abbr> application. On Windows I use [FlashFXP](http://flashfxp.com), where you find the remote file or folder that you want to change the permissions of, you right-click on it, and choose _Attributes (CHMOD)_. On Mac <abbr title="Operating System">OS</abbr> X I use [Transmit](http://panic.com/transmit/), where you find the remote file or folder that you want to change the permissions of, you right-click (or ctrl-click for you one-button-mousers) on it, and choose _Get Info_. Your specific <abbr title="File Transfer Protocol">FTP</abbr> application will most likely be something similar.

#### Step 5: Enable the plugin in your Textpattern control panel {#step_5enable_the_plugin_in_your_textpattern_control_panel}

1.  Log into your Textpattern control panel, click on the “admin” tab, then the “plugins” tab.
2.  Copy-paste the contents of `simplepie_textpattern.txt` into the form and click “upload”.
3.  You should see some colorized <abbr title="Hypertext Preprocessor">PHP</abbr> code. Scroll to the bottom of the page, and click “install”.
4.  You should see the SimplePie Plugin for Textpattern listed in your plugins list. On the right-hand side of the row, you'll see the word “no” under the “Active” column. Click “no” to change it to “yes”, meaning that the plugin is now enabled.

If you need more help installing Textpattern plugins, check out the [Textpattern plugin installation instructions](http://textbook.textpattern.net/wiki/index.php?title=Intermediate_Weblog_Model#Adding_Plugins_to_Your_Textpattern_Installation).

SimplePie and the SimplePie Plugin for Textpattern are now installed.

## Usage {#usage}

### How to use it {#how_to_use_it}

SimplePie Plugin for Textpattern adds one tag to your Textpattern installation: the `<txp:feed>` tag. Here's how you use it:  
**Changes from version 1.2.1 to 1.2.2 highlighted in bold.**

1.  `<txp:feed>http://example.com/feed.xml</txp:feed>`  
    To load a feed on your Textpattern pages, simply wrap the feed <abbr title="Uniform Resource Locator">URL</abbr> with `<txp:feed>` tags. Doing this with no attributes will display the default way:
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
    Displays a custom title in place of the feed's built-in title. **If ”-1” is entered no title is displayed (removes the built-in title too)**. Defaults to blank.
8.  `h` attribute  
    **Define the html header used for the title (eg h4) defaults to h3.**
9.  `listtype` attribute  
    **Defines the list type. Eg listtype=“ol” will give an ordered list. Defaults to “ul”.**
10. `error` attribute  
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

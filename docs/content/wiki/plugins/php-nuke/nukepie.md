+++
title = "nukePIE"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><a href="http://nukeSEO.com">nukePIE</a></td>
</tr>
<tr>
<th>Author</th>
<td><a href="http://nukeSEO.com">Kevin Guske</a></td>
</tr>
<tr>
<th>Plugin Version</th>
<td>1.1.1</td>
</tr>
<tr>
<th>Compatible <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke version</th>
<td>6.5+</td>
</tr>
<tr>
<th>Compatible <a href="http://ravenphpscripts.com">RavenNuke</a> version</th>
<td>2.1+ (included with 2.20+)</td>
</tr>
<tr>
<th>Download</th>
<td><a href="http://nukeseo.com/modules.php?name=Downloads&amp;cid=12">Download</a> (free registration required)</td>
</tr>
<tr>
<th>Required SimplePie version</th>
<td>1.1.1 (Bundled)</td>
</tr>
<tr>
<th>Plugin Support</th>
<td><a href="http://nukeseo.com/modules.php?name=Forums&amp;file=viewforum&amp;f=9">http://nukeseo.com/modules.php?name=Forums&amp;file=viewforum&amp;f=9</a></td>
</tr>
</tbody>
</table>

### About the Plugin {#about_the_plugin}

nukePIE™ is a replacement for the standard <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke block feed reader and uses the blocks administration without modification.

With nukePIE™, RavenNuke, BonusNuke, DadaNuke, Future Nuke, NukeEvolution, Nuke Platinum and other <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke distributions can:

- Display <abbr title="Rich Site Summary">RSS</abbr> 2.0, ATOM 1.0, or any properly-formed feed in Nuke blocks
- Display feed item descriptions as either full-<abbr title="HyperText Markup Language">HTML</abbr> tool tips or as title tags for the link
- Control the appearance of tool tips using cascading style sheets (<abbr title="Cascading Style Sheets">CSS</abbr>)

nukePIE™ uses the SimplePie class and BoxOver script.

Since nukePIE™ replaces core <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke functions, it requires modifications to <abbr title="Hypertext Preprocessor">PHP</abbr> scripts (namely, mainfile.php).

### What Do I Need To Know? {#what_do_i_need_to_know}

These instructions assume that you have a basic familiarity with <abbr title="Hypertext Preprocessor">PHP</abbr> and know how to modify <abbr title="Hypertext Preprocessor">PHP</abbr> code in your <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke distribution. If you don't, and you're just getting started, we would suggest you take a look at the following documentation and tutorials:

- [Introduction to PHP tutorial](http://www.php.net/manual/en/tutorial.php)
- [PHP for Beginners](http://www.php-for-beginners.co.uk/)
- [PHP Manual](http://ravenphpscripts.com/phpmanual.html)
- [CSS Manual](http://www.css2.code-authors.com/)
- [PHP-Nuke: Management and Programming](http://ravenphpscripts.com/nukemanual.html)

### Brief Version History {#brief_version_history}

- 1.1.1: Update includes SimplePie 1.1.1.
- 1.0: First release.

## Installation {#installation}

### Fresh Installation {#fresh_installation}

#### Step 1: Download the plugin above {#step_1download_the_plugin_above}

There's a link above to download nukePIE, which already includes the latest release version of SimplePie. When you download them, make sure you know where you've downloaded them to. Once you've done that, unzip them.

#### Step 2: Upload the entire html folder to your root PHP-Nuke directory {#step_2upload_the_entire_html_folder_to_your_root_php-nuke_directory}

The entire html folder should be uploaded as-is to your <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke installation. Any existing files may be overwritten as described in the readme.txt file in the download.

#### Step 3: Make sure the cache folder is writeable {#step_3make_sure_the_cache_folder_is_writeable}

The /cache/ folder should be writeable on your <abbr title="Hypertext Preprocessor">PHP</abbr>-Nuke webserver.

#### Step 4: Modify 3 php files according to the readme.txt instructions {#step_4modify_3_php_files_according_to_the_readmetxt_instructions}

Modify config.php (or rnconfig.php) to include a new setting, mainfile.php to replace the headlines function, and header.php / my_header.php / custom_header.php file to include a file that loads the appropriate Javascript and <abbr title="Cascading Style Sheets">CSS</abbr> files.

nukePIE™ is now installed!

## Usage {#usage}

Add <abbr title="Rich Site Summary">RSS</abbr>, ATOM and other feeds as blocks using the standard Blocks Administration function.

## Troubleshooting {#troubleshooting}

### Cache Error {#cache_error}

nukePIE™ assumes that the cache folder is writable. If this isn't the case for you, you'll need to change the file permissions for the `/cache` directory to be server-writable (try setting the permission to one of the following using your <abbr title="File Transfer Protocol">FTP</abbr> client: `755`, `775`, or `777`).

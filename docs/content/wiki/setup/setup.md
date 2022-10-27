+++
title = "Setup and Getting Started"
+++

These instructions are for installing SimplePie on a website as an additional library that can be accessed by any <abbr title="Hypertext Preprocessor">PHP</abbr>-based page. There are other instructions available for the [SimplePie Plugins and Integration](@/wiki/plugins/_index.md).

## How the Instructions Work {#how_the_instructions_work}

SimplePie is a <abbr title="Hypertext Preprocessor">PHP</abbr> library for parsing <abbr title="Rich Site Summary">RSS</abbr> and Atom feeds. If you know how to upload a library, require it in your pages, and use the resulting [API functions](@/wiki/reference/_index.md), you can probably skip this primer. Each instruction is broken into two parts:

- The actual step, bolded and italicized **_like this_**.
- The explanation of the details of the step, for those who don't already know.

For the purposes of these instructions, we're going to make a few assumptions. We're going to assume that you want your <abbr title="Hypertext Preprocessor">PHP</abbr> libraries (like SimplePie) to live in `http://example.com/php`, your cache files to be stored in `http://example.com/cache`, and the page that displays the feeds is at `http://example.com/news`.

Granted, if you're familiar with <abbr title="Hypertext Preprocessor">PHP</abbr>, you can pretty much set it up however you want. But this is the setup that we'll work towards in these instructions. Feel free to deviate as you so choose.

## The Instructions {#the_instructions}

### Step 1 {#step_1}

**_Start by launching your <abbr title="File Transfer Protocol">FTP</abbr> program, and accessing the web-accessible root directory of your site._**

You'll need to know what the “web-accessible root directory” is (hereafter known as “root directory”). Every host is different, and I've seen this folder named `public_html`, `www`, and even the name of the domain itself – in our case, `http://example.com`. If you wanted `mypage.html` to show up at `http://example.com/mypage.html`, then that's the folder you want to find.

Since this is specific to your webhost, and not to SimplePie, there really isn't much more I can do to help you other than to tell you to contact your webhost if you don't know. Many webhosts also have a knowledge base or a wiki of some sort that you can consult if you're not sure.

### Step 2 {#step_2}

**_In your root directory, if they don't already exist, create two folders: `php` and `cache`._**

Simple enough.

### Step 3 {#step_3}

**_We'll need to change the file permissions (aka CHMOD permissions) for the cache directory to be server-writable._**

This setting also varies from webhost to webhost. In the past, I've used [iPowerWeb](http://ipowerweb.com/), and they required file permissions of `777` in order to be server-writable. Currently, I use [Dreamhost](http://dreamhost.com/r.cgi?skyzyx), and they need permissions to be set to `755` to be server-writable. Again, if you're not sure, either go ask your host or you can try various settings yourself. The three to try are `755`, `775`, or `777`.

The specific process of _how_ you change your file permissions differs from <abbr title="File Transfer Protocol">FTP</abbr> application to <abbr title="File Transfer Protocol">FTP</abbr> application. On Windows I use [FlashFXP](http://flashfxp.com), where you find the remote file or folder that you want to change the permissions of, you right-click on it, and choose _Attributes (CHMOD)_. On Mac <abbr title="Operating System">OS</abbr> X I use [Transmit](http://panic.com/transmit/), where you find the remote file or folder that you want to change the permissions of, you right-click (or ctrl-click for you one-button-mousers) on it, and choose _Get Info_. Your specific <abbr title="File Transfer Protocol">FTP</abbr> application will most likely be something similar.

### Step 4 {#step_4}

**_Upload `library/` and `autoloader.php` to the `php` folder you just created._**

This is where you will reference SimplePie from when you require it on your pages.

### Step 5 {#step_5}

**_At this point, SimplePie is installed._**

SimplePie is ready to go at this point. If you know how to require SimplePie in your pages, and can find your way around the [function reference](@/wiki/reference/_index.md), you should be fine at this point. If you need help putting a basic page together, [read on](@/wiki/setup/sample_page.md).

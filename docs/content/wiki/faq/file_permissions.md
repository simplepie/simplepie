+++
title = "Change the file permissions to be server-writable?"
+++

This setting varies from webhost to webhost. In the past, I've used [iPowerWeb](http://ipowerweb.com/), and they required file permissions of `777` in order to be server-writable. Currently, I use [Dreamhost](http://dreamhost.com/r.cgi?skyzyx), and they need permissions to be set to `755` to be server-writable. Again, if you're not sure, either go ask your host or you can try various settings yourself. The three to try are `755`, `775`, or `777`.

The specific process of _how_ you change your file permissions differs from <abbr title="File Transfer Protocol">FTP</abbr> application to <abbr title="File Transfer Protocol">FTP</abbr> application.

## Windows {#windows}

On Windows I use [FlashFXP](http://flashfxp.com), and this is the process I use:

1.  Find the remote file or folder that you want to change the permissions of
2.  Right-click on it.
3.  Choose _Attributes (CHMOD)_
4.  Try `755`, `775`, and `777` in order until you find one that works.

Your specific <abbr title="File Transfer Protocol">FTP</abbr> application will most likely be something similar.

## Mac OS X {#mac_os_x}

On Mac <abbr title="Operating System">OS</abbr> X I use [Transmit](http://panic.com/transmit/), and this is the process I use:

1.  Find the remote file or folder that you want to change the permissions of
2.  Right-click (or Ctrl-click for you one-button-mousers) on it
3.  Choose _Get Info_.
4.  Try `755`, `775`, and `777` in order until you find one that works.

Your specific <abbr title="File Transfer Protocol">FTP</abbr> application will most likely be something similar.

## Linux {#linux}

Once you have the files set up on your Linux box, and assuming you can <abbr title="Secure Shell">SSH</abbr> into the box to access your SimplePie files:

1.  Navigate to the directory above your `cache` directory.
2.  Type `chmod -Rf 755 ./cache`.
3.  If that doesn't work, try `775`, then `777` in order until you find one that works.

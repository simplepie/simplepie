+++
title = "Create a sample SimplePie-enabled page"
+++

## Example: Nothing Fancy {#examplenothing_fancy}

This is a very basic page with valid <abbr title="Extensible HyperText Markup Language">XHTML</abbr> 1.1 syntax. This is likely what a bare-minimum page would look like.

```php
<?php

// Make sure SimplePie is included. You may need to change this to match the location of autoloader.php
// For 1.0-1.2:

#require_once('../simplepie.inc');
// For 1.3+:
require_once('../autoloader.php');

// We'll process this feed with all of the default options.
$feed = new SimplePie();

// Set which feed to process.

// Run SimplePie.
$feed->init();

// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

// Let's begin our XHTML webpage code.  The DOCTYPE is supposed to be the very first thing, so we'll keep it on the same line as the closing-PHP tag.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"

<html xmlns
<head>
    <title>Sample SimplePie Page</title>
    <meta
</head>
<body>

    <div class="header">
        <h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
        <p><?php echo $feed->get_description(); ?></p>
    </div>

    <?php
    /*
    Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
    */
    foreach ($feed->get_items() as $item):
    ?>

        <div class="item">
            <h2><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
            <p><?php echo $item->get_description(); ?></p>
            <p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
        </div>

    <?php endforeach; ?>

</body>
</html>
```

## Example: Nothing Fancy, with CSS {#examplenothing_fancy_with_css}

This is the same thing as the last example, except we've added some <abbr title="Cascading Style Sheets">CSS</abbr> to make it look nicer.

```php
<?php

// Make sure SimplePie is included. You may need to change this to match the location of autoloader.php
// For 1.0-1.2:
#require_once('../simplepie.inc');
// For 1.3+:
require_once('../autoloader.php');

// We'll process this feed with all of the default options.
$feed = new SimplePie();

// Set the feed to process.
$feed->set_feed_url

// Run SimplePie.
$feed->init();

// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

// Let's begin our XHTML webpage code.  The DOCTYPE is supposed to be the very first thing, so we'll keep it on the same line as the closing-PHP tag.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"


<html xmlns="
<head>
    <title>Sample SimplePie Page</title>


    <style type="text/css">
    body {
        font:12px/1.4em Verdana, sans-serif;
        color:#333;
        background-color:#fff;
        width:700px;
        margin:50px auto;
        padding:0;
    }

    a {
        color:#326EA1;
        text-decoration:underline;
        padding:0 1px;
    }

    a:hover {
        background-color:#333;
        color:#fff;
        text-decoration:none;
    }

    div.header {
        border-bottom:1px solid #999;
    }

    div.item {
        padding:5px 0;
        border-bottom:1px solid #999;
    }
    </style>

</head>
<body>

    <div class="header">
        <h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
        <p><?php echo $feed->get_description(); ?></p>
    </div>

    <?php
    /*
    Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
    */
    foreach ($feed->get_items() as $item):
    ?>

        <div class="item">
            <h2><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
            <p><?php echo $item->get_description(); ?></p>
            <p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
        </div>

    <?php endforeach; ?>

</body>
</html>
```

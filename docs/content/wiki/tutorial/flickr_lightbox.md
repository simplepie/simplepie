+++
title = "Flickr Lightbox"
+++

[Flickr](http://flickr.com) is a popular photo sharing site that supports the best and the brightest ideas that the modern web has to offer. [Lightbox](http://www.huddletogether.com/projects/lightbox/) is a relatively popular script that provides a cool looking UI for viewing photos. Lightbox was so popular, in fact, that it has inspired innumerable spinoffs and variations. [Here is a list of some of the various Lightbox clones](http://www.fortysomething.ca/mt/etc/archives/005400.php).

Having mentioned that there are lots and lots of variations, one of the more popular ones is [Lightbox 2](http://www.huddletogether.com/projects/lightbox2/) created by Lightbox's original author. Many of the photo-only variations of Lightbox are compatible with the original Lightbox <abbr title="HyperText Markup Language">HTML</abbr>, so this is what we'll be creating. Feel free to tweak and adjust as the instructions for whichever 'box you're using dictates.

This tutorial was partially inspired by <http://www.eleven3.com/2006/07/using_flickr_magpie_and_lightb.php>

<div class="warning">

This tutorial assumes that you're already familiar with using SimplePie, including looping through items.

</div>

## Notes {#notes}

- Apparently, Flickr now has a different “secret” ID for the original image, which we don't have access to in the feed. Because of that, this tutorial does not support the displaying of the “original” image.
- The large version of the photo may or may not be available from Flickr. Flickr resizes and store photos based on the width/height of the image. If the original image that was uploaded was too small for a “large” version, then there won't be one.
- There is TONS more functionality available from the [Flickr API](http://www.flickr.com/services/api/). If there's something you want to do that isn't part of this tutorial, take some time to go over the Flickr <abbr title="Application Programming Interface">API</abbr> docs. I would also recommend [phpFlickr](http://phpflickr.com/) if you're looking for a <abbr title="Hypertext Preprocessor">PHP</abbr>-based <abbr title="Application Programming Interface">API</abbr> for Flickr's web services.
- This is actually pretty simple code. I've already written the upfront functions to do all the dirty work. All you have to do to use it is loop through each item in the Flickr feed and pass in some parameters (which in this example have already been done for you).

## Compatibility {#compatibility}

- Tested with a standard Flickr Atom feed as of 23 August 2007.
- Supported in SimplePie 1.0.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `flickr_lightbox.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this on, make sure you include it in the same way that you include `simplepie.inc`.

### Source Code {#source_code}

```php
<?php
class lightbox
{
    /**
     * Function that removes double-quotes so they don't interfere with the HTML.
     */
    function cleanup($s = null)
    {
        if (!$s) return false;
        else
        {
            return str_replace('"', '', $s);
        }
    }

    /**
     * Function that returns the correctly sized photo URL.
     */
    function photo($url, $size)
    {
        $url = explode('/', $url);
        $photo = array_pop($url);

        switch($size)
        {
            case 'square':
                $r = preg_replace('/(_(s|t|m|b))?\./i', '_s.', $photo);
                break;
            case 'thumb':
                $r = preg_replace('/(_(s|t|m|b))?\./i', '_t.', $photo);
                break;
            case 'small':
                $r = preg_replace('/(_(s|t|m|b))?\./i', '_m.', $photo);
                break;
            case 'large':
                $r = preg_replace('/(_(s|t|m|b))?\./i', '_b.', $photo);
                break;
            default: // Medium
                $r = preg_replace('/(_(s|t|m|b))?\./i', '.', $photo);
                break;
        }

        $url[] = $r;
        return implode('/', $url);
    }

    /**
     * Function that looks through the description and finds the first image.
     */
    function find_photo($data)
    {
        preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $m);
        return $m[1][0];
    }
}
?>
```

### Example "Full Page" Code {#example_full_page_code}

```php
<?php
require_once('simplepie.inc');
require_once('flickr_lightbox.inc');

/**
 * Set up SimplePie with all default values using shorthand syntax.
 */
$feed = new SimplePie('http://api.flickr.com/services/feeds/photos_public.gne?id=33495701@N00&lang=en-us&format=atom');
$feed->handle_content_type();

/**
 * What sizes should we use?
 * Choices: square, thumb, small, medium, large.
 */
$thumb = 'square';
$full = 'medium';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Flickr Lightbox</title>

    <!-- Lightbox 2 includes -->
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

</head>

<body>

    <!-- Format the photos in a way that the Lightbox-clone scripts prefer. -->
    <?php
  foreach ($feed->get_items() as $item):

        // Set some variables to keep the rest of the code cleaner.
        $url = lightbox::find_photo($item->get_description());
        $title = lightbox::cleanup($item->get_title());
        $full_url = lightbox::photo($url, $full);
        $thumb_url = lightbox::photo($url, $thumb);
    ?>

    <a href="<?php echo $full_url; ?>" title="<?php echo $title; ?>" rel="lightbox">
        <img src="<?php echo $thumb_url; ?>" alt="<?php echo $title; ?>" border="0" />
    </a>

    <?php endforeach; ?>

</body>
</html>
```

### Example "Add it to an existing page" Code {#example_add_it_to_an_existing_page_code}

**Assumes:**

1.  You've already got a page…
2.  … with a Lightbox of some sort already installed…
3.  … and your page is set to UTF-8…
4.  … and you're not already including SimplePie somewhere else in the page.

```php
<?php
require_once('simplepie.inc');
require_once('flickr_lightbox.inc');

$feed = new SimplePie('http://api.flickr.com/services/feeds/photos_public.gne?id=33495701@N00&lang=en-us&format=atom');

$thumb = 'square';
$full = 'medium';

foreach ($feed->get_items() as $item):
    $url = lightbox::find_photo($item->get_description());
    $title = lightbox::cleanup($item->get_title());
    $full_url = lightbox::photo($url, $full);
    $thumb_url = lightbox::photo($url, $thumb);
?>

<a href="<?php echo $full_url; ?>" title="<?php echo $title; ?>" rel="lightbox">
    <img src="<?php echo $thumb_url; ?>" alt="<?php echo $title; ?>" border="0" />
</a>

<?php endforeach; ?>
```

+++
title = "Use Relative Dates"
+++

“Relative dates” is a method where instead of showing the exact date of a post, you can say it was posted “4 days ago.” Tomorrow, this message would say “5 days ago.”

The information and code for this tutorial was taken from a [Maniacal Rage](http://maniacalrage.net) posting entitled ”[Relative Dates Using PHP](http://graveyard.maniacalrage.net/archives/2004/02/relativedatesusing/).” Although the original article was geared for Movable Type, we're going to apply it to feed items returned from SimplePie.

<div class="warning">

**This tutorial RELIES on feed items having dates. Ergo, if there are no dates, then this method won't work.** This tutorial assumes that you're already familiar with using SimplePie, including looping through items. It also assumes that you know how to add new functions to whatever you're using (WordPress, custom <abbr title="Hypertext Preprocessor">PHP</abbr>, etc.).

</div>

## "Relative Date" Function {#relative_date_function}

This is the function that translates dates into relative dates. It's in English, so you'll need to translate some of the output words into other languages if need be. If you have questions specific to this function, check out the original posting, entitled [Relative Dates Using PHP](http://graveyard.maniacalrage.net/archives/2004/02/relativedatesusing/).

Make sure that this function is being included or required in the pages you want to use it on.

```php
define('SIMPLEPIE_RELATIVE_DATE', 'YmdHis'); // We'll define this here so we won't have to remember it later.

function doRelativeDate($posted_date) {
    /**
        This function returns either a relative date or a formatted date depending
        on the difference between the current datetime and the datetime passed.
            $posted_date should be in the following format: YYYYMMDDHHMMSS
 
        Relative dates look something like this:
            3 weeks, 4 days ago
        Formatted dates look like this:
            on 02/18/2004
 
        The function includes 'ago' or 'on' and assumes you'll properly add a word
        like 'Posted ' before the function output.
 
        By Garrett Murray, http://graveyard.maniacalrage.net/etc/relative/
    **/
    $in_seconds = strtotime(substr($posted_date,0,8).' '.
                  substr($posted_date,8,2).':'.
                  substr($posted_date,10,2).':'.
                  substr($posted_date,12,2));
    $diff = time()-$in_seconds;
    $months = floor($diff/2592000);
    $diff -= $months*2419200;
    $weeks = floor($diff/604800);
    $diff -= $weeks*604800;
    $days = floor($diff/86400);
    $diff -= $days*86400;
    $hours = floor($diff/3600);
    $diff -= $hours*3600;
    $minutes = floor($diff/60);
    $diff -= $minutes*60;
    $seconds = $diff;

    if ($months>0) {
        // over a month old, just show date (mm/dd/yyyy format)
        return 'on '.substr($posted_date,4,2).'/'.substr($posted_date,6,2).'/'.substr($posted_date,0,4);
    } else {
        if ($weeks>0) {
            // weeks and days
            $relative_date .= ($relative_date?', ':'').$weeks.' week'.($weeks>1?'s':'');
            $relative_date .= $days>0?($relative_date?', ':'').$days.' day'.($days>1?'s':''):'';
        } elseif ($days>0) {
            // days and hours
            $relative_date .= ($relative_date?', ':'').$days.' day'.($days>1?'s':'');
            $relative_date .= $hours>0?($relative_date?', ':'').$hours.' hour'.($hours>1?'s':''):'';
        } elseif ($hours>0) {
            // hours and minutes
            $relative_date .= ($relative_date?', ':'').$hours.' hour'.($hours>1?'s':'');
            $relative_date .= $minutes>0?($relative_date?', ':'').$minutes.' minute'.($minutes>1?'s':''):'';
        } elseif ($minutes>0) {
            // minutes only
            $relative_date .= ($relative_date?', ':'').$minutes.' minute'.($minutes>1?'s':'');
        } else {
            // seconds only
            $relative_date .= ($relative_date?', ':'').$seconds.' second'.($seconds>1?'s':'');
        }
    }
    // show relative date and add proper verbiage
    return $relative_date.' ago';
}
```

## Using it with SimplePie {#using_it_with_simplepie}

Using the aforementioned function with SimplePie is easy once you've made it available to your SimplePie-enabled page.

```php
foreach ($feed->get_items() as $item) {

    echo $item->get_date(); // Display Normal Date

    echo doRelativeDate( $item->get_date( SIMPLEPIE_RELATIVE_DATE ) ); // Display Relative Date

}
```

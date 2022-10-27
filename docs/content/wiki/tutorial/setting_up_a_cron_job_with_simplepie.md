+++
title = "Setting up a cron job for SimplePie and SimplePie Plugin for Wordpress"
+++

This procedure to set up a cron job to update the SimplePie cache in the background once an hour is similar for both SimplePie and SimplePie Plugin for Wordpress so I've combined them in one tutorial.

## Compatibility {#compatibility}

- Supported in SimplePie 1.0 or newer.
- Requires a Linux based host that allows cron jobs.

## Instructions {#instructions}

The sequence of events for both SimplePie classic and SimplePie Plugin for Wordpress is:

1.  Create and upload a web page that updates the SimplePie cache.
2.  Run a cron job to load that page once an hour.
3.  Change the cache duration of your normal SimplePie runs to 999999999, and timeout to -1.

## SimplePie Classic {#simplepie_classic}

Create a file called **update_simplepie_cache.php**

Enter the text below.

```php
<?php
        require 'simplepie.inc';
        $urls = array([enter all your feed urls here]);
        $cache_location = './cache';  //  change to your cache location
        $feed = new SimplePie();
        $feed->set_feed_url($urls);
        $feed->set_cache_location($cache_location);
        $feed->set_cache_duration(0);   // force cache to update immediatlely
        $feed->set_timeout(5);   // optional, if you have a lot of feeds a low timeout may be necessary
        $feed->init();
?>
```

Upload that file to a web accessible directory on your website so you can access it via <abbr title="Hyper Text Transfer Protocol">HTTP</abbr>. For instance:

<http://yoursite.com/update_simiplepie_cache.php>

## SimplePie Plugin for Wordpress {#simplepie_plugin_for_wordpress}

Create a file named **update_simplepie_cache.php** and enter this text:

```php
<?php
/*
Template Name: update_simplepie_cache
*/
        SimplePieWP(array([your feed urls here]),
        array('set_cache_duration' => 0,'set_timeout' => 5));
?>
```

Upload **update_simplepie_cache.php** to your current Wordpress theme directory.

Create a “Page” in Wordpress using the template: “**update_simplepie_cache**”.

If you have permalinks turned on in Wordpress, change the permalink for the page to **update_simplepie_cache**. If not, write down the pageid number for use later.

## Create the cron job {#create_the_cron_job}

There are two ways to create the cron job. If you have <abbr title="Secure Shell">SSH</abbr> and root access to your server, you create a BASH script and upload it directly to your **/etc/cron.hourly** directory, or the monthly directory if you only want to update your cache once a month. There is no yearly or age-of-aquarius directory.

## The first way to create the cron job {#the_first_way_to_create_the_cron_job}

**SimplePie Classic**

Create a file named **update_simplepie_cache.sh** and enter this text into it:

```bash
#!/bin/bash
wget -O /dev/null http://yoursite.com/update_simplepie_cache.php
```

**SimplePie Plugin for Wordpress**

Create a file named **update_simplepie_cache.sh** and enter this text into it:

With permalinks on:

```bash
#!/bin/bash
wget -O /dev/null http://yoursite.com/update_simplepie_cache/
```

With permalinks off:

```bash
#!/bin/bash
wget -O /dev/null http://yoursite.com/?pageid=[page number]
```

Enter the pageid number of Page you created in Wordpress.

When your ready to start the cron job, upload **update_simplepie_cache.sh** to your /etc/cron.hourly directory. It will run automatically once an hour, usually at minute 56.

## The second way to create the cron job {#the_second_way_to_create_the_cron_job}

Use your server control panel. Here's a screenshot of the CPANEL CRON job manager:

<img src="/wiki/_media/tutorial/update_simplepie_cache.jpg?w=561&amp;h=362" title="cpanel" class="media" width="561" height="362" alt="cpanel" />

Enter the “wget” line into the CPANEL CRON manager's “command to run” text box. Select minute 0, or whichever you want, Every Hour, Every Day, Every Month, Every Weekday.

## Or {#or}

php -f /sitedirectory/update_simplepie_cache.php

## Set your cache duration {#set_your_cache_duration}

Once your cron job is running, go back to your original SimplePie code and set the cache duration to a number greater than the cron job time period which is usually 1 hour. I use 999999999 just to be sure but if you like living on the edge you could just set it to 3601, 1 second more than an hour. Why are you doing this you say? Doing this effectively tells SimplePie to never update its cache during a normal operations since it's already being updated by the cron job. Also, just in case, set the timeout to -1 to prevent SimplePie from retrying previous failed feeds if there were any. You might also want to check your server temp periodically because SimplePie will now be running at the speed of wheat and could break the pie barrier.

**Set cache duration and timeout in SimplePie Plugin for Wordpress**

You can do this in the configuration webpage, or in the call to SimplePieWP, like this:

```php
<?php echo SimplePieWP(array('feed1.com',feed2.com'),
                       array('set_cache_duration'=>999999999,'set_timeout'=>-1));
```

**Set cache duration and timeout in SimplePie Classic**

```php
$feed->set_cache_duration(999999999);
$feed->set_timeout(-1);
```

That's it!

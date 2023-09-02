+++
title = "This demo shows how to use SimplePie and a flat file database to display previous feed items like Google Reader"
+++

### This demo shows how to use SimplePie and a flat file database to display previous feed items like Google Reader {#this_demo_shows_how_to_use_simplepie_and_a_flat_file_database_to_display_previous_feed_items_like_google_reader}

```php
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Demo of how to use SimplePie and a flat file database to display old feed items</title>
</head>
<body>


<?php

/*
        This is a demo showing how to use SimplePie and a flat file database to display previous feed items like Google Reader.
 
        Summary
                Load the flat file db into array.
                Run SimplePie.
                Add new feed items to the array.
                Save the array back to the flat file db.
                Loop through the db to display feed items.
 
        Author: Michael Shipley (http://www.michaelpshipley.com/)
 
*/

require 'simplepie.inc';

// db holder
$savedItems = array();

// db file name
$savedItemsFilename = 'saveditems.php';

// max days to keep items in db
$numberOfDays = 3;

$numberOfDaysInSeconds = ($numberOfDays*24*60*60);
$expireDate = time() - $numberOfDaysInSeconds;

$urls = array('foxnews.com','cnn.com','digg.com');
$feed = new SimplePie();
$feed->set_feed_url($urls);
$feed->set_cache_duration(100);
$feed->init();


/*
        load flat file db into array
*/
if(file_exists($savedItemsFilename))
{
        $savedItems = unserialize(file_get_contents($savedItemsFilename));
        if(!$savedItems)
        {
                $savedItems = array();
        }
}


/*
        Loop through items to find new ones and insert them into db
*/
foreach($feed->get_items() as $item)
{

        // if item is too old dont even look at it
        if($item->get_date('U') < $expireDate)
                continue;


        // make id
        $id = md5($item->get_id());


        // if item is already in db, skip it
        if(isset($savedItems[$id]))
        {
                continue;
        }

        // found new item, add it to db
        $i = array();
        $i['title'] = $item->get_title();
        $i['link'] = $item->get_link();
        $i['author'] = '';
        $author = $item->get_author();
        if($author)
        {
                $i['author'] = $author->get_name();
        }
        $i['date'] = $item->get_date('U');
        $i['content'] = $item->get_content();
        $feed = $item->get_feed();
        $i['feed_link'] = $feed->get_permalink();
        $i['feed_title'] = $feed->get_title();

        $savedItems[$id] = $i;
}


/*
        remove expired items from db
*/
$keys = array_keys($savedItems);
foreach($keys as $key)
{
        if($savedItems[$key]['date'] < $expireDate)
        {
                unset($savedItems[$key]);
        }
}


/*
        sort items in reverse chronological order
*/
function customSort($a,$b)
{
        return $a['date'] <= $b['date'];
}
uasort($savedItems,'customSort');



/*
        save db
*/
if(!file_put_contents($savedItemsFilename,serialize($savedItems)))
{
        echo ("<strong>Error: Can't save items.</strong><br>");
}


/*
        display all items from db
*/
echo '<h2>SimplePie + flat file database</h2>';
$count = 1;
foreach($savedItems as $item)
{
        echo $count++ . '. ';
        echo '<strong>' . $item['feed_title'] . '</strong>';
        echo ' : ';
        echo $item['title'];
        echo '<br>';
        echo '<small>' . date('r',$item['date']) . '</small>';
        echo '<br>';
        echo '<br>';
}

/*
        for comparison, show all feed items using SimplePie only
*/
echo '<h2>SimplePie only</h2>';
$count = 1;
foreach($feed->get_items() as $item)
{
        echo $count++ . '. ';
        $iFeed = $item->get_feed();
        echo '<strong>' . $iFeed->get_title() . '</strong>';
        echo ' : ';
        echo $item->get_title();
        echo '<br>';
        echo '<small>' . $item->get_date('r') . '</small>';
        echo '<br>';
        echo '<br>';
}

/*
        Total counts
*/
        echo '<h2>Total item counts</h2>';
        echo 'Database item count: ' . count($savedItems);
        echo '<br>';
        echo 'SimplePie item count: ' . $feed->get_item_quantity();
        echo '<br>';
?>


</body>
</html>
```

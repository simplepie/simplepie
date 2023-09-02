+++
title = "Typical Multifeed Gotchas"
+++

Being able to merge the items from multiple feeds together simply and easily is really cool, but it also comes with some caveats that you need to watch out for.

## Sorting by date {#sorting_by_date}

One of the (very) common recurring threads we get in support is “I'm using Multifeeds, but the feeds are sorting by \[insert blame here\] instead of the date!” SimplePie IS, in fact, sorting by date, but in 100% of cases, a person is trying to merge in one or more feeds where the items don't have a date stamp.

### What's going on? {#what_s_going_on}

Internally, SimplePie uses <abbr title="Hypertext Preprocessor">PHP</abbr>'s [usort()](http://php.net/usort) function to compare the values of `$item→get_date('U')` for each item. If an item has a non-existent or invalid date stamp, SimplePie doesn't bother to fire the sorting function because the data isn't going to come out right anyway.

### Solution {#solution}

Remove the feed (or feeds) that doesn't have dates for all of its items from the list of feeds to process.

A [bug report has been filed](http://bugs.simplepie.org/issues/show/34) to add additional logic to sort these unsorted items to the end of the array instead of the beginning. This is the ideal solution, but it doesn't exist yet. Add a patch to the aforementioned bug report if you take the time to do this yourself.

## Missing data from $feed {#missing_data_from_feed}

You're merging multiple feeds together and you try to access data from `$feed→get_title()` or `$feed→get_description()` but there doesn't seem to be anything. It's because when you're merging multiple feeds together, there is no single feed for $feed to contain data for.

### What's going on? {#what_s_going_on1}

Let's say that you're merging together 3 feeds, each with their own titles, descriptions, etc. We'll use Digg, Slashdot, and Apple as examples. Digg has its own title, so does Slashdot, and so does Apple. If there are 3 competing pieces of data, what should `$feed→get_title()` return?

Well, put simply, SimplePie has no idea which data to show for `$feed→anything()`, so it returns `null`.

### Solution {#solution1}

The safest (and most consistent) way to always ensure that you can access feed-level data from within the context of an item (e.g. such as inside a `for()` or `foreach()` loop), is to access the item's parent data using `get_feed()`.

```php
// Only works when you're handling a single feed. Has no value when using Multifeeds.
$feed->get_title();

// Always works, assuming you've defined $item as a feed item (such as in a foreach() loop).
$item->get_feed()->get_title();
```

`$item→get_feed()` is a reference to that item's parent `$feed` object, which contains all of the data that is available for that feed. Use this instead of a plain `$feed` when you're using Multifeeds.

<div class="warning">

As an example of something stupid and ridiculous that you _could_, but _should_ never do:

</div>

```php
echo $feed->get_item(0)->get_feed()->get_item(0)->get_feed()->get_item(0)->get_feed()->get_item(0)->get_feed()->get_item(0)->get_feed()->get_item(0)->get_feed()->get_title();
```

It's also always good practice to check to see if a method has a value before trying to output it:

```php
if ($feed->get_title())
{
    echo $feed->get_title();
}
```

### Other Notes {#other_notes}

For reasons outlined above, `$feed→data` doesn't exist, so if you're used to checking for it before doing anything, it'll return `false` every time.

## Memory Leaks/Out of Memory Errors {#memory_leaksout_of_memory_errors}

This issue is explained in greater detail here: [I'm getting memory leaks!](@/wiki/faq/i_m_getting_memory_leaks.md).

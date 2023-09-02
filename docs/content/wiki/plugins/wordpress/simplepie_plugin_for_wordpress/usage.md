+++
title = "Getting Started"
+++

SimplePie Plugin for WordPress has a control panel that lets you configure all sorts of settings. These settings are applied globally to all uses of the plugin by default, and makes it simple to change the settings for all of your feeds with a single click (very few, at least). If you want to override the default settings for a specific feed, or any other kind of customization, check out the [Customization](@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md) page for more information.

## Navigation {#navigation}

<table class="inline">
<tbody>
<tr>
<th>→</th>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">Overview</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/installation.md">Installation</a></td>
<td><span class="curid"><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md">Getting Started</a></span></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md">Customization</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/processing.md">Post-Processing</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md">Troubleshooting</a></td>
</tr>
</tbody>
</table>

## The Basics {#the_basics}

Let's start with something basic:

```php
<?php echo SimplePieWP('http://simplepie.org'); ?>
```

This code sample will display the feed using all of the default settings. If you ever want to change the settings for this feed, you could do everything directly from the control panel, as we're not overriding any settings in this example. It will display the default number of items using the default template, and will apply all other default settings (that you've configured in your control panel).

We're also utilizing SimplePie's built-in auto-discovery feature to discover the feed for this particular website even though we only entered the website address.

### Newbie Note: Where do I put the code? {#newbie_notewhere_do_i_put_the_code}

If you're familiar with WordPress, you'll know that you CAN put pure <abbr title="Hypertext Preprocessor">PHP</abbr> code into your templates by editing the template code itself. Adding things to your sidebar is documented in the WordPress wiki in an article called ["Customizing your Sidebar"](http://codex.wordpress.org/Customizing_Your_Sidebar). Additional links for tweaking stuff in WordPress (and just the basic fundamentals of doing stuff in <abbr title="Hypertext Preprocessor">PHP</abbr>) are noted in ["What do I need to know"](@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md#what_do_i_need_to_know).

Normally you CANNOT put pure <abbr title="Hypertext Preprocessor">PHP</abbr> code into your posts/pages, but you can enable this functionality by installing a plugin such as [Exec-PHP](http://wordpress.org/extend/plugins/exec-php/).

## Overriding Settings (Basic) {#overriding_settings_basic}

Additionally, you can override the default settings for any specific SimplePie instance by passing parameters directly to the `SimplePieWP()` function. Here is an example of what passing parameters could look like:

```php
<?php
echo SimplePieWP('http://simplepie.org', array(
    'items' => 5,
    'cache_duration' => 1800,
    'date_format' => 'j M Y, g:i a'
));
?>
```

In the above example, we've chosen to accept ALL of the default settings (configured in the options panel), but we've overridden (a) the number of items to display, (b) the number of seconds to cache the feed for, and ( c ) the date formatting on a per-feed basis.

### Newbie Note: Letters, Numbers, and telling the Truth {#newbie_noteletters_numbers_and_telling_the_truth}

It's good to know the difference between “Strings” (e.g. text, words, letters) and “Integers” (whole numbers). Notice in the above example that the value for `items` is simply `5`, without quotes. That's because this value is an integer (whole number) and needs to be treated as such. On the other hand, the value for `date_format` has single quote marks around it. That's because this value is a string (text, words, letters) and needs to be treated as such.

There is another data type called a “Float.” Float is short for floating-point, or better known as a decimal point. These are essentially numbers that are not whole numbers. For example, `10` is an integer (whole number), while `10.5` is a float (contains a partial whole number). When we talk about numbers in programming, we're referring to integers and floats.

Lastly, we have a “Boolean.” Booleans only have two possible values: `true` or `false`. It's basically the on/off switch of programming. Either we do or we don't. Booleans could also be known as “toggles.”

### Newbie Note: false vs. 'false' {#newbie_notefalse_vs_false}

Here's a place where many newbies make mistakes. They might set something like the following, which will confuse <abbr title="Hypertext Preprocessor">PHP</abbr>.

```text
'enable_cache' => 'false'
```

What's wrong here? You passed in a string instead of a boolean value. This is what happened in the above example:

1.  You set the value to `'false'` in an attempt to NOT do something.
2.  <abbr title="Hypertext Preprocessor">PHP</abbr> sees `'false'`, notices the quote marks, and says to itself “Ah, this is a _string_ value that they're passing in!” Programming languages are dumb because they can't read minds. :)
3.  <abbr title="Hypertext Preprocessor">PHP</abbr> replies with “yes, this _string_ DOES have a value to it”, and will respond in the positive instead of the negative (which is what we wanted).
4.  SimplePie will do the opposite of what you intended.

What you need to do is use `false` (without the quotes – because this is a boolean, not a string), like so.

```text
'enable_cache' => false
```

With this, SimplePie (and <abbr title="Hypertext Preprocessor">PHP</abbr>) will respond correctly.

## Multifeeds {#multifeeds}

As if all of this wasn't enough, the plugin also supports what we affectionately call “Multifeeds”. This allows you to merge multiple feeds together and sort the items by time and date. Using Multifeeds is as simple as passing in an array of URLs instead of a single <abbr title="Uniform Resource Locator">URL</abbr>:

```php
<?php
echo SimplePieWP(array(
    'http://feeds.feedburner.com/simplepie',
    'http://laughingmeme.org/category/magpie/feed/'
), array(
    'items' => 5,
    'cache_duration' => 1800,
    'date_format' => 'j M Y, g:i a'
));
?>
```

Now, notice that I said “sort the items by time and date.” So, what happens if a feed is missing a time/date-stamp? They won't sort. (Duh.) Sorting by date requires ALL individual items in ALL merged feeds to have time/date-stamps associated with them.

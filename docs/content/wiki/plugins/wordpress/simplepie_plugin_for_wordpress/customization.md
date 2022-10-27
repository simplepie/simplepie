+++
title = "Customization"
+++

Nearly every aspect of SimplePie Plugin for WordPress is customizable. You can create multiple templates, customize those templates, choose the settings that work best for you, and even edit and alter the feed data after it's read from the feed but before it's displayed on the page! These are the customization options available as of the latest version of the plugin.

## Navigation {#navigation}

<table class="inline">
<tbody>
<tr>
<th>→</th>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">Overview</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/installation.md">Installation</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md">Getting Started</a></td>
<td><span class="curid"><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md">Customization</a></span></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/processing.md">Post-Processing</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md">Troubleshooting</a></td>
</tr>
</tbody>
</table>

## Per-Feed Settings {#per-feed_settings}

If you want to override the default settings on a per-feed basis, these are the options that you can set (as discussed in [Getting Started: Overriding Settings (Basic)](@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md#overriding_settings_basic "plugins:wordpress:simplepie_plugin_for_wordpress:usage")). You would only use these if you want to _override_ the settings from the options panel.

<table class="inline">
<thead>
<tr>
<th>OPTION/ATTRIBUTE</th>
<th>DATATYPE</th>
<th>DESCRIPTION</th>
</tr>
</thead>
<tbody>
<tr>
<th>date_format</th>
<td>string</td>
<td>The date format to use for English dates. Supports anything that <abbr title="Hypertext Preprocessor">PHP</abbr>'s <a href="http://php.net/date">date()</a> function.</td>
</tr>
<tr>
<th>enable_cache</th>
<td>boolean</td>
<td>Whether the given feed should be cached or not.</td>
</tr>
<tr>
<th>enable_order_by_date</th>
<td>boolean</td>
<td>Whether to force-reorder items into chronological order. Only works when items have dates associated with them.</td>
</tr>
<tr>
<th>items</th>
<td>integer</td>
<td>The number of feed items to display. Will display this value, or all of the items in the feed – whichever is less.</td>
</tr>
<tr>
<th>items_per_feed</th>
<td>integer</td>
<td>The number of feed items to display per-feed (e.g. setting this to <code>3</code> will only merge 3 items from each feed). Only works when merging multiple feeds and obeys the <code>items</code> setting.</td>
</tr>
<tr>
<th>locale</th>
<td>string</td>
<td>The locale value to use for displaying localized datestamps.</td>
</tr>
<tr>
<th>local_date_format</th>
<td>string</td>
<td>The format to use for localized dates.</td>
</tr>
<tr>
<th>processing</th>
<td>string</td>
<td>The file to use for post-processing the feed. Can use the name of any process listed in the options panel, preferably lowercased with spaces replaced by underscores.</td>
</tr>
<tr>
<th>set_cache_duration</th>
<td>integer</td>
<td>The number of seconds to consider the cache file fresh.</td>
</tr>
<tr>
<th>set_max_checked_feeds</th>
<td>integer</td>
<td>When using auto-discovery, this is the number of links to check for the existence of a feed.</td>
</tr>
<tr>
<th>set_timeout</th>
<td>integer</td>
<td>The number of seconds to wait for a remote website while fetching a feed.</td>
</tr>
<tr>
<th>strip_attributes</th>
<td>string</td>
<td>A space-delimited list of <abbr title="HyperText Markup Language">HTML</abbr> attributes to remove from the feed's content.</td>
</tr>
<tr>
<th>strip_htmltags</th>
<td>string</td>
<td>A space-delimited list of <abbr title="HyperText Markup Language">HTML</abbr> tags to remove from the feed's content.</td>
</tr>
<tr>
<th>template</th>
<td>string</td>
<td>The template to use for displaying the feed. Can use the name of any template listed in the options panel, preferably lowercased with spaces replaced by underscores.</td>
</tr>
<tr>
<th>truncate_feed_description</th>
<td>integer</td>
<td>The number of characters to shorten the feed's description to. Only used with <code>{TRUNCATE_FEED_DESCRIPTION}</code> and <code>{TRUNCATE_ITEM_PARENT_DESCRIPTION}</code>.</td>
</tr>
<tr>
<th>truncate_feed_title</th>
<td>integer</td>
<td>The number of characters to shorten the feed's title to. Only used with <code>{TRUNCATE_FEED_TITLE}</code> and <code>{TRUNCATE_ITEM_PARENT_TITLE}</code>.</td>
</tr>
<tr>
<th>truncate_item_description</th>
<td>integer</td>
<td>The number of characters to shorten the item's description to. Only used with <code>{TRUNCATE_ITEM_DESCRIPTION}</code>.</td>
</tr>
<tr>
<th>truncate_item_title</th>
<td>integer</td>
<td>The number of characters to shorten the item's title to. Only used with <code>{TRUNCATE_ITEM_TITLE}</code>.</td>
</tr>
</tbody>
</table>

## Template Tags {#template_tags}

Another major feature is that instead of being locked into a single, simple layout, you can create your own layouts in the form of templates. The following is a list of template tags you can use. Feel free to take a look at the ones that were supplied in the `templates` folder.

### Plugin Tags {#plugin_tags}

These are tags that are related to the plugin, but not necessarily anything with the SimplePie <abbr title="Application Programming Interface">API</abbr>.

<table class="inline">
<tbody>
<tr>
<th>{PLUGIN_DIR}</th>
<td>Returns the web <abbr title="Uniform Resource Locator">URL</abbr> of the SimplePie plugin directory. This is useful for linking to images or other files that are stored inside the SimplePie plugin directory.</td>
</tr>
</tbody>
</table>

### Error Tags {#error_tags}

These tags are used for displaying error messages.

<table class="inline">
<tbody>
<tr>
<th>{IF_ERROR_BEGIN}</th>
<td>Marks the beginning of where the error message would display if there was one.</td>
</tr>
<tr>
<th>{IF_ERROR_END}</th>
<td>Marks the end of where the error message would display.</td>
</tr>
<tr>
<th>{ERROR_MESSAGE}</th>
<td>The error message that SimplePie throws.</td>
</tr>
</tbody>
</table>

### Feed/Anywhere-Level Tags {#feedanywhere-level_tags}

These tags can be used anywhere in the template.

<table class="inline">
<tbody>
<tr>
<th>{FEED_AUTHOR_EMAIL}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_email.md">$feed-&gt;get_author(0)-&gt;get_email()</a>.</td>
</tr>
<tr>
<th>{FEED_AUTHOR_LINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_link.md">$feed-&gt;get_author(0)-&gt;get_link()</a>.</td>
</tr>
<tr>
<th>{FEED_AUTHOR_NAME}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_name.md">$feed-&gt;get_author(0)-&gt;get_name()</a>.</td>
</tr>
<tr>
<th>{FEED_CONTRIBUTOR_EMAIL}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_email.md">$feed-&gt;get_contributor(0)-&gt;get_email()</a>.</td>
</tr>
<tr>
<th>{FEED_CONTRIBUTOR_LINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_link.md">$feed-&gt;get_contributor(0)-&gt;get_link()</a>.</td>
</tr>
<tr>
<th>{FEED_CONTRIBUTOR_NAME}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_name.md">$feed-&gt;get_contributor(0)-&gt;get_name()</a>.</td>
</tr>
<tr>
<th>{FEED_COPYRIGHT}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_copyright.md">$feed-&gt;get_copyright()</a>.</td>
</tr>
<tr>
<th>{FEED_DESCRIPTION}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_description.md">$feed-&gt;get_description()</a>.</td>
</tr>
<tr>
<th>{FEED_ENCODING}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_encoding.md">$feed-&gt;get_encoding()</a>.</td>
</tr>
<tr>
<th>{FEED_FAVICON}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_favicon.md">$feed-&gt;get_favicon()</a>.</td>
</tr>
<tr>
<th>{FEED_IMAGE_HEIGHT}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_image_height.md">$feed-&gt;get_image_height()</a>.</td>
</tr>
<tr>
<th>{FEED_IMAGE_LINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_image_link.md">$feed-&gt;get_image_link()</a>.</td>
</tr>
<tr>
<th>{FEED_IMAGE_TITLE}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_image_title.md">$feed-&gt;get_image_title()</a>.</td>
</tr>
<tr>
<th>{FEED_IMAGE_<abbr title="Uniform Resource Locator">URL</abbr>}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_image_url.md">$feed-&gt;get_image_url()</a>.</td>
</tr>
<tr>
<th>{FEED_IMAGE_WIDTH}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_image_width.md">$feed-&gt;get_image_width()</a>.</td>
</tr>
<tr>
<th>{FEED_LANGUAGE}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_language.md">$feed-&gt;get_language()</a>.</td>
</tr>
<tr>
<th>{FEED_LATITUDE}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_latitude.md">$feed-&gt;get_latitude()</a>.</td>
</tr>
<tr>
<th>{FEED_LONGITUDE}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_longitude.md">$feed-&gt;get_longitude()</a>.</td>
</tr>
<tr>
<th>{FEED_PERMALINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_permalink.md">$feed-&gt;get_permalink()</a>.</td>
</tr>
<tr>
<th>{FEED_TITLE}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_title.md">$feed-&gt;get_title()</a>.</td>
</tr>
<tr>
<th>{SUBSCRIBE_<abbr title="Uniform Resource Locator">URL</abbr>}</th>
<td>Same as <a href="@/wiki/reference/simplepie/subscribe_url.md">$feed-&gt;subscribe_url()</a>.</td>
</tr>
<tr>
<th>{TRUNCATE_FEED_DESCRIPTION}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_description.md">$feed-&gt;get_description()</a> except that it obeys the appropriate “truncate text” setting.</td>
</tr>
<tr>
<th>{TRUNCATE_FEED_TITLE}</th>
<td>Same as <a href="@/wiki/reference/simplepie/get_title.md">$feed-&gt;get_title()</a> except that it obeys the appropriate “truncate text” setting.</td>
</tr>
</tbody>
</table>

### Item Looping Tags {#item_looping_tags}

These tags mark the beginning and end of items.

<table class="inline">
<tbody>
<tr>
<th>{ITEM_LOOP_BEGIN}</th>
<td>Marks the beginning of where we should begin looping through items.</td>
</tr>
<tr>
<th>{ITEM_LOOP_END}</th>
<td>Marks the end of where we should stop looping through items.</td>
</tr>
</tbody>
</table>

### Item-Level Tags {#item-level_tags}

These are tags that can be used inside the item loop. These will NOT work outside of the item loop and there will be a <abbr title="Hypertext Preprocessor">PHP</abbr> error if you try.

<table class="inline">
<tbody>
<tr>
<th>{ITEM_AUTHOR_EMAIL}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_email.md">$item-&gt;get_author(0)-&gt;get_email()</a>.</td>
</tr>
<tr>
<th>{ITEM_AUTHOR_LINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_link.md">$item-&gt;get_author(0)-&gt;get_link()</a>.</td>
</tr>
<tr>
<th>{ITEM_AUTHOR_NAME}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_name.md">$item-&gt;get_author(0)-&gt;get_name()</a>.</td>
</tr>
<tr>
<th>{ITEM_CATEGORY}</th>
<td>Same as <a href="@/wiki/reference/simplepie_category/get_label.md">$item-&gt;get_category(0)-&gt;get_label()</a>.</td>
</tr>
<tr>
<th>{ITEM_CONTENT}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_content.md">$item-&gt;get_content()</a>.</td>
</tr>
<tr>
<th>{ITEM_CONTRIBUTOR_EMAIL}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_email.md">$item-&gt;get_contributor(0)-&gt;get_email()</a>.</td>
</tr>
<tr>
<th>{ITEM_CONTRIBUTOR_LINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_link.md">$item-&gt;get_contributor(0)-&gt;get_link()</a>.</td>
</tr>
<tr>
<th>{ITEM_CONTRIBUTOR_NAME}</th>
<td>Same as <a href="@/wiki/reference/simplepie_author/get_name.md">$item-&gt;get_contributor(0)-&gt;get_name()</a>.</td>
</tr>
<tr>
<th>{ITEM_COPYRIGHT}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_copyright.md">$item-&gt;get_copyright()</a>.</td>
</tr>
<tr>
<th>{ITEM_DATE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_date.md">$item-&gt;get_date()</a>.</td>
</tr>
<tr>
<th>{ITEM_DATE_UTC}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_date.md">$item-&gt;get_date()</a> except that a GMT/UTC timestamp is displayed.</td>
</tr>
<tr>
<th>{ITEM_DESCRIPTION}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_description.md">$item-&gt;get_description()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_BITRATE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_bitrate.md">$item-&gt;get_enclosure(0)-&gt;get_bitrate()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_CHANNELS}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_channels.md">$item-&gt;get_enclosure(0)-&gt;get_channels()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_DESCRIPTION}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_description.md">$item-&gt;get_enclosure(0)-&gt;get_description()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_DURATION}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_duration.md">$item-&gt;get_enclosure(0)-&gt;get_duration()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_EMBED}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/embed.md">$item-&gt;get_enclosure(0)-&gt;native_embed()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_EXPRESSION}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_expression.md">$item-&gt;get_enclosure(0)-&gt;get_expression()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_EXTENSION}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_extension.md">$item-&gt;get_enclosure(0)-&gt;get_extension()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_FRAMERATE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_framerate.md">$item-&gt;get_enclosure(0)-&gt;get_framerate()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_HANDLER}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_handler.md">$item-&gt;get_enclosure(0)-&gt;get_handler()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_HASH}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_hash.md">$item-&gt;get_enclosure(0)-&gt;get_hash()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_HEIGHT}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_height.md">$item-&gt;get_enclosure(0)-&gt;get_height()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_LANGUAGE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_language.md">$item-&gt;get_enclosure(0)-&gt;get_language()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_LENGTH}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_length.md">$item-&gt;get_enclosure(0)-&gt;get_length()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_LINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_link.md">$item-&gt;get_enclosure(0)-&gt;get_link()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_MEDIUM}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_medium.md">$item-&gt;get_enclosure(0)-&gt;get_medium()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_PLAYER}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_player.md">$item-&gt;get_enclosure(0)-&gt;get_player()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_REAL_TYPE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_real_type.md">$item-&gt;get_enclosure(0)-&gt;get_real_type()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_SAMPLINGRATE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_sampling_rate.md">$item-&gt;get_enclosure(0)-&gt;get_sampling_rate()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_SIZE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_size.md">$item-&gt;get_enclosure(0)-&gt;get_size()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_THUMBNAIL}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_thumbnail.md">$item-&gt;get_enclosure(0)-&gt;get_thumbnail()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_TITLE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_title.md">$item-&gt;get_enclosure(0)-&gt;get_title()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_TYPE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_type.md">$item-&gt;get_enclosure(0)-&gt;get_type()</a>.</td>
</tr>
<tr>
<th>{ITEM_ENCLOSURE_WIDTH}</th>
<td>Same as <a href="@/wiki/reference/simplepie_enclosure/get_width.md">$item-&gt;get_enclosure(0)-&gt;get_width()</a>.</td>
</tr>
<tr>
<th>{ITEM_ID}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_id.md">$item-&gt;get_id()</a>.</td>
</tr>
<tr>
<th>{ITEM_LATITUDE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_latitude.md">$item-&gt;get_latitude()</a>.</td>
</tr>
<tr>
<th>{ITEM_LOCAL_DATE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_local_date.md">$item-&gt;get_local_date()</a>.</td>
</tr>
<tr>
<th>{ITEM_LOCAL_DATE_UTC}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_local_date.md">$item-&gt;get_local_date()</a> except that a GMT/UTC timestamp is displayed.</td>
</tr>
<tr>
<th>{ITEM_LONGITUDE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_longitude.md">$item-&gt;get_longitude()</a>.</td>
</tr>
<tr>
<th>{ITEM_PERMALINK}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_permalink.md">$item-&gt;get_permalink()</a>.</td>
</tr>
<tr>
<th>{ITEM_TITLE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_title.md">$item-&gt;get_title()</a>.</td>
</tr>
<tr>
<th>{TRUNCATE_ITEM_DESCRIPTION}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_description.md">$item-&gt;get_description()</a> except that it obeys the appropriate “truncate text” setting.</td>
</tr>
<tr>
<th>{TRUNCATE_ITEM_TITLE}</th>
<td>Same as <a href="@/wiki/reference/simplepie_item/get_title.md">$item-&gt;get_title()</a> except that it obeys the appropriate “truncate text” setting.</td>
</tr>
</tbody>
</table>

### Newbie Note: Missing Data with Multifeeds {#newbie_notemissing_data_with_multifeeds}

You're merging multiple feeds together and you try to access data from `{FEED_TITLE}` or `{FEED_DESCRIPTION}` but there doesn't seem to be anything. Let's say that you're merging together 3 feeds, each with their own titles, descriptions, etc. We'll use Digg, Slashdot, and Apple as examples. Digg has its own title, so does Slashdot, and so does Apple. If there are 3 competing pieces of data, what should `{FEED_TITLE}` return?

Well, put simply, SimplePie has no idea which data to show, so it doesn't display anything.

So what do we do? If you merge together a feed from Digg and a feed from Slashdot, some items will be from Digg while others are from Slashdot – obviously. As you narrow down a specific item, you can get the feed-level information for that specific item using `{ITEM_PARENT_*}` tags like `{ITEM_PARENT_TITLE}` for example.

To use these tags, simply replace the `FEED` part of each of the feed-level tags above with `ITEM_PARENT`. `{FEED_TITLE}` becomes `{ITEM_PARENT_TITLE}`, `{FEED_DESCRIPTION}` becomes `{ITEM_PARENT_DESCRIPTION}` and so on. These tags only work properly between the `{ITEM_LOOP_BEGIN}` and `{ITEM_LOOP_END}` tags.

This is used in a few of the sample templates that came bundled with the plugin, so feel free to check them out to get a better feel for how they're used.

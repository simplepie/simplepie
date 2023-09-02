+++
title = "API Reference"
+++

<div class="warning">

**This documentation is for 1.2 only. 1.3 documentation can be found in the [API Docs](/api/ "http://simplepie.org/api/") section of the site.**

</div>

These are all of the public functions for SimplePie. Our goal is to not break any of these constructors and methods for all 1.x releases. If there are methods or constructors not mentioned here, or are marked “Non-Public”, then they are not considered public and may change tomorrow and the “no-breaking” rule does not apply to them. The next <abbr title="Application Programming Interface">API</abbr> breakage will be in SimplePie 2.0, but that's still quite a while off. :)

Documentation for the latest in-development build can be found in our automatically generated [API documentation](http://dev.simplepie.org/api/).

## SimplePie {#simplepie}

### Constructor {#constructor}

- [SimplePie](@/wiki/reference/simplepie/_index.md) — construct a new SimplePie object.

### Constants {#constants}

- [SIMPLEPIE_BUILD](@/wiki/reference/simplepie/simplepie_build.md) — Defines SimplePie's build ID.
- [SIMPLEPIE_LINKBACK](@/wiki/reference/simplepie/simplepie_linkback.md) — Defines the <abbr title="Uniform Resource Locator">URL</abbr> for linking back to SimplePie's website.
- [SIMPLEPIE_NAME](@/wiki/reference/simplepie/simplepie_name.md) — Defines SimplePie's name.
- [SIMPLEPIE_URL](@/wiki/reference/simplepie/simplepie_url.md) — Defines SimplePie's home page <abbr title="Uniform Resource Locator">URL</abbr>.
- [SIMPLEPIE_USERAGENT](@/wiki/reference/simplepie/simplepie_useragent.md) — Defines SimplePie's default user agent string.
- [SIMPLEPIE_VERSION](@/wiki/reference/simplepie/simplepie_version.md) — Defines SimplePie's version.

### Methods {#methods}

#### Configuration (Required) {#configuration_required}

- [set_feed_url()](@/wiki/reference/simplepie/set_feed_url.md) — <abbr title="Uniform Resource Locator">URL</abbr> of the feed you want to parse.

#### Configuration (Basic) {#configuration_basic}

- [enable_cache()](@/wiki/reference/simplepie/enable_cache.md) — Enable/disable caching in SimplePie.
- [enable_order_by_date()](@/wiki/reference/simplepie/enable_order_by_date.md) — Enable/disable the reordering of items into reverse chronological order.
- [set_cache_duration()](@/wiki/reference/simplepie/set_cache_duration.md) — Set the minimum time for which a feed will be cached.
- [set_cache_location()](@/wiki/reference/simplepie/set_cache_location.md) — Set the folder where the cache files should be written.
- [set_favicon_handler()](@/wiki/reference/simplepie/set_favicon_handler.md) — Set the handler to enable the display of cached favicons.
- [set_image_handler()](@/wiki/reference/simplepie/set_image_handler.md) — Set the handler to enable the display of cached images.
- [set_item_limit()](@/wiki/reference/simplepie/set_item_limit.md) — Set a limit on how many items are returned per feed with Multifeeds.
- [set_javascript()](@/wiki/reference/simplepie/set_javascript.md) — Set the query string used for the JavaScript for [embed()](@/wiki/reference/simplepie_enclosure/embed.md).
- [strip_attributes()](@/wiki/reference/simplepie/strip_attributes.md) — <abbr title="HyperText Markup Language">HTML</abbr> attributes to strip.
- [strip_comments()](@/wiki/reference/simplepie/strip_comments.md) — Strip <abbr title="HyperText Markup Language">HTML</abbr> comments.
- [strip_htmltags()](@/wiki/reference/simplepie/strip_htmltags.md) — <abbr title="HyperText Markup Language">HTML</abbr> tags to strip.

#### Configuration (Advanced) {#configuration_advanced}

- [enable_xml_dump()](@/wiki/reference/simplepie/enable_xml_dump.md) — Output the raw <abbr title="Extensible Markup Language">XML</abbr> feed, after it has gone through SimplePie's filters.
- [encode_instead_of_strip()](@/wiki/reference/simplepie/encode_instead_of_strip.md) — Encode the <abbr title="HyperText Markup Language">HTML</abbr> tags instead of stripping them.
- [force_feed()](@/wiki/reference/simplepie/force_feed.md) — Force SimplePie to parse the content, even if it doesn't believe it's a feed.
- [force_fsockopen()](@/wiki/reference/simplepie/force_fsockopen.md) — Use instead of the preferred extension for fetching remote files.
- [remove_div()](@/wiki/reference/simplepie/remove_div.md) — Remove the surrounding \<div\> from <abbr title="Extensible HyperText Markup Language">XHTML</abbr> content in Atom feeds.
- [set_autodiscovery_cache_duration()](@/wiki/reference/simplepie/set_autodiscovery_cache_duration.md) — Set the maximum time for which an autodiscovered feed <abbr title="Uniform Resource Locator">URL</abbr> will be cached.
- [set_autodiscovery_level()](@/wiki/reference/simplepie/set_autodiscovery_level.md) — Set what types of autodiscovery to use.
- [set_cache_name_function()](@/wiki/reference/simplepie/set_cache_name_function.md) — Set the callback function used to create cache filenames.
- [set_file()](@/wiki/reference/simplepie/set_file.md) — Set an instance of [SimplePie_File](@/wiki/reference/simplepie_file/_index.md) to use as a feed.
- [set_input_encoding()](@/wiki/reference/simplepie/set_input_encoding.md) — Override the character set within the feed.
- [set_max_checked_feeds()](@/wiki/reference/simplepie/set_max_checked_feeds.md) — Maximum number of URLs to check whether they are feeds before giving up.
- [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md) — Set the output character set.
- [set_raw_data()](@/wiki/reference/simplepie/set_raw_data.md) — String of Atom/<abbr title="Rich Site Summary">RSS</abbr> data to use as a feed.
- [set_stupidly_fast()](@/wiki/reference/simplepie/set_stupidly_fast.md) — Set the configurations to make SimplePie as fast as possible (if you don't do your own data sanitisation this can be a security hole).
- [set_timeout()](@/wiki/reference/simplepie/set_timeout.md) — Timeout for fetching remote files.
- [set_url_replacements()](@/wiki/reference/simplepie/set_url_replacements.md) — Set <abbr title="HyperText Markup Language">HTML</abbr> attributes containing URLs that need to be resolved relative to the feed.
- [set_useragent()](@/wiki/reference/simplepie/set_useragent.md) — Set the useragent SimplePie should use for fetching remote files.

#### Extending Classes (Advanced) {#extending_classes_advanced}

- [Extending the SimplePie class](@/wiki/reference/simplepie/extending_the_simplepie_class.md) – Notes on how to extend the [SimplePie](@/wiki/reference/simplepie/_index.md) class like the others below.
- [set_author_class()](@/wiki/reference/simplepie/set_author_class.md) – Set the class to use for authors.
- [set_cache_class()](@/wiki/reference/simplepie/set_cache_class.md) – Set the class to use for caching.
- [set_caption_class()](@/wiki/reference/simplepie/set_caption_class.md) – Set the class to use for Media <abbr title="Rich Site Summary">RSS</abbr> caption data.
- [set_category_class()](@/wiki/reference/simplepie/set_category_class.md) – Set the class to use for categories.
- [set_content_type_sniffer_class()](@/wiki/reference/simplepie/set_content_type_sniffer_class.md) – Set the class to use for content-type sniffing.
- [set_copyright_class()](@/wiki/reference/simplepie/set_copyright_class.md) – Set the class to use for Media <abbr title="Rich Site Summary">RSS</abbr> copyright data.
- [set_credit_class()](@/wiki/reference/simplepie/set_credit_class.md) – Set the class to use for Media <abbr title="Rich Site Summary">RSS</abbr> credit data.
- [set_enclosure_class()](@/wiki/reference/simplepie/set_enclosure_class.md) – Set the class to use for enclosures.
- [set_file_class()](@/wiki/reference/simplepie/set_file_class.md) – Set the class to use for reading files (both local and remote).
- [set_item_class()](@/wiki/reference/simplepie/set_item_class.md) – Set the class to use for items.
- [set_locator_class()](@/wiki/reference/simplepie/set_locator_class.md) – Set the class to use for auto-discovery.
- [set_parser_class()](@/wiki/reference/simplepie/set_parser_class.md) – Set the class to use for <abbr title="Extensible Markup Language">XML</abbr> parsing.
- [set_rating_class()](@/wiki/reference/simplepie/set_rating_class.md) – Set the class to use for Media <abbr title="Rich Site Summary">RSS</abbr> rating data.
- [set_restriction_class()](@/wiki/reference/simplepie/set_restriction_class.md) – Set the class to use for Media <abbr title="Rich Site Summary">RSS</abbr> restriction data.
- [set_sanitize_class()](@/wiki/reference/simplepie/set_sanitize_class.md) – Set the class to use for data sanitization.
- [set_source_class()](@/wiki/reference/simplepie/set_source_class.md) – Set the class to use for handling `atom:source`.

#### Processing {#processing}

- [\_\_destruct()](@/wiki/reference/simplepie/destruct.md) – Used for avoiding memory leaks when processing lots of feeds.
- [error()](@/wiki/reference/simplepie/error.md) — Return the error message for the occured error.
- [handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md) — Sets the proper <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> headers for the page, setting the character set to match the output encoding.
- [init()](@/wiki/reference/simplepie/init.md) — Initialise the feed, parsing it, etc.

#### Feed-Level Data (Basic) {#feed-level_data_basic}

- [get_author()](@/wiki/reference/simplepie/get_author.md) — Get a single author for the feed. Returns a reference to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_authors()](@/wiki/reference/simplepie/get_authors.md) — Get all authors for the feed. Returns references to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_contributor()](@/wiki/reference/simplepie/get_contributor.md) — Get a single contributor for the feed. Returns a reference to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_contributors()](@/wiki/reference/simplepie/get_contributors.md) — Get all contributors for the feed. Returns references to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_copyright()](@/wiki/reference/simplepie/get_copyright.md) — Get the feed copyright information.
- [get_description()](@/wiki/reference/simplepie/get_description.md) — Get the feed description.
- [get_encoding()](@/wiki/reference/simplepie/get_encoding.md) — Get the character set for the returned values.
- [get_favicon()](@/wiki/reference/simplepie/get_favicon.md) — Get the <abbr title="Uniform Resource Locator">URL</abbr> for the favicon of the feed's website.
- [get_item()](@/wiki/reference/simplepie/get_item.md) — Get a single item. Returns a reference to [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md).
- [get_items()](@/wiki/reference/simplepie/get_items.md) — Get all the items. Returns references to [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md).
- [get_item_quantity()](@/wiki/reference/simplepie/get_item_quantity.md) — Get the number of items in the feed.
- [get_language()](@/wiki/reference/simplepie/get_language.md) — Get the feed language.
- [get_link()](@/wiki/reference/simplepie/get_link.md) — Get a single link.
- [get_links()](@/wiki/reference/simplepie/get_links.md) — Get all the links of a specific relation.
- [get_permalink()](@/wiki/reference/simplepie/get_permalink.md) — Get the first feed link (i.e. the permalink).
- [get_title()](@/wiki/reference/simplepie/get_title.md) — Get the feed title.
- [get_type()](@/wiki/reference/simplepie/get_type.md) — Get the type of feed.

#### Feed-Level GeoData {#feed-level_geodata}

- [get_latitude()](@/wiki/reference/simplepie/get_latitude.md) — Get the feed latitude.
- [get_longitude()](@/wiki/reference/simplepie/get_longitude.md) — Get the feed longitude.

#### Feed Logo {#feed_logo}

- [get_image_height()](@/wiki/reference/simplepie/get_image_height.md) — Get the logo/image height.
- [get_image_link()](@/wiki/reference/simplepie/get_image_link.md) — Get the logo/image linkback <abbr title="Uniform Resource Locator">URL</abbr>.
- [get_image_title()](@/wiki/reference/simplepie/get_image_title.md) — Get the logo/image title.
- [get_image_url()](@/wiki/reference/simplepie/get_image_url.md) — Get the logo/image <abbr title="Uniform Resource Locator">URL</abbr>.
- [get_image_width()](@/wiki/reference/simplepie/get_image_width.md) — Get the logo/image width.

#### Feed-Level Data Hacking (Advanced) {#feed-level_data_hacking_advanced}

- [get_all_discovered_feeds()](@/wiki/reference/simplepie/get_all_discovered_feeds.md) — Get all feeds discovered during the autodiscovery process.
- [get_base()](@/wiki/reference/simplepie/get_base.md) – Get the `xml:base` value of a given element.
- [get_channel_tags()](@/wiki/reference/simplepie/get_channel_tags.md) — Get the value of ANY tag in the “channel” section of the feed.
- [get_feed_tags()](@/wiki/reference/simplepie/get_feed_tags.md) — Get the value of ANY tag in the “feed” section of the feed.
- [get_image_tags()](@/wiki/reference/simplepie/get_image_tags.md) — Get the value of ANY tag in the “image” section of the feed.
- [merge_items()](@/wiki/reference/simplepie/merge_items.md) — Merge the items of multiple feeds together.
- [sanitize()](@/wiki/reference/simplepie/sanitize.md) – Sanitizes data based on the type of data it is expected to be.
- [sort_items()](@/wiki/reference/simplepie/sort_items.md) – An over-ridable method that handles the sorting of items by some criteria.

#### One-Click Subscriptions {#one-click_subscriptions}

- [subscribe_aol()](@/wiki/reference/simplepie/subscribe_aol.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in My <abbr title="America Online">AOL</abbr>.
- [subscribe_bloglines()](@/wiki/reference/simplepie/subscribe_bloglines.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Bloglines.
- [subscribe_eskobo()](@/wiki/reference/simplepie/subscribe_eskobo.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Eskobo.
- [subscribe_feed()](@/wiki/reference/simplepie/subscribe_feed.md) — The actual feed <abbr title="Uniform Resource Locator">URL</abbr>, with a `feed: protocol for subscribing in a desktop aggregator. * subscribe_feedfeeds() — URL for subscribing in FeedFeeds. * subscribe_feedster() — URL for subscribing in Feedster. * subscribe_google() — URL for subscribing in Google Reader. * subscribe_gritwire() — URL for subscribing in Gritwire. * subscribe_itunes() — The actual feed URL, with an `itpc: protocol for subscribing in iTunes.
- [subscribe_msn()](@/wiki/reference/simplepie/subscribe_msn.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in My MSN.
- [subscribe_netvibes()](@/wiki/reference/simplepie/subscribe_netvibes.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Netvibes.
- [subscribe_newsburst()](@/wiki/reference/simplepie/subscribe_newsburst.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Newsburst.
- [subscribe_newsgator()](@/wiki/reference/simplepie/subscribe_newsgator.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Newsgator.
- [subscribe_odeo()](@/wiki/reference/simplepie/subscribe_odeo.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Odeo.
- [subscribe_outlook()](@/wiki/reference/simplepie/subscribe_outlook.md) — The actual feed <abbr title="Uniform Resource Locator">URL</abbr>, with an `outlook: protocol for subscribing in Microsoft Outlook 2007. * subscribe_podcast() — The actual feed URL, with a `podcast: protocol for subscribing in a desktop podcast player.
- [subscribe_podnova()](@/wiki/reference/simplepie/subscribe_podnova.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Podnova.
- [subscribe_rojo()](@/wiki/reference/simplepie/subscribe_rojo.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in Rojo.
- [subscribe_url()](@/wiki/reference/simplepie/subscribe_url.md) — The actual feed <abbr title="Uniform Resource Locator">URL</abbr>.
- [subscribe_yahoo()](@/wiki/reference/simplepie/subscribe_yahoo.md) — <abbr title="Uniform Resource Locator">URL</abbr> for subscribing in My Yahoo!

## SimplePie_Item {#simplepie_item}

- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md) — Learn more about this object.

### Methods {#methods1}

#### Item-Level Data (Basic) {#item-level_data_basic}

- [get_author()](@/wiki/reference/simplepie_item/get_author.md) — Get a single author for the post. Returns a reference to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_authors()](@/wiki/reference/simplepie_item/get_authors.md) — Get all authors for the post. Returns references to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_categories()](@/wiki/reference/simplepie_item/get_categories.md) — Get all categories for the post. Returns a reference to [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md).
- [get_category()](@/wiki/reference/simplepie_item/get_category.md) — Get a single category for the post. Returns references to [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md).
- [get_content()](@/wiki/reference/simplepie_item/get_content.md) — Get the content of the post (prefers full-content)
- [get_contributor()](@/wiki/reference/simplepie_item/get_contributor.md) — Get a single contributor for the post. Returns a reference to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_contributors()](@/wiki/reference/simplepie_item/get_contributors.md) — Get all contributors for the post. Returns references to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_copyright()](@/wiki/reference/simplepie_item/get_copyright.md) — Get the copyright information for the post.
- [get_date()](@/wiki/reference/simplepie_item/get_date.md) — Get the date for the post.
- [get_description()](@/wiki/reference/simplepie_item/get_description.md) — Get the content of the post (prefers summaries)
- [get_enclosure()](@/wiki/reference/simplepie_item/get_enclosure.md) — Get a single enclosure for the post. Returns a reference to [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md).
- [get_enclosures()](@/wiki/reference/simplepie_item/get_enclosures.md) — Get all enclosures for the post. Returns references to [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md).
- [get_feed()](@/wiki/reference/simplepie_item/get_feed.md) — Get a reference to the parent feed object. Returns a reference to [SimplePie](@/wiki/reference/simplepie/_index.md).
- [get_id()](@/wiki/reference/simplepie_item/get_id.md) — Get the unique identifier for the post.
- [get_link()](@/wiki/reference/simplepie_item/get_link.md) — Get a single link for the post.
- [get_links()](@/wiki/reference/simplepie_item/get_links.md) — Get all links for the post of a specific relation.
- [get_local_date()](@/wiki/reference/simplepie_item/get_local_date.md) — Get the localized date for the post.
- [get_permalink()](@/wiki/reference/simplepie_item/get_permalink.md) — Get the first link for the post (i.e. the permalink).
- [get_source()](@/wiki/reference/simplepie_item/get_source.md) — Get a reference to the feed referenced in `atom:source`. Returns a reference to [SimplePie_Source](@/wiki/reference/simplepie_source/_index.md).
- [get_title()](@/wiki/reference/simplepie_item/get_title.md) — Get the title for the post.

#### Item-Level GeoData {#item-level_geodata}

- [get_latitude()](@/wiki/reference/simplepie_item/get_latitude.md) — Get the post latitude.
- [get_longitude()](@/wiki/reference/simplepie_item/get_longitude.md) — Get the post longitude.

#### Item-Level Data Hacking (Advanced) {#item-level_data_hacking_advanced}

- [get_base()](@/wiki/reference/simplepie/get_base.md) – Get the `xml:base` value of a given element.
- [get_item_tags()](@/wiki/reference/simplepie_item/get_item_tags.md) — Get the value of ANY tag in the item.
- [sanitize()](@/wiki/reference/simplepie/sanitize.md) – Sanitizes data based on the type of data it is expected to be.

#### Bookmarking {#bookmarking}

- [add_to_service()](@/wiki/reference/simplepie_item/add_to_service.md) — Generic method for adding more “add to” services.
- [add_to_blinklist()](@/wiki/reference/simplepie_item/add_to_blinklist.md) — Add the post to Blinklist.
- [add_to_blogmarks()](@/wiki/reference/simplepie_item/add_to_blogmarks.md) — Add the post to Blogmarks.
- [add_to_delicious()](@/wiki/reference/simplepie_item/add_to_delicious.md) — Add the post to Del.icio.us.
- [add_to_digg()](@/wiki/reference/simplepie_item/add_to_digg.md) — Add the post to Digg.
- [add_to_furl()](@/wiki/reference/simplepie_item/add_to_furl.md) — Add the post to Furl.
- [add_to_magnolia()](@/wiki/reference/simplepie_item/add_to_magnolia.md) — Add the post to Ma.gnolia.
- [add_to_myweb20()](@/wiki/reference/simplepie_item/add_to_myweb20.md) — Add the post to My Web 2.0.
- [add_to_newsvine()](@/wiki/reference/simplepie_item/add_to_newsvine.md) — Add the post to Newsvine.
- [add_to_reddit()](@/wiki/reference/simplepie_item/add_to_reddit.md) — Add the post to Reddit.
- [add_to_segnalo()](@/wiki/reference/simplepie_item/add_to_segnalo.md) — Add the post to Segnalo.
- [add_to_simpy()](@/wiki/reference/simplepie_item/add_to_simpy.md) — Add the post to Simpy.
- [add_to_spurl()](@/wiki/reference/simplepie_item/add_to_spurl.md) — Add the post to Spurl.
- [add_to_wists()](@/wiki/reference/simplepie_item/add_to_wists.md) — Add the post to Wists.
- [search_technorati()](@/wiki/reference/simplepie_item/search_technorati.md) — Search for discussions about the post.

## SimplePie_Author {#simplepie_author}

- [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md) — Learn more about this object.

### Methods {#methods2}

#### Author-Level Data {#author-level_data}

- [get_email()](@/wiki/reference/simplepie_author/get_email.md) — Get the author's email address.
- [get_link()](@/wiki/reference/simplepie_author/get_link.md) — Get the author's link.
- [get_name()](@/wiki/reference/simplepie_author/get_name.md) — Get the author's name.

## SimplePie_Category {#simplepie_category}

- [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md) — Learn more about this object.

### Methods {#methods3}

#### Category-Level Data {#category-level_data}

- [get_term()](@/wiki/reference/simplepie_category/get_term.md) — Get the category's identifier.
- [get_scheme()](@/wiki/reference/simplepie_category/get_scheme.md) — Get the category's categorization scheme identifier.
- [get_label()](@/wiki/reference/simplepie_category/get_label.md) — Get the category's human-readable label.

## SimplePie_Enclosure {#simplepie_enclosure}

- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md) — Learn more about this object.

### Methods {#methods4}

#### Enclosure-Level Data {#enclosure-level_data}

- [get_extension()](@/wiki/reference/simplepie_enclosure/get_extension.md) – Get the file extension of the enclosure.
- [get_handler()](@/wiki/reference/simplepie_enclosure/get_handler.md) – Get the preferred plugin handler for this content.
- [get_length()](@/wiki/reference/simplepie_enclosure/get_length.md) – Get the file size (in bytes) of the enclosure.
- [get_link()](@/wiki/reference/simplepie_enclosure/get_link.md) – Get the <abbr title="Uniform Resource Locator">URL</abbr> of the enclosure.
- [get_real_type()](@/wiki/reference/simplepie_enclosure/get_real_type.md) – Get the mime type that the enclosure likely is (despite the [get_type()](@/wiki/reference/simplepie_enclosure/get_type.md) setting)
- [get_size()](@/wiki/reference/simplepie_enclosure/get_size.md) – Get the file size (in Mebibytes) of the enclosure.
- [get_type()](@/wiki/reference/simplepie_enclosure/get_type.md) – Get the mime type of the enclosure.

#### Extended Enclosure-Level Data (Media RSS, iTunes RSS) {#extended_enclosure-level_data_media_rss_itunes_rss}

- [get_bitrate()](@/wiki/reference/simplepie_enclosure/get_bitrate.md) – Get the bitrate of the enclosure.
- [get_caption()](@/wiki/reference/simplepie_enclosure/get_caption.md) – Get a single caption for the enclosure. Returns a reference to [SimplePie_Caption](@/wiki/reference/simplepie_caption/_index.md).
- [get_captions()](@/wiki/reference/simplepie_enclosure/get_captions.md) – Get all captions for the enclosure. Returns references to [SimplePie_Caption](@/wiki/reference/simplepie_caption/_index.md).
- [get_category()](@/wiki/reference/simplepie_enclosure/get_category.md) – Get a single category for the enclosure. Returns a reference to [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md).
- [get_categories()](@/wiki/reference/simplepie_enclosure/get_categories.md) – Get all categories for the enclosure. Returns references to [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md).
- [get_channels()](@/wiki/reference/simplepie_enclosure/get_channels.md) – Get the number of audio channels for the enclosure.
- [get_copyright()](@/wiki/reference/simplepie_enclosure/get_copyright.md) – Get the copyright info for the enclosure. Returns a reference to [SimplePie_Copyright](@/wiki/reference/simplepie_copyright/_index.md).
- [get_credit()](@/wiki/reference/simplepie_enclosure/get_credit.md) – Get a single credit for the enclosure. Returns a reference to [SimplePie_Credit](@/wiki/reference/simplepie_credit/_index.md).
- [get_credits()](@/wiki/reference/simplepie_enclosure/get_credits.md) – Get all credits for the enclosure. Returns references to [SimplePie_Credit](@/wiki/reference/simplepie_credit/_index.md).
- [get_description()](@/wiki/reference/simplepie_enclosure/get_description.md) – Get the description of the enclosure.
- [get_duration()](@/wiki/reference/simplepie_enclosure/get_duration.md) – Get the duration (in seconds) of the enclosure.
- [get_expression()](@/wiki/reference/simplepie_enclosure/get_expression.md) – Get the expression of the enclosure.
- [get_framerate()](@/wiki/reference/simplepie_enclosure/get_framerate.md) – Get the framerate of the enclosure.
- [get_hash()](@/wiki/reference/simplepie_enclosure/get_hash.md) – Get a single hash for the enclosure.
- [get_hashes()](@/wiki/reference/simplepie_enclosure/get_hashes.md) – Get all hashes for the enclosure.
- [get_height()](@/wiki/reference/simplepie_enclosure/get_height.md) – Get the height of the enclosure.
- [get_keyword()](@/wiki/reference/simplepie_enclosure/get_keyword.md) – Get a single keyword for the enclosure.
- [get_keywords()](@/wiki/reference/simplepie_enclosure/get_keywords.md) – Get all keywords for the enclosure.
- [get_language()](@/wiki/reference/simplepie_enclosure/get_language.md) – Get the language of the enclosure.
- [get_medium()](@/wiki/reference/simplepie_enclosure/get_medium.md) – Get the medium of the enclosure.
- [get_player()](@/wiki/reference/simplepie_enclosure/get_player.md) – Get the player page for the enclosure.
- [get_rating()](@/wiki/reference/simplepie_enclosure/get_rating.md) – Get a single rating for the enclosure. Returns a reference to [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md).
- [get_ratings()](@/wiki/reference/simplepie_enclosure/get_ratings.md) – Get all ratings for the enclosure. Returns references to [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md).
- [get_restriction()](@/wiki/reference/simplepie_enclosure/get_restriction.md) – Get a single restriction for the enclosure. Returns a reference to [SimplePie_Restriction](@/wiki/reference/simplepie_restriction/_index.md).
- [get_restrictions()](@/wiki/reference/simplepie_enclosure/get_restrictions.md) – Get all restrictions for the enclosure. Returns references to [SimplePie_Restriction](@/wiki/reference/simplepie_restriction/_index.md).
- [get_sampling_rate()](@/wiki/reference/simplepie_enclosure/get_sampling_rate.md) – Get the sampling rate of the enclosure.
- [get_thumbnail()](@/wiki/reference/simplepie_enclosure/get_thumbnail.md) – Get a single thumbnail for the enclosure.
- [get_thumbnails()](@/wiki/reference/simplepie_enclosure/get_thumbnails.md) – Get all thumbnails for the enclosure.
- [get_title()](@/wiki/reference/simplepie_enclosure/get_title.md) – Get the title of the enclosure.
- [get_width()](@/wiki/reference/simplepie_enclosure/get_width.md) – Get the width of the enclosure.

#### Embedding {#embedding}

- [embed()](@/wiki/reference/simplepie_enclosure/embed.md) — Automatically embed the enclosure in the page using JavaScript.
- [native_embed()](@/wiki/reference/simplepie_enclosure/native_embed.md) — Automatically embed the enclosure in the page using the \<embed\> tag.

## SimplePie_Caption {#simplepie_caption}

- [SimplePie_Caption](@/wiki/reference/simplepie_caption/_index.md) — Learn more about this object.

### Methods {#methods5}

#### Caption-Level Data {#caption-level_data}

- [get_endtime()](@/wiki/reference/simplepie_caption/get_endtime.md) — Get the time that a caption should end.
- [get_language()](@/wiki/reference/simplepie_caption/get_language.md) — Get the language of the caption.
- [get_starttime()](@/wiki/reference/simplepie_caption/get_starttime.md) — Get the time that a caption should start.
- [get_text()](@/wiki/reference/simplepie_caption/get_text.md) — Get the text to display.
- [get_type()](@/wiki/reference/simplepie_caption/get_type.md) — Get the type of the caption (`text` or `html`).

## SimplePie_Copyright {#simplepie_copyright}

- [SimplePie_Copyright](@/wiki/reference/simplepie_copyright/_index.md) — Learn more about this object.

### Methods {#methods6}

#### Copyright-Level Data {#copyright-level_data}

- [get_attribution()](@/wiki/reference/simplepie_copyright/get_attribution.md) — Get the copyright attribution.
- [get_url()](@/wiki/reference/simplepie_copyright/get_url.md) — Get the <abbr title="Uniform Resource Locator">URL</abbr> containing more information.

## SimplePie_Credit {#simplepie_credit}

- [SimplePie_Credit](@/wiki/reference/simplepie_credit/_index.md) — Learn more about this object.

### Methods {#methods7}

#### Credit-Level Data {#credit-level_data}

- [get_name()](@/wiki/reference/simplepie_credit/get_name.md) — Get the credited person/entity's name.
- [get_role()](@/wiki/reference/simplepie_credit/get_role.md) — Get the credited role.
- [get_scheme()](@/wiki/reference/simplepie_credit/get_scheme.md) — Get the organizational scheme for the credit.

## SimplePie_Rating {#simplepie_rating}

- [SimplePie_Rating](@/wiki/reference/simplepie_rating/_index.md) — Learn more about this object.

### Methods {#methods8}

#### Rating-Level Data {#rating-level_data}

- [get_scheme()](@/wiki/reference/simplepie_rating/get_scheme.md) — Get the organizational scheme for the rating.
- [get_value()](@/wiki/reference/simplepie_rating/get_value.md) — Get the rating itself.

## SimplePie_Restriction {#simplepie_restriction}

- [SimplePie_Restriction](@/wiki/reference/simplepie_restriction/_index.md) — Learn more about this object.

### Methods {#methods9}

#### Restriction-Level Data {#restriction-level_data}

- [get_relationship()](@/wiki/reference/simplepie_restriction/get_relationship.md) — Get whether it's `allow` or `deny`.
- [get_type()](@/wiki/reference/simplepie_restriction/get_type.md) — Get the type of restriction.
- [get_value()](@/wiki/reference/simplepie_restriction/get_value.md) — Get the list of things that are restricted.

## SimplePie_Source {#simplepie_source}

- [SimplePie_Source](@/wiki/reference/simplepie_source/_index.md) — Learn more about this object.

### Methods {#methods10}

Most of these methods are identical to those of [SimplePie](@/wiki/reference/simplepie/_index.md) and [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md) methods, so we're linking back to those docs.

#### Source-Level Data (Basic) {#source-level_data_basic}

- [get_author()](@/wiki/reference/simplepie_item/get_author.md) – Get a single author for the source. Returns a reference to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_authors()](@/wiki/reference/simplepie_item/get_authors.md) – Get all authors for the source. Returns references to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_categories()](@/wiki/reference/simplepie_item/get_categories.md) – Get all categories for the source. Returns a reference to [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md).
- [get_category()](@/wiki/reference/simplepie_item/get_category.md) – Get a single category for the source. Returns references to [SimplePie_Category](@/wiki/reference/simplepie_category/_index.md).
- [get_contributor()](@/wiki/reference/simplepie_item/get_contributor.md) – Get a single contributor for the source. Returns a reference to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_contributors()](@/wiki/reference/simplepie_item/get_contributors.md) – Get all contributors for the source. Returns references to [SimplePie_Author](@/wiki/reference/simplepie_author/_index.md).
- [get_copyright()](@/wiki/reference/simplepie_item/get_copyright.md) – Get the copyright information for the source.
- [get_description()](@/wiki/reference/simplepie_item/get_description.md) – Get the content of the source.
- [get_image_url()](@/wiki/reference/simplepie/get_image_url.md) – Get the logo/image <abbr title="Uniform Resource Locator">URL</abbr>.
- [get_item()](@/wiki/reference/simplepie_source/get_item.md) – Get a reference to the parent item object. Returns a reference to [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md).
- [get_language()](@/wiki/reference/simplepie/get_language.md) – Get the source language.
- [get_link()](@/wiki/reference/simplepie_item/get_link.md) – Get a single link for the source.
- [get_links()](@/wiki/reference/simplepie_item/get_links.md) – Get all links for the source of a specific relation.
- [get_permalink()](@/wiki/reference/simplepie_item/get_permalink.md) – Get the first link for the source (i.e. the permalink).
- [get_title()](@/wiki/reference/simplepie_item/get_title.md) – Get the title for the source.

#### Source-Level GeoData {#source-level_geodata}

- [get_latitude()](@/wiki/reference/simplepie_item/get_latitude.md) – Get the source latitude.
- [get_longitude()](@/wiki/reference/simplepie_item/get_longitude.md) – Get the source longitude.

#### Source-Level Data Hacking (Advanced) {#source-level_data_hacking_advanced}

- [get_base()](@/wiki/reference/simplepie/get_base.md) – Get the `xml:base` value of a given element.
- [get_source_tags()](@/wiki/reference/simplepie_source/get_source_tags.md) – Get the value of ANY tag in the source.
- [sanitize()](@/wiki/reference/simplepie/sanitize.md) – Sanitizes data based on the type of data it is expected to be.

## SimplePie_Cache (Non-Public) {#simplepie_cache_non-public}

- [SimplePie_Cache](@/wiki/reference/simplepie_cache/_index.md) — Learn more about this object.

## SimplePie_Cache_File (Non-Public) {#simplepie_cache_file_non-public}

- [SimplePie_Cache_File](@/wiki/reference/simplepie_cache_file/_index.md) — Learn more about this object.

## SimplePie_Content_Type_Sniffer (Non-Public) {#simplepie_content_type_sniffer_non-public}

- [SimplePie_Content_Type_Sniffer](@/wiki/reference/simplepie_content_type_sniffer/_index.md) — Learn more about this object.

## SimplePie_Decode_HTML_Entities (Non-Public) {#simplepie_decode_html_entities_non-public}

- [SimplePie_Decode_HTML_Entities](@/wiki/reference/simplepie_decode_html_entities/_index.md) — Learn more about this object.

## SimplePie_File (Non-Public) {#simplepie_file_non-public}

- [SimplePie_File](@/wiki/reference/simplepie_file/_index.md) — Learn more about this object.

## SimplePie_Locator (Non-Public) {#simplepie_locator_non-public}

- [SimplePie_Locator](@/wiki/reference/simplepie_locator/_index.md) — Learn more about this object.

## SimplePie_HTTP_Parser (Non-Public) {#simplepie_http_parser_non-public}

- [SimplePie_HTTP_Parser](@/wiki/reference/simplepie_http_parser/_index.md) — Learn more about this object.

## SimplePie_Misc (Non-Public) {#simplepie_misc_non-public}

- [SimplePie_Misc](@/wiki/reference/simplepie_misc/_index.md) — Learn more about this object.

## SimplePie_Parser (Non-Public) {#simplepie_parser_non-public}

- [SimplePie_Parser](@/wiki/reference/simplepie_parser/_index.md) — Learn more about this object.

## SimplePie_Parse_Date (Non-Public) {#simplepie_parse_date_non-public}

- [SimplePie_Parse_Date](@/wiki/reference/simplepie_parse_date/_index.md) — Learn more about this object.

## SimplePie_Sanitize (Non-Public) {#simplepie_sanitize_non-public}

- [SimplePie_Sanitize](@/wiki/reference/simplepie_sanitize/_index.md) — Learn more about this object.

## SimplePie_XML_Declaration_Parser (Non-Public) {#simplepie_xml_declaration_parser_non-public}

- [SimplePie_XML_Declaration_Parser](@/wiki/reference/simplepie_xml_declaration_parser/_index.md) — Learn more about this object.

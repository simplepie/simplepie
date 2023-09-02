+++
title = "Upgrading from Beta 2, 3, 3.1, or 3.2"
+++

Several method names were changed between Beta 3 and 1.0 in an effort to have the most logical names for our 1.x releases (since we're planning NO public <abbr title="Application Programming Interface">API</abbr> breakages through the entire 1.x series of releases). There were no <abbr title="Application Programming Interface">API</abbr> breakages between Beta 2 and Beta 3, 3.1, or 3.2, so upgrading to 1.0 should be the same as upgrading from Beta 3.x. Beta 2 users should see a **remarkable** difference in speed and compatibility after the upgrade.

## SimplePie Properties {#simplepie_properties}

<table class="inline">
<thead>
<tr>
<th>Old name</th>
<th>New name</th>
</tr>
</thead>
<tbody>
<tr>
<td>build</td>
<td><a href="@/wiki/reference/simplepie/simplepie_build.md">SIMPLEPIE_BUILD</a> (constant)</td>
</tr>
<tr>
<td>error</td>
<td><a href="@/wiki/reference/simplepie/error.md">error()</a></td>
</tr>
<tr>
<td>linkback</td>
<td><a href="@/wiki/reference/simplepie/simplepie_linkback.md">SIMPLEPIE_LINKBACK</a> (constant)</td>
</tr>
<tr>
<td>name</td>
<td><a href="@/wiki/reference/simplepie/simplepie_name.md">SIMPLEPIE_NAME</a> (constant)</td>
</tr>
<tr>
<td>url</td>
<td><a href="@/wiki/reference/simplepie/simplepie_url.md">SIMPLEPIE_URL</a> (constant)</td>
</tr>
<tr>
<td>useragent</td>
<td><a href="@/wiki/reference/simplepie/simplepie_useragent.md">SIMPLEPIE_USERAGENT</a> (constant)</td>
</tr>
<tr>
<td>version</td>
<td><a href="@/wiki/reference/simplepie/simplepie_version.md">SIMPLEPIE_VERSION</a> (constant)</td>
</tr>
</tbody>
</table>

## Configuration Options {#configuration_options}

<table class="inline">
<thead>
<tr>
<th>Old name</th>
<th>New name</th>
</tr>
</thead>
<tbody>
<tr>
<td>feed_url()</td>
<td><a href="@/wiki/reference/simplepie/set_feed_url.md">set_feed_url()</a></td>
</tr>
<tr>
<td>enable_caching()</td>
<td><a href="@/wiki/reference/simplepie/enable_cache.md">enable_cache()</a></td>
</tr>
<tr>
<td>order_by_date()</td>
<td><a href="@/wiki/reference/simplepie/enable_order_by_date.md">enable_order_by_date()</a></td>
</tr>
<tr>
<td>cache_max_minutes()</td>
<td><a href="@/wiki/reference/simplepie/set_cache_duration.md">set_cache_duration()</a></td>
</tr>
<tr>
<td>cache_location()</td>
<td><a href="@/wiki/reference/simplepie/set_cache_location.md">set_cache_location()</a></td>
</tr>
<tr>
<td>enable_xmldump()</td>
<td><a href="@/wiki/reference/simplepie/enable_xml_dump.md">enable_xml_dump()</a></td>
</tr>
<tr>
<td>set_cache_name_type()</td>
<td><a href="@/wiki/reference/simplepie/set_cache_name_function.md">set_cache_name_function()</a></td>
</tr>
<tr>
<td>input_encoding()</td>
<td><a href="@/wiki/reference/simplepie/set_input_encoding.md">set_input_encoding()</a></td>
</tr>
<tr>
<td>output_encoding()</td>
<td><a href="@/wiki/reference/simplepie/set_output_encoding.md">set_output_encoding()</a></td>
</tr>
<tr>
<td>bypass_image_hotlink()</td>
<td>Rewritten and replaced by <a href="@/wiki/reference/simplepie/set_image_handler.md">set_image_handler()</a></td>
</tr>
<tr>
<td>bypass_image_hotlink_page()</td>
<td>Rewritten and replaced by <a href="@/wiki/reference/simplepie/set_image_handler.md">set_image_handler()</a></td>
</tr>
<tr>
<td>replace_headers()</td>
<td>No longer available</td>
</tr>
<tr>
<td>strip_ads()</td>
<td>No longer available</td>
</tr>
</tbody>
</table>

## Feed-Level Methods {#feed-level_methods}

<table class="inline">
<thead>
<tr>
<th>Old name</th>
<th>New name</th>
</tr>
</thead>
<tbody>
<tr>
<td>get_feed_copyright()</td>
<td><a href="@/wiki/reference/simplepie/get_copyright.md">get_copyright()</a></td>
</tr>
<tr>
<td>get_feed_description()</td>
<td><a href="@/wiki/reference/simplepie/get_description.md">get_description()</a></td>
</tr>
<tr>
<td>get_feed_language()</td>
<td><a href="@/wiki/reference/simplepie/get_language.md">get_language()</a></td>
</tr>
<tr>
<td>get_feed_link()</td>
<td><a href="@/wiki/reference/simplepie/get_link.md">get_link()</a></td>
</tr>
<tr>
<td>get_feed_title()</td>
<td><a href="@/wiki/reference/simplepie/get_title.md">get_title()</a></td>
</tr>
<tr>
<td>get_image_exist()</td>
<td>No longer available</td>
</tr>
<tr>
<td>get_version()</td>
<td>No longer available</td>
</tr>
<tr>
<td>subscribe_feedlounge()</td>
<td>No longer available</td>
</tr>
<tr>
<td>subscribe_pluck()</td>
<td>No longer available</td>
</tr>
</tbody>
</table>

## Item-Level Methods {#item-level_methods}

<table class="inline">
<thead>
<tr>
<th>Old name</th>
<th>New name</th>
</tr>
</thead>
<tbody>
<tr>
<td>get_category()</td>
<td>Now has sub-methods. See <a href="@/wiki/reference/simplepie_category/_index.md">SimplePie_Category</a></td>
</tr>
<tr>
<td>get_categories()</td>
<td>Now has sub-methods. See <a href="@/wiki/reference/simplepie_category/_index.md">SimplePie_Category</a></td>
</tr>
</tbody>
</table>

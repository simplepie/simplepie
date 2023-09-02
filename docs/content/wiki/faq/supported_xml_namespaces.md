+++
title = "Supported XML Namespaces"
+++

SimplePie 1.0 introduces four new methods for getting data from _ANY_ element or attribute in the feed: [get_channel_tags()](@/wiki/reference/simplepie/get_channel_tags.md), [get_feed_tags()](@/wiki/reference/simplepie/get_feed_tags.md), [get_image_tags()](@/wiki/reference/simplepie/get_image_tags.md), and [get_item_tags()](@/wiki/reference/simplepie_item/get_item_tags.md).

These are the methods that SimplePie uses internally, and they rely on the use of namespace URLs to find these elements. Because a number of these namespace URLs are used frequently by SimplePie, we've set up the following constants to make namespace stuff simpler. If you want to gain access to a namespaced element that isn't on this list, you can manually type (or copy-paste) the namespace <abbr title="Uniform Resource Locator">URL</abbr>.

<table class="inline">
<thead>
<tr>
<th>Constant</th>
<th>Namespace <abbr title="Uniform Resource Locator">URL</abbr></th>
</tr>
</thead>
<tbody>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Extensible Markup Language">XML</abbr></td>
<td><a href="http://www.w3.org/XML/1998/namespace">http://www.w3.org/XML/1998/namespace</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_ATOM_10</td>
<td><a href="http://www.w3.org/2005/Atom">http://www.w3.org/2005/Atom</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_ATOM_03</td>
<td><a href="http://purl.org/atom/ns#">http://purl.org/atom/ns#</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Resource Description Framework">RDF</abbr></td>
<td><a href="http://www.w3.org/1999/02/22-rdf-syntax-ns#">http://www.w3.org/1999/02/22-rdf-syntax-ns#</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Rich Site Summary">RSS</abbr>_090</td>
<td><a href="http://my.netscape.com/rdf/simple/0.9/">http://my.netscape.com/rdf/simple/0.9/</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Rich Site Summary">RSS</abbr>_10</td>
<td><a href="http://purl.org/rss/1.0/">http://purl.org/rss/1.0/</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Rich Site Summary">RSS</abbr>_10_MODULES_CONTENT</td>
<td><a href="http://purl.org/rss/1.0/modules/content/">http://purl.org/rss/1.0/modules/content/</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Rich Site Summary">RSS</abbr>_20</td>
<td>(Blank. <abbr title="Rich Site Summary">RSS</abbr> 2.0 doesn't have a namespace.*)</td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_DC_10</td>
<td><a href="http://purl.org/dc/elements/1.0/">http://purl.org/dc/elements/1.0/</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_DC_11</td>
<td><a href="http://purl.org/dc/elements/1.1/">http://purl.org/dc/elements/1.1/</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="World Wide Web Consortium">W3C</abbr>_BASIC_GEO</td>
<td><a href="http://www.w3.org/2003/01/geo/wgs84_pos#">http://www.w3.org/2003/01/geo/wgs84_pos#</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_GEORSS</td>
<td><a href="http://www.georss.org/georss">http://www.georss.org/georss</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_MEDIARSS</td>
<td><a href="http://search.yahoo.com/mrss/">http://search.yahoo.com/mrss/</a> <a href="http://forums.feedburner.com/viewtopic.php?t=14466">Note</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG</td>
<td><a href="http://search.yahoo.com/mrss">http://search.yahoo.com/mrss</a> <a href="http://forums.feedburner.com/viewtopic.php?t=14466">Note</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_ITUNES</td>
<td><a href="http://www.itunes.com/dtds/podcast-1.0.dtd">http://www.itunes.com/dtds/podcast-1.0.dtd</a></td>
</tr>
<tr>
<td>SIMPLEPIE_NAMESPACE_<abbr title="Extensible HyperText Markup Language">XHTML</abbr></td>
<td><a href="http://www.w3.org/1999/xhtml">http://www.w3.org/1999/xhtml</a></td>
</tr>
</tbody>
</table>

\* Available in SimplePie 1.1.2 and later. Available in [trunk and 1.1.x branch builds](http://svn.simplepie.org/simplepie/) from r972.

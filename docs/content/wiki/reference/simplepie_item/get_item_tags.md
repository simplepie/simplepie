+++
title = "get_item_tags()"
+++

## Description {#description}

```php
class SimplePie_Item {
    get_item_tags ( string $namespace, string $tag )
}
```

This method allows you to get access to ANY element/attribute that is a sub-element of the item/entry tag. It will return an _array_, which you should look at with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [print_r()](http://php.net/print_r) function.

<div class="warning">

Note that this will return an array of all of the elements it finds, and you can only go deeper – not shallower.

</div>

## Availability {#availability}

- Available since SimplePie 1.0.

## Parameters {#parameters}

### namespace (required) {#namespace_required}

The <abbr title="Uniform Resource Locator">URL</abbr> of the <abbr title="Extensible Markup Language">XML</abbr> namespace of the elements you're trying to access. SimplePie has a number of constants for supported namespaces in our [Supported XML Namespaces](@/wiki/faq/supported_xml_namespaces.md) document. If we don't have a constant for it, you can manually add the namespace <abbr title="Uniform Resource Locator">URL</abbr> as listed inside the feed.

### tag (required) {#tag_required}

This is the tag (element) that you want to get.

## Examples {#examples}

### Grab the contents of a custom element {#grab_the_contents_of_a_custom_element}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://video.google.com/videofeed?type=top100new&num=20&output=rss');
$feed->enable_cache(false);
$success = $feed->init();
$feed->handle_content_type('text/plain');

if ($success)
{
    if ($item = $feed->get_item(0))
    {
        // This is probably a bad example because we already support <media:content> natively, but it shows you how to parse through the nodes.
        $media_group = $item->get_item_tags('http://search.yahoo.com/mrss/', 'group');
        $media_content = $media_group[0]['child']['http://search.yahoo.com/mrss/']['content'];
        $file = $media_content[0]['attribs']['']['url'];
        echo $file;
    }
    else
    {
        echo 'Error: Could not get first item';
    }
}
else
{
    echo $feed->error();
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [get_channel_tags()](@/wiki/reference/simplepie/get_channel_tags.md)
- [get_feed_tags()](@/wiki/reference/simplepie/get_feed_tags.md)
- [get_image_tags()](@/wiki/reference/simplepie/get_image_tags.md)
- [get_source_tags()](@/wiki/reference/simplepie_source/get_source_tags.md)

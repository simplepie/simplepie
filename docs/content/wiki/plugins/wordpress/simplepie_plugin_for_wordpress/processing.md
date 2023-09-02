+++
title = "Post-Processing"
+++

New in version 2.1, SimplePie Plugin for WordPress allows you to do post-processing on the feed data. This allows you to do things like strip all content from an item except for images, do profanity censoring, strip out advertisements in feeds, and just about anything else you might want to do.

## Navigation {#navigation}

<table class="inline">
<tbody>
<tr>
<th>→</th>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/_index.md">Overview</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/installation.md">Installation</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/usage.md">Getting Started</a></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/customization.md">Customization</a></td>
<td><span class="curid"><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/processing.md">Post-Processing</a></span></td>
<td><a href="@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md">Troubleshooting</a></td>
</tr>
</tbody>
</table>

## Notes about Post-Processing {#notes_about_post-processing}

- Post-Processing files should be stored in the `processes` directory.
- All post-processing functions need to be contained within the `SimplePie_PostProcess` class (look at the examples).
- The function to post-process a given template tag should have the same name but lowercased (i.e. `{ITEM_CONTENT}` would be overridden with `function item_content()`).
- The function should accept a single parameter, which is the value that SimplePie returns. This is the value that you will manipulate.

## Example {#example}

```php
<?php
// We MUST keep this classname.
class SimplePie_PostProcess
{
    // Function name MUST be the same as the template tag we're processing, all lowercase, and MUST accept a single string parameter.
    function item_content($s)
    {
        // Match all images in the content.
        preg_match_all('/<img([^>]*)>/i', $s, $matches);

        // Clear out the variable.
        $s = '';

        // Loop through all of the *complete* matches (stored in $matches[0]).
        foreach ($matches[0] as $match)
        {
            // Add the images (only) back to $s.
            $s .= $match . '<br />';
        }

        // Return $s back out to the plugin.
        return $s;
    }
}
?>
```

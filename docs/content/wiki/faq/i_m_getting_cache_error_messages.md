+++
title = "I'm getting cache error messages"
+++

The default cache directory is `./cache`.

## Dot-slash-cache {#dot-slash-cache}

Dot-slash-cache (`./cache`) means that the cache directory is in a location that is relative to the page calling SimplePie – not `simplepie.inc` itself. Dot-slash-cache is not relative to your root (like slash-cache (`/cache`) is).

## Default file paths {#default_file_paths}

As a simple explanation, the (default) cache directory needs to be [writable](@/wiki/faq/file_permissions.md) and in the same folder as your SimplePie-enabled page – not SimplePie itself. For example:

```text
/path/to/mypage.php
/path/to/cache/
/path/to/some/ridiculously/long/path/someplace/else/for/simplepie.inc
```

## Using a non-default path {#using_a_non-default_path}

You can use [set_cache_location()](@/wiki/reference/simplepie/set_cache_location.md) to set the cache directory to a different location. This is particularly useful when you have several SimplePie-enabled pages in various locations and you want them all to share the same cache location.

## WordPress plugin {#wordpress_plugin}

See [Troubleshooting the SimplePie Plugin for WordPress](@/wiki/plugins/wordpress/simplepie_plugin_for_wordpress/troubleshooting.md).

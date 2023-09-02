+++
title = "Default Cache Location"
+++

There is some misunderstanding about where the default cache location is.

Here is a rather ridiculous, but accurate explanation of where the cache directory should exist if you are using the default cache location:

```text
/path/to/your/feed_page.php
/path/to/your/cache/
/path/to/simplepie/that/is/way/off/someplace/else/autoloader.php
```

In short, using `./cache` (dot-slash-cache) means that the cache directory will be relative to the page that's calling SimplePie, not SimplePie itself.

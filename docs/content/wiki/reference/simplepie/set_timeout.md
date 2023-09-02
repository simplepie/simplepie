+++
title = "set_timeout()"
+++

## Description {#description}

```php
class SimplePie {
    set_timeout ( [int $timeout = 10] )
}
```

Allows you to override the maximum amount of time spent waiting for the remote feed's server to respond and send the feed back so that we can begin processing it.

## Availability {#availability}

- Available since SimplePie Beta 3.

## Parameters {#parameters}

### timeout {#timeout}

Number of seconds to wait for the remote server before giving up.

## Examples {#examples}

### Wait for 30 seconds {#wait_for_30_seconds}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->set_timeout(30);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [API Reference](@/wiki/reference/_index.md)

</div>

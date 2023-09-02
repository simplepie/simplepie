+++
title = "set_raw_data()"
+++

## Description {#description}

```php
class SimplePie {
    set_raw_data ( string $data )
}
```

Allows you to use a string of <abbr title="Rich Site Summary">RSS</abbr>/Atom data instead of a remote feed. If you have a feed available as a string in <abbr title="Hypertext Preprocessor">PHP</abbr>, you can tell SimplePie to parse that data string instead of a remote feed. Any set feed <abbr title="Uniform Resource Locator">URL</abbr> takes precedence.

<div class="warning">

**NOTE:** If you pass a feed to SimplePie this way, SimplePie doesn't do any caching. You'll need to manage caching yourself.

</div>

## Availability {#availability}

- Available since SimplePie Beta 3.

## Parameters {#parameters}

### data (required) {#data_required}

A string of <abbr title="Rich Site Summary">RSS</abbr>/Atom data.

## Examples {#examples}

### Use raw feed data {#use_raw_feed_data}

```php
/*
Add raw Atom data to a PHP string using heredoc syntax
http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
Sample feed from http://www.w3.org/2001/sw/grddl-wg/td/atom-grddl.xml
*/
$atom = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom"
    xmlns:grddl="http://www.w3.org/2003/g/data-view#"
    grddl:transformation="atom2turtle_xslt-1.0.xsl">

    <title>Example Feed</title>
    <link href="http://example.org/"/>
    <updated>2003-12-13T18:30:02Z</updated>
    <author>
        <name>John Doe</name>
    </author>
    <id>urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6</id>

    <entry>
        <title>Atom-Powered Robots Run Amok</title>
        <link href="http://example.org/2003/12/13/atom03"/>
        <id>urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a</id>
        <updated>2003-12-13T18:30:02Z</updated>
        <summary>Some text.</summary>
    </entry>
</feed>
EOT;

$feed = new SimplePie();
$feed->set_raw_data($atom);
$feed->init();
$feed->handle_content_type();
echo $feed->get_title();
```

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_feed_url()](@/wiki/reference/simplepie/set_feed_url.md)
- [API Reference](@/wiki/reference/_index.md)

</div>

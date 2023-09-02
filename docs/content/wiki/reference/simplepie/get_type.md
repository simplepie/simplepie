+++
title = "get_type()"
+++

## Description {#description}

```php
class SimplePie {
    get_type ()
}
```

Returns the type of the feed. The type can be tested against using [bitwise operators](http://php.net/language.operators.bitwise). There are a number of constants available for matching types:

- `SIMPLEPIE_TYPE_NONE`  
  Type is unknown.
- `SIMPLEPIE_TYPE_RSS_090`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.90.
- `SIMPLEPIE_TYPE_RSS_091_NETSCAPE`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.91 (Netscape).
- `SIMPLEPIE_TYPE_RSS_091_USERLAND`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.91 (Userland).
- `SIMPLEPIE_TYPE_RSS_091`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.91.
- `SIMPLEPIE_TYPE_RSS_092`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.92.
- `SIMPLEPIE_TYPE_RSS_093`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.93.
- `SIMPLEPIE_TYPE_RSS_094`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 0.94.
- `SIMPLEPIE_TYPE_RSS_10`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 1.0.
- `SIMPLEPIE_TYPE_RSS_20`  
  Type is <abbr title="Rich Site Summary">RSS</abbr> 2.0.x.
- `SIMPLEPIE_TYPE_RSS_RDF`  
  Type is <abbr title="Resource Description Framework">RDF</abbr>-based <abbr title="Rich Site Summary">RSS</abbr>.
- `SIMPLEPIE_TYPE_RSS_SYNDICATION`  
  Type is Non-<abbr title="Resource Description Framework">RDF</abbr>-based <abbr title="Rich Site Summary">RSS</abbr> (truly intended as syndication format).
- `SIMPLEPIE_TYPE_RSS_ALL`  
  Type is any version of <abbr title="Rich Site Summary">RSS</abbr>.
- `SIMPLEPIE_TYPE_ATOM_03`  
  Type is Atom 0.3.
- `SIMPLEPIE_TYPE_ATOM_10`  
  Type is Atom 1.0.
- `SIMPLEPIE_TYPE_ATOM_ALL`  
  Type is any version of Atom.
- `SIMPLEPIE_TYPE_ALL`  
  Type is any known/supported feed type.

## Availability {#availability}

- Available since SimplePie 0.8.
- Usage changed drastically in SimplePie 1.0. Constants are only available in SimplePie 1.0.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://simplepie.org/blog/feed/');
$feed->init();
$feed->handle_content_type();

echo 'Feed type is ';

if ($feed->get_type() & SIMPLEPIE_TYPE_NONE)
{
    echo 'Unknown';
}
elseif ($feed->get_type() & SIMPLEPIE_TYPE_RSS_ALL)
{
    echo 'RSS';
}
elseif ($feed->get_type() & SIMPLEPIE_TYPE_ATOM_ALL)
{
    echo 'Atom';
}
elseif ($feed->get_type() & SIMPLEPIE_TYPE_ALL)
{
    echo 'Supported';
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)

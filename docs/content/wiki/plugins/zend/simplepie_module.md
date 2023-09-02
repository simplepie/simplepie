+++
title = "SimpleZend"
+++

# SimpleZend {#simplezend}

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><a href="https://github.com/jfabian-pe/SimpleZend">https://github.com/jfabian-pe/SimpleZend</a></td>
</tr>
<tr>
<th>Author</th>
<td><a href="https://github.com/jfabian-pe">Jesus Fabian</a> (based on work by <a href="http://baphled.wordpress.com/2009/04/21/simplepie-zendframework/">baphled</a>)</td>
</tr>
<tr>
<th>Plugin Version</th>
<td>1.0</td>
</tr>
<tr>
<th>Compatible Zend Framework version</th>
<td>1.x</td>
</tr>
<tr>
<th>Download</th>
<td><a href="https://github.com/jfabian-pe/SimpleZend/tarball/master">Download</a></td>
</tr>
<tr>
<th>Required SimplePie version</th>
<td>1.0</td>
</tr>
<tr>
<th>Optional Helpers</th>
<td>Unknown</td>
</tr>
<tr>
<th>Plugin Support</th>
<td>None</td>
</tr>
</tbody>
</table>

### Installation {#installation}

Download SimpleZend, decompress and copy in `/library`.

## Usage {#usage}

# How to use it {#how_to_use_it}

In your Controller class:

```php
<?php
    require_once 'simplezend/simplepie.php';
    $feed = new SimplePie('http://news.google.com.pe/news?pz=1&cf=all&ned=es_pe&hl=es&topic=h&num=3&output=rss');
    $feed->init();
    $this->view->title = $feed->get_title();
    $this->view->items = $feed->get_items();
    parent::init();
?>
```

In your View:

```php
<?php

foreach($this->items as $item)
{
    echo $item->get_content();
}
?>
```

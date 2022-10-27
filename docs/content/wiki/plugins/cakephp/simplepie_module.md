+++
title = "SimplePHP"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Main page</th>
<td><a href="http://bakery.cakephp.org/articles/view/simplepie-cakephp-component">SimplePHP</a></td>
</tr>
<tr>
<th>Author</th>
<td><a href="http://www.pseudocoder.com/archives/2007/07/23/simplepie-cakephp-component/">Matt Curry</a> (based on work by <a href="http://cakeforge.org/users/manta/">Scott Sansoni</a>)</td>
</tr>
<tr>
<th>Plugin Version</th>
<td>1.0</td>
</tr>
<tr>
<th>Compatible CakePHP version</th>
<td>1.x</td>
</tr>
<tr>
<th>Download</th>
<td><a href="http://sandbox.pseudocoder.com/files/CakePHP-SimplePie-Component-v1.0.zip">Download</a></td>
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

### About the Plugin {#about_the_plugin}

SimplePHP is a <abbr title="Hypertext Preprocessor">PHP</abbr> class for retrieval and parsing of <abbr title="Rich Site Summary">RSS</abbr> feeds. This is a wrapper to that class making it easy to use in the CakePHP framwork. Much of this component is taken from the work of Scott Sansoni (<http://cakeforge.org/snippet/detail.php?type=snippet&id=53>). This is mostly an update so the component works with the lastest version of SimplePie.

### What Do I Need To Know? {#what_do_i_need_to_know}

These instructions assume that you have a familiarity with working with the CakePHP framework.

## Installation {#installation}

### Fresh Installation {#fresh_installation}

#### Step 1: Download both the required files above {#step_1download_both_the_required_files_above}

Download SimplePie and unzip the contents. Move the `simplepie.inc` file to one of the vendors folders. Rename the file to `simplepie.php`. I like to put the file in the subfolder with the README.txt and LICENSE.txt for easy reference.

Download the SimplePHP component and unzip it to `app/controllers/components`.

#### Step 2: Include it {#step_2include_it}

Include the component in any controller that will need it.

## Usage {#usage}

### How to use it {#how_to_use_it}

In your Controller Class:

```php
<?php

$items = $this->Simplepie->feed('http://feeds.feedburner.com/pseudocoder');

?>
```

In your View Template:

```php
<?php

foreach($items as $item)
{
    echo $html->link($item->get_title(), $item->get_permalink()) . '<br />';
}

?>
```

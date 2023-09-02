+++
title = "Shopify"
+++

## The Basics {#the_basics}

<table class="inline">
<tbody>
<tr>
<th>Author</th>
<td><a href="http://simplepie.org">Ryan Parman</a></td>
</tr>
<tr>
<th>Revision</th>
<td>1</td>
</tr>
<tr>
<th>SimplePie version</th>
<td>1.0</td>
</tr>
<tr>
<th>Classes Extended</th>
<td><a href="@/wiki/reference/simplepie_item/_index.md">SimplePie_Item</a></td>
</tr>
</tbody>
</table>

### About the Add-on {#about_the_add-on}

This add-on adds methods for easily working with Shopify feeds.

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_shopify.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
/**
 * SimplePie Add-on for Shopify
 *
 * Copyright (c) 2004-2007, Ryan Parman and Geoffrey Sneddon
 * All rights reserved. License matches the current SimplePie license.
 */

if (!defined('SIMPLEPIE_NAMESPACE_SHOPIFY'))
{
    define('SIMPLEPIE_NAMESPACE_SHOPIFY', 'http://shopify.com/schema/order');
}

class SimplePie_Item_Shopify extends SimplePie_Item
{
    function get_order_id()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'order_id');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_guid()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'guid');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_email()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'email');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_status()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'status');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_financial_status()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'financial_status');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_fulfillment_status()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'fulfillment_status');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_closed_date($format = null)
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'closed_at');
        if ($return = $data[0]['data'])
        {
            if ($format)
            {
                $return = date($format, SimplePie_Misc::parse_date($return));
            }
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_local_closed_date($format = null)
    {
        if ($return = $this->get_closed_date('U'))
        {
            if ($format)
            {
                $return = strftime($format, $return);
            }
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_created_date($format = null)
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'created_at');
        if ($return = $data[0]['data'])
        {
            if ($format)
            {
                $return = date($format, SimplePie_Misc::parse_date($return));
            }
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_local_created_date($format = null)
    {
        if ($return = $this->get_created_date('U'))
        {
            if ($format)
            {
                $return = strftime($format, $return);
            }
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_updated_date($format = null)
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'updated_at');
        if ($return = $data[0]['data'])
        {
            if ($format)
            {
                $return = date($format, SimplePie_Misc::parse_date($return));
            }
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_local_updated_date($format = null)
    {
        if ($return = $this->get_updated_date('U'))
        {
            if ($format)
            {
                $return = strftime($format, $return);
            }
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }

    }

    function get_note()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'note');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_shipping_title()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'shipping_title');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_total_price()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'total_price');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_subtotal_price()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'subtotal_price');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_total_tax()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'total_tax');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_total_weight()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'total_weight');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_shipping_price()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'shipping_price');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function get_payments_total()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'payments_total');
        if ($return = $data[0]['data'])
        {
            return $this->sanitize($return, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        else
        {
            return null;
        }
    }

    function _process_contact_info($data = null)
    {
        $data = $data[0]['child'][SIMPLEPIE_NAMESPACE_SHOPIFY];
        $first_name = null;
        $last_name = null;
        $address1 = null;
        $address2 = null;
        $phone = null;
        $city = null;
        $zip = null;
        $province = null;
        $country = null;

        if ($first_name = $data['first_name'][0]['data'])
        {
            $first_name = $this->sanitize($first_name, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($last_name = $data['last_name'][0]['data'])
        {
            $last_name = $this->sanitize($last_name, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($address1 = $data['address1'][0]['data'])
        {
            $address1 = $this->sanitize($address1, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($address2 = $data['address2'][0]['data'])
        {
            $address2 =  $this->sanitize($address2, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($phone = $data['phone'][0]['data'])
        {
            $phone = $this->sanitize($phone, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($city = $data['city'][0]['data'])
        {
            $city = $this->sanitize($city, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($zip = $data['zip'][0]['data'])
        {
            $zip = $this->sanitize($zip, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($province = $data['province'][0]['data'])
        {
            $province = $this->sanitize($province, SIMPLEPIE_CONSTRUCT_TEXT);
        }
        if ($country = $data['country'][0]['data'])
        {
            $country = $this->sanitize($country, SIMPLEPIE_CONSTRUCT_TEXT);
        }

        return new SimplePie_Shopify_Contact($first_name, $last_name, $address1, $address2, $phone, $city, $zip, $province, $country);
    }

    function get_billing_info()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'billing_address');
        return $this->_process_contact_info($data);
    }

    function get_shipping_info()
    {
        $data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'shipping_address');
        return $this->_process_contact_info($data);
    }

    function get_line_item($key = 0)
    {
        $line_items = $this->get_line_items();
        if (isset($line_items[$key]))
        {
            return $line_items[$key];
        }
        else
        {
            return null;
        }
    }

    function get_line_items()
    {
        $return = array();
        $line_items = $this->get_item_tags(SIMPLEPIE_NAMESPACE_SHOPIFY, 'line_items');
        $line_items = $line_items[0]['child'][SIMPLEPIE_NAMESPACE_SHOPIFY]['line_items'];

        foreach ($line_items as $item)
        {
            $data = $item['child'][SIMPLEPIE_NAMESPACE_SHOPIFY];
            $sku = null;
            $line_title = null;
            $variant_title = null;
            $quantity = null;
            $price = null;
            $vendor = null;
            $grams = null;

            if ($sku = $data['sku'][0]['data'])
            {
                $sku = $this->sanitize($sku, SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if ($line_title = $data['line_title'][0]['data'])
            {
                $line_title = $this->sanitize($line_title, SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if ($variant_title = $data['variant_title'][0]['data'])
            {
                $variant_title = $this->sanitize($variant_title, SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if ($quantity = $data['quantity'][0]['data'])
            {
                $quantity = $this->sanitize($quantity, SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if ($price = $data['price'][0]['data'])
            {
                $price = $this->sanitize($price, SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if ($vendor = $data['vendor'][0]['data'])
            {
                $vendor = $this->sanitize($vendor, SIMPLEPIE_CONSTRUCT_TEXT);
            }
            if ($grams = $data['grams'][0]['data'])
            {
                $grams = $this->sanitize($grams, SIMPLEPIE_CONSTRUCT_TEXT);
            }

            $return[] = new SimplePie_Shopify_Line_Item($sku, $line_title, $variant_title, $quantity, $price, $vendor, $grams);
        }

        return $return;
    }
}

class SimplePie_Shopify_Contact
{
    var $first_name;
    var $last_name;
    var $address1;
    var $address2;
    var $phone;
    var $city;
    var $zip;
    var $province;
    var $country;

    function SimplePie_Shopify_Contact($first_name, $last_name, $address1, $address2, $phone, $city, $zip, $province, $country)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->phone = $phone;
        $this->city = $city;
        $this->zip = $zip;
        $this->province = $province;
        $this->country = $country;
    }

    function get_first_name()
    {
        return $this->first_name;
    }

    function get_last_name()
    {
        return $this->last_name;
    }

    function get_address1()
    {
        return $this->address1;
    }

    function get_address2()
    {
        return $this->address2;
    }

    function get_phone()
    {
        return $this->phone;
    }

    function get_city()
    {
        return $this->city;
    }

    function get_zip()
    {
        return $this->zip;
    }

    function get_province()
    {
        return $this->province;
    }

    function get_state()
    {
        return $this->get_province();
    }

    function get_country()
    {
        return $this->country;
    }
}

class SimplePie_Shopify_Line_Item
{
    var $sku;
    var $line_title;
    var $variant_title;
    var $quantity;
    var $price;
    var $vendor;
    var $grams;

    function SimplePie_Shopify_Line_Item($sku, $line_title, $variant_title, $quantity, $price, $vendor, $grams)
    {
        $this->sku = $sku;
        $this->line_title = $line_title;
        $this->variant_title = $variant_title;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->vendor = $vendor;
        $this->grams = $grams;
    }

    function get_sku()
    {
        return $this->sku;
    }

    function get_line_title()
    {
        return $this->line_title;
    }

    function get_variant_title()
    {
        return $this->variant_title;
    }

    function get_quantity()
    {
        return $this->quantity;
    }

    function get_price()
    {
        return $this->price;
    }

    function get_vendor()
    {
        return $this->vendor;
    }

    function get_grams()
    {
        return $this->grams;
    }
}

?>
```

## Using the Add-on {#using_the_add-on}

### Methods {#methods}

- `get_billing_info()`  
  Get the billing information for the order. Has sub-methods.
- `get_closed_date($format)`  
  Get the closing date of the order. The $format parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s [date()](http://php.net/date) function.
- `get_created_date($format)`  
  Get the created date of the order. The $format parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s [date()](http://php.net/date) function.
- `get_email()`  
  Get the email address for the order.
- `get_financial_status()`  
  Get the financial status for the order.
- `get_fulfillment_status()`  
  Get the fulfillment status for the order.
- `get_guid()`  
  Get the globally unique identifier for the order.
- `get_line_item()`  
  Get a single line item for the order. Has sub-methods.
- `get_line_items()`  
  Get all line items for the order. Has sub-methods.
- `get_local_closed_date($format)`  
  Get the localized closing date of the order. The $format parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s [strftime()](http://php.net/strftime) function. To display in other languages, you need to change the locale with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [setlocale()](http://php.net/setlocale) function. The available localizations depend on which ones are installed on your web server.
- `get_local_created_date($format)`  
  Get the localized created date of the order. The $format parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s [strftime()](http://php.net/strftime) function. To display in other languages, you need to change the locale with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [setlocale()](http://php.net/setlocale) function. The available localizations depend on which ones are installed on your web server.
- `get_local_updated_date($format)`  
  Get the localized date of the last update for the order. The $format parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s [strftime()](http://php.net/strftime) function. To display in other languages, you need to change the locale with <abbr title="Hypertext Preprocessor">PHP</abbr>'s [setlocale()](http://php.net/setlocale) function. The available localizations depend on which ones are installed on your web server.
- `get_note()`  
  Get the notes for the order.
- `get_order_id()`  
  Get the order ID.
- `get_payments_total()`  
  Get the payment total for the order.
- `get_shipping_info()`  
  Get the shipping information for the order. Has sub-methods.
- `get_shipping_price()`  
  Get the shipping price for the order.
- `get_shipping_title()`  
  Get the shipping title for the order.
- `get_status()`  
  Get the status for the order.
- `get_subtotal_price()`  
  Get the subtotal for the order.
- `get_total_price()`  
  Get the grand total for the order.
- `get_total_tax()`  
  Get the VAT/Sales Tax for the order.
- `get_total_weight()`  
  Get the total weight (in grams) for the order.
- `get_updated_date($format)`  
  Get the date of the last update for the order. The $format parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s [date()](http://php.net/date) function.

### Sub-Methods for get_billing_info() and get_shipping_info() {#sub-methods_for_get_billing_info_and_get_shipping_info}

- `get_first_name()`  
  Get the first name
- `get_last_name()`  
  Get the last name
- `get_address1()`  
  Get the street address (line 1)
- `get_address2()`  
  Get the street address (line 2)
- `get_phone()`  
  Get the phone number
- `get_city()`  
  Get the city
- `get_zip()`  
  Get the zip or postal code
- `get_province()`  
  Get the province
- `get_state()`  
  Alias for `get_province()`. This is more appropriate for places like the USA.
- `get_country()`  
  Get the country

### Sub-Methods for get_line_item() and get_line_items() {#sub-methods_for_get_line_item_and_get_line_items}

- `get_grams()`  
  Get the weight of the item in grams
- `get_line_title()`  
  Get the title of the item
- `get_price()`  
  Get the price of the item
- `get_quantity()`  
  Get the quantity ordered of the item
- `get_sku()`  
  Get the SKU number for the item
- `get_variant_title()`  
  Get the variant title of the item
- `get_vendor()`  
  Get the vendor for the item

### Example Code {#example_code}

```php
<?php
require_once('simplepie.inc');
require_once('simplepie_shopify.inc');

$feed = new SimplePie();
$feed->set_feed_url('http://shopify.com/your/shopify/rss/url/');
$feed->set_item_class('SimplePie_Item_Shopify');
$feed->init();
$feed->handle_content_type();

$item = $feed->get_item(0);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Sample Shopify Page</title>
</head>

<body>
    <h1>Invoice No. <?php echo $item->get_order_id(); ?></h1>

    <table cellpadding="5" cellspacing="1" border="0">
        <tbody>
            <tr>
                <th align="right" valign="top">Email Address</th>
                <td><?php echo $item->get_email(); ?></td>
            </tr>
            <tr>
                <th align="right" valign="top">Created</th>
                <td><?php echo $item->get_created_date('l, F jS Y, g:i a T')?></td>
            </tr>
            <tr>
                <th align="right" valign="top">Updated</th>
                <td><?php echo $item->get_updated_date('l, F jS Y, g:i a T')?></td>
            </tr>
            <tr>
                <th align="right" valign="top">Closed</th>
                <td><?php echo $item->get_closed_date('l, F jS Y, g:i a T')?></td>
            </tr>
            <tr>
                <th align="right" valign="top">Billing</th>
                <td>
                    <?php
                    $contact = $item->get_billing_info();
                    if ($contact->get_address1())
                    {
                        echo $contact->get_address1() . '<br />';
                    }
                    if ($contact->get_address2())
                    {
                        echo $contact->get_address2() . '<br />';
                    }
                    if ($contact->get_city())
                    {
                        echo $contact->get_city() . ', ';
                    }
                    if ($contact->get_state())
                    {
                        echo $contact->get_state();
                    }
                    if ($contact->get_zip())
                    {
                        echo ' ' . $contact->get_zip();
                    }
                    echo '<br />';
                    if ($contact->get_country())
                    {
                        echo $contact->get_country() . '<br />';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th align="right" valign="top">Shipping</th>
                <td>
                    <?php
                    $contact = $item->get_shipping_info();
                    if ($contact->get_address1())
                    {
                        echo $contact->get_address1() . '<br />';
                    }
                    if ($contact->get_address2())
                    {
                        echo $contact->get_address2() . '<br />';
                    }
                    if ($contact->get_city())
                    {
                        echo $contact->get_city() . ', ';
                    }
                    if ($contact->get_state())
                    {
                        echo $contact->get_state();
                    }
                    if ($contact->get_zip())
                    {
                        echo ' ' . $contact->get_zip();
                    }
                    echo '<br />';
                    if ($contact->get_country())
                    {
                        echo $contact->get_country() . '<br />';
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h2>Items</h2>
    <table cellpadding="5" cellspacing="0" border="1">
        <tbody>
            <?php foreach ($item->get_line_items() as $line_item): ?>
            <tr>
                <td><?php echo $line_item->get_quantity(); ?></td>
                <td><?php echo $line_item->get_sku(); ?></td>
                <td><?php echo $line_item->get_line_title(); ?></td>
                <td><?php echo $line_item->get_price(); ?></td>
            </tr>
            <?php endforeach; ?>

            <tr>
                <td align="left" colspan="3">Subtotal:</td>
                <td><?php echo $item->get_subtotal_price(); ?></td>
            </tr>
            <tr>
                <td align="left" colspan="3">Sales Tax/VAT:</td>
                <td><?php echo $item->get_total_tax(); ?></td>
            </tr>
            <tr>
                <td align="left" colspan="3">Shipping and Handling:</td>
                <td><?php echo $item->get_shipping_price(); ?></td>
            </tr>
            <tr>
                <td align="left" colspan="3"><strong>Grand Total:</strong></td>
                <td><strong><?php echo $item->get_total_price(); ?></strong></td>
            </tr>

        </tbody>
    </table>

    <h2>Notes:</h2>
    <div><?php echo $item->get_note(); ?></div>

</body>
</html>
```

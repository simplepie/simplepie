+++
title = "Yahoo! Weather"
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

This add-on adds methods for easily working with Yahoo! Weather feeds. Yahoo! Weather feeds can be found at <http://developer.yahoo.com/weather/>. This add-on was heavily inspired by the [Get Yahoo! Weather with SimplePie](http://jivebay.com/2007/07/25/get-yahoo-weather-with-simplepie/) tutorial over at [JiveBay.com](http://jivebay.com).

## Installation {#installation}

### Instructions {#instructions}

1.  Create a new file called `simplepie_yahoo_weather.inc` and place it in the same directory as your `simplepie.inc` file.
2.  On the SimplePie-enabled page you want to use this extension on, make sure you include it in the same way that you include `simplepie.inc`.

### Add-on Source Code {#add-on_source_code}

```php
<?php
/**
 * SimplePie Add-on for Yahoo! Weather
 *
 * Copyright (c) 2004-2007, Ryan Parman and Geoffrey Sneddon
 * All rights reserved. License matches the current SimplePie license.
 */

// Define the namespace for simplicity.
if (!defined('SIMPLEPIE_NAMESPACE_YWEATHER'))
{
    define('SIMPLEPIE_NAMESPACE_YWEATHER', 'http://xml.weather.yahoo.com/ns/rss/1.0');
}

// Extend the SimplePie_Item class.
class SimplePie_Item_YWeather extends SimplePie_Item
{
    // Get <yweather:location> data
    function _get_location()
    {
        $feed = $this->get_feed();
        return $feed->get_channel_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'location');
    }

    function get_city()
    {
        $data = $this->_get_location();
        return $data[0]['attribs']['']['city'];
    }

    function get_region()
    {
        $data = $this->_get_location();
        return $data[0]['attribs']['']['region'];
    }

    function get_state()
    {
        return $this->get_region();
    }

    function get_country()
    {
        $data = $this->_get_location();
        return $data[0]['attribs']['']['country'];
    }


    // Get <yweather:units> data
    function _get_units()
    {
        $feed = $this->get_feed();
        return $feed->get_channel_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'units');
    }

    function get_units_temp()
    {
        $data = $this->_get_units();
        return $data[0]['attribs']['']['temperature'];
    }

    function get_units_distance()
    {
        $data = $this->_get_units();
        return $data[0]['attribs']['']['distance'];
    }

    function get_units_pressure()
    {
        $data = $this->_get_units();
        return $data[0]['attribs']['']['pressure'];
    }

    function get_units_speed()
    {
        $data = $this->_get_units();
        return $data[0]['attribs']['']['speed'];
    }


    // Get <yweather:wind> data
    function _get_wind()
    {
        $feed = $this->get_feed();
        return $feed->get_channel_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'wind');
    }

    function get_wind_chill()
    {
        $data = $this->_get_wind();
        return $data[0]['attribs']['']['chill'];
    }

    function get_wind_direction_degrees()
    {
        $data = $this->_get_wind();
        return $data[0]['attribs']['']['direction'];
    }

    function get_wind_direction()
    {
        $wind_direction = $this->get_wind_direction_degrees();

        // Calculations taken from http://jivebay.com/2007/07/25/get-yahoo-weather-with-simplepie/
                if ($wind_direction == 0){
                        $wind_direction_converted = "VAR";
                }
        else if ($wind_direction > 348.75 || $wind_direction < 11.25)
            $wind_direction_converted = "N";
        else if ($wind_direction > 11.25 && $wind_direction < 33.75)
            $wind_direction_converted = "NNE";
        else if ($wind_direction > 33.75 && $wind_direction < 56.25)
            $wind_direction_converted = "NE";
        else if ($wind_direction > 56.25 && $wind_direction < 78.75)
            $wind_direction_converted = "ENE";
        else if ($wind_direction > 78.75 && $wind_direction < 101.25)
            $wind_direction_converted = "E";
        else if ($wind_direction > 101.25 && $wind_direction < 123.75)
            $wind_direction_converted = "ESE";
        else if ($wind_direction > 123.75 && $wind_direction < 146.25)
            $wind_direction_converted = "SE";
        else if ($wind_direction > 146.25 && $wind_direction < 168.75)
            $wind_direction_converted = "SSE";
        else if ($wind_direction > 168.75 && $wind_direction < 191.25)
            $wind_direction_converted = "S";
        else if ($wind_direction > 191.25 && $wind_direction < 213.75)
            $wind_direction_converted = "SSW";
        else if ($wind_direction > 213.75 && $wind_direction < 236.25)
            $wind_direction_converted = "SW";
        else if ($wind_direction > 236.25 && $wind_direction < 258.75)
            $wind_direction_converted = "WSW";
        else if ($wind_direction > 258.75 && $wind_direction < 281.25)
            $wind_direction_converted = "W";
        else if ($wind_direction > 281.25 && $wind_direction < 303.75)
            $wind_direction_converted = "WNW";
        else if ($wind_direction > 303.75 && $wind_direction < 326.25)
            $wind_direction_converted = "NW";
        else if ($wind_direction > 326.25 && $wind_direction < 348.75)
            $wind_direction_converted = "NNW";
        else $wind_direction_converted = null;

        return $wind_direction_converted;
    }

    function get_wind_speed()
    {
        $data = $this->_get_wind();
        return $data[0]['attribs']['']['speed'];
    }


    // Get <yweather:atmosphere> data
    function _get_atmosphere()
    {
        $feed = $this->get_feed();
        return $feed->get_channel_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'atmosphere');
    }

    function get_humidity()
    {
        $data = $this->_get_atmosphere();
        return $data[0]['attribs']['']['humidity'];
    }

    function get_visibility()
    {
        $data = $this->_get_atmosphere();
        return $data[0]['attribs']['']['visibility'];
    }

    function get_pressure()
    {
        $data = $this->_get_atmosphere();
        return $data[0]['attribs']['']['pressure'];
    }

    function get_rising()
    {
        $data = $this->_get_atmosphere();
        return $data[0]['attribs']['']['rising'];
    }


    // Get <yweather:astronomy> data
    function _get_astronomy()
    {
        $feed = $this->get_feed();
        return $feed->get_channel_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'astronomy');
    }

    function get_sunrise()
    {
        $data = $this->_get_astronomy();
        return $data[0]['attribs']['']['sunrise'];
    }

    function get_sunset()
    {
        $data = $this->_get_astronomy();
        return $data[0]['attribs']['']['sunset'];
    }


    // Get <yweather:condition> data
    function _get_condition()
    {
        return $this->get_item_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'condition');
    }

    function get_condition()
    {
        $data = $this->_get_condition();
        return $data[0]['attribs']['']['text'];
    }

    function get_condition_code()
    {
        $data = $this->_get_condition();
        return $data[0]['attribs']['']['code'];
    }

    function get_condition_image()
    {
        return 'http://l.yimg.com/us.yimg.com/i/us/we/52/' . $this->get_condition_code() . '.gif';
    }

    function get_temperature()
    {
        $data = $this->_get_condition();
        return $data[0]['attribs']['']['temp'];
    }

    function get_last_updated($format = null)
    {
        $data = $this->_get_condition();

        if ($format)
        {
            return date($format, SimplePie_Misc::parse_date($data[0]['attribs']['']['date']));
        }
        else
        {
            return $data[0]['attribs']['']['date'];
        }
    }


    // Get <yweather:forecast> data
    function _get_forecast()
    {
        return $this->get_item_tags(SIMPLEPIE_NAMESPACE_YWEATHER, 'forecast');
    }

    function get_forecast($key = 0)
    {
        $forecasts = $this->get_forecasts();
        if (isset($forecasts[$key]))
        {
            return $forecasts[$key];
        }
        else
        {
            return null;
        }
    }

    function get_forecasts()
    {
        $temp = array();
        $data = $this->_get_forecast();
        foreach ($data as $forecast)
        {
            $temp[] = new SimplePie_YWeather_Forecast($forecast['attribs']['']['date'], $forecast['attribs']['']['low'], $forecast['attribs']['']['high'], $forecast['attribs']['']['text'], $forecast['attribs']['']['code']);
        }
        return $temp;
    }
}

class SimplePie_YWeather_Forecast
{
    var $date;
    var $low;
    var $high;
    var $label;
    var $code;

    function SimplePie_YWeather_Forecast($date, $low, $high, $label, $code)
    {
        $this->date = $date;
        $this->low = $low;
        $this->high = $high;
        $this->label = $label;
        $this->code = $code;
    }

    function get_date($format = null)
    {
        if ($format)
        {
            return date($format, SimplePie_Misc::parse_date($this->date));
        }
        else
        {
            return $this->date;
        }
    }

    function get_low()
    {
        return $this->low;
    }

    function get_high()
    {
        return $this->high;
    }

    function get_label()
    {
        return $this->label;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_image()
    {
        return 'http://l.yimg.com/us.yimg.com/i/us/we/52/' . $this->get_code() . '.gif';
    }
}

?>
```

## Using the Add-on {#using_the_add-on}

### Methods {#methods}

- `get_city()`  
  The city the weather is for.
- `get_region()`  
  The region that the city is in.
- `get_state()`  
  Completely identical to `get_region()`. This might make better sense in the U.S.
- `get_country()`  
  The country that the city is in.
- `get_units_temp()`  
  The units used for the temperature.
- `get_units_distance()`  
  The units used for the distance.
- `get_units_pressure()`  
  The units used for the pressure.
- `get_units_speed()`  
  The units used for the speed.
- `get_wind_chill()`  
  The “feels like” temperature due to wind.
- `get_wind_direction_degrees()`  
  The degrees (out of a circular 360 degrees) marking the direction of the wind.
- `get_wind_direction()`  
  The human-understandable name of the direction of the wind.
- `get_wind_speed()`  
  The wind speed.
- `get_humidity()`  
  The current humidity.
- `get_visibility()`  
  The distance of visibility.
- `get_pressure()`  
  The air pressure.
- `get_rising()`  
  The rising
- `get_sunrise()`  
  The time of today's sunrise.
- `get_sunset()`  
  The time of today's sunset.
- `get_condition()`  
  Current conditions.
- `get_condition_code()`  
  Code for current conditions.
- `get_temperature()`  
  Get the current temperature.
- `get_last_updated($format)`  
  The timestamp of the last update. The `$format` parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s <http://php.net/date> function.
- `get_forecast()`  
  Get a single forecast (typically one of two). Has sub-methods.
- `get_forecasts()`  
  Get all forecasts (typically two) as an array. Has sub-methods.

### Sub-Methods for get_forecast() and get_forecasts() {#sub-methods_for_get_forecast_and_get_forecasts}

- `get_date($format)`  
  Gets the date of the forecast. The `$format` parameter takes anything that is supported by <abbr title="Hypertext Preprocessor">PHP</abbr>'s <http://php.net/date> function.
- `get_low()`  
  Gets the “low” temperature of the forecast.
- `get_high()`  
  Gets the “high” temperature of the forecast.
- `get_label()`  
  Gets the human-readable description of the forecast.
- `get_code()`  
  Gets the code of the forecast.

### Example Code {#example_code}

```php
<?php
require_once('simplepie.inc');
require_once('simplepie_yahoo_weather.inc');

// Initialize a new SimplePie object.
$feed = new SimplePie();

// Parse a Yahoo! Weather feed for San Francisco, CA
$feed->set_feed_url('http://weather.yahooapis.com/forecastrss?p=USCA0987');

// We're going to override the built-in SimplePie_Item class with the SimplePie_Item_YWeather class.
$feed->set_item_class('SimplePie_Item_YWeather');

// Initialize the feed
$feed->init();

// Since Y! Weather feeds only have one item, we'll base everything around that.
$weather = $feed->get_item(0);

// Begin XHTML page
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Sample Yahoo Weather Page</title>
    <style type="text/css">
    h1 {
        padding:0 0 0 60px;
        background:transparent url(<?php echo $weather->get_condition_image(); ?>) no-repeat 0 10%;
        line-height:2em;
    }
    </style>
</head>
<body>
    <h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
    <ul>
        <li><strong>Currently:</strong> <?php echo $weather->get_condition(); ?>, <?php echo $weather->get_temperature(); ?>&deg;<?php echo $weather->get_units_temp(); ?> (feels like <?php echo $weather->get_wind_chill(); ?>&deg;<?php echo $weather->get_units_temp(); ?>)</li>
        <li><strong>Wind:</strong> <?php echo $weather->get_wind_speed(); ?><?php echo $weather->get_units_speed(); ?>, <?php echo $weather->get_wind_direction(); ?></li>
        <li><strong>Sunrise:</strong> <?php echo $weather->get_sunrise(); ?></li>
        <li><strong>Sunset:</strong> <?php echo $weather->get_sunset(); ?></li>
    </ul>

    <h2>Forecast</h2>
    <ul>
        <?php foreach ($weather->get_forecasts() as $forecast): ?>

        <li><?php echo $forecast->get_date('l, F jS'); ?> &mdash; Low: <?php echo $forecast->get_low(); ?>; High: <?php echo $forecast->get_high(); ?>; <?php echo $forecast->get_label(); ?></li>

        <?php endforeach; ?>
    </ul>
</body>
</html>
```

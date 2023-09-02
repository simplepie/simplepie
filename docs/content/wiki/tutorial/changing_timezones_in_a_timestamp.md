+++
title = "Changing timezones in a timestamp"
+++

By default <abbr title="Hypertext Preprocessor">PHP</abbr>'s [date()](http://php.net/date) function (and in turn, SimplePie's get_date() method) return the timestamp according to the web server's timezone. But what if your timezone and your server's are different and you want to display yours?

## PHP 5.1 or newer {#php_51_or_newer}

Use the [date_default_timezone_set()](http://us.php.net/manual/en/function.date-default-timezone-set.php) function with a timezone parameter from the [timezone page](http://us.php.net/manual/en/timezones.america.php). This should be set before <abbr title="Hypertext Preprocessor">PHP</abbr>'s date() or SimplePie's get_date() is called.

```php
date_default_timezone_set('America/Los_Angeles');
```

## PHP 5.0.x or earlier {#php_50x_or_earlier}

Use the [putenv()](http://us.php.net/manual/en/function.putenv.php) function as documented in [this comment](http://us.php.net/manual/en/function.putenv.php#11811).

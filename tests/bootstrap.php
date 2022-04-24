<?php

require_once dirname(__DIR__) . '/autoloader.php';

// if the composer autoload.php file exists, require it
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}

require_once dirname(__DIR__) . '/vendor/yoast/phpunit-polyfills/phpunitpolyfills-autoload.php';
require_once dirname(__DIR__) . '/tests/Fixtures/Mocks.php';

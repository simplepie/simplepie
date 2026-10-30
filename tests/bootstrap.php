<?php

declare(strict_types=1);

// require the composer autoload.php file
require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once dirname(__DIR__) . '/autoloader.php';

// Keep notices from the MockWebServer process (e.g. deprecations in mf2) out of its responses.
putenv('PHP_INI_SCAN_DIR=' . (getenv('PHP_INI_SCAN_DIR') ?: '') . PATH_SEPARATOR . __DIR__ . '/data/mock-server');

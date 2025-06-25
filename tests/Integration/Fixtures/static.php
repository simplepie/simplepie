<?php

declare(strict_types=1);

namespace SimplePie\Tests\Integration\Fixtures;

require_once __DIR__ . '/response_utilities.php';

$path = $_GET['path'] ?? null;
$testsDir = dirname(__DIR__, 2);
if ($path === null || ($path = realpath(__DIR__ . '/' .$path)) === false || strpos($path, $testsDir . '/') !== 0) {
    output('Not found', 404);
} else {
    if (($_GET['gzip'] ?? '0') === '1') {
        ob_start('ob_gzhandler');
    }
    output(file_get_contents($path));
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

use SimplePie\Cache;
use SimplePie\File;
use SimplePie\Tests\Fixtures\Exception\SuccessException;
use SimplePie\Tests\Fixtures\FileMock;
use Yoast\PHPUnitPolyfills\Polyfills\ExpectPHPException;

class Mock_CacheLegacy extends SimplePie_Cache
{
    public static function get_handler($location, $filename, $extension)
    {
        throw new Exception('Legacy cache class should not have get_handler() called');
    }
    public function create($location, $filename, $extension)
    {
        throw new SuccessException('Correct function called');
    }
}

class Mock_CacheNew extends SimplePie_Cache
{
    public static function get_handler($location, $filename, $extension)
    {
        throw new SuccessException('Correct function called');
    }
    public function create($location, $filename, $extension)
    {
        throw new Exception('New cache class should not have create() called');
    }
}

class CacheTest extends PHPUnit\Framework\TestCase
{
    use ExpectPHPException;

    public function testDirectOverrideLegacy()
    {
        if (version_compare(PHP_VERSION, '8.0', '<')) {
            $this->expectException(SuccessException::class);
        } else {
            // PHP 8.0 will throw a `TypeError` for trying to call a non-static method statically.
            // This is no longer supported in PHP, so there is just no way to continue to provide BC
            // for the old non-static cache methods.
            $this->expectError();
        }

        $feed = new SimplePie();
        $this->expectDeprecation();
        $feed->set_cache_class(Mock_CacheLegacy::class);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }

    public function testDirectOverrideNew()
    {
        $this->expectException(SuccessException::class);

        $feed = new SimplePie();
        $feed->get_registry()->register(Cache::class, Mock_CacheNew::class);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }
}

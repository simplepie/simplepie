<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use SimplePie;
use SimplePie\Cache;
use SimplePie\File;
use SimplePie\Tests\Fixtures\Exception\SuccessException;
use SimplePie\Tests\Fixtures\FileMock;
use SimplePie_Cache;
use TypeError;

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

class CacheTest extends TestCase
{
    public function testDirectOverrideLegacy(): void
    {
        if (version_compare(PHP_VERSION, '8.0', '<')) {
            $this->expectException(SuccessException::class);
        } else {
            // PHP 8.0 will throw a `TypeError` for trying to call a non-static method statically.
            // This is no longer supported in PHP, so there is just no way to continue to provide BC
            // for the old non-static cache methods.
            $this->expectException(TypeError::class);
            $this->expectExceptionMessage('call_user_func_array(): Argument #1 ($callback) must be a valid callback, non-static method SimplePie\Tests\Mock_CacheLegacy::create() cannot be called statically');
        }

        $feed = new SimplePie();

        // PHPUnit 10 compatible way to test trigger_error().
        set_error_handler(
            function ($errno, $errstr): bool {
                $this->assertSame(
                    '"SimplePie\SimplePie::set_cache_class()" is deprecated since SimplePie 1.3, please use "SimplePie\SimplePie::set_cache()" instead.',
                    $errstr,
                );

                restore_error_handler();
                return true;
            },
            E_USER_DEPRECATED,
        );

        $feed->set_cache_class(Mock_CacheLegacy::class);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }

    public function testDirectOverrideNew(): void
    {
        $this->expectException(SuccessException::class);

        $feed = new SimplePie();
        $feed->get_registry()->register(Cache::class, Mock_CacheNew::class);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }
}

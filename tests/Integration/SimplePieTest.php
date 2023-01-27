<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use SimplePie\Cache;
use SimplePie\File;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\Cache\BaseCacheWithCallbacksMock;
use SimplePie\Tests\Fixtures\FileConstructorThrowsExceptionMock;

class SimplePieTest extends TestCase
{
    /**
     * @test that requesting a local file via SimplePie->set_feed_url() works
     */
    public function testRequestingALocalFileWithSetFeedUrlWorks(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_feed_url($filepath);

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    /**
     * @test that requesting a local file via SimplePie->set_file() works
     */
    public function testRequestingALocalFileWithSetFileWorks(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $file = new File($filepath);
        $simplepie->set_file($file);

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    /**
     * @test that requesting a local file with Psr18Client works
     */
    public function testRequestingALocalFileWithPsr18ClientWorks(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_http_client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );
        $simplepie->set_feed_url($filepath);

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    /**
     * @test that requesting a feed from cache works
     */
    public function testRequestingAFeedFromCacheWorks(): void
    {
        // Setup cache mock
        BaseCacheWithCallbacksMock::setSaveCallback(function ($data) {
            throw new Exception('BaseCacheWithCallbacksMock::mtime() should never been called.', 1);
        });
        BaseCacheWithCallbacksMock::setLoadCallback(function () {
            $cachepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.spc';
            $data = unserialize(file_get_contents($cachepath));

            if ($data === false) {
                throw new Exception(sprintf(
                    '%s::setLoadCallback() could not get contents of file "%s". Make sure that the file has not been modified.',
                    BaseCacheWithCallbacksMock::class,
                    $cachepath
                ), 1);
            }

            // Fix build in cache
            $data['build'] = \SimplePie\Misc::get_build();

            return $data;
        });
        BaseCacheWithCallbacksMock::setMtimeCallback(function () {
            throw new Exception('BaseCacheWithCallbacksMock::mtime() should never been called.', 1);
        });
        BaseCacheWithCallbacksMock::setTouchCallback(function () {
            throw new Exception('BaseCacheWithCallbacksMock::touch() should never been called.', 1);
        });
        BaseCacheWithCallbacksMock::setUnlinkCallback(function () {
            throw new Exception('BaseCacheWithCallbacksMock::unlink() should never been called.', 1);
        });

        $simplepie = new SimplePie();
        // Set FileMock to enforce that we never make an external http request
        $simplepie->get_registry()->register(File::class, FileConstructorThrowsExceptionMock::class);
        // Setup cache
        $simplepie->get_registry()->call(Cache::class, 'register', ['mock', BaseCacheWithCallbacksMock::class]);
        $simplepie->set_cache_location('mock');

        $simplepie->set_feed_url('https://example.com/feed.xml');

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());

        BaseCacheWithCallbacksMock::resetAllCallbacks();
    }
}

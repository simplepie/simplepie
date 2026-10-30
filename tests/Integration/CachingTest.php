<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use Exception;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use SimplePie\Cache;
use SimplePie\Cache\Base;
use SimplePie\File;
use SimplePie\Misc;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\Cache\BaseCacheWithCallbacksMock;
use SimplePie\Tests\Fixtures\FileMock;

class CachingTest extends TestCase
{
    /**
     * @dataProvider provideSavedCacheData
     * @param array<string, mixed> $currentDataCached
     * @param array<string, mixed> $expectedDataWritten
     */
    public function testInitWithDifferentCacheStateCallsCacheCorrectly(
        string $testedCacheClass,
        array $currentDataCached,
        array $expectedDataWritten,
        int $currentMtime
    ): void {
        $writtenData = [];

        $feed = new SimplePie();
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        switch ($testedCacheClass) {
            case CacheInterface::class:
                $psr16 = $this->createMock(CacheInterface::class);
                // Set current cached data and mtime
                $psr16->method('get')->willReturnCallback(function ($key, $default) use ($currentDataCached, $currentMtime) {
                    // Set current mtime
                    if (substr($key, -strlen('_mtime')) === '_mtime') {
                        return $currentMtime;
                    }

                    // Set current cached data
                    return $currentDataCached;
                });

                // Test data written
                $psr16->method('set')->willReturnCallback(function ($key, $value, $ttl) use (&$writtenData): bool {
                    // Ignore setting of the _mtime value
                    if (substr($key, -strlen('_mtime')) !== '_mtime') {
                        $writtenData = $value;
                    }

                    return true;
                });

                $psr16->method('delete')->willReturn(true);

                $feed->set_cache($psr16);
                break;

            case Base::class:
                // Set current cached data
                BaseCacheWithCallbacksMock::setLoadCallback(function () use ($currentDataCached): array {
                    return $currentDataCached;
                });

                // Set current mtime
                BaseCacheWithCallbacksMock::setMtimeCallback(function () use ($currentMtime): int {
                    return $currentMtime;
                });

                // Test data written
                BaseCacheWithCallbacksMock::setSaveCallback(function ($data) use (&$writtenData): bool {
                    if ($data instanceof SimplePie) {
                        $data = $data->data;
                    }

                    $writtenData = $data;

                    // Ignore internally set '__cache_expiration_time'
                    if (array_key_exists('__cache_expiration_time', $writtenData)) {
                        unset($writtenData['__cache_expiration_time']);
                    }

                    return true;
                });

                $feed->get_registry()->call(Cache::class, 'register', ['mock', BaseCacheWithCallbacksMock::class]);
                $feed->set_cache_location('mock');
                break;

            default:
                throw new Exception($testedCacheClass . ' is not supported.');
        }

        $feed->init();

        if ($testedCacheClass === Base::class) {
            BaseCacheWithCallbacksMock::resetAllCallbacks();
        }

        // Adjust expected cache expiration time to prevent race conditions
        if (array_key_exists('cache_expiration_time', $writtenData)) {
            $expectedDataWritten['cache_expiration_time'] = $writtenData['cache_expiration_time'];
        }

        self::assertSame($expectedDataWritten, $writtenData);
    }

    /**
     * @return array<array{string, array<string, mixed>, array<string, mixed>, int}>
     */
    public static function provideSavedCacheData(): array
    {
        $defaultMtime = time() - 1; // -1 to account for tests running within the same second
        $defaultExpirationTime = $defaultMtime + 3600;

        $expectDefaultDataWritten = [
            'child' => [
                'http://www.w3.org/2005/Atom' => [
                    'feed' => [
                        0 => [
                            'data' => '',
                            'attribs' => [],
                            'xml_base' => '',
                            'xml_base_explicit' => false,
                            'xml_lang' => '',
                         ],
                    ],
                ],
            ],
            'type' => 512,
            'headers' => [
                'content-type' => 'application/atom+xml',
            ],
            'build' => Misc::get_build(),
            'cache_expiration_time' => 0, // Needs to be adjust in test case
        ];

        $expectNoDataWritten = [];

        $expectDataWithNewFeedUrl = [
            'url' => 'http://example.com/feed.xml/',
            'feed_url' => 'http://example.com/feed.xml/',
            'build' => Misc::get_build(),
            'cache_expiration_time' => $defaultExpirationTime,
        ];

        $currentlyCachedDataIsUpdated = [
            'child' => [
                'http://www.w3.org/2005/Atom' => [
                    'feed' => [
                        0 => [
                            'data' => '',
                            'attribs' => [],
                            'xml_base' => '',
                            'xml_base_explicit' => false,
                            'xml_lang' => '',
                         ],
                    ],
                ],
            ],
            'type' => 512,
            'headers' => [
                'content-type' => 'application/atom+xml',
            ],
            'build' => Misc::get_build(),
            'cache_expiration_time' => $defaultExpirationTime,
        ];

        $currentlyCachedDataIsValid = [
            'child' => [
                'http://www.w3.org/2005/Atom' => [
                    'feed' => [
                        0 => [
                            'data' => '',
                            'attribs' => [],
                            'xml_base' => '',
                            'xml_base_explicit' => false,
                            'xml_lang' => '',
                         ],
                    ],
                ],
            ],
            'type' => 512,
            'headers' => [
                'content-type' => 'application/atom+xml',
            ],
            'build' => Misc::get_build(),
            'cache_expiration_time' => $defaultMtime,
        ];

        $currentlyNoDataIsCached = [];

        $currentlyCachedDataWithWrongBuild = [
            'build' => 0,
        ];

        $currentlyCachedDataWithCacheCollision = [
            'url' => 'http://example.com/some-different-url',
            'build' => Misc::get_build(),
            'cache_expiration_time' => $defaultExpirationTime,
        ];

        $currentlyCachedDataWithFeedUrl = [
            'url' => 'http://example.com/feed/',
            'feed_url' => 'http://example.com/feed/',
            'build' => Misc::get_build(),
            'cache_expiration_time' => $defaultExpirationTime,
        ];

        $currentlyCachedDataWithNonFeedUrl = [
            'url' => 'http://example.com/feed/',
            'feed_url' => 'http://example.com/feed.xml/',
            'build' => Misc::get_build(),
            'cache_expiration_time' => $defaultExpirationTime,
        ];

        return [
            // If the cache is empty
            [Base::class,           $currentlyNoDataIsCached,               $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyNoDataIsCached,               $expectDefaultDataWritten, $defaultMtime],
            // If the cache is for an outdated build of SimplePie
            [Base::class,           $currentlyCachedDataWithWrongBuild,     $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithWrongBuild,     $expectDefaultDataWritten, $defaultMtime],
            // If we've hit a collision just rerun it with caching disabled
            [Base::class,           $currentlyCachedDataWithCacheCollision, $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithCacheCollision, $expectNoDataWritten,      $defaultMtime],
            // If we've got a non feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL.
            // If the autodiscovery cache is still valid use it.
            // And we need to do feed autodiscovery.
            [Base::class,           $currentlyCachedDataWithFeedUrl,        $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithFeedUrl,        $expectDefaultDataWritten, $defaultMtime],
            // If we've got a non feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL.
            // If the autodiscovery cache is still valid use it.
            // Do not need to do feed autodiscovery yet.
            [Base::class,           $currentlyCachedDataWithNonFeedUrl,     $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithNonFeedUrl,     $expectDataWithNewFeedUrl, $defaultMtime],
            // Check if the cache has been updated
            [Base::class,           $currentlyCachedDataIsUpdated,          $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataIsUpdated,          $expectNoDataWritten,      $defaultMtime],
            // If the cache is still valid, just return true
            [Base::class,           $currentlyCachedDataIsValid,            $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataIsValid,            $expectDefaultDataWritten, $defaultMtime],
        ];
    }
}

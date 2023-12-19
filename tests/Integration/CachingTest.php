<?php

/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

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
use Yoast\PHPUnitPolyfills\Polyfills\ExpectPHPException;

class CachingTest extends TestCase
{
    use ExpectPHPException;

    /**
     * @dataProvider provideSavedCacheData
     */
    public function testInitWithDifferentCacheStateCallsCacheCorrectly(
        $testedCacheClass,
        $currentDataCached,
        $expectedDataWritten,
        $currentMtime
    ) {
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
                $psr16->method('set')->willReturnCallback(function ($key, $value, $ttl) use (&$writtenData) {
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
                BaseCacheWithCallbacksMock::setLoadCallback(function () use ($currentDataCached) {
                    return $currentDataCached;
                });

                // Set current mtime
                BaseCacheWithCallbacksMock::setMtimeCallback(function () use ($currentMtime) {
                    return $currentMtime;
                });

                // Test data written
                BaseCacheWithCallbacksMock::setSaveCallback(function ($data) use (&$writtenData) {
                    if ($data instanceof SimplePie) {
                        $data = $data->data;
                    }

                    $writtenData = $data;

                    // Ignore internally setted '__cache_expiration_time'
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

                break;
        }

        $feed->init();

        if ($testedCacheClass === Base::class) {
            BaseCacheWithCallbacksMock::resetAllCallbacks();
        }

        // Adjust expected cache expiration time to prevent race conditions
        if (array_key_exists('cache_expiration_time', $writtenData)) {
            $expectedDataWritten['cache_expiration_time'] = $writtenData['cache_expiration_time'];
        }

        $this->assertSame($expectedDataWritten, $writtenData);
    }

    public function provideSavedCacheData()
    {
        $defaultMtime = time();
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
            [CacheInterface::class, $currentlyCachedDataIsUpdated,          $expectDefaultDataWritten, $defaultMtime],
            // If the cache is still valid, just return true
            [Base::class,           $currentlyCachedDataIsValid,            $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataIsValid,            $expectNoDataWritten,      $defaultMtime],
        ];
    }
}

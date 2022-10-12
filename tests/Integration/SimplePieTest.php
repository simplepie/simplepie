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
use SimplePie\Cache\Base;
use SimplePie\Misc;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\Cache\BaseCacheWithCallbacksMock;
use SimplePie\Tests\Fixtures\FileMock;
use Yoast\PHPUnitPolyfills\Polyfills\ExpectPHPException;

class SimplePieTest extends TestCase
{
    use ExpectPHPException;

    /**
     * @dataProvider provideSavedCacheData
     */
    public function testInitWithEmptyCacheSavesCorrectDataInCache(
        $testedCacheClass,
        $currentDataCached,
        $expectedDataWritten,
        $currentMtime
    ) {
        $writtenData = [];

        $feed = new SimplePie();
        $feed->get_registry()->register('File', FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        switch ($testedCacheClass) {
            case CacheInterface::class:
                $psr16 = $this->createMock(CacheInterface::class);
                // Set current cached data
                $psr16->method('get')->willReturn($currentDataCached);

                // Test data written
                $psr16->method('set')->willReturnCallback(function ($key, $value, $ttl) use (&$writtenData) {
                    // Ignore setting of the _mtime value
                    if (substr($key, - strlen('_mtime')) !== '_mtime') {
                        $writtenData = $value;
                    }

                    return true;
                });

                $feed->set_cache($psr16);
                break;

            case Base::class:
                // Set current cached data
                BaseCacheWithCallbacksMock::setLoadCallback(function() use ($currentDataCached) {
                    return $currentDataCached;
                });

                // Set current mtime
                BaseCacheWithCallbacksMock::setMtimeCallback(function() use ($currentMtime) {
                    return $currentMtime;
                });

                // Test data written
                BaseCacheWithCallbacksMock::setSaveCallback(function($data) use (&$writtenData) {
                    if ($data instanceof SimplePie) {
                        $data = $data->data;
                    }

                    $writtenData = $data;

                    return true;
                });

                $feed->get_registry()->call('Cache', 'register', ['mock', BaseCacheWithCallbacksMock::class]);
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

        $this->assertSame($expectedDataWritten, $writtenData);
    }

    public function provideSavedCacheData()
    {
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
        ];

        $expectNoDataWritten = [];

        $currentlyNoDataIsCached = [];

        $currentlyCachedDataWithWrongBuild = [
            'build' => 0,
        ];

        $currentlyCachedDataWithCacheCollision = [
            'url' => 'http://example.com/some-different-url',
            'build' => Misc::get_build(),
        ];

        $currentlyCachedDataWithFeedUrl = [
            'url' => 'http://example.com/feed/',
            'feed_url' => 'http://example.com/feed/',
            'build' => Misc::get_build(),
        ];

        $defaultMtime = time();

        return [
            // If the cache is empty
            [Base::class,           $currentlyNoDataIsCached,               $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyNoDataIsCached,               $expectDefaultDataWritten, $defaultMtime],
            // If the cache is for an outdated build of SimplePie
            [Base::class,           $currentlyCachedDataWithWrongBuild,     $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithWrongBuild,     $expectDefaultDataWritten, $defaultMtime],
            // If we've hit a collision just rerun it with caching disabled
            [Base::class,           $currentlyCachedDataWithCacheCollision, $expectNoDataWritten,      $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithCacheCollision, $expectNoDataWritten,      $defaultMtime],
            // If we've got a non feed_url stored (if the page isn't actually a feed, or is a redirect) use that URL.
            // If the autodiscovery cache is still valid use it.
            // And we need to do feed autodiscovery.
            [Base::class,           $currentlyCachedDataWithFeedUrl,        $expectDefaultDataWritten, $defaultMtime],
            [CacheInterface::class, $currentlyCachedDataWithFeedUrl,        $expectDefaultDataWritten, $defaultMtime],
        ];
    }
}

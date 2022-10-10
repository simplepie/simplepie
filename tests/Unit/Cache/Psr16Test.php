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

namespace SimplePie\Tests\Unit\Cache;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use SimplePie\Cache\Psr16;
use SimplePie\Tests\Fixtures\Exception\Psr16CacheException;

class Psr16Test extends TestCase
{
    public function testImplementationIsGloballyStored()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('You must set an implementation of `Psr\SimpleCache\CacheInterface` via `SimplePie\SimplePie::set_cache()` first.');

        new Psr16('location', 'name', 'type');
    }

    public function testSaveWithWrongDataTypeThrowsInvalidArgumentException()
    {
        $data = 'string';
        $psr16 = $this->createMock(CacheInterface::class);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('SimplePie\Cache\Psr16::save(): Argument #1 ($data) must be of type array|SimplePie\SimplePie');

        $this->assertFalse($cache->save($data));
    }

    public function testSaveReturnsTrueIfDataAndMtimeCouldBeWritten()
    {
        $data = [];
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->exactly(2))->method('set')->withConsecutive(
            [
                '18bb0a0a94b49eda35e8944672d60a1474ff2895524f0e56c3752c1e0f7853e7',
                $data,
                3600,
            ],
            [
                '18bb0a0a94b49eda35e8944672d60a1474ff2895524f0e56c3752c1e0f7853e7_mtime'
            ]
        )->willReturn(true);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertTrue($cache->save($data));
    }

    public function testSaveReturnsFalseIfDataOrMtimeCouldNotBeWritten()
    {
        $data = [];
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->exactly(2))->method('set')->willReturn(false);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertFalse($cache->save($data));
    }

    public function testSaveCatchesCacheExceptionAndReturnsFalse()
    {
        $e = new Psr16CacheException();

        $data = [];
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('set')->willThrowException($e);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertFalse($cache->save($data));
    }

    public function testLoadReturnsCorrectData()
    {
        $data = [];
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn($data);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame($data, $cache->load());
    }

    public function testLoadReturnsFalseOnCacheMiss()
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturnCallback(function ($key, $default) {
            return $default;
        });

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(false, $cache->load());
    }

    public function testMtimeReturnsCorrectInt()
    {
        $data = 1234568790;
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn($data);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame($data, $cache->mtime());
    }

    public function testMtimeReturnsZeroOnNonInteger()
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn(false);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(0, $cache->mtime());
    }

    public function testMtimeReturnsZeroOnCacheException()
    {
        $e = new Psr16CacheException();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willThrowException($e);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(0, $cache->mtime());
    }

    public function testTouchReturnsTrueIfDataAndMtimeCouldBeWritten()
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn(true);
        $psr16->expects($this->exactly(2))->method('set')->willReturn(true);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(true, $cache->touch());
    }

    public function testTouchReturnsFalseOnNonInteger()
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn(false);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(false, $cache->touch());
    }

    public function testTouchReturnsFalseOnCacheException()
    {
        $e = new Psr16CacheException();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willThrowException($e);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(false, $cache->touch());
    }

    public function testUnlinkReturnsTrueIfDataAndMtimeCouldBeDeleted()
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->exactly(2))->method('delete')->willReturn(true);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(true, $cache->unlink());
    }

    public function testUnlinkReturnsFalseIfDataOrMtimeCouldNotBeDeleted()
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->exactly(2))->method('delete')->willReturn(false);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(false, $cache->unlink());
    }

    public function testUnlinkReturnsFalseOnCacheException()
    {
        $e = new Psr16CacheException();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('delete')->willThrowException($e);

        Psr16::store_cache($psr16);
        $cache = new Psr16('location', 'name', 'type');

        $this->assertSame(false, $cache->unlink());
    }
}

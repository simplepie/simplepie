<?php

declare(strict_types=1);
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
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Tests\Unit\Cache;

use PHPUnit\Framework\TestCase;
use SimplePie\Cache\Base;
use SimplePie\Cache\BaseDataCache;
use stdClass;

class BaseDataCacheTest extends TestCase
{
    public function testSetDataReturnsTrueIfDataCouldBeWritten()
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('save')->willReturn(true);

        $cache = new BaseDataCache($baseCache);

        $this->assertTrue($cache->set_data($key, $value, $ttl));
    }

    public function testSetDataReturnsFalseIfDataCouldNotBeWritten()
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('save')->willReturn(false);

        $cache = new BaseDataCache($baseCache);

        $this->assertFalse($cache->set_data($key, $value, $ttl));
    }

    public function testGetDataReturnsCorrectData()
    {
        $key = 'name';
        $cachedValue = ['__cache_expiration_time' => time() + 3600];
        $value = [];

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn($cachedValue);

        $cache = new BaseDataCache($baseCache);

        $this->assertSame($value, $cache->get_data($key));
    }

    public function testGetDataWithCacheMissReturnsDefault()
    {
        $key = 'name';
        $default = new stdClass();

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn(false);

        $cache = new BaseDataCache($baseCache);

        $this->assertSame($default, $cache->get_data($key, $default));
    }

    public function testGetDataWithCacheExpiredReturnsDefault()
    {
        $key = 'name';
        $cachedValue = ['__cache_expiration_time' => 0];
        $default = new stdClass();

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn($cachedValue);

        $cache = new BaseDataCache($baseCache);

        $this->assertSame($default, $cache->get_data($key, $default));
    }

    public function testGetDataWithCacheCorruptionReturnsDefault()
    {
        $key = 'name';
        $default = new stdClass();

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn('this is not an array');

        $cache = new BaseDataCache($baseCache);

        $this->assertSame($default, $cache->get_data($key, $default));
    }

    public function testDeleteDataReturnsTrueIfDataCouldBeDeleted()
    {
        $key = 'name';

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('unlink')->willReturn(true);

        $cache = new BaseDataCache($baseCache);

        $this->assertTrue($cache->delete_data($key));
    }

    public function testDeleteDataReturnsFalseIfDataCouldNotBeDeleted()
    {
        $key = 'name';

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('unlink')->willReturn(false);

        $cache = new BaseDataCache($baseCache);

        $this->assertFalse($cache->delete_data($key));
    }
}

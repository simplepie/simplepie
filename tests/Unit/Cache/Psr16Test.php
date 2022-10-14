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
use stdClass;

class Psr16Test extends TestCase
{
    public function testSetDataReturnsTrueIfDataCouldBeWritten()
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('set')->with($key, $value, $ttl)->willReturn(true);

        $cache = new Psr16($psr16);

        $this->assertTrue($cache->setData($key, $value, $ttl));
    }

    public function testSetDataReturnsFalseIfDataCouldNotBeWritten()
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('set')->willReturn(false);

        $cache = new Psr16($psr16);

        $this->assertFalse($cache->setData($key, $value, $ttl));
    }

    public function testGetDataReturnsCorrectData()
    {
        $key = 'name';
        $value = [];

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn($value);

        $cache = new Psr16($psr16);

        $this->assertSame($value, $cache->getData($key));
    }

    public function testGetDataWithCacheMissReturnsDefault()
    {
        $key = 'name';
        $default = new stdClass();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn($default);

        $cache = new Psr16($psr16);

        $this->assertSame($default, $cache->getData($key, $default));
    }

    public function testGetDataWithCacheCorruptionReturnsDefault()
    {
        $key = 'name';
        $default = new stdClass();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn('this is not an array');

        $cache = new Psr16($psr16);

        $this->assertSame($default, $cache->getData($key, $default));
    }

    public function testDeleteDataReturnsTrueIfDataCouldBeDeleted()
    {
        $key = 'name';

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('delete')->willReturn(true);

        $cache = new Psr16($psr16);

        $this->assertTrue($cache->deleteData($key));
    }

    public function testDeleteDataReturnsFalseIfDataCouldNotBeDeleted()
    {
        $key = 'name';

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('delete')->willReturn(false);

        $cache = new Psr16($psr16);

        $this->assertFalse($cache->deleteData($key));
    }
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Cache;

use PHPUnit\Framework\TestCase;
use SimplePie\Cache\Base;
use SimplePie\Cache\BaseDataCache;
use stdClass;

class BaseDataCacheTest extends TestCase
{
    public function testSetDataReturnsTrueIfDataCouldBeWritten(): void
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('save')->willReturn(true);

        $cache = new BaseDataCache($baseCache);

        self::assertTrue($cache->set_data($key, $value, $ttl));
    }

    public function testSetDataReturnsFalseIfDataCouldNotBeWritten(): void
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('save')->willReturn(false);

        $cache = new BaseDataCache($baseCache);

        self::assertFalse($cache->set_data($key, $value, $ttl));
    }

    public function testGetDataReturnsCorrectData(): void
    {
        $key = 'name';
        $cachedValue = ['__cache_expiration_time' => time() + 3600];
        $value = [];

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn($cachedValue);

        $cache = new BaseDataCache($baseCache);

        self::assertSame($value, $cache->get_data($key));
    }

    public function testGetDataWithCacheMissReturnsDefault(): void
    {
        $key = 'name';
        $default = new stdClass();

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn(false);

        $cache = new BaseDataCache($baseCache);

        self::assertSame($default, $cache->get_data($key, $default));
    }

    public function testGetDataWithCacheExpiredReturnsDefault(): void
    {
        $key = 'name';
        $cachedValue = ['__cache_expiration_time' => 0];
        $default = new stdClass();

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn($cachedValue);

        $cache = new BaseDataCache($baseCache);

        self::assertSame($default, $cache->get_data($key, $default));
    }

    public function testGetDataWithCacheCorruptionReturnsDefault(): void
    {
        $key = 'name';
        $default = new stdClass();

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('load')->willReturn('this is not an array');

        $cache = new BaseDataCache($baseCache);

        self::assertSame($default, $cache->get_data($key, $default));
    }

    public function testDeleteDataReturnsTrueIfDataCouldBeDeleted(): void
    {
        $key = 'name';

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('unlink')->willReturn(true);

        $cache = new BaseDataCache($baseCache);

        self::assertTrue($cache->delete_data($key));
    }

    public function testDeleteDataReturnsFalseIfDataCouldNotBeDeleted(): void
    {
        $key = 'name';

        $baseCache = $this->createMock(Base::class);
        $baseCache->expects($this->once())->method('unlink')->willReturn(false);

        $cache = new BaseDataCache($baseCache);

        self::assertFalse($cache->delete_data($key));
    }
}

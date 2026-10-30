<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Cache;

use Exception;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;
use SimplePie\Cache\Psr16;
use stdClass;
use Throwable;

class Psr16Test extends TestCase
{
    public function testSetDataReturnsTrueIfDataCouldBeWritten(): void
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('set')->with($key, $value, $ttl)->willReturn(true);

        $cache = new Psr16($psr16);

        self::assertTrue($cache->set_data($key, $value, $ttl));
    }

    public function testSetDataReturnsFalseIfDataCouldNotBeWritten(): void
    {
        $key = 'name';
        $value = [];
        $ttl = 3600;

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('set')->willReturn(false);

        $cache = new Psr16($psr16);

        self::assertFalse($cache->set_data($key, $value, $ttl));
    }

    public function testSetDataWithInvalidKeyThrowsInvalidArgumentException(): void
    {
        $key = 'invalid key';
        $value = [];
        $ttl = 3600;

        $e = $this->createMock(InvalidArgumentException::class);

        // BC for PHP <8.0 and psr/simple-cache <2.0.0: $e must implement \Throwable
        if (!$e instanceof Throwable) {
            $e = new class () extends Exception implements InvalidArgumentException {};
        }

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('set')->willThrowException($e);

        $cache = new Psr16($psr16);

        $this->expectException(InvalidArgumentException::class);

        $cache->set_data($key, $value, $ttl);
    }

    public function testGetDataReturnsCorrectData(): void
    {
        $key = 'name';
        $value = [];

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn($value);

        $cache = new Psr16($psr16);

        self::assertSame($value, $cache->get_data($key));
    }

    public function testGetDataWithCacheMissReturnsDefault(): void
    {
        $key = 'name';
        $default = new stdClass();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn($default);

        $cache = new Psr16($psr16);

        self::assertSame($default, $cache->get_data($key, $default));
    }

    public function testGetDataWithCacheCorruptionReturnsDefault(): void
    {
        $key = 'name';
        $default = new stdClass();

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn('this is not an array');

        $cache = new Psr16($psr16);

        self::assertSame($default, $cache->get_data($key, $default));
    }

    public function testGetDataWithInvalidKeyThrowsInvalidArgumentException(): void
    {
        $key = 'invalid key';

        $e = $this->createMock(InvalidArgumentException::class);

        // BC for PHP <8.0 and psr/simple-cache <2.0.0: $e must implement \Throwable
        if (!$e instanceof Throwable) {
            $e = new class () extends Exception implements InvalidArgumentException {};
        }

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willThrowException($e);

        $cache = new Psr16($psr16);

        $this->expectException(InvalidArgumentException::class);

        $cache->get_data($key);
    }

    public function testDeleteDataReturnsTrueIfDataCouldBeDeleted(): void
    {
        $key = 'name';

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('delete')->willReturn(true);

        $cache = new Psr16($psr16);

        self::assertTrue($cache->delete_data($key));
    }

    public function testDeleteDataReturnsFalseIfDataCouldNotBeDeleted(): void
    {
        $key = 'name';

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('delete')->willReturn(false);

        $cache = new Psr16($psr16);

        self::assertFalse($cache->delete_data($key));
    }

    public function testDeleteDataWithInvalidKeyThrowsInvalidArgumentException(): void
    {
        $key = 'invalid key';

        $e = $this->createMock(InvalidArgumentException::class);

        // BC for PHP <8.0 and psr/simple-cache <2.0.0: $e must implement \Throwable
        if (!$e instanceof Throwable) {
            $e = new class () extends Exception implements InvalidArgumentException {};
        }

        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('delete')->willThrowException($e);

        $cache = new Psr16($psr16);

        $this->expectException(InvalidArgumentException::class);

        $cache->delete_data($key);
    }
}

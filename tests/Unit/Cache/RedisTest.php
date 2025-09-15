<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Cache;

use PHPUnit\Framework\TestCase;

class RedisTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Cache\Redis'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Cache_Redis'));
    }
}

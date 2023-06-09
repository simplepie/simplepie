<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Cache;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\Cache\File'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_Cache_File'));
    }
}

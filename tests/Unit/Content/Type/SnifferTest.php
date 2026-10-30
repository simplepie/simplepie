<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Content\Type;

use PHPUnit\Framework\TestCase;

class SnifferTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Content\Type\Sniffer'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Content_Type_Sniffer'));
    }
}

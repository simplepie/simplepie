<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Net;

use PHPUnit\Framework\TestCase;

class IPv6Test extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\Net\IPv6'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_Net_IPv6'));
    }
}

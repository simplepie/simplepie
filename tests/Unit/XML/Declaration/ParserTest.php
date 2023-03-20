<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\XML\Declaration;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\XML\Declaration\Parser'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_XML_Declaration_Parser'));
    }
}

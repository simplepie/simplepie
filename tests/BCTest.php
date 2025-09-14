<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Encoding tests for SimplePie_Misc::change_encoding() and SimplePie_Misc::encoding()
 */
class BCTest extends TestCase
{
    /**
     * Test class SimplePie_Core exists
     */
    public function test_class_SimplePie_Core_exists(): void
    {
        self::assertTrue(class_exists('SimplePie_Core'));
    }

    /**
     * Test class SimplePie_Misc exists
     */
    public function test_class_SimplePie_Misc_exists(): void
    {
        self::assertTrue(class_exists('SimplePie_Misc'));
    }

    /**
     * Test class SimplePie_Decode_HTML_Entities exists
     */
    public function test_class_SimplePie_Decode_HTML_Entities_exists(): void
    {
        self::assertTrue(class_exists('SimplePie_Decode_HTML_Entities'));
    }
}

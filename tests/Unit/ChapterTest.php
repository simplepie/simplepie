<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Chapter;

class ChapterTest extends TestCase
{
    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Chapter'));
    }

    /**
     * @return array<array{string, float|null}>
     */
    public static function startProvider(): array
    {
        return [
            ['00:00:00.000', 0.0],
            ['01:02:03', 3723.0],
            ['00:01:30.250', 90.25],
            ['12:34', 754.0],
            ['45.5', 45.5],
            ['90', 90.0],
            ['abc', null],
            ['', null],
            ['1:2:3:4', null],
        ];
    }

    /**
     * @dataProvider startProvider
     */
    public function testGetStartSeconds(string $start, ?float $expected): void
    {
        $chapter = new Chapter($start);

        self::assertSame($start, $chapter->get_start());
        self::assertSame($expected, $chapter->get_start_seconds());
    }
}

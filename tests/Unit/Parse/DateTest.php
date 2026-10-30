<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\Parse;

use PHPUnit\Framework\TestCase;
use SimplePie\Parse\Date;

class DateTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Parse\Date'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Parse_Date'));
    }

    /**
     * @return iterable<array{string, int}>
     */
    public static function w3cDtfDatesProvider(): iterable
    {
        // The examples enclosed within come from the W3C Date and Time Formats note
        // https://www.w3.org/TR/NOTE-datetime
        yield 'Year' => [
            '1997',
            852076800,
        ];
        yield 'Year and month' => [
            '1997-07',
            867715200,
        ];
        yield 'Complete date' => [
            '1997-07-16',
            869011200,
        ];
        yield 'Complete date plus hours and minutes' => [
            '1997-07-16T19:20+01:00',
            869077200,
        ];
        yield 'Complete date plus hours, minutes and seconds' => [
            '1997-07-16T19:20:30+01:00',
            869077230,
        ];
        yield 'Complete date plus hours, minutes, seconds and a decimal fraction of a second' => [
            '1997-07-16T19:20:30.45+01:00',
            869077230,
        ];

        yield 'W3CDTF Example 1' => [
            '1994-11-05T08:15:30-05:00',
            784041330,
        ];
        yield 'W3CDTF Example 2' => [
            '1994-11-05T13:15:30Z',
            784041330,
        ];

        yield 'bug 259 test 0' => [
            '1994-11-05T08:15:30-0500',
            784041330,
        ];
    }

    /**
     * @dataProvider w3cDtfDatesProvider
     */
    public function testW3cDtf(string $data, int $expected): void
    {
        $date = new Date();
        self::assertSame(
            $expected,
            $date->date_w3cdtf($data)
        );
    }
}

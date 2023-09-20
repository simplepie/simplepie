<?php

/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Tests\Unit\Parse;

use PHPUnit\Framework\TestCase;
use SimplePie\Parse\Date;

class DateTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\Parse\Date'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_Parse_Date'));
    }

    public function w3cDtfDatesProvider()
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
    public function testW3cDtf($data, $expected)
    {
        $date = new Date();
        $this->assertSame(
            $expected,
            $date->date_w3cdtf($data)
        );
    }
}

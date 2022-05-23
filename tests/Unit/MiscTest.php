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

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Misc;
use SimplePie\Tests\Fixtures\MiscWithPublicStaticMethodsMock;
use SimplePie_Misc;

class MiscTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists(Misc::class));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists(SimplePie_Misc::class));
    }

    public function test_existence_of_get_element()
    {
        // BC: make sure that get_element() exists
        $this->assertSame([], Misc::get_element('', ''));
    }

    public function test_existence_of_entities_decode()
    {
        // BC: make sure that entities_decode() exists
        $this->assertSame('', Misc::entities_decode(''));
    }

    /**
     * #@+
     * UTF-8 methods
     *
     * Provider for the convert toUTF8* tests
     */
    public function utf8DataProvider()
    {
        return array(
            array('A', 'A', 'ASCII'),
            array("\xa1\xdb", "\xe2\x88\x9e", 'Big5'),
            array("\xa1\xe7", "\xe2\x88\x9e", 'EUC-JP'),
            array("\xa1\xde", "\xe2\x88\x9e", 'GBK'),
            array("\x81\x87", "\xe2\x88\x9e", 'Shift_JIS'),
            array("\x2b\x49\x68\x34\x2d", "\xe2\x88\x9e", 'UTF-7'),
            array("\xfe\xff\x22\x1e", "\xe2\x88\x9e", 'UTF-16'),
            array("\xff\xfe\x1e\x22", "\xe2\x88\x9e", 'UTF-16'),
            array("\x22\x1e", "\xe2\x88\x9e", 'UTF-16BE'),
            array("\x1e\x22", "\xe2\x88\x9e", 'UTF-16LE'),
        );
    }

    /**
     * Convert * to UTF-8
     *
     * @dataProvider utf8DataProvider
     */
    public function test_convert_UTF8($input, $expected, $encoding)
    {
        $encoding = Misc::encoding($encoding);
        $this->assertSameBin2Hex($expected, Misc::change_encoding($input, $encoding, 'UTF-8'));
    }

    /**
     * Special cases with mbstring handling
     */
    public function utf8MbstringDataProvider()
    {
        return array(
            array("\xa1\xc4", "\xe2\x88\x9e", 'EUC-KR'),
        );
    }

    /**
     * Convert * to UTF-8 using mbstring
     *
     * Special cases only
     * @dataProvider utf8MbstringDataProvider
     */
    public function test_convert_UTF8_mbstring($input, $expected, $encoding)
    {
        if (! extension_loaded('mbstring')) {
            $this->markTestSkipped('Skipping test because mbstring extension is not available.');
        }

        $encoding = Misc::encoding($encoding);
        $this->assertSameBin2Hex($expected, MiscWithPublicStaticMethodsMock::change_encoding_mbstring($input, $encoding, 'UTF-8'));
    }

    /**
     * Special cases with iconv handling
     */
    public function utf8IconvDataProvider()
    {
        return array(
            array("\xfe\xff\x22\x1e", "\xe2\x88\x9e", 'UTF-16'),
        );
    }

    /**
     * Convert * to UTF-8 using iconv
     *
     * Special cases only
     * @dataProvider utf8IconvDataProvider
     */
    public function test_convert_UTF8_iconv($input, $expected, $encoding)
    {
        if (! extension_loaded('iconv')) {
            $this->markTestSkipped('Skipping test because iconv extension is not available.');
        }

        $encoding = Misc::encoding($encoding);
        $this->assertSameBin2Hex($expected, MiscWithPublicStaticMethodsMock::change_encoding_iconv($input, $encoding, 'UTF-8'));
    }

    /**
     * Special cases with uconverter handling
     */
    public function utf8IntlDataProvider()
    {
        return array(
            array("\xfe\xff\x22\x1e", "\xe2\x88\x9e", 'UTF-16'),
        );
    }

    /**
     * Convert * to UTF-8 using UConverter
     *
     * Special cases only
     * @dataProvider utf8IntlDataProvider
     */
    public function test_convert_UTF8_uconverter($input, $expected, $encoding)
    {
        if (! extension_loaded('intl')) {
            $this->markTestSkipped('Skipping test because intl extension is not available.');
        }

        $encoding = Misc::encoding($encoding);
        $this->assertSameBin2Hex($expected, MiscWithPublicStaticMethodsMock::change_encoding_uconverter($input, $encoding, 'UTF-8'));
    }
    /**#@-*/

    /**#@+
     * UTF-16 methods
     */
    public function utf16DataProvider()
    {
        return array(
            array("\x22\x1e", "\x22\x1e", 'UTF-16BE'),
            array("\x1e\x22", "\x22\x1e", 'UTF-16LE'),
        );
    }

    /**
     * Convert * to UTF-16
     * @dataProvider utf16DataProvider
     */
    public function test_convert_UTF16($input, $expected, $encoding)
    {
        $encoding = Misc::encoding($encoding);
        $this->assertSameBin2Hex($expected, Misc::change_encoding($input, $encoding, 'UTF-16'));
    }
    /**#@-*/

    public function test_nonexistant()
    {
        $this->assertFalse(Misc::change_encoding('', 'TESTENC', 'UTF-8'));
    }

    public function assertSameBin2Hex($expected, $actual, $message = '')
    {
        if (is_string($expected)) {
            $expected = bin2hex($expected);
        }
        if (is_string($actual)) {
            $actual = bin2hex($actual);
        }
        $this->assertSame($expected, $actual, $message);
    }

    public function absolutizeUrlRFC3986DataProvider()
    {
        // The tests enclosed within come from RFC 3986 section 5.4
        // and all share the same base URL
        return [
            // normal
            [
                'g:h',
                'g:h',
            ],
            [
                'g',
                'http://a/b/c/g',
            ],
            [
                './g',
                'http://a/b/c/g',
            ],
            [
                'g/',
                'http://a/b/c/g/',
            ],
            [
                '/g',
                'http://a/g',
            ],
            [
                '//g',
                'http://g/',
            ],
            [
                '?y',
                'http://a/b/c/d;p?y',
            ],
            [
                'g?y',
                'http://a/b/c/g?y',
            ],
            [
                '#s',
                'http://a/b/c/d;p?q#s',
            ],
            [
                'g#s',
                'http://a/b/c/g#s',
            ],
            [
                'g?y#s',
                'http://a/b/c/g?y#s',
            ],
            [
                ';x',
                'http://a/b/c/;x',
            ],
            [
                'g;x',
                'http://a/b/c/g;x',
            ],
            [
                'g;x?y#s',
                'http://a/b/c/g;x?y#s',
            ],
            [
                '',
                'http://a/b/c/d;p?q',
            ],
            [
                '.',
                'http://a/b/c/',
            ],
            [
                './',
                'http://a/b/c/',
            ],
            [
                '..',
                'http://a/b/',
            ],
            [
                '../',
                'http://a/b/',
            ],
            [
                '../g',
                'http://a/b/g',
            ],
            [
                '../..',
                'http://a/',
            ],
            [
                '../../',
                'http://a/',
            ],
            [
                '../../g',
                'http://a/g',
            ],
            // abnormal
            [
                '../../../g',
                'http://a/g',
            ],
            [
                '../../../../g',
                'http://a/g',
            ],
            [
                '/./g',
                'http://a/g',
            ],
            [
                '/../g',
                'http://a/g',
            ],
            [
                'g.',
                'http://a/b/c/g.',
            ],
            [
                '.g',
                'http://a/b/c/.g',
            ],
            [
                'g..',
                'http://a/b/c/g..',
            ],
            [
                '..g',
                'http://a/b/c/..g',
            ],
            [
                './../g',
                'http://a/b/g',
            ],
            [
                './g/.',
                'http://a/b/c/g/',
            ],
            [
                'g/./h',
                'http://a/b/c/g/h',
            ],
            [
                'g/../h',
                'http://a/b/c/h',
            ],
            [
                'g;x=1/./y',
                'http://a/b/c/g;x=1/y',
            ],
            [
                'g;x=1/../y',
                'http://a/b/c/y',
            ],
            [
                'g?y/./x',
                'http://a/b/c/g?y/./x',
            ],
            [
                'g?y/../x',
                'http://a/b/c/g?y/../x',
            ],
            [
                'g#s/./x',
                'http://a/b/c/g#s/./x',
            ],
            [
                'g#s/../x',
                'http://a/b/c/g#s/../x',
            ],
            [
                'http:g',
                'http:g',
            ],
        ];
    }

    /**
     * @dataProvider absolutizeUrlRFC3986DataProvider
     */
    public function test_absolutize_url_RFC3986($relative, $expected)
    {
        $base = 'http://a/b/c/d;p?q';

        $this->assertSame(
            $expected,
            Misc::absolutize_url($relative, $base)
        );
    }

    public function absolutizeUrlBugsDataProvider()
    {
        return [
            'bug 274.0' => [
                'http://a/b/',
                'c',
                'http://a/b/c',
            ],
            'bug 274.1' => [
                'http://a/',
                'b',
                'http://a/b',
            ],
            'bug 274.2' => [
                'http://a/',
                '/b',
                'http://a/b',
            ],
            'bug 274.3' => [
                'http://a/b',
                'c',
                'http://a/c',
            ],
            'bug 579.0' => [
                'http://a/b/',
                "b\x0Ac",
                'http://a/b/b%0Ac',
            ],
            'bug 691.0' => [
                'http://a/b/c',
                'zero://a/b/c',
                'zero://a/b/c',
            ],
            'bug 691.1' => [
                'http://a/b/c',
                '//0',
                'http://0/',
            ],
            'bug 691.2' => [
                'http://a/b/c',
                '0',
                'http://a/b/0',
            ],
            'bug 691.3' => [
                'http://a/b/c',
                '?0',
                'http://a/b/c?0',
            ],
            'bug 691.4' => [
                'http://a/b/c',
                '#0',
                'http://a/b/c#0',
            ],
            'bug 691.5' => [
                'zero://a/b/c',
                'd',
                'zero://a/b/d',
            ],
            'bug 691.6' => [
                'http://0/b/c',
                'd',
                'http://0/b/d',
            ],
            'bug 691.7' => [
                'http://a/b/c?0',
                'd',
                'http://a/b/d',
            ],
            'bug 691.8' => [
                'http://a/b/c#0',
                'd',
                'http://a/b/d',
            ],
            'bug 1091.0.1' => [
                'http://example.com',
                '//example.net',
                'http://example.net/',
            ],
            'bug 1091.0' => [
                'http:g',
                'a',
                'http:a',
            ],
            'bug pct_encoding_invalid_second_char' => [
                'http://a/b/c/d',
                'f%0o',
                'http://a/b/c/f%250o',
            ],
        ];
    }

    /**
     * @dataProvider absolutizeUrlBugsDataProvider
     */
    public function test_absolutize_url_bugs($base, $relative, $expected)
    {
        $this->assertSame(
            $expected,
            Misc::absolutize_url($relative, $base)
        );
    }

    public function parseDateDataProvider()
    {
        return [
            // The tests enclosed within come from RFC 3339 section 5.8
            'RFC3339 section 5.8 test 1' => [
                '1985-04-12T23:20:50.52Z',
                482196051,
            ],
            'RFC3339 section 5.8 test 2' => [
                '1996-12-19T16:39:57-08:00',
                851042397,
            ],
            'RFC3339 section 5.8 test 3' => [
                '1996-12-20T00:39:57Z',
                851042397,
            ],
            // The tests enclosed within come from the W3C Date and Time Formats note
            'W3CDTF test 1' => [
                '1994-11-05T08:15:30-05:00',
                784041330,
            ],
            'W3CDTF test 2' => [
                '1994-11-05T13:15:30Z',
                784041330,
            ],
            // The tests enclosed within come from the RFC 2822
            // valid
            'RFC2822 test 1' => [
                'Fri, 05 Nov 94 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test 2' => [
                '05 Nov 94 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test 3' => [
                'Fri, 5 Nov 94 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test 4' => [
                'Fri, 05 Nov 94 13:15 GMT',
                784041300,
            ],
            'RFC2822 test 5' => [
                'Fri, 05 Nov 94 13:15:30 UT',
                784041330,
            ],
            'RFC2822 test 6' => [
                'Fri, 05 Nov 94 08:15:30 EST',
                784041330,
            ],
            'RFC2822 test 7' => [
                'Fri, 05 Nov 94 09:15:30 EDT',
                784041330,
            ],
            'RFC2822 test 8' => [
                'Fri, 05 Nov 94 07:15:30 CST',
                784041330,
            ],
            'RFC2822 test 9' => [
                'Fri, 05 Nov 94 08:15:30 CDT',
                784041330,
            ],
            'RFC2822 test 10' => [
                'Fri, 05 Nov 94 06:15:30 MST',
                784041330,
            ],
            'RFC2822 test 11' => [
                'Fri, 05 Nov 94 07:15:30 MDT',
                784041330,
            ],
            'RFC2822 test 12' => [
                'Fri, 05 Nov 94 05:15:30 PST',
                784041330,
            ],
            'RFC2822 test 13' => [
                'Fri, 05 Nov 94 06:15:30 PDT',
                784041330,
            ],
            'RFC2822 test 14' => [
                'Fri, 05 Nov 94 13:15:30 A',
                784041330,
            ],
            'RFC2822 test 15' => [
                'Fri, 05 Nov 94 13:15:30 B',
                784041330,
            ],
            'RFC2822 test 16' => [
                'Fri, 05 Nov 94 13:15:30 C',
                784041330,
            ],
            'RFC2822 test 17' => [
                'Fri, 05 Nov 94 13:15:30 D',
                784041330,
            ],
            'RFC2822 test 18' => [
                'Fri, 05 Nov 94 13:15:30 E',
                784041330,
            ],
            'RFC2822 test 19' => [
                'Fri, 05 Nov 94 13:15:30 F',
                784041330,
            ],
            'RFC2822 test 20' => [
                'Fri, 05 Nov 94 13:15:30 G',
                784041330,
            ],
            'RFC2822 test 21' => [
                'Fri, 05 Nov 94 13:15:30 H',
                784041330,
            ],
            'RFC2822 test 22' => [
                'Fri, 05 Nov 94 13:15:30 I',
                784041330,
            ],
            'RFC2822 test 23' => [
                'Fri, 05 Nov 94 13:15:30 K',
                784041330,
            ],
            'RFC2822 test 24' => [
                'Fri, 05 Nov 94 13:15:30 L',
                784041330,
            ],
            'RFC2822 test 25' => [
                'Fri, 05 Nov 94 13:15:30 M',
                784041330,
            ],
            'RFC2822 test 26' => [
                'Fri, 05 Nov 94 13:15:30 N',
                784041330,
            ],
            'RFC2822 test 27' => [
                'Fri, 05 Nov 94 13:15:30 O',
                784041330,
            ],
            'RFC2822 test 28' => [
                'Fri, 05 Nov 94 13:15:30 P',
                784041330,
            ],
            'RFC2822 test 29' => [
                'Fri, 05 Nov 94 13:15:30 Q',
                784041330,
            ],
            'RFC2822 test 30' => [
                'Fri, 05 Nov 94 13:15:30 R',
                784041330,
            ],
            'RFC2822 test 31' => [
                'Fri, 05 Nov 94 13:15:30 S',
                784041330,
            ],
            'RFC2822 test 32' => [
                'Fri, 05 Nov 94 13:15:30 T',
                784041330,
            ],
            'RFC2822 test 33' => [
                'Fri, 05 Nov 94 13:15:30 U',
                784041330,
            ],
            'RFC2822 test 34' => [
                'Fri, 05 Nov 94 13:15:30 V',
                784041330,
            ],
            'RFC2822 test 35' => [
                'Fri, 05 Nov 94 13:15:30 W',
                784041330,
            ],
            'RFC2822 test 36' => [
                'Fri, 05 Nov 94 13:15:30 X',
                784041330,
            ],
            'RFC2822 test 37' => [
                'Fri, 05 Nov 94 13:15:30 Y',
                784041330,
            ],
            'RFC2822 test 38' => [
                'Fri, 05 Nov 94 13:15:30 Z',
                784041330,
            ],
            'RFC2822 test 39' => [
                'Fri, 05 Nov 94 13:15:30 +0000',
                784041330,
            ],
            'RFC2822 test 40' => [
                'Fri, 05 Nov 94 13:15:30 -0000',
                784041330,
            ],
            'RFC2822 test 41' => [
                'Fri, 05 Nov 94 14:15:30 +0100',
                784041330,
            ],
            'RFC2822 test 42' => [
                'Fri, 05 Nov 94 12:15:30 -0100',
                784041330,
            ],
            'RFC2822 test 43' => [
                'Fri(day), 05 Nov(ember) 94 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test 44' => [
                'Fri(day), 05 Nov(ember) 94 13:15:30 A',
                784041330,
            ],
            // invalid
            'RFC2822 test four_digit_year' => [
                'Fri, 05 Nov 1994 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test full_name_of_day' => [
                'Friday, 05 Nov 94 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test invalid_day' => [
                'Vendredi, 05 Nov 94 13:15:30 GMT',
                784041330,
            ],
            'RFC2822 test invalid_timezone' => [
                'Fri, 05 Nov 94 13:15:30 UTC',
                784041330,
            ],
            'RFC2822 test mismatch_name_of_day' => [
                'Mon, 05 Nov 94 13:15:30 GMT',
                784041330,
            ],
            // Bug tests
            'bug 157 test 0' => [
                'meep',
                false,
            ],
            'bug 259 test 0' => [
                '1994-11-05T08:15:30-0500',
                784041330,
            ],
        ];
    }

    /**
     * @dataProvider parseDateDataProvider
     */
    public function test_parse_date($data, $expected)
    {
        $this->assertSame(
            $expected,
            Misc::parse_date($data)
        );
    }
}

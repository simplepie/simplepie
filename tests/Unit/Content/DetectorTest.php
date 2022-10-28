<?php
/**
 * Tests for autodiscovery
 *
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

namespace SimplePie\Tests\Unit\Content;

use PHPUnit\Framework\TestCase;
use SimplePie\Content\Detector;
use SimplePie\HTTP\Response;
use SimplePie\Registry;
use SimplePie\SimplePie;

class DetectorTest extends TestCase
{
    /**
     * @dataProvider possibleFeedsData
     */
    public function testDiscoverPossibleFeedUrlsReturnsCorrectData(string $body, $headers, $type, $expected)
    {
        $response = $this->createMock(Response::class);
        $response->method('get_requested_uri')->willReturn('http://example.com/');
        $response->method('get_body_content')->willReturn($body);

        foreach ($headers as $name => $value) {
            $response->method('has_header')->with($name)->willReturn(true);
            $response->method('get_header_line')->with($name)->willReturn($value);
        }

        $detector = new Detector(new Registry());

        $this->assertSame($expected, $detector->discover_possible_feed_urls($response, $type));
    }

    public function possibleFeedsData()
    {
        yield [
            '',
            [],
            SimplePie::LOCATOR_ALL,
            [],
        ];

        yield [
            file_get_contents(dirname(__DIR__, 2) . '/data/fftests.html'),
            [],
            SimplePie::LOCATOR_ALL,
            [
                'http://example.com/1.atom',
                'http://example.com/2.rss',
                'http://example.com/3.xml',
                'http://example.com/4.atom',
                'http://example.com/5.atom',
                'http://example.com/6.atom',
                'http://example.com/7.atom',
                'http://example.com/8.atom',
                'http://example.com/9.atom',
                'http://example.com/10.atom',
                'http://example.com/11.atom',
                'http://example.com/12.atom',
                'http://example.com/13.atom',
            ],
        ];

        // TODO Add tests
        yield [
            file_get_contents(dirname(__DIR__, 2) . '/data/fftests.html'),
            [],
            SimplePie::LOCATOR_LOCAL_EXTENSION,
            [],
        ];

        // TODO Add tests
        yield [
            file_get_contents(dirname(__DIR__, 2) . '/data/fftests.html'),
            [],
            SimplePie::LOCATOR_LOCAL_BODY,
            [],
        ];

        // TODO Add tests
        yield [
            file_get_contents(dirname(__DIR__, 2) . '/data/fftests.html'),
            [],
            SimplePie::LOCATOR_REMOTE_EXTENSION,
            [],
        ];

        // TODO Add tests
        yield [
            file_get_contents(dirname(__DIR__, 2) . '/data/fftests.html'),
            [],
            SimplePie::LOCATOR_REMOTE_BODY,
            [],
        ];

        yield [
            '',
            [],
            SimplePie::LOCATOR_NONE,
            [],
        ];
    }

    /**
     * @dataProvider detectData
     */
    public function testGetTypeDetectsCorrectType($body, $headers, $expected)
    {
        $response = $this->createMock(Response::class);
        $response->method('get_body_content')->willReturn($body);

        foreach ($headers as $name => $value) {
            $response->method('has_header')->with($name)->willReturn(true);
            $response->method('get_header_line')->with($name)->willReturn($value);
        }

        $detector = new Detector(new Registry());

        $this->assertSame($expected, $detector->detect_type($response));
    }

    public function detectData()
    {
        return [
            [
                '',
                [],
                'text/plain',
            ],
            [
                '<!doctype html',
                [],
                'text/html',
            ],
            [
                '<html',
                [],
                'text/html',
            ],
            [
                '<script',
                [],
                'text/html',
            ],
            [
                '%PDF-',
                [],
                'application/pdf',
            ],
            [
                '%!PS-Adobe-',
                [],
                'application/postscript',
            ],
            [
                'GIF87a',
                [],
                'image/gif',
            ],
            [
                'GIF89a',
                [],
                'image/gif',
            ],
            [
                "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A",
                [],
                'image/png',
            ],
            [
                "\xFF\xD8\xFF",
                [],
                'image/jpeg',
            ],
            [
                "\x42\x4D",
                [],
                'image/bmp',
            ],
            [
                "\x00\x00\x01\x00",
                [],
                'image/vnd.microsoft.icon',
            ],
        ];
    }
}

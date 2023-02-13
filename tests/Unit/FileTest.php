<?php

declare(strict_types=1);
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
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\File;
use SimplePie\HTTP\Response;
use SimplePie\Tests\Fixtures\FileMock;

class FileTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\File'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_File'));
    }

    public function testFileExtendsResponse(): void
    {
        $this->assertInstanceOf(Response::class, new FileMock(''));
    }

    public function getResponseData(): iterable
    {
        yield [new FileMock('http://example.com/feed')];
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetRequestedUriReturnsString(File $response): void
    {
        $this->assertSame(
            'http://example.com/feed',
            $response->get_requested_uri()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetStatusCodeReturnsInt(File $response): void
    {
        $this->assertSame(
            200,
            $response->get_status_code()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeadersReturnsArray(File $response): void
    {
        $this->assertSame(
            ['content-type' => ['application/atom+xml']],
            $response->get_headers()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testHasHeadersReturnsTrue(File $response): void
    {
        $this->assertTrue($response->has_header('Content-Type'));
    }

    /**
     * @dataProvider getResponseData
     */
    public function testHasHeadersReturnsFalse(File $response): void
    {
        $this->assertFalse($response->has_header('X-Custom-Header'));
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderReturnsArray(File $response): void
    {
        $this->assertSame(
            ['application/atom+xml'],
            $response->get_header('CONTENT-TYPE')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderReturnsEmptyArray(File $response): void
    {
        $this->assertSame(
            [],
            $response->get_header('X-Custom-Header')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderLineReturnsString(File $response): void
    {
        $this->assertSame(
            'application/atom+xml',
            $response->get_header_line('content-Type')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderLineReturnsEmptyString(File $response): void
    {
        $this->assertSame(
            '',
            $response->get_header_line('X-Custom-Header')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetBodyContentReturnsString(File $response): void
    {
        $this->assertSame(
            '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />',
            $response->get_body_content()
        );
    }
}

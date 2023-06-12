<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use SimplePie\HTTP\Psr7Response;
use SimplePie\HTTP\Response;

class Psr7ResponseTest extends TestCase
{
    public function testPsr7ResponseExtendsResponse(): void
    {
        $this->assertInstanceOf(Response::class, new Psr7Response($this->createMock(ResponseInterface::class), '', ''));
    }

    public function getResponseData(): iterable
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('getContents')->willReturn('<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />');

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);
        $response->method('getBody')->willReturn($stream);
        $response->method('getHeaders')->willReturn(['content-type' => ['application/atom+xml']]);
        $response->method('hasHeader')->willReturnMap([
            ['Content-Type', true],
            ['X-Custom-Header', false],
        ]);
        $response->method('getHeader')->willReturnMap([
            ['CONTENT-TYPE', ['application/atom+xml']],
            ['X-Custom-Header', []],
        ]);
        $response->method('getHeaderLine')->willReturnMap([
            ['content-Type', 'application/atom+xml'],
            ['X-Custom-Header', ''],
        ]);

        yield [new Psr7Response(
            $response,
            'https://example.com',
            'https://example.com/feed.xml'
        )];
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetPermanentUriReturnsString(Psr7Response $response): void
    {
        $this->assertSame(
            'https://example.com',
            $response->get_permanent_uri()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetFinalRequestedUriReturnsString(Psr7Response $response): void
    {
        $this->assertSame(
            'https://example.com/feed.xml',
            $response->get_final_requested_uri()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetStatusCodeReturnsInt(Psr7Response $response): void
    {
        $this->assertSame(
            200,
            $response->get_status_code()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeadersReturnsArray(Psr7Response $response): void
    {
        $this->assertSame(
            ['content-type' => ['application/atom+xml']],
            $response->get_headers()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testHasHeadersReturnsTrue(Psr7Response $response): void
    {
        $this->assertTrue($response->has_header('Content-Type'));
    }

    /**
     * @dataProvider getResponseData
     */
    public function testHasHeadersReturnsFalse(Psr7Response $response): void
    {
        $this->assertFalse($response->has_header('X-Custom-Header'));
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderReturnsArray(Psr7Response $response): void
    {
        $this->assertSame(
            ['application/atom+xml'],
            $response->get_header('CONTENT-TYPE')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderReturnsEmptyArray(Psr7Response $response): void
    {
        $this->assertSame(
            [],
            $response->get_header('X-Custom-Header')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderLineReturnsString(Psr7Response $response): void
    {
        $this->assertSame(
            'application/atom+xml',
            $response->get_header_line('content-Type')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderLineReturnsEmptyString(Psr7Response $response): void
    {
        $this->assertSame(
            '',
            $response->get_header_line('X-Custom-Header')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetBodyContentReturnsString(Psr7Response $response): void
    {
        $this->assertSame(
            '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />',
            $response->get_body_content()
        );
    }
}

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
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(Response::class, new Psr7Response($this->createMock(ResponseInterface::class), '', ''));
    }

    public function createPsr7Response(): Psr7Response
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('__toString')->willReturn('<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />');

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

        return new Psr7Response(
            $response,
            'https://example.com',
            'https://example.com/feed.xml'
        );
    }

    public function testGetPermanentUriReturnsString(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            'https://example.com',
            $response->get_permanent_uri()
        );
    }

    public function testGetFinalRequestedUriReturnsString(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            'https://example.com/feed.xml',
            $response->get_final_requested_uri()
        );
    }

    public function testGetStatusCodeReturnsInt(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            200,
            $response->get_status_code()
        );
    }

    public function testGetHeadersReturnsArray(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            ['content-type' => ['application/atom+xml']],
            $response->get_headers()
        );
    }

    public function testHasHeadersReturnsTrue(): void
    {
        $response = $this->createPsr7Response();

        self::assertTrue($response->has_header('Content-Type'));
    }

    public function testHasHeadersReturnsFalse(): void
    {
        $response = $this->createPsr7Response();

        self::assertFalse($response->has_header('X-Custom-Header'));
    }

    public function testGetHeaderReturnsArray(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            ['application/atom+xml'],
            $response->get_header('CONTENT-TYPE')
        );
    }

    public function testGetHeaderReturnsEmptyArray(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            [],
            $response->get_header('X-Custom-Header')
        );
    }

    public function testGetHeaderLineReturnsString(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            'application/atom+xml',
            $response->get_header_line('content-Type')
        );
    }

    public function testGetHeaderLineReturnsEmptyString(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            '',
            $response->get_header_line('X-Custom-Header')
        );
    }

    public function testGetBodyContentReturnsString(): void
    {
        $response = $this->createPsr7Response();

        self::assertSame(
            '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />',
            $response->get_body_content()
        );
    }
}

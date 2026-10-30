<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\File;
use SimplePie\HTTP\Response;
use SimplePie\Tests\Fixtures\FileMock;

class FileTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\File'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_File'));
    }

    public function testFileExtendsResponse(): void
    {
        self::assertInstanceOf(Response::class, new FileMock(''));
    }

    /**
     * @return array<array{File}>
     */
    public static function getResponseData(): iterable
    {
        yield [new FileMock('http://example.com/feed')];
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetRequestedUriReturnsString(File $response): void
    {
        self::assertSame(
            'http://example.com/feed',
            $response->get_final_requested_uri()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetStatusCodeReturnsInt(File $response): void
    {
        self::assertSame(
            200,
            $response->get_status_code()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeadersReturnsArray(File $response): void
    {
        self::assertSame(
            ['content-type' => ['application/atom+xml']],
            $response->get_headers()
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testHasHeadersReturnsTrue(File $response): void
    {
        self::assertTrue($response->has_header('Content-Type'));
    }

    /**
     * @dataProvider getResponseData
     */
    public function testHasHeadersReturnsFalse(File $response): void
    {
        self::assertFalse($response->has_header('X-Custom-Header'));
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderReturnsArray(File $response): void
    {
        self::assertSame(
            ['application/atom+xml'],
            $response->get_header('CONTENT-TYPE')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderReturnsEmptyArray(File $response): void
    {
        self::assertSame(
            [],
            $response->get_header('X-Custom-Header')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderLineReturnsString(File $response): void
    {
        self::assertSame(
            'application/atom+xml',
            $response->get_header_line('content-Type')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetHeaderLineReturnsEmptyString(File $response): void
    {
        self::assertSame(
            '',
            $response->get_header_line('X-Custom-Header')
        );
    }

    /**
     * @dataProvider getResponseData
     */
    public function testGetBodyContentReturnsString(File $response): void
    {
        self::assertSame(
            '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />',
            $response->get_body_content()
        );
    }
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use SimplePie\HTTP\Parser;

class ParserTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\HTTP\Parser'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_HTTP_Parser'));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function chunkedDataProvider(): array
    {
        return [
            [
                "25\r\nThis is the data in the first chunk\r\n\r\n1A\r\nand this is the second one\r\n0\r\n",
                "This is the data in the first chunk\r\nand this is the second one"
            ],
            [
                "02\r\nab\r\n04\r\nra\nc\r\n06\r\nadabra\r\n0\r\nnothing\n",
                "abra\ncadabra"
            ],
            [
                "02\r\nab\r\n04\r\nra\nc\r\n06\r\nadabra\r\n0c\r\n\nall we got\n",
                "abra\ncadabra\nall we got\n"
            ],
        ];
    }

    /**
     * @dataProvider chunkedDataProvider
     */
    public function testChunkedNormal(string $data, string $expected): void
    {
        $data = "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nTransfer-Encoding: chunked\r\n\r\n" . $data;
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data);
        $this->assertTrue($parser->parse());
        $this->assertSame(1.1, $parser->http_version);
        $this->assertSame(200, $parser->status_code);
        $this->assertSame('OK', $parser->reason);
        $this->assertSame(['content-type' => 'text/plain'], $parser->headers);
        $this->assertSame($expected, $parser->body);
    }

    /**
     * @dataProvider chunkedDataProvider
     */
    public function testChunkedProxy(string $data, string $expected): void
    {
        $data = "HTTP/1.0 200 Connection established\r\n\r\nHTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nTransfer-Encoding: chunked\r\n\r\n" . $data;
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data);
        $this->assertTrue($parser->parse());
        $this->assertSame(1.1, $parser->http_version);
        $this->assertSame(200, $parser->status_code);
        $this->assertSame('OK', $parser->reason);
        $this->assertSame(['content-type' => 'text/plain'], $parser->headers);
        $this->assertSame($expected, $parser->body);
    }

    /**
     * @dataProvider chunkedDataProvider
     */
    public function testChunkedProxy11(string $data, string $expected): void
    {
        $data = "HTTP/1.1 200 Connection established\r\n\r\nHTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nTransfer-Encoding: chunked\r\n\r\n" . $data;
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data);
        $this->assertTrue($parser->parse());
        $this->assertSame(1.1, $parser->http_version);
        $this->assertSame(200, $parser->status_code);
        $this->assertSame('OK', $parser->reason);
        $this->assertSame(['content-type' => 'text/plain'], $parser->headers);
        $this->assertSame($expected, $parser->body);
    }

    public function testDuplicateHeaders(): void
    {
        $data = "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\nContent-Security-Policy: default-src 'self' http://example.com\r\nContent-Type: text/plain\r\nContent-Security-Policy: script-src http://example.com/\r\n\r\n";
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data);
        $this->assertTrue($parser->parse());
        $this->assertSame([
            // Later Content-Type takes precedence.
            'content-type' => 'text/plain',
            // This is invalid but we are going to remove the parser eventually.
            'content-security-policy' => "default-src 'self' http://example.com, script-src http://example.com/",
        ], $parser->headers);
    }

    /**
     * @dataProvider chunkedDataProvider
     */
    public function testChunkedNormalPsr7(string $data, string $expected): void
    {
        $data = "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nTransfer-Encoding: chunked\r\n\r\n" . $data;
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data, true);
        $this->assertTrue($parser->parse());
        $this->assertSame(1.1, $parser->http_version);
        $this->assertSame(200, $parser->status_code);
        $this->assertSame('OK', $parser->reason);
        $this->assertSame(['content-type' => ['text/plain']], $parser->headers);
        $this->assertSame($expected, $parser->body);
    }

    /**
     * @dataProvider chunkedDataProvider
     */
    public function testChunkedProxyPsr7(string $data, string $expected): void
    {
        $data = "HTTP/1.0 200 Connection established\r\n\r\nHTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nTransfer-Encoding: chunked\r\n\r\n" . $data;
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data, true);
        $this->assertTrue($parser->parse());
        $this->assertSame(1.1, $parser->http_version);
        $this->assertSame(200, $parser->status_code);
        $this->assertSame('OK', $parser->reason);
        $this->assertSame(['content-type' => ['text/plain']], $parser->headers);
        $this->assertSame($expected, $parser->body);
    }

    /**
     * @dataProvider chunkedDataProvider
     */
    public function testChunkedProxy11Psr7(string $data, string $expected): void
    {
        $data = "HTTP/1.1 200 Connection established\r\n\r\nHTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nTransfer-Encoding: chunked\r\n\r\n" . $data;
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data, true);
        $this->assertTrue($parser->parse());
        $this->assertSame(1.1, $parser->http_version);
        $this->assertSame(200, $parser->status_code);
        $this->assertSame('OK', $parser->reason);
        $this->assertSame(['content-type' => ['text/plain']], $parser->headers);
        $this->assertSame($expected, $parser->body);
    }

    public function testDuplicateHeadersPsr7(): void
    {
        $data = "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\nContent-Security-Policy: default-src 'self' http://example.com\r\nContent-Type: text/plain\r\nContent-Security-Policy: script-src http://example.com/\r\n\r\n";
        $data = Parser::prepareHeaders($data);
        $parser = new Parser($data, true);
        $this->assertTrue($parser->parse());
        $this->assertSame([
            // Later Content-Type takes precedence.
            'content-type' => ['text/plain'],
            'content-security-policy' => ["default-src 'self' http://example.com", 'script-src http://example.com/'],
        ], $parser->headers);
    }
}

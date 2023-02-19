<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use SimplePie\HTTP\Parser;

class ParserTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\HTTP\Parser'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_HTTP_Parser'));
    }

    public function chunkedDataProvider()
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
    public function testChunkedNormal($data, $expected)
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
    public function testChunkedProxy($data, $expected)
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
    public function testChunkedProxy11($data, $expected)
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
}

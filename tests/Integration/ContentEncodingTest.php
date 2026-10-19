<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Response as MockWebServerResponse;
use PHPUnit\Framework\TestCase;
use SimplePie\SimplePie;

class ContentEncodingTest extends TestCase
{
    private static function feed(): string
    {
        $body = file_get_contents(dirname(__FILE__, 2) . '/data/feed_rss-2.0.xml');
        \assert($body !== false);

        return $body;
    }

    /**
     * @return iterable<string, array{0: string, 1: list<string>}>
     */
    public static function provideEncodedResponses(): iterable
    {
        $xml = self::feed();
        $gzip = (string) gzencode($xml);
        $deflateZlib = (string) gzcompress($xml);
        $deflateRaw = (string) gzdeflate($xml);
        $type = 'content-type: application/rss+xml';

        yield 'no Content-Encoding header' => [$xml, [$type]];
        yield 'identity' => [$xml, [$type, 'content-encoding: identity']];
        yield 'none' => [$xml, [$type, 'content-encoding: none']];
        yield 'empty value' => [$xml, [$type, 'content-encoding: ']];
        yield 'unknown coding' => [$xml, [$type, 'content-encoding: aws-chunked']];
        yield 'gzip' => [$gzip, [$type, 'content-encoding: gzip']];
        yield 'gzip uppercase' => [$gzip, [$type, 'content-encoding: GZIP']];
        yield 'x-gzip' => [$gzip, [$type, 'content-encoding: x-gzip']];
        yield 'deflate zlib' => [$deflateZlib, [$type, 'content-encoding: deflate']];
        yield 'deflate raw' => [$deflateRaw, [$type, 'content-encoding: deflate']];
        yield 'gzip header but plain body' => [$xml, [$type, 'content-encoding: gzip']];
        yield 'deflate header but plain body' => [$xml, [$type, 'content-encoding: deflate']];
        yield 'gzip body without header' => [$gzip, [$type]];
        yield 'double gzip' => [(string) gzencode($gzip), [$type, 'content-encoding: gzip']];
        yield 'gzip, gzip header' => [(string) gzencode($gzip), [$type, 'content-encoding: gzip, gzip']];
        yield 'deflate, gzip header' => [(string) gzencode($deflateZlib), [$type, 'content-encoding: deflate, gzip']];
        yield 'missing Content-Type' => [$xml, []];
        yield 'missing Content-Type with gzip' => [$gzip, ['content-encoding: gzip']];
    }

    /**
     * @dataProvider provideEncodedResponses
     *
     * @param list<string> $headers
     */
    public function testFeedIsFetchedWithCurl(string $body, array $headers): void
    {
        $this->assertFeedIsFetched($body, $headers, false);
    }

    /**
     * @dataProvider provideEncodedResponses
     *
     * @param list<string> $headers
     */
    public function testFeedIsFetchedWithFsockopen(string $body, array $headers): void
    {
        $this->assertFeedIsFetched($body, $headers, true);
    }

    /**
     * @param list<string> $headers
     */
    private function assertFeedIsFetched(string $body, array $headers, bool $fsockopen): void
    {
        if (!$fsockopen && !function_exists('curl_exec')) {
            self::markTestSkipped('cURL is not available');
        }

        $server = new MockWebServer();
        $server->start();
        // The first response from the PHP built-in server can carry deprecation notices, so discard it.
        @file_get_contents($server->setResponseOfPath('/warmup', new MockWebServerResponse('', [], 200)));
        $url = $server->setResponseOfPath('/feed', new MockWebServerResponse($body, $headers, 200));

        $feed = new SimplePie();
        $feed->enable_cache(false);
        $feed->force_fsockopen($fsockopen);
        $feed->set_feed_url($url);
        $feed->force_feed(true);

        $return = $feed->init();
        $server->stop();

        $error = implode("\n", (array) ($feed->error() ?? ''));
        self::assertTrue($return, 'Failed fetching feed: ' . $error);
        self::assertSame(200, $feed->status_code());
        self::assertNotEmpty($feed->get_items(), 'Feed has no items');
    }
}

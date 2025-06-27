<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Response as MockWebServerResponse;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use SimplePie\Cache;
use SimplePie\File;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\Cache\BaseCacheWithCallbacksMock;
use SimplePie\Tests\Fixtures\FileConstructorThrowsExceptionMock;

class SimplePieTest extends TestCase
{
    /**
     * @test that requesting a local file via SimplePie->set_feed_url() works
     */
    public function testRequestingALocalFileWithSetFeedUrlWorks(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_feed_url($filepath);

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    /**
     * @test that requesting a local file via SimplePie->set_file() works
     */
    public function testRequestingALocalFileWithSetFileWorks(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $file = new File($filepath);
        $simplepie->set_file($file);

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    /**
     * @test that requesting a local file with Psr18Client works
     */
    public function testRequestingALocalFileWithPsr18ClientWorks(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_http_client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );
        $simplepie->set_feed_url($filepath);

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    /**
     * @test that requesting a feed with Psr18Client works
     */
    public function testRequestingAFeedWithPsr18ClientWorks(): void
    {
        $request = $this->createMock(RequestInterface::class);
        $request->method('withHeader')->willReturn($request);

        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturn($request);

        $body = $this->createMock(StreamInterface::class);
        $body->method('__toString')->willReturnCallback(function () {
            $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

            return file_get_contents($filepath);
        });

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($body);
        $response->method('getStatusCode')->willReturn(200);
        $response->method('hasHeader')->willReturnMap([
            ['content-encoding', false],
            ['content-type', true],
        ]);
        $response->method('getHeaderLine')->willReturnMap([
            ['content-encoding', ''],
            ['content-type', 'application/x-rss+xml'],
        ]);
        $response->method('getHeaders')->willReturn([
            'content-type' => ['application/x-rss+xml'],
        ]);

        $client = $this->createMock(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_http_client(
            $client,
            $requestFactory,
            $this->createMock(UriFactoryInterface::class)
        );
        $simplepie->set_feed_url('https://example.org/feed.xml');

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }

    public function testSimplePieReturnsCorrectStatusCodeFromServerResponse(): void
    {
        $server = new MockWebServer();
        $server->start();

        $url = $server->setResponseOfPath(
            '/status/429',
            new MockWebServerResponse('Too many redirects', [], 429)
        );

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);

        $simplepie->set_feed_url($url);

        $return = $simplepie->init();

        $server->stop();

        $this->assertFalse($return);
        $this->assertSame(429, $simplepie->status_code());
        $this->assertSame('Retrieved unsupported status code "429"', $simplepie->error());
    }

    public function testSimplePieReturnsCorrectStatusCodeOnServerConnectionError(): void
    {
        $url = 'https://example.invalid:404/this-server-does-not-exist';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);

        $simplepie->set_feed_url($url);

        $return = $simplepie->init();

        $this->assertFalse($return);
        $this->assertSame(0, $simplepie->status_code());
        $this->assertSame('cURL error 6: Could not resolve host: example.invalid', $simplepie->error());

    }

    /**
     * @test that requesting a feed from cache works
     */
    public function testRequestingAFeedFromCacheWorks(): void
    {
        // Setup cache mock
        BaseCacheWithCallbacksMock::setSaveCallback(function ($data) {
            throw new Exception('BaseCacheWithCallbacksMock::mtime() should never been called.', 1);
        });
        BaseCacheWithCallbacksMock::setLoadCallback(function () {
            $cachepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.spc';
            $data = unserialize(file_get_contents($cachepath));

            if ($data === false) {
                throw new Exception(sprintf(
                    '%s::setLoadCallback() could not get contents of file "%s". Make sure that the file has not been modified.',
                    BaseCacheWithCallbacksMock::class,
                    $cachepath
                ), 1);
            }

            // Fix build in cache
            $data['build'] = \SimplePie\Misc::get_build();

            return $data;
        });
        BaseCacheWithCallbacksMock::setMtimeCallback(function () {
            throw new Exception('BaseCacheWithCallbacksMock::mtime() should never been called.', 1);
        });
        BaseCacheWithCallbacksMock::setTouchCallback(function () {
            throw new Exception('BaseCacheWithCallbacksMock::touch() should never been called.', 1);
        });
        BaseCacheWithCallbacksMock::setUnlinkCallback(function () {
            throw new Exception('BaseCacheWithCallbacksMock::unlink() should never been called.', 1);
        });

        $simplepie = new SimplePie();
        // Set FileMock to enforce that we never make an external http request
        $simplepie->get_registry()->register(File::class, FileConstructorThrowsExceptionMock::class);
        // Setup cache
        $simplepie->get_registry()->call(Cache::class, 'register', ['mock', BaseCacheWithCallbacksMock::class]);
        $simplepie->set_cache_location('mock');

        $simplepie->set_feed_url('https://example.com/feed.xml');

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());

        BaseCacheWithCallbacksMock::resetAllCallbacks();
    }

    /**
     * @test that requesting a feed from PSR-16 cache works
     */
    public function testRequestingAFeedFromPsr16CacheWorks(): void
    {
        // Setup cache mock
        $cache = $this->createMock(CacheInterface::class);
        $cache->method('get')->willReturnCallback(function () {
            $cachepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.spc';
            $data = unserialize(file_get_contents($cachepath));

            if ($data === false) {
                throw new Exception(sprintf(
                    '%s::get() could not get contents of file "%s". Make sure that the file has not been modified.',
                    CacheInterface::class,
                    $cachepath
                ), 1);
            }

            // Fix build in cache
            $data['build'] = \SimplePie\Misc::get_build();

            return $data;
        });

        $simplepie = new SimplePie();
        // Set FileMock to enforce that we never make an external http request
        $simplepie->get_registry()->register(File::class, FileConstructorThrowsExceptionMock::class);
        // Setup cache
        $simplepie->set_cache($cache);
        $simplepie->set_feed_url('https://example.com/feed.xml');

        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }


    /**
     * @test Regression for https://github.com/simplepie/simplepie/pull/445
     *
     * There can be no content other than BOM before XML declaration or it will fail to parse.
     * This can occur in badly written PHP scripts so we have to trim it.
     */
    public function testWhitespaceBeforeXmlDeclaration(): void
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed-with-whitespace-before-xml-declaration.xml';

        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_feed_url($filepath);

        $this->assertTrue($simplepie->init());
    }

    /**
     * @return iterable<array{path: string, feedTitle: string, titles: list<string>}>
     */
    public static function microformatFeedProvider(): iterable
    {
        yield [
            'path' => dirname(__FILE__, 2) . '/data/microformats/h-feed-simple.html',
            'feedTitle' => 'Test',
            'titles' => [
                'One',
                'Two',
                'Three',
                'Four',
            ],
        ];

        yield [
            'path' => dirname(__FILE__, 2) . '/data/microformats/h-feed-with-comments.html',
            'feedTitle' => 'Test',
            'titles' => [
                'One',
                'Two',
                'Three',
                'Four',
            ],
        ];
    }

    /**
     * @dataProvider microformatFeedProvider
     *
     * @param list<string> $titles
     */
    public function testMicroformatItems(string $path, string $feedTitle, array $titles): void
    {
        if (!function_exists('Mf2\parse')) {
            $this->markTestSkipped('Test requires Mf2 library.');
        }

        $feed = new SimplePie();
        $feed->set_raw_data(file_get_contents($path));
        $feed->enable_cache(false);

        $this->assertTrue($feed->init(), 'Failed fetching feed: ' . $feed->error());

        $this->assertSame($feedTitle, $feed->get_title());
        $items = $feed->get_items();
        $this->assertSame(count($titles), count($items), 'Number of items does not match');
        foreach (array_map(null, $titles, $items) as $i => [$expectedTitle, $item]) {
            $this->assertSame($expectedTitle, $item->get_title(), "Title of item #$i does not match");
        }
    }

    /**
     * @return iterable<array{data: string, hubUrl: ?string, selfUrl: ?string, headers?: list<string>, bogoUrl?: ?string}>
     */
    public static function microformatHubFeedProvider(): iterable
    {
        yield 'neither' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => null,
            'selfUrl' => null,
        ];

        yield 'hub only' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
        <link rel="hub" href="https://pubsubhubbub.appspot.com">
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => 'https://pubsubhubbub.appspot.com/',
            'selfUrl' => null,
        ];

        yield 'hub + self' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
        <link rel="hub" href="https://pubsubhubbub.appspot.com">
        <link rel="self" href="https://example.com">
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => 'https://pubsubhubbub.appspot.com/',
            'selfUrl' => 'https://example.com/',
        ];

        yield 'hub + self in `a` element (insecure and unsupported)' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <a rel="hub" href="https://pubsubhubbub.appspot.com" />
        <a rel="self" href="https://example.com" />
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => null,
            'selfUrl' => null,
        ];

        yield 'hub + self inside `body (insecure and unsupported)`' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <link rel="hub" href="https://pubsubhubbub.appspot.com">
        <link rel="self" href="https://example.com">
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => null,
            'selfUrl' => null,
        ];

        yield 'self only' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
        <link rel="self" href="https://example.com">
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => null,
            'selfUrl' => 'https://example.com/',
        ];

        yield 'hub + self + bogo in header' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
        <link rel="hub" href="https://pubsubhubbub.appspot.com">
        <link rel="self" href="https://example.com">
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => 'https://pubsubhubbub.appspot.com/',
            'selfUrl' => 'https://example.com/',
            'headers' => [
                'Link: <https://bogo.test/>; rel=bogo',
            ],
            'bogoUrl' => 'https://bogo.test/',
        ];

        yield 'hub + self + self in header' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
        <link rel="hub" href="https://pubsubhubbub.appspot.com">
        <link rel="self" href="https://example.com">
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => 'https://pubsubhubbub.appspot.com/',
            'selfUrl' => 'https://example.org/',
            'headers' => [
                'Link: <https://example.org/>; rel=self',
            ],
        ];

        yield 'hub in header + self' => [
            'data' => <<<HTML
<html>
    <head>
        <title>Test</title>
        <link rel="hub" href="https://pubsubhubbub.appspot.com">
        <link rel="self" href="https://example.com">
    </head>
    <body>
        <div class="h-feed">
        </div>
    </body>
</html>
HTML
            ,
            'hubUrl' => 'https://switchboard.p3k.io/',
            'selfUrl' => 'https://example.com/',
            'headers' => [
                'Link: <https://switchboard.p3k.io/>; rel=hub',
            ],
        ];
    }

    /**
     * @dataProvider microformatHubFeedProvider
     *
     * @param list<string> $headers
     */
    public function testMicroformatLinkHub(string $data, ?string $hubUrl, ?string $selfUrl, array $headers = [], ?string $bogoUrl = null): void
    {
        if (!function_exists('Mf2\parse')) {
            $this->markTestSkipped('Test requires Mf2 library.');
        }

        $server = new MockWebServer();
        $server->start();

        $url = $server->setResponseOfPath(
            '/index.html',
            new MockWebServerResponse($data, $headers, 200)
        );

        $feed = new SimplePie();
        $feed->set_feed_url($url);
        $feed->enable_cache(false);

        $this->assertTrue($feed->init(), 'Failed fetching feed: ' . $feed->error());

        $server->stop();

        $this->assertSame($hubUrl, $feed->get_link(0, 'hub'), 'Link rel=hub does not match');
        $this->assertSame($selfUrl, $feed->get_link(0, 'self'), 'Link rel=self does not match');
        $this->assertLessThanOrEqual(1, count($feed->get_links('self') ?? []), 'Link rel=self should not be promoted from HTML when it is already present in headers');
        $this->assertSame($bogoUrl, $feed->get_link(0, 'bogo'), 'Link rel=bogo does not match');
    }
}

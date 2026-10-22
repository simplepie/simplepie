<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use SimplePie\Exception as SimplePieException;
use SimplePie\Locator;
use SimplePie\Misc;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\LocatorFindThrowsExceptionMock;
use SimplePie\Tests\Fixtures\MiscChangeEncodingFailsMock;

class ErrorHandlingTest extends TestCase
{
    private const FEED_URL = 'https://example.com/feed';

    /**
     * @return iterable<string, array{callable(TestCase): SimplePie, non-empty-string, bool}>
     */
    public static function errorProvider(): iterable
    {
        yield 'empty body' => [
            function (TestCase $test): SimplePie {
                return self::createFeedWithRawData('');
            },
            'A feed could not be found at ``. Empty body.',
            false,
        ];

        yield 'not a feed' => [
            function (TestCase $test): SimplePie {
                return self::createFeedWithRawData('<?xml version="1.0"?><html></html>');
            },
            'A feed could not be found at ``. This does not appear to be a valid RSS or Atom feed.',
            false,
        ];

        yield 'invalid XML' => [
            function (TestCase $test): SimplePie {
                return self::createFeedWithRawData('<rss version="2.0"><channel><title>Feed</channel></rss>');
            },
            ' is invalid XML, likely due to invalid characters. XML error: Mismatched tag',
            false,
        ];

        yield 'encoding conversion fails' => [
            function (TestCase $test): SimplePie {
                $feed = self::createFeedWithRawData('<rss version="2.0"><channel></channel></rss>');
                $feed->get_registry()->register(Misc::class, MiscChangeEncodingFailsMock::class);

                return $feed;
            },
            'The data could not be converted to UTF-8.',
            false,
        ];

        yield 'request fails' => [
            function (TestCase $test): SimplePie {
                $client = $test->createMock(ClientInterface::class);
                $client->method('sendRequest')->willThrowException(self::createClientException('Connection refused'));

                return self::createFeedWithHttpClient($test, $client);
            },
            'Connection refused',
            false,
        ];

        yield 'unsupported status code' => [
            function (TestCase $test): SimplePie {
                return self::createFeedWithHttpClient($test, self::createClientReturning($test, 404, 'text/html', 'Not found'));
            },
            'Retrieved unsupported status code "404"',
            false,
        ];

        yield 'no feed found on page' => [
            function (TestCase $test): SimplePie {
                return self::createFeedWithHttpClient($test, self::createClientReturning($test, 200, 'text/html', '<html><body>Hello</body></html>'));
            },
            'A feed could not be found at `' . self::FEED_URL . '`; the status code is `200` and content-type is `text/html`',
            false,
        ];

        yield 'locator throws' => [
            function (TestCase $test): SimplePie {
                $feed = self::createFeedWithHttpClient($test, self::createClientReturning($test, 200, 'text/html', '<html><body>Hello</body></html>'));
                $feed->get_registry()->register(Locator::class, LocatorFindThrowsExceptionMock::class);

                return $feed;
            },
            'DOMDocument not found, unable to use locator',
            false,
        ];

        yield 'conditional request fails with stale cache' => [
            function (TestCase $test): SimplePie {
                $client = $test->createMock(ClientInterface::class);
                $client->method('sendRequest')->willThrowException(self::createClientException('Connection timed out'));

                $cache = $test->createMock(CacheInterface::class);
                $cache->method('get')->willReturn([
                    'child' => [],
                    'headers' => ['etag' => '"abc"'],
                    'build' => Misc::get_build(),
                    'cache_expiration_time' => 0,
                ]);
                $cache->method('set')->willReturn(true);

                $feed = self::createFeedWithHttpClient($test, $client);
                $feed->set_cache($cache);
                $feed->enable_cache(true);

                return $feed;
            },
            'Connection timed out',
            true,
        ];
    }

    /**
     * @dataProvider errorProvider
     * @param callable(TestCase): SimplePie $createFeed
     * @param non-empty-string $expectedMessage
     */
    public function testErrorWithExceptionsDisabled(callable $createFeed, string $expectedMessage, bool $expectedResult): void
    {
        $feed = $createFeed($this);

        self::assertSame($expectedResult, $feed->init());
        $error = $feed->error();
        self::assertIsString($error);
        self::assertStringStartsWith($expectedMessage, $error);
    }

    /**
     * @dataProvider errorProvider
     * @param callable(TestCase): SimplePie $createFeed
     * @param non-empty-string $expectedMessage
     */
    public function testErrorWithExceptionsEnabled(callable $createFeed, string $expectedMessage, bool $expectedResult): void
    {
        $feed = $createFeed($this);
        $feed->enable_exceptions();

        $this->expectException(SimplePieException::class);
        $this->expectExceptionMessage($expectedMessage);

        $feed->init();
    }

    public function testMultifeedCollectsErrorsWithExceptionsEnabled(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client->method('sendRequest')->willThrowException(self::createClientException('Connection refused'));

        $feed = self::createFeedWithHttpClient($this, $client);
        @$feed->set_feed_url(['https://example.com/a', 'https://example.com/b']);
        $feed->enable_exceptions();

        self::assertFalse($feed->init());
        self::assertSame(['Connection refused', 'Connection refused'], $feed->error());
    }

    private static function createFeedWithRawData(string $data): SimplePie
    {
        $feed = new SimplePie();
        $feed->enable_cache(false);
        $feed->set_raw_data($data);

        return $feed;
    }

    private static function createFeedWithHttpClient(TestCase $test, ClientInterface $client): SimplePie
    {
        $request = $test->createMock(RequestInterface::class);
        $request->method('withHeader')->willReturn($request);

        $requestFactory = $test->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturn($request);

        $feed = new SimplePie();
        $feed->enable_cache(false);
        $feed->set_http_client($client, $requestFactory, $test->createMock(UriFactoryInterface::class));
        $feed->set_feed_url(self::FEED_URL);

        return $feed;
    }

    private static function createClientReturning(TestCase $test, int $statusCode, string $contentType, string $body): ClientInterface
    {
        $stream = $test->createMock(StreamInterface::class);
        $stream->method('__toString')->willReturn($body);

        $response = $test->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($stream);
        $response->method('getStatusCode')->willReturn($statusCode);
        $response->method('hasHeader')->willReturnMap([
            ['content-encoding', false],
            ['content-type', true],
        ]);
        $response->method('getHeaderLine')->willReturnMap([
            ['content-encoding', ''],
            ['content-type', $contentType],
        ]);
        $response->method('getHeaders')->willReturn([
            'content-type' => [$contentType],
        ]);

        $client = $test->createMock(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);

        return $client;
    }

    private static function createClientException(string $message): ClientExceptionInterface
    {
        return new class ($message) extends Exception implements ClientExceptionInterface {
        };
    }
}

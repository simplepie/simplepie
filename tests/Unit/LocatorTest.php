<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use DOMDocument;
use DOMXPath;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use SimplePie\File;
use SimplePie\Locator;
use SimplePie\Registry;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\FileMock;

class LocatorTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Locator'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Locator'));
    }

    /**
     * @return array<array{string}>
     */
    public static function feedmimetypes(): array
    {
        return [
            ['application/rss+xml'],
            ['application/rdf+xml'],
            ['text/rdf'],
            ['application/atom+xml'],
            ['text/xml'],
            ['application/xml'],
        ];
    }
    /**
     * @dataProvider feedmimetypes
     */
    public function testAutodiscoverOnFeed(string $mime): void
    {
        $data = new FileMock('http://example.com/feed.xml');
        $data->headers['content-type'] = $mime;

        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);
        self::assertSame($data, $feed);
    }

    public function testInvalidMIMEType(): void
    {
        $data = new FileMock('http://example.com/feed.xml');
        $data->headers['content-type'] = 'application/pdf';

        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);
        self::assertNull($feed);
    }

    public function testDirectNoDOM(): void
    {
        $data = new FileMock('http://example.com/feed.xml');

        $registry = new Registry();
        $locator = new Locator($data, 0, null, -1);
        $locator->dom = null;
        $locator->set_registry($registry);

        self::assertTrue($locator->is_feed($data));
        self::assertSame($data, $locator->find(SimplePie::LOCATOR_ALL, $found));
    }

    public function testFailDiscoveryNoDOM(): void
    {
        $this->expectException(\SimplePie\Exception::class);

        $data = new FileMock('http://example.com/feed.xml');
        $data->headers['content-type'] = 'text/html';
        $data->body = '<!DOCTYPE html><html><body>Hi!</body></html>';

        $registry = new Registry();
        $locator = new Locator($data, 0, null, -1);
        $locator->dom = null;
        $locator->set_registry($registry);

        self::assertFalse($locator->is_feed($data));
        self::assertFalse($locator->find(SimplePie::LOCATOR_ALL, $found));
    }

    /**
     * Tests from Firefox
     *
     * Tests are used under the LGPL license, see file for license
     * information
     *
     * @return iterable<array{File}>
     */
    public static function firefoxTestDataProvider(): iterable
    {
        $data = new File(dirname(__DIR__) . '/data/fftests.html');
        $data->headers = ['content-type' => 'text/html'];
        $data->method = SimplePie::FILE_SOURCE_REMOTE;
        $data->url = 'http://example.com/';

        yield [$data];
    }

    /**
     * @dataProvider firefoxTestDataProvider
     */
    public function test_from_file(File $data): void
    {
        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);

        $expected = [];
        $document = new DOMDocument();
        $document->loadHTML((string) $data->body);
        $xpath = new DOMXPath($document);

        /** @var \DOMNodeList<\DOMElement> $queryResult */
        $queryResult = $xpath->query('//link');

        foreach ($queryResult as $element) {
            /** @var \DOMElement $element */
            $expected[] = 'http://example.com' . $element->getAttribute('href');
        }
        //$expected = SimplePie_Misc::get_element('link', $data->body);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);
        self::assertFalse($locator->is_feed($data), 'HTML document not be a feed itself');
        self::assertInstanceOf(FileMock::class, $feed);
        $success = array_filter($expected, [get_class($this), 'filter_success']);

        $found = is_array($all) ? array_map([get_class($this), 'map_url_file'], $all) : [];
        self::assertSame($success, $found);
    }

    protected function filter_success(string $url): bool
    {
        return (stripos($url, 'bogus') === false);
    }

    protected function map_url_file(File $file): string
    {
        return $file->url;
    }

    /**
     * @test that autodiscovery never fetches a local file candidate.
     *
     * The page carries a file:// candidate pointing at a real, readable feed that would win
     * autodiscovery if it were fetched. It must be filtered out, so only the http candidate
     * is requested and discovered.
     */
    public function testAutodiscoverySkipsNonHttpCandidates(): void
    {
        $localFeedFile = realpath(dirname(__FILE__) . '/../data/feed_rss-2.0.xml');
        \assert($localFeedFile !== false); // For PHPStan
        $localFeedUri = 'file://' . $localFeedFile;

        $data = new FileMock('http://example.com/');
        $data->headers['content-type'] = 'text/html';
        $data->body = '<!DOCTYPE html><html><head>'
            . '<link rel="alternate" type="application/rss+xml" href="' . $localFeedUri . '" />'
            . '<link rel="alternate" type="application/rss+xml" href="/feed" />'
            . '</head><body></body></html>';

        $requestedUris = [];
        $request = $this->createMock(RequestInterface::class);
        $request->method('withHeader')->willReturn($request);
        $request->method('withUri')->willReturn($request);

        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturnCallback(
            function (string $method, $uri) use (&$requestedUris, $request): RequestInterface {
                \assert($uri instanceof UriInterface); // For PHPStan
                $requestedUris[] = (string) $uri;

                return $request;
            }
        );

        $uriFactory = $this->createMock(UriFactoryInterface::class);
        $uriFactory->method('createUri')->willReturnCallback(
            function (string $requestedUrl): UriInterface {
                $uri = $this->createMock(UriInterface::class);
                $uri->method('__toString')->willReturn($requestedUrl);

                return $uri;
            }
        );

        $body = $this->createMock(StreamInterface::class);
        $body->method('__toString')->willReturn('<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />');

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($body);
        $response->method('getStatusCode')->willReturn(200);
        $response->method('hasHeader')->willReturnMap([
            ['content-encoding', false],
            ['content-type', true],
        ]);
        $response->method('getHeaderLine')->willReturnMap([
            ['content-encoding', ''],
            ['content-type', 'application/rss+xml'],
        ]);
        $response->method('getHeaders')->willReturn([
            'content-type' => ['application/rss+xml'],
        ]);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('sendRequest')->willReturn($response);

        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);
        $locator->set_http_client($httpClient, $requestFactory, $uriFactory);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);

        self::assertNotNull($feed);
        self::assertSame('http://example.com/feed', $feed->get_final_requested_uri());
        self::assertNotContains($localFeedUri, $requestedUris);
        self::assertContains('http://example.com/feed', $requestedUris);
    }
}

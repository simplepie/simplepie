<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriFactoryInterface;
use SimplePie\HTTP\Client;
use SimplePie\HTTP\ClientException;
use SimplePie\HTTP\NotAllowedException;
use SimplePie\HTTP\Psr18Client;
use SimplePie\HTTP\Response;
use SimplePie\HTTP\UrlPolicy;

class Psr18ClientTest extends TestCase
{
    public function testRequestReturnsResponse(): void
    {
        $client = new Psr18Client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );

        self::assertInstanceOf(Response::class, $client->request(Client::METHOD_GET, 'https://example.com/feed.xml'));
    }

    public function testRequestReturnsResponseWithStatusCode429(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(429);

        $psr18 = $this->createStub(ClientInterface::class);
        $psr18->method('sendRequest')->willReturn($response);

        $client = new Psr18Client(
            $psr18,
            $this->createStub(RequestFactoryInterface::class),
            $this->createStub(UriFactoryInterface::class)
        );

        // Make sure no ClientException is thrown on status code 429
        self::assertSame(
            429,
            $client->request(Client::METHOD_GET, 'https://example.com/429-error')->get_status_code()
        );
    }

    public function testRequestWithRedirectReturnsResponseWithCorrectUrls(): void
    {
        $request = $this->createMock(RequestInterface::class);
        $request->method('withUri')->willReturn($request);

        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturn($request);

        $response1 = $this->createMock(ResponseInterface::class);
        $response1->method('getStatusCode')->willReturn(302);
        $response1->method('hasHeader')->with('Location')->willReturn(true);
        $response1->method('getHeaderLine')->with('Location')->willReturn('https://example.com/feed.xml');

        $response2 = $this->createMock(ResponseInterface::class);
        $response2->method('getStatusCode')->willReturn(200);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('sendRequest')->willReturnOnConsecutiveCalls($response1, $response2);

        $client = new Psr18Client(
            $httpClient,
            $requestFactory,
            $this->createMock(UriFactoryInterface::class)
        );

        $response = $client->request(Client::METHOD_GET, 'https://example.com/redirect');

        self::assertSame('https://example.com/redirect', $response->get_permanent_uri());
        self::assertSame('https://example.com/feed.xml', $response->get_final_requested_uri());
    }

    public function testRequestRejectsLocalFilePathByDefault(): void
    {
        $client = new Psr18Client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );

        $this->expectException(NotAllowedException::class);
        $this->expectExceptionMessage('Refusing to fetch');

        $client->request(Client::METHOD_GET, __FILE__);
    }

    public function testRequestRejectsFileUriByDefault(): void
    {
        $client = new Psr18Client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );

        $this->expectException(NotAllowedException::class);
        $this->expectExceptionMessage('Refusing to fetch');

        $client->request(Client::METHOD_GET, 'file:///etc/passwd');
    }

    public function testRequestReturnsContentOfLocalFileAfterOptIn(): void
    {
        $client = new Psr18Client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );
        $policy = new UrlPolicy();
        $policy->set_allow_local_files(true);
        $client->set_url_policy($policy);

        $response = $client->request(Client::METHOD_GET, __FILE__);

        self::assertSame(200, $response->get_status_code());
        self::assertSame(__FILE__, $response->get_permanent_uri());
        self::assertSame(__FILE__, $response->get_final_requested_uri());
        self::assertSame(file_get_contents(__FILE__), $response->get_body_content());
    }

    public function testRequestDoesNotForwardNonHttpRedirectLocation(): void
    {
        $request = $this->createMock(RequestInterface::class);
        $request->method('withUri')->willReturn($request);

        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturn($request);

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(302);
        $response->method('hasHeader')->with('Location')->willReturn(true);
        $response->method('getHeaderLine')->with('Location')->willReturn('file:///etc/passwd');

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects($this->once())->method('sendRequest')->willReturn($response);

        $client = new Psr18Client(
            $httpClient,
            $requestFactory,
            $this->createMock(UriFactoryInterface::class)
        );

        // The local-file redirect hop must never be forwarded to the injected client.
        $this->expectException(NotAllowedException::class);

        $client->request(Client::METHOD_GET, 'https://example.com/redirect');
    }

    private function createClientWithRedirectTo(int $statusCode, string $location, ?UrlPolicy $policy = null): Psr18Client
    {
        $request = $this->createMock(RequestInterface::class);
        $request->method('withUri')->willReturn($request);

        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturn($request);

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn($statusCode);
        $response->method('hasHeader')->with('Location')->willReturn(true);
        $response->method('getHeaderLine')->with('Location')->willReturn($location);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects($this->once())->method('sendRequest')->willReturn($response);

        $client = new Psr18Client(
            $httpClient,
            $requestFactory,
            $this->createMock(UriFactoryInterface::class)
        );
        if ($policy !== null) {
            $client->set_url_policy($policy);
        }

        return $client;
    }

    public function testRefusedPermanentRedirectDoesNotChangeResponseUris(): void
    {
        $client = $this->createClientWithRedirectTo(301, 'file:///etc/passwd');

        // The refused redirect must never be forwarded to the injected client.
        $this->expectException(NotAllowedException::class);

        $client->request(Client::METHOD_GET, 'https://example.com/redirect');
    }

    public function testNonHttpRedirectIsNotForwardedEvenWithLocalFilesAllowed(): void
    {
        $policy = new UrlPolicy();
        $policy->set_allow_local_files(true);
        $client = $this->createClientWithRedirectTo(302, 'file:///etc/passwd', $policy);

        // Even with local files allowed, a content-derived redirect is refused.
        $this->expectException(NotAllowedException::class);

        $client->request(Client::METHOD_GET, 'https://example.com/redirect');
    }

    public function testRelativeRedirectLocationIsResolvedAgainstCurrentUrl(): void
    {
        $request = $this->createMock(RequestInterface::class);
        $request->method('withUri')->willReturn($request);

        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('createRequest')->willReturn($request);

        $response1 = $this->createMock(ResponseInterface::class);
        $response1->method('getStatusCode')->willReturn(302);
        $response1->method('hasHeader')->with('Location')->willReturn(true);
        $response1->method('getHeaderLine')->with('Location')->willReturn('/feed.xml');

        $response2 = $this->createMock(ResponseInterface::class);
        $response2->method('getStatusCode')->willReturn(200);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('sendRequest')->willReturnOnConsecutiveCalls($response1, $response2);

        $client = new Psr18Client(
            $httpClient,
            $requestFactory,
            $this->createMock(UriFactoryInterface::class)
        );

        // A relative Location is resolved against the current URL before being followed.
        $response = $client->request(Client::METHOD_GET, 'https://example.com/redirect');

        self::assertSame(200, $response->get_status_code());
        self::assertSame('https://example.com/redirect', $response->get_permanent_uri());
        self::assertSame('https://example.com/feed.xml', $response->get_final_requested_uri());
    }
}

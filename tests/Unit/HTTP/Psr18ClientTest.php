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
use SimplePie\HTTP\Psr18Client;
use SimplePie\HTTP\Response;

class Psr18ClientTest extends TestCase
{
    public function testRequestReturnsResponse(): void
    {
        $client = new Psr18Client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        );

        $this->assertInstanceOf(Response::class, $client->request(Client::METHOD_GET, 'https://example.com/feed.xml'));
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
        $this->assertSame(
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

        $this->assertSame('https://example.com/redirect', $response->get_permanent_uri());
        $this->assertSame('https://example.com/feed.xml', $response->get_final_requested_uri());
    }
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\HTTP;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use SimplePie\Exception\HttpException;

/**
 * HTTP Client based on PSR-18 and PSR-17 implementations
 *
 * @internal
 */
final class Psr18Client implements Client
{
    /** @var ClientInterface */
    private $httpClient;

    /** @var RequestFactoryInterface */
    private $requestFactory;

    /** @var UriFactoryInterface */
    private $uriFactory;

    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $requestFactory, UriFactoryInterface $uriFactory)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
    }

    /**
     * send a request and return the response
     *
     * @param Client::METHOD_* $method
     * @param string $url
     * @param string[] $headers
     *
     * @throws HttpException if anything goes wrong requesting the data
     */
    public function request(string $method, string $url, array $headers = []): Response
    {
        $uri = $this->uriFactory->createUri($url);

        $request = $this->requestFactory->createRequest($method, $uri);

        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $th) {
            throw new HttpException($th->getMessage(), $th->getCode(), $th);
        }

        return new Psr7Response($response, $url, $url);
    }
}

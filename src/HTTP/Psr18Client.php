<?php

declare(strict_types=1);
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\HTTP;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use SimplePie\Exception\HttpException;
use Throwable;

/**
 * HTTP Client based on PSR-18 and PSR-17 implementations
 *
 * @package SimplePie
 * @subpackage HTTP
 * @internal
 */
final class Psr18Client implements Client
{
    private $httpClient;

    private $requestFactory;

    private $uriFactory;

    private $allowedRedirects = 5;

    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $requestFactory, UriFactoryInterface $uriFactory)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
    }

    /**
     * send a request and return the response
     *
     * @param Client::METHOD_GET|string $method
     * @param string $url
     * @param string[] $headers
     *
     * @throws HttpException if anything goes wrong requesting the data
     */
    public function request(string $method, string $url, array $headers = []): Response
    {
        if ($method !== self::METHOD_GET) {
            throw new InvalidArgumentException(sprintf(
                '%s(): Argument #1 ($method) only supports method "%s".',
                __METHOD__,
                self::METHOD_GET
            ), 1);
        }

        if (preg_match('/^http(s)?:\/\//i', $url)) {
            return $this->requestUrl($method, $url, $headers);
        }

        return $this->requestLocalFile($url);
    }

    private function requestUrl(string $method, string $url, array $headers): Response
    {
        $permanentUrl = $url;
        $requestedUrl = $url;
        $remainingRedirects = $this->allowedRedirects;

        $request = $this->requestFactory->createRequest(
            $method,
            $this->uriFactory->createUri($requestedUrl)
        );

        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        do {
            $followRedirect = false;

            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (ClientExceptionInterface $th) {
                throw new HttpException($th->getMessage(), $th->getCode(), $th);
            }

            $statusCode = $response->getStatusCode();

            // If we have a redirect
            if (in_array($statusCode, [300, 301, 302, 303, 307]) && $response->hasHeader('Location')) {
                // Prevent infinity redirect loops
                if ($remainingRedirects <= 0) {
                    break;
                }

                $remainingRedirects--;
                $followRedirect = true;

                $requestedUrl = $response->getHeaderLine('Location');

                if ($statusCode === 301) {
                    $permanentUrl = $requestedUrl;
                }

                $request = $request->withUri($this->uriFactory->createUri($requestedUrl));
            }
        } while ($followRedirect);

        return new Psr7Response($response, $permanentUrl, $requestedUrl);
    }

    private function requestLocalFile(string $path): Response
    {
        try {
            $raw = file_get_contents($path);
        } catch (Throwable $th) {
            throw new HttpException($th->getMessage(), $th->getCode(), $th);
        }

        if ($raw === false) {
            throw new HttpException('file_get_contents() could not read the file', 1);
        }

        return new RawTextResponse($raw, $path);
    }
}

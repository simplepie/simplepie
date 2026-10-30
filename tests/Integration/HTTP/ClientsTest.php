<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration\HTTP;

use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Response as MockWebServerResponse;
use donatj\MockWebServer\Responses\NotFoundResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use SimplePie\HTTP\Client;
use SimplePie\HTTP\ClientException;
use SimplePie\HTTP\FileClient;
use SimplePie\HTTP\Psr18Client;
use SimplePie\HTTP\Response;
use SimplePie\Registry;

class ClientsTest extends TestCase
{
    public function testFileClientGetContentOfLocalFile(): void
    {
        $this->runTestsWithClientGetContentOfLocalFile(
            new FileClient(new Registry())
        );
    }

    public function testPrs18ClientGetContentOfLocalFile(): void
    {
        $this->runTestsWithClientGetContentOfLocalFile(
            new Psr18Client(
                $this->createMock(ClientInterface::class),
                $this->createMock(RequestFactoryInterface::class),
                $this->createMock(UriFactoryInterface::class)
            )
        );
    }

    private function runTestsWithClientGetContentOfLocalFile(Client $client): void
    {
        $filepath = dirname(__FILE__, 3) . '/data/feed_rss-2.0.xml';

        $response = $client->request(Client::METHOD_GET, $filepath);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame($filepath, $response->get_permanent_uri());
        self::assertSame($filepath, $response->get_final_requested_uri());
        self::assertSame(200, $response->get_status_code());
        self::assertSame([], $response->get_headers());
        self::assertStringStartsWith('<rss version="2.0">', $response->get_body_content());
    }

    public function testFileClientThrowsClientException(): void
    {
        $this->runTestWithClientThrowsClientException(
            new FileClient(new Registry())
        );
    }

    public function testPsr18ClientThrowsClientException(): void
    {
        $this->runTestWithClientThrowsClientException(
            new Psr18Client(
                $this->createMock(ClientInterface::class),
                $this->createMock(RequestFactoryInterface::class),
                $this->createMock(UriFactoryInterface::class)
            )
        );
    }

    private function runTestWithClientThrowsClientException(Client $client): void
    {
        $filepath = dirname(__FILE__, 3) . '/data/this-file-does-not-exist';

        $this->expectException(ClientException::class);
        $this->expectExceptionCode(0);

        $this->expectExceptionMessage(sprintf('file "%s" is not readable', $filepath));

        $client->request(Client::METHOD_GET, $filepath);
    }

    public function testFileClientReturnsResponseOn429StatusCode(): void
    {
        $client = new FileClient(new Registry());

        $server = new MockWebServer();
        $server->start();

        $url = $server->setResponseOfPath(
            '/status/429',
            new MockWebServerResponse('Too many redirects', [], 429)
        );

        $url = $server->getServerRoot() . '/status/429';

        $response = $client->request(Client::METHOD_GET, $url);

        $server->stop();

        self::assertSame(429, $response->get_status_code());
    }

    public function testFileClientReturnsResponseOn500StatusCode(): void
    {
        $client = new FileClient(new Registry());

        $server = new MockWebServer();
        $server->start();

        $url = $server->setResponseOfPath(
            '/status/500',
            new MockWebServerResponse('Internal Server Error', [], 500)
        );

        $response = $client->request(Client::METHOD_GET, $url);

        $server->stop();

        self::assertSame(500, $response->get_status_code());
    }

    public function testFileClientThrowsClientExceptionIfServerIsUnreachable(): void
    {
        $client = new FileClient(new Registry());

        $url = 'https://example.invalid:404/this-server-does-not-exist';

        $this->expectException(ClientException::class);
        $this->expectExceptionCode(0);

        $this->expectExceptionMessage('cURL error 6: Could not resolve host: example.invalid');

        $client->request(Client::METHOD_GET, $url);
    }

    /**
     * @return iterable<array{client: Client}>
     */
    public static function clientsProvider(): iterable
    {
        yield 'curl' => [
            'client' => new FileClient(new Registry(), [
                'redirects' => 10,
                'force_fsockopen' => false,
            ]),
        ];

        yield 'fsockopen' => [
            'client' => new FileClient(new Registry(), [
                'redirects' => 10,
                'force_fsockopen' => true,
            ]),
        ];
    }

    /**
     * Chain of redirects designed to test their handling.
     *
     * @dataProvider clientsProvider
     */
    public function testRedirectsChain(Client $client): void
    {
        $server = new MockWebServer();
        $server->start();

        $server->setDefaultResponse(new NotFoundResponse());
        $url = $server->setResponseOfPath(
            '/perm2',
            new MockWebServerResponse('', ['Location: /perm1'], 308)
        );
        $server->setResponseOfPath(
            '/perm1',
            new MockWebServerResponse('', ['Location: /perm0'], 301)
        );
        $server->setResponseOfPath(
            '/perm0',
            new MockWebServerResponse('', ['Location: /temp2'], 308)
        );
        $permanentLocation = $server->setResponseOfPath(
            '/temp2',
            new MockWebServerResponse('', ['Location: /temp1'], 307)
        );
        $server->setResponseOfPath(
            '/temp1',
            new MockWebServerResponse('', ['Location: /temp0'], 302)
        );
        $server->setResponseOfPath(
            '/temp0',
            new MockWebServerResponse('', ['Location: /permA'], 307)
        );
        $server->setResponseOfPath(
            '/permA',
            new MockWebServerResponse('', ['Location: /permB'], 301)
        );
        $server->setResponseOfPath(
            '/permB',
            new MockWebServerResponse('', ['Location: /permC'], 308)
        );
        $server->setResponseOfPath(
            '/permC',
            new MockWebServerResponse('', ['Location: /final'], 308)
        );
        $finalLocation = $server->setResponseOfPath(
            '/final',
            new MockWebServerResponse('OK', [], 200)
        );

        $response = $client->request(Client::METHOD_GET, $url);

        $server->stop();

        self::assertSame(200, $response->get_status_code());
        self::assertSame('OK', $response->get_body_content());
        self::assertSame($permanentLocation, $response->get_permanent_uri());
        self::assertSame($finalLocation, $response->get_final_requested_uri());
    }

    /**
     * @return iterable<array{client: Client, kind: "remote"|"remote-gzip"|"local", endianness: "le"|"be"}>
     */
    public static function utf16Provider(): iterable
    {
        foreach (self::clientsProvider() as $clientName => $client) {
            foreach (['remote', 'remote-gzip', 'local'] as $kind) {
                foreach (['le', 'be'] as $endianness) {
                    yield "$clientName-$kind-$endianness" => array_merge($client, [
                        'kind' => $kind,
                        'endianness' => $endianness,
                    ]);
                }
            }
        }
    }

    /**
     * Regression test for File trimming zero bytes, which breaks UTF-16.
     *
     * With big-endian, `<` will be encoded as `003C`, which `trim` will mangle at the start of a file.
     * With little-endian, `>` will be encoded as `3E00`, which `trim` will mangle at the end of a file.
     *
     * @dataProvider utf16Provider
     *
     * @param "remote"|"remote-gzip"|"local" $kind
     * @param "le"|"be" $endianness
     */
    public function testUtf16(Client $client, string $kind, string $endianness): void
    {
        $url = dirname(__FILE__, 3) . "/data/feed-utf16$endianness.xml";
        if ('local' !== $kind) {
            $server = new MockWebServer();
            $server->start();

            $headers = [];
            $body = file_get_contents($url);
            \assert($body !== false); // For PHPStan

            if ('remote-gzip' === $kind) {
                $headers[] = 'Content-Encoding: gzip';
                $body = gzencode($body);
                \assert($body !== false); // For PHPStan
            }

            $response = new MockWebServerResponse($body, $headers, 200);
            $url = $server->setResponseOfPath('/', $response);
        }

        $response = $client->request(Client::METHOD_GET, $url);

        if ('local' !== $kind) {
            $server->stop();
        }

        $start = $endianness === 'be' ? "\x00<\x00r\x00s\x00s\x00 " : "<\x00r\x00s\x00s\x00 \x00";
        $end = $endianness === 'be' ? "\x00<\x00/\x00r\x00s\x00s\x00>\x00\n" : "<\x00/\x00r\x00s\x00s\x00>\x00\n\x00";

        self::assertSame(
            $start,
            substr($response->get_body_content(), 0, strlen($start)),
            'Body does not start as expected: ' . $response->get_body_content()
        );
        self::assertSame(
            $end,
            substr($response->get_body_content(), -strlen($end)),
            'Body does not end as expected: ' . $response->get_body_content()
        );
    }
}

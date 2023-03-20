<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration\HTTP;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use SimplePie\Exception\HttpException;
use SimplePie\HTTP\Client;
use SimplePie\HTTP\FileClient;
use SimplePie\HTTP\Psr18Client;
use SimplePie\HTTP\Response;
use SimplePie\Registry;

class ClientsTest extends TestCase
{
    public function provideHttpClientsForLocalFiles(): iterable
    {
        yield [new FileClient(new Registry())];

        yield [new Psr18Client(
            $this->createMock(ClientInterface::class),
            $this->createMock(RequestFactoryInterface::class),
            $this->createMock(UriFactoryInterface::class)
        )];
    }

    /**
     * @dataProvider provideHttpClientsForLocalFiles
     */
    public function testClientGetContentOfLocalFile(Client $client): void
    {
        $filepath = dirname(__FILE__, 3) . '/data/feed_rss-2.0.xml';

        $response = $client->request(Client::METHOD_GET, $filepath);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame($filepath, $response->get_permanent_uri());
        $this->assertSame($filepath, $response->get_requested_uri());
        $this->assertSame(200, $response->get_status_code());
        $this->assertSame([], $response->get_headers());
        $this->assertStringStartsWith('<rss version="2.0">', $response->get_body_content());
    }

    /**
     * @dataProvider provideHttpClientsForLocalFiles
     */
    public function testClientThrowsHttpException(Client $client): void
    {
        $filepath = dirname(__FILE__, 3) . '/data/this-file-does-not-exist';

        $this->expectException(HttpException::class);

        if (version_compare(PHP_VERSION, '8.0', '<')) {
            $this->expectExceptionMessage('file_get_contents('.$filepath.'): failed to open stream: No such file or directory');
        } else {
            $this->expectExceptionMessage('file_get_contents('.$filepath.'): Failed to open stream: No such file or directory');
        }

        $client->request(Client::METHOD_GET, $filepath);
    }
}

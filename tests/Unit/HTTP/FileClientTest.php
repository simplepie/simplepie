<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use SimplePie\File;
use SimplePie\HTTP\FileClient;
use SimplePie\Misc;
use SimplePie\Registry;

final class FileClientTest extends TestCase
{
    public function testFileClientProvidesDefaultOptionsAndHeaders()
    {
        $response = $this->createMock(File::class);

        $registry = $this->createMock(Registry::class);
        $registry->expects($this->once())->method('create')->with(
            File::class,
            [
                'http://example.com',
                10,
                5,
                [],
                Misc::get_default_useragent(),
                false,
                [],
            ]
        )->willReturn($response);

        $client = new FileClient($registry, []);

        $client->request(
            FileClient::METHOD_GET,
            'http://example.com'
        );
    }

    public function testFileClientProvidesCorrectOptionsAndHeaders()
    {
        $response = $this->createMock(File::class);

        $registry = $this->createMock(Registry::class);
        $registry->expects($this->once())->method('create')->with(
            File::class,
            [
                'http://example.com/feed.xml',
                30,
                10,
                ['Accept' => 'application/atom+xml'],
                'dummy-useragent',
                true,
                [45 => true],
            ]
        )->willReturn($response);

        $client = new FileClient($registry, [
            'timeout' => 30,
            'useragent' => 'dummy-useragent',
            'redirects' => 10,
            'force_fsockopen' => true,
            'curl_options' => [
                \CURLOPT_FAILONERROR => true,
            ],
        ]);

        $client->request(
            FileClient::METHOD_GET,
            'http://example.com/feed.xml',
            ['Accept' => 'application/atom+xml']
        );
    }
}

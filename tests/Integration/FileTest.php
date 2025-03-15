<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use Exception;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use SimplePie\Cache;
use SimplePie\Cache\Base;
use SimplePie\File;
use SimplePie\Misc;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\Cache\BaseCacheWithCallbacksMock;
use SimplePie\Tests\Fixtures\FileMock;
use SimplePie\Tests\Integration\Fixtures\HttpServer;

final class FileTest extends TestCase
{
    /**
     * @return iterable<array{bool}>
     */
    public function redirectsConfigProvider(): iterable
    {
        yield 'curl' => [
            'force_fsockopen' => false,
        ];

        yield 'fsockopen' => [
            'force_fsockopen' => true,
        ];
    }

    /**
     * @dataProvider redirectsConfigProvider
     */
    public function testRedirects(bool $force_fsockopen): void
    {
        $server = new HttpServer(__DIR__ . '/Fixtures/redirects.php');
        $server->start();

        $base = $server->getBaseUri();
        $file = new File(
            "{$base}/perm2",
            10, // timeout
            10, // redirects
            null, // headers
            null, // useragent
            $force_fsockopen
        );
        $server->terminate();

        $this->assertSame("{$base}/temp2", $file->permanent_url);
        $this->assertSame("{$base}/final", $file->url);
    }
}

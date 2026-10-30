<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SimplePie\File;
use SimplePie\Tests\Fixtures\FileWithRedirectMock;

class SubscribeUrlTest extends TestCase
{
    public function testDirectOverrideLegacy(): void
    {
        $feed = new SimplePie();
        $feed->get_registry()->register(File::class, FileWithRedirectMock::class);
        $feed->enable_cache(false);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();

        self::assertSame('https://example.com/feed/2019-10-07', $feed->subscribe_url());
        self::assertSame('https://example.com/feed/', $feed->subscribe_url(true));
    }
}

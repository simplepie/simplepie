<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration;

use PHPUnit\Framework\TestCase;
use SimplePie\File;
use SimplePie\SimplePie;

class SimplePieTest extends TestCase
{
    /**
     * @return iterable<array{SimplePie}>
     */
    public function provideSimplePieInstances(): iterable
    {
        $filepath = dirname(__FILE__, 2) . '/data/feed_rss-2.0_for_file_mock.xml';

        // Test, that requesting a local file via SimplePie->set_feed_url() works
        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $simplepie->set_feed_url($filepath);

        yield [$simplepie];

        // Test, that requesting a local file via SimplePie->set_file() works
        $simplepie = new SimplePie();
        $simplepie->enable_cache(false);
        $file = new File($filepath);
        $simplepie->set_file($file);

        yield [$simplepie];
    }

    /**
     * @dataProvider provideSimplePieInstances
     */
    public function testSimplePieInit(SimplePie $simplepie): void
    {
        $this->assertTrue($simplepie->init());
        $this->assertSame(100, $simplepie->get_item_quantity());
    }
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\SimplePie;
use SimplePie\Source;

class SourceTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Source'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Source'));
    }

    public function testRss20Source(): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data(
            <<<XML
<rss version="2.0">
	<channel>
		<item>
			<title>Example item</title>
			<source url="http://example.com/feed.xml">Example &amp; Co</source>
		</item>
	</channel>
</rss>
XML
        );
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        self::assertNotNull($item);
        $source = $item->get_source();

        self::assertInstanceOf(Source::class, $source);
        self::assertSame('Example &amp; Co', $source->get_title());
        self::assertSame('http://example.com/feed.xml', $source->get_link(0, 'self'));
        self::assertNull($source->get_link());
    }

    public function testItemWithoutSource(): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data(
            <<<XML
<rss version="2.0">
	<channel>
		<item>
			<title>Example item</title>
		</item>
	</channel>
</rss>
XML
        );
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        self::assertNotNull($item);
        self::assertNull($item->get_source());
    }
}

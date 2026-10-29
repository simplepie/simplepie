<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Chapter;
use SimplePie\SimplePie;

class ItemChaptersTest extends TestCase
{
    private function getFirstItem(string $xml): \SimplePie\Item
    {
        $feed = new SimplePie();
        $feed->set_raw_data($xml);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        self::assertNotNull($item);

        return $item;
    }

    public function testRssChapters(): void
    {
        $item = $this->getFirstItem(<<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:psc="http://podlove.org/simple-chapters">
<channel>
<title>Podcast</title>
<item>
<title>Episode</title>
<psc:chapters version="1.2">
<psc:chapter start="00:00:00.000" title="Intro"/>
<psc:chapter start="00:03:15.500" title="Main &amp; more" href="http://example.com/topic" image="http://example.com/chapter.png"/>
</psc:chapters>
</item>
</channel>
</rss>
XML);

        $chapters = $item->get_chapters();

        self::assertNotNull($chapters);
        self::assertCount(2, $chapters);
        self::assertContainsOnlyInstancesOf(Chapter::class, $chapters);
        self::assertSame('00:00:00.000', $chapters[0]->get_start());
        self::assertSame(0.0, $chapters[0]->get_start_seconds());
        self::assertSame('Intro', $chapters[0]->get_title());
        self::assertNull($chapters[0]->get_href());
        self::assertNull($chapters[0]->get_image());
        self::assertSame(195.5, $chapters[1]->get_start_seconds());
        self::assertSame('Main &amp; more', $chapters[1]->get_title());
        self::assertSame('http://example.com/topic', $chapters[1]->get_href());
        self::assertSame('http://example.com/chapter.png', $chapters[1]->get_image());
    }

    public function testAtomChapters(): void
    {
        $item = $this->getFirstItem(<<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:p="http://podlove.org/simple-chapters">
<title>Podcast</title>
<entry>
<title>Episode</title>
<p:chapters version="1.2">
<p:chapter start="12:34" title="Middle"/>
</p:chapters>
</entry>
</feed>
XML);

        $chapters = $item->get_chapters();

        self::assertNotNull($chapters);
        self::assertCount(1, $chapters);
        self::assertSame(754.0, $chapters[0]->get_start_seconds());
        self::assertSame('Middle', $chapters[0]->get_title());
    }

    public function testChapterWithoutStartIsSkipped(): void
    {
        $item = $this->getFirstItem(<<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:psc="http://podlove.org/simple-chapters">
<channel>
<title>Podcast</title>
<item>
<title>Episode</title>
<psc:chapters version="1.2">
<psc:chapter title="No start"/>
<psc:chapter start="00:00:10" title="Has start"/>
</psc:chapters>
</item>
</channel>
</rss>
XML);

        $chapters = $item->get_chapters();

        self::assertNotNull($chapters);
        self::assertCount(1, $chapters);
        self::assertSame('Has start', $chapters[0]->get_title());
    }

    public function testNoChapters(): void
    {
        $item = $this->getFirstItem(<<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title>Podcast</title>
<item>
<title>Episode</title>
</item>
</channel>
</rss>
XML);

        self::assertNull($item->get_chapters());
    }
}

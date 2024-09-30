<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Enclosure;
use SimplePie\Item;
use SimplePie\Restriction;
use SimplePie\SimplePie;

class RestrictionTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\Restriction'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_Restriction'));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getRelationshipDataProvider(): array
    {
        return [
            'iTunesRSS Channel Block Test RSS 2.0' => [
<<<EOT
<rss xmlns:itunes="http://www.itunes.com/DTDs/Podcast-1.0.dtd">
	<channel>
		<itunes:block>yes</itunes:block>
		<item>
			<enclosure url="http://test.com/test.mp3" />
		</item>
	</channel>
</rss>
EOT
                ,
                Restriction::RELATIONSHIP_DENY,
            ],
            'iTunesRSS Channel Block Default Test RSS 2.0' => [
<<<EOT
<rss xmlns:itunes="http://www.itunes.com/DTDs/Podcast-1.0.dtd">
	<channel>
		<item>
			<enclosure url="http://test.com/test.mp3" />
		</item>
	</channel>
</rss>
EOT
                ,
                Restriction::RELATIONSHIP_ALLOW,
            ],
            'iTunesRSS Channel Block Reverse Test RSS 2.0' => [
<<<EOT
<rss xmlns:itunes="http://www.itunes.com/DTDs/Podcast-1.0.dtd">
	<channel>
		<itunes:block>no</itunes:block>
		<item>
			<enclosure url="http://test.com/test.mp3" />
		</item>
	</channel>
</rss>
EOT
                ,
                Restriction::RELATIONSHIP_ALLOW,
            ],
        ];
    }

    /**
     * @dataProvider getRelationshipDataProvider
     */
    public function test_get_relationship(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        $this->assertInstanceOf(Item::class, $item);

        $enclosure = $item->get_enclosure();
        $this->assertInstanceOf(Enclosure::class, $enclosure);

        $restriction = $enclosure->get_restriction();
        $this->assertInstanceOf(Restriction::class, $restriction);

        $this->assertSame($expected, $restriction->get_relationship());
    }
}

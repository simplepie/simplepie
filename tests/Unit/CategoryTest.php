<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Category;
use SimplePie\Item;
use SimplePie\SimplePie;

class CategoryTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Category'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Category'));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getFeedCategoryLabelDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Subject' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:subject>Feed Category</dc:subject>
</feed>
XML
                ,
                'Feed Category',
            ],
            'Test Atom 0.3 DC 1.1 Subject' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:subject>Feed Category</dc:subject>
</feed>
XML
                ,
                'Feed Category',
            ],
            'Test Atom 1.0 DC 1.0 Subject' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:subject>Feed Category</dc:subject>
</feed>
XML
                ,
                'Feed Category',
            ],
            'Test Atom 1.0 DC 1.1 Subject' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:subject>Feed Category</dc:subject>
</feed>
XML
                ,
                'Feed Category',
            ],
            'Test Atom 1.0 Category Label' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<category label="Feed Category"/>
</feed>
XML
                ,
                'Feed Category',
            ],
            'Test Atom 1.0 Category Term' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<category term="Feed Category"/>
</feed>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.90 Atom 1.0 Category Label' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category label="Feed Category"/>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.90 Atom 1.0 Category Term' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category term="Feed Category"/>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.90 DC 1.0 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.90 DC 1.1 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Category Label' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category label="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Category Term' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category term="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Subject' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Subject' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Category Label' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category label="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Category Term' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category term="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Userland DC 1.0 Subject' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.91-Userland DC 1.1 Subject' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.92 Atom 1.0 Category Label' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category label="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.92 Atom 1.0 Category Term' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category term="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.92 DC 1.0 Subject' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 0.92 DC 1.1 Subject' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 1.0 Atom 1.0 Category Label' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category label="Feed Category"/>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 1.0 Atom 1.0 Category Term' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category term="Feed Category"/>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 1.0 DC 1.0 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 1.0 DC 1.1 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 2.0 Atom 1.0 Category Label' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category label="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 2.0 Atom 1.0 Category Term' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:category term="Feed Category"/>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 2.0 DC 1.0 Subject' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 2.0 DC 1.1 Subject' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:subject>Feed Category</dc:subject>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            'Test RSS 2.0 Category' => [
<<<XML
<rss version="2.0">
	<channel>
		<category>Feed Category</category>
	</channel>
</rss>
XML
                ,
                'Feed Category',
            ],
            // Test Bugs
            'Test Bug 21 Test 0' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<category term="Example category"/>
</feed>
XML
                ,
                'Example category',
            ],
        ];
    }

    /**
     * @dataProvider getFeedCategoryLabelDataProvider
     */
    public function test_get_label_from_feed_category(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $category = $feed->get_category();
        self::assertInstanceOf(Category::class, $category);

        self::assertSame($expected, $category->get_label());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getItemCategoryLabelDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Subject' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>
XML
                ,
                'Item Category',
            ],
            'Test Atom 0.3 DC 1.1 Subject' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>
XML
                ,
                'Item Category',
            ],
            'Test Atom 1.0 DC 1.0 Subject' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>
XML
                ,
                'Item Category',
            ],
            'Test Atom 1.0 DC 1.1 Subject' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:subject>Item Category</dc:subject>
	</entry>
</feed>
XML
                ,
                'Item Category',
            ],
            'Test Atom 1.0 Category Label' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<category label="Item Category"/>
	</entry>
</feed>
XML
                ,
                'Item Category',
            ],
            'Test Atom 1.0 Category Term' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<category term="Item Category"/>
	</entry>
</feed>
XML
                ,
                'Item Category',
            ],
            'Test Bug 21 Test 0' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<category term="Example category"/>
	</entry>
</feed>
XML
                ,
                'Example category',
            ],
            'Test RSS 0.90 Atom 1.0 Category Label' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category label="Item Category"/>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.90 Atom 1.0 Category Term' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category term="Item Category"/>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.90 DC 1.0 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.90 DC 1.1 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Category Label' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Category Term' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Subject' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Subject' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Category Label' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Category Term' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Userland DC 1.0 Subject' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.91-Userland DC 1.1 Subject' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.92 Atom 1.0 Category Label' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.92 Atom 1.0 Category Term' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.92 Category' => [
<<<XML
<rss version="0.92">
	<channel>
		<item>
			<category>Item Category</category>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.92 DC 1.0 Subject' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 0.92 DC 1.1 Subject' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 1.0 Atom 1.0 Category Label' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category label="Item Category"/>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 1.0 Atom 1.0 Category Term' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:category term="Item Category"/>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 1.0 DC 1.0 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 1.0 DC 1.1 Subject' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:subject>Item Category</dc:subject>
	</item>
</rdf:RDF>
XML
                ,
                'Item Category',
            ],
            'Test RSS 2.0 Atom 1.0 Category Label' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category label="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 2.0 Atom 1.0 Category Term' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:category term="Item Category"/>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 2.0 Category' => [
<<<XML
<rss version="2.0">
	<channel>
		<item>
			<category>Item Category</category>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 2.0 DC 1.0 Subject' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
            'Test RSS 2.0 DC 1.1 Subject' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:subject>Item Category</dc:subject>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Category',
            ],
        ];
    }

    /**
     * @dataProvider getItemCategoryLabelDataProvider
     */
    public function test_get_label_from_item_category(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        self::assertInstanceOf(Item::class, $item);

        $category = $item->get_category();
        self::assertInstanceOf(Category::class, $category);

        self::assertSame($expected, $category->get_label());
    }
}

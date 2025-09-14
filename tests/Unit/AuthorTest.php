<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Author;
use SimplePie\Item;
use SimplePie\SimplePie;

class AuthorTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Author'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Author'));
    }

    /**
     * @return array<array{string, ?string}>
     */
    public static function getAuthorNameDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Creator' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Test Atom 0.3 DC 1.1 Creator' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Atom 0.3 Inheritance Feed Name' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Test Atom 0.3 Name' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<author>
			<name>Item Author</name>
		</author>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Test Atom 1.0 DC 1.0 Creator' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Test Atom 1.0 DC 1.1 Creator' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Atom 1.0 Inheritance Feed Name' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Test Atom 1.0 Name' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<author>
			<name>Item Author</name>
		</author>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Atom 1.0 Inheritance Source Name' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<source>
			<author>
				<name>Item Author</name>
			</author>
		</source>
	</entry>
</feed>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.90 Atom 0.3 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.90 Atom 1.0 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.90 DC 1.0 Creator' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.90 DC 1.1 Creator' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Name' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Name' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Creator' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Creator' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Name' => [
<<<XML
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Name' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland DC 1.0 Creator' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland DC 1.1 Creator' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.92 Atom 0.3 Name' => [
<<<XML
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.92 Atom 1.0 Name' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.92 DC 1.0 Creator' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 0.92 DC 1.1 Creator' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 1.0 Atom 0.3 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 1.0 Atom 1.0 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 1.0 DC 1.0 Creator' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 1.0 DC 1.1 Creator' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
XML
                ,
                'Item Author',
            ],
            'Test RSS 2.0 Atom 0.3 Name' => [
<<<XML
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 2.0 Atom 1.0 Name' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 2.0 Author' => [
<<<XML
<rss version="2.0">
	<channel>
		<item>
			<author>example@example.com (Item Author)</author>
		</item>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 2.0 DC 1.0 Creator' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
            'Test RSS 2.0 DC 1.1 Creator' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Author',
            ],
        ];
    }

    /**
     * @dataProvider getAuthorNameDataProvider
     */
    public function test_get_name_from_author(string $data, ?string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        self::assertInstanceOf(Item::class, $item);

        $author = $item->get_author();
        self::assertInstanceOf(Author::class, $author);

        self::assertSame($expected, $author->get_name());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getContributorNameDataProvider(): array
    {
        return [
            'Test Atom 0.3 Name' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<contributor>
			<name>Item Contributor</name>
		</contributor>
	</entry>
</feed>
XML
                ,
                'Item Contributor',
            ],
            'Test Atom 1.0 Name' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<contributor>
			<name>Item Contributor</name>
		</contributor>
	</entry>
</feed>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.90 Atom 0.3 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.90 Atom 1.0 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Name' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Name' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Name' => [
<<<XML
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Name' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.92 Atom 0.3 Name' => [
<<<XML
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 0.92 Atom 1.0 Name' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 1.0 Atom 0.3 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 1.0 Atom 1.0 Name' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 2.0 Atom 0.3 Name' => [
<<<XML
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
            'Test RSS 2.0 Atom 1.0 Name' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
XML
                ,
                'Item Contributor',
            ],
        ];
    }

    /**
     * @dataProvider getContributorNameDataProvider
     */
    public function test_get_name_from_contributor(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        self::assertInstanceOf(Item::class, $item);

        $author = $item->get_contributor();
        self::assertInstanceOf(Author::class, $author);

        self::assertSame($expected, $author->get_name());
    }
}

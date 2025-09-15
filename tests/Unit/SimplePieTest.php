<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use SimplePie\Cache;
use SimplePie\File;
use SimplePie\Item;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\Cache\LegacyCacheMock;
use SimplePie\Tests\Fixtures\Cache\NewCacheMock;
use SimplePie\Tests\Fixtures\Exception\SuccessException;
use SimplePie\Tests\Fixtures\FileMock;
use SimplePie\Tests\Fixtures\FileWithRedirectMock;
use TypeError;

class SimplePieTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\SimplePie'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(SimplePie::class));
    }

    /**
     * Run a test using a sprintf template and data
     *
     * @param string $template
     */
    private function createFeedWithTemplate(string $template, string $data): SimplePie
    {
        $data = [$data];

        $xml = vsprintf($template, $data);
        $feed = new SimplePie();
        $feed->set_raw_data($xml);
        $feed->enable_cache(false);
        $feed->init();

        return $feed;
    }

    /**
     * @return array<array{string, string}>
     */
    public static function titleDataProvider(): array
    {
        return [
            ['Feed Title', 'Feed Title'],

            // RSS Profile tests
            ['AT&amp;T', 'AT&amp;T'],
            ['AT&#x26;T', 'AT&amp;T'],
            ["Bill &amp; Ted's Excellent Adventure", "Bill &amp; Ted's Excellent Adventure"],
            ["Bill &#x26; Ted's Excellent Adventure", "Bill &amp; Ted's Excellent Adventure"],
            ['The &amp; entity', 'The &amp; entity'],
            ['The &#x26; entity', 'The &amp; entity'],
            ['The &amp;amp; entity', 'The &amp;amp; entity'],
            ['The &#x26;amp; entity', 'The &amp;amp; entity'],
            ['I &lt;3 Phil Ringnalda', 'I &lt;3 Phil Ringnalda'],
            ['I &#x3C;3 Phil Ringnalda', 'I &lt;3 Phil Ringnalda'],
            ['A &lt; B', 'A &lt; B'],
            ['A &#x3C; B', 'A &lt; B'],
            ['A&lt;B', 'A&lt;B'],
            ['A&#x3C;B', 'A&lt;B'],
            ["Nice &lt;gorilla&gt; what's he weigh?", "Nice &lt;gorilla&gt; what's he weigh?"],
            ["Nice &#x3C;gorilla&gt; what's he weigh?", "Nice &lt;gorilla&gt; what's he weigh?"],
        ];
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20(string $title, string $expected): void
    {
        $data =
'<rss version="2.0">
	<channel>
		<title>%s</title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithDC10(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>%s</dc:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithDC11(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>%s</dc:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithAtom03(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>%s</a:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithAtom10(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>%s</a:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * Based on a test from old bug 18
     *
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithImageTitle(string $title, string $expected): void
    {
        $data =
'<rss version="2.0">
	<channel>
		<title>%s</title>
		<image>
			<title>Image title</title>
		</image>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * Based on a test from old bug 18
     *
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithImageTitleReversed(string $title, string $expected): void
    {
        $data =
'<rss version="2.0">
	<channel>
		<image>
			<title>Image title</title>
		</image>
		<title>%s</title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    public function testItemWithEmptyContent(): void
    {
        $data =
'<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<item>
			<description>%s</description>
			<content:encoded><![CDATA[ <script> ]]></content:encoded>
		</item>
	</channel>
</rss>';
        $content = 'item description';
        $feed = $this->createFeedWithTemplate($data, $content);
        $item = $feed->get_item();
        $this->assertInstanceOf(Item::class, $item);
        $this->assertSame($content, $item->get_content());
    }

    public function testSetPsr16Cache(): void
    {
        $psr16 = $this->createMock(CacheInterface::class);
        $psr16->expects($this->once())->method('get')->willReturn([]);
        $psr16->expects($this->once())->method('set')->willReturn(true);

        $feed = new SimplePie();
        $feed->set_cache($psr16);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }

    public function testLegacyCallOfSetCacheClass(): void
    {
        $feed = new SimplePie();

        // PHPUnit 10 compatible way to test trigger_error().
        set_error_handler(
            function ($errno, $errstr): bool {
                $this->assertSame(
                    '"SimplePie\SimplePie::set_cache_class()" is deprecated since SimplePie 1.3, please use "SimplePie\SimplePie::set_cache()" instead.',
                    $errstr
                );

                restore_error_handler();
                return true;
            },
            E_USER_DEPRECATED
        );

        $feed->set_cache_class(LegacyCacheMock::class);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        if (version_compare(PHP_VERSION, '8.0', '<')) {
            $this->expectException(SuccessException::class);
        } else {
            // PHP 8.0 will throw a `TypeError` for trying to call a non-static method statically.
            // This is no longer supported in PHP, so there is just no way to continue to provide BC
            // for the old non-static cache methods.
            $this->expectException(TypeError::class);
            $this->expectExceptionMessage('call_user_func_array(): Argument #1 ($callback) must be a valid callback, non-static method SimplePie\Tests\Fixtures\Cache\LegacyCacheMock::create() cannot be called statically');
        }

        $feed->init();
    }

    public function testDirectOverrideNew(): void
    {
        $this->expectException(SuccessException::class);

        $feed = new SimplePie();
        $feed->get_registry()->register(Cache::class, NewCacheMock::class);
        $feed->get_registry()->register(File::class, FileMock::class);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }

    public function testDirectOverrideLegacy(): void
    {
        $feed = new SimplePie();
        $feed->get_registry()->register(File::class, FileWithRedirectMock::class);
        $feed->enable_cache(false);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();

        $this->assertSame('https://example.com/feed/2019-10-07', $feed->subscribe_url());
        $this->assertSame('https://example.com/feed/', $feed->subscribe_url(true));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getCopyrightDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
XML
                ,
                'Example Copyright Information',
            ],
            'Test Atom 0.3 DC 1.1' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
XML
                ,
                'Example Copyright Information',
            ],
            'Test Atom 1.0 DC 1.0' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
XML
                ,
                'Example Copyright Information',
            ],
            'Test Atom 1.0 DC 1.1' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
XML
                ,
                'Example Copyright Information',
            ],
            'Test Atom 1.0 Rights' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<rights>Example Copyright Information</rights>
</feed>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.90 Atom 1.0 Rights' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rdf:RDF>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.90 DC 1.0 Rights' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.90 DC 1.1 Rights' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Rights' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Rights' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Rights' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape Copyright' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Rights' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland DC 1.0 Rights' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland DC 1.1 Rights' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland Copyright' => [
<<<XML
<rss version="0.91">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 Atom 1.0 Rights' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 DC 1.0 Rights' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 DC 1.1 Rights' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 Copyright' => [
<<<XML
<rss version="0.92">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 1.0 Atom 1.0 Rights' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rdf:RDF>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 1.0 DC 1.0 Rights' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 1.0 DC 1.1 Rights' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 Atom 1.0 Rights' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 DC 1.0 Rights' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 DC 1.1 Rights' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 Copyright' => [
<<<XML
<rss version="2.0">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
XML
                ,
                'Example Copyright Information',
            ],
        ];
    }

    /**
     * @dataProvider getCopyrightDataProvider
     */
    public function test_get_copyright(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_copyright());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getDescriptionDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Description' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:description>Feed Description</dc:description>
</feed>
XML
                ,
                'Feed Description',
            ],
            'Test Atom 0.3 DC 1.1 Description' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:description>Feed Description</dc:description>
</feed>
XML
                ,
                'Feed Description',
            ],
            'Test Atom 0.3 Tagline' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<tagline>Feed Description</tagline>
</feed>
XML
                ,
                'Feed Description',
            ],
            'Test Atom 1.0 DC 1.0 Description' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:description>Feed Description</dc:description>
</feed>
XML
                ,
                'Feed Description',
            ],
            'Test Atom 1.0 DC 1.1 Description' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:description>Feed Description</dc:description>
</feed>
XML
                ,
                'Feed Description',
            ],
            'Test Atom 1.0 Subtitle' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<subtitle>Feed Description</subtitle>
</feed>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 Atom 0.3 Tagline' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 Atom 1.0 Subtitle' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 DC 1.0 Description' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 DC 1.1 Description' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 Description' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<description>Feed Description</description>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Tagline' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Subtitle' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Description' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Description' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape Description' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Tagline' => [
<<<XML
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Subtitle' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland DC 1.0 Description' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland DC 1.1 Description' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland Description' => [
<<<XML
<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 Atom 0.3 Tagline' => [
<<<XML
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 Atom 1.0 Subtitle' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 DC 1.0 Description' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 DC 1.1 Description' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 Description' => [
<<<XML
<rss version="0.92">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 Atom 0.3 Tagline' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 Atom 1.0 Subtitle' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 DC 1.0 Description' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 DC 1.1 Description' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 Description' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<description>Feed Description</description>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 20 Atom 0.3 Tagline' => [
<<<XML
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 20 Atom 1.0 Subtitle' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 20 DC 1.0 Description' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 20 DC 1.1 Description' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
            'Test RSS 20 Description' => [
<<<XML
<rss version="2.0">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
XML
                ,
                'Feed Description',
            ],
        ];
    }

    /**
     * @dataProvider getDescriptionDataProvider
     */
    public function test_get_description(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_description());
    }

    /**
     * @return array<array{string, int|null}>
     */
    public static function getImageHeightDataProvider(): array
    {
        return [
            'Test Atom 1.0 Icon Default' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>
XML				,
                null,
            ],
            'Test Atom 1.0 Logo Default' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>
XML				,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Icon Default' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
XML				,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Logo Default' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
XML				,
                null,
            ],
            'Test RSS 0.90 URL Default' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
XML				,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Icon Default' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Logo Default' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Height' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 0.91-Netscape URL Default' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                31,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Icon Default' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Logo Default' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Userland Height' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 0.91-Userland URL Default' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                31,
            ],
            'Test RSS 0.92 Atom 1.0 Icon Default' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.92 Atom 1.0 Logo Default' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.92 Height' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 0.92 URL Default' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                31,
            ],
            'Test RSS 1.0 Atom 1.0 Icon Default' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 1.0 Atom 1.0 Logo Default' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 1.0 URL Default' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Icon Default' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Logo Default' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 2.0 Height' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 2.0 URL Default' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                31,
            ],
        ];
    }

    /**
     * @dataProvider getImageHeightDataProvider
     */
    public function test_get_image_height(string $data, ?int $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_height());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getImageLinkDataProvider(): array
    {
        return [
            'Test RSS 0.90 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<link>http://example.com/</link>
	</image>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Link' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Link' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Link' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<link>http://example.com/</link>
	</image>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Link' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
        ];
    }

    /**
     * @dataProvider getImageLinkDataProvider
     */
    public function test_get_image_link(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_link());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getImageTitleDataProvider(): array
    {
        return [
            'Test RSS 0.90 DC 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.90 DC 1.1 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.90 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<title>Image Title</title>
	</image>
</rdf:RDF>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Netscape Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Userland DC 1.0 Title' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Userland DC 1.1 Title' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Userland Title' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.92 DC 1.0 Title' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.92 DC 1.1 Title' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 0.92 Title' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 1.0 DC 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
XML
                ,
                'Image Title',
            ],
            'Test RSS 1.0 DC 1.1 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
XML
                ,
                'Image Title',
            ],
            'Test RSS 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<title>Image Title</title>
	</image>
</rdf:RDF>
XML
                ,
                'Image Title',
            ],
            'Test RSS 2.0 DC 1.0 Title' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 2.0 DC 1.1 Title' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
            'Test RSS 2.0 Title' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
XML
                ,
                'Image Title',
            ],
        ];
    }

    /**
     * @dataProvider getImageTitleDataProvider
     */
    public function test_get_image_title(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_title());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getImageUrlDataProvider(): array
    {
        return [
            'Test Atom 1.0 Icon' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Logo' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 1.0 Icon' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 1.0 Logo' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 URL' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Icon' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Logo' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape URL' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Icon' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Logo' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland URL' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 1.0 Icon' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 1.0 Logo' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 URL' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 1.0 Icon' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 1.0 Logo' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 URL' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 1.0 Icon' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 1.0 Logo' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 URL' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
        ];
    }

    /**
     * @dataProvider getImageUrlDataProvider
     */
    public function test_get_image_url(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_url());
    }

    /**
     * @return array<array{string, int|null}>
     */
    public static function getImageWidthDataProvider(): array
    {
        return [
            'Test Atom 1.0 Icon Default' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>
XML
                ,
                null,
            ],
            'Test Atom 1.0 Logo Default' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>
XML
                ,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Icon' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Logo' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 0.90' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Icon' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Logo' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Netscape' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                88,
            ],
            'Test RSS 0.91-Netscape Width' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Icon' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Logo' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.91-Userland' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                88,
            ],
            'Test RSS 0.91-Userland Width' => [
<<<XML
<rss version="0.91">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 0.92 Atom 1.0 Icon' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.92 Atom 1.0 Logo' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 0.92' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                88,
            ],
            'Test RSS 0.92 Width' => [
<<<XML
<rss version="0.92">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
            'Test RSS 1.0 Atom 1.0 Icon' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 1.0 Atom 1.0 Logo' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 1.0' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
XML
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Icon' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Logo' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
XML
                ,
                null,
            ],
            'Test RSS 2.0' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
XML
                ,
                88,
            ],
            'Test RSS 2.0 Width' => [
<<<XML
<rss version="2.0">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
XML
                ,
                100,
            ],
        ];
    }

    /**
     * @dataProvider getImageWidthDataProvider
     */
    public function test_get_image_width(string $data, ?int $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_width());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getLanguageDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Language' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:language>en-GB</dc:language>
</feed>
XML
                ,
                'en-GB',
            ],
            'Test Atom 0.3 DC 1.1 Language' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:language>en-GB</dc:language>
</feed>
XML
                ,
                'en-GB',
            ],
            'Test Atom 0.3 xmllang' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xml:lang="en-GB">
	<title>Feed Title</title>
</feed>
XML
                ,
                'en-GB',
            ],
            'Test Atom 1.0 DC 1.0 Language' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:language>en-GB</dc:language>
</feed>
XML
                ,
                'en-GB',
            ],
            'Test Atom 1.0 DC 1.1 Language' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:language>en-GB</dc:language>
</feed>
XML
                ,
                'en-GB',
            ],
            'Test Atom 1.0 xmllang' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-GB">
	<title>Feed Title</title>
</feed>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.90 DC 1.0 Language' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.90 DC 1.1 Language' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Language' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Language' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Netscape Language' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Userland DC 1.0 Language' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Userland DC 1.1 Language' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Userland Language' => [
<<<XML
<rss version="0.91">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.92 DC 1.0 Language' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.92 DC 1.1 Language' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 0.92 Language' => [
<<<XML
<rss version="0.92">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 1.0 DC 1.0 Language' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
XML
                ,
                'en-GB',
            ],
            'Test RSS 1.0 DC 1.1 Language' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
XML
                ,
                'en-GB',
            ],
            'Test RSS 2.0 DC 1.0 Language' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 2.0 DC 1.1 Language' => [
<<<XML
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
            'Test RSS 2.0 Language' => [
<<<XML
<rss version="2.0">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
XML
                ,
                'en-GB',
            ],
        ];
    }

    /**
     * @dataProvider getLanguageDataProvider
     */
    public function test_get_language(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_language());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getLinkDataProvider(): array
    {
        return [
            'Test Atom 0.3 Link' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<link href="http://example.com/"/>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test Atom 0.3 Link Alternate' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<link href="http://example.com/" rel="alternate"/>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Link' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/"/>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Link Absolute IRI' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/" rel="http://www.iana.org/assignments/relation/alternate"/>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Link Relative IRI' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/" rel="alternate"/>
</feed>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 0.3 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 1.0 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Link' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Link' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Link' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Link' => [
<<<XML
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Link' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Link' => [
<<<XML
<rss version="0.91">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 0.3 Link' => [
<<<XML
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 1.0 Link' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Link' => [
<<<XML
<rss version="0.92">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 0.3 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 1.0 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Link' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rdf:RDF>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 0.3 Link' => [
<<<XML
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 1.0 Link' => [
<<<XML
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Link' => [
<<<XML
<rss version="2.0">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
XML
                ,
                'http://example.com/',
            ],
        ];
    }

    /**
     * @dataProvider getLinkDataProvider
     */
    public function test_get_link(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_link());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function getTitleDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Title' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:title>Feed Title</dc:title>
</feed>
XML
                ,
                'Feed Title',
            ],
            'Test Atom 0.3 DC 1.1 Title' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:title>Feed Title</dc:title>
</feed>
XML
                ,
                'Feed Title',
            ],
            'Test Atom 0.3 Title' => [
<<<XML
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<title>Feed Title</title>
</feed>
XML
                ,
                'Feed Title',
            ],
            'Test Atom 1.0 DC 1.0 Title' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:title>Feed Title</dc:title>
</feed>
XML
                ,
                'Feed Title',
            ],
            'Test Atom 1.0 DC 1.1 Title' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:title>Feed Title</dc:title>
</feed>
XML
                ,
                'Feed Title',
            ],
            'Test Atom 1.0 Title' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Feed Title</title>
</feed>
XML
                ,
                'Feed Title',
            ],
            'Test Bug 16 Test 0' => [
<<<XML
<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN"
"http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<title>Feed with DOCTYPE</title>
	</channel>
</rss>
XML
                ,
                'Feed with DOCTYPE',
            ],
            'Test Bug 174 Test 0' => [
<<<XML
<?xml version = "1.0" encoding = "UTF-8" ?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Spaces in prolog</title>
</feed>
XML
                ,
                'Spaces in prolog',
            ],
            'Test Bug 20 Test 0' => [
<<<XML
<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title>Non-default namespace</a:title>
</a:feed>
XML
                ,
                'Non-default namespace',
            ],
            'Test Bug 20 Test 1' => [
<<<XML
<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title type="xhtml"><div>Non-default namespace</div></a:title>
</a:feed>
XML
                ,
                'Non-default namespace',
            ],
            'Test Bug 20 Test 2' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:h="http://www.w3.org/1999/xhtml">
	<title type="xhtml"><h:div>Non-default namespace</h:div></title>
</feed>
XML
                ,
                'Non-default namespace',
            ],
            'Test Bug 272 Test 0' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Ampersand: <![CDATA[&]]></title>
</feed>
XML
                ,
                'Ampersand: &amp;',
            ],
            'Test Bug 272 Test 1' => [
<<<XML
<feed xmlns="http://www.w3.org/2005/Atom">
	<title><![CDATA[&]]>: Ampersand</title>
</feed>
XML
                ,
                '&amp;: Ampersand',
            ],
            'Test RSS 0.90 Atom 0.3 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 Atom 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 DC 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 DC 1.1 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<title>Feed Title</title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape Title' => [
<<<XML
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Title' => [
<<<XML
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Title' => [
<<<XML
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland DC 1.0 Title' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland DC 1.1 Title' => [
<<<XML
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland Title' => [
<<<XML
<rss version="0.91">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 Atom 0.3 Title' => [
<<<XML
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 Atom 1.0 Title' => [
<<<XML
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 DC 1.0 Title' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 DC 1.1 Title' => [
<<<XML
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 Title' => [
<<<XML
<rss version="0.92">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 Atom 0.3 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 Atom 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 DC 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 DC 1.1 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 Title' => [
<<<XML
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<title>Feed Title</title>
	</channel>
</rdf:RDF>
XML
                ,
                'Feed Title',
            ],
        ];
    }

    /**
     * @dataProvider getTitleDataProvider
     */
    public function test_get_title(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_title());
    }
}

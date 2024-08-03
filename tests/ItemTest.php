<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Tests for SimplePie\Item
 */
class ItemTest extends TestCase
{
    /**
     * Run a test using a sprintf template and data
     */
    protected function checkFromTemplate(string $template, string $data): SimplePie
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
    public static function titleprovider(): array
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
     * @dataProvider titleprovider
     */
    public function testTitleRSS20(string $title, string $expected): void
    {
        $data =
'<rss version="2.0">
	<channel>
		<title>%s</title>
	</channel>
</rss>';
        $feed = $this->checkFromTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleprovider
     */
    public function testTitleRSS20WithDC10(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>%s</dc:title>
	</channel>
</rss>';
        $feed = $this->checkFromTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleprovider
     */
    public function testTitleRSS20WithDC11(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>%s</dc:title>
	</channel>
</rss>';
        $feed = $this->checkFromTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleprovider
     */
    public function testTitleRSS20WithAtom03(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>%s</a:title>
	</channel>
</rss>';
        $feed = $this->checkFromTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleprovider
     */
    public function testTitleRSS20WithAtom10(string $title, string $expected): void
    {
        $data =
'<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>%s</a:title>
	</channel>
</rss>';
        $feed = $this->checkFromTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * Based on a test from old bug 18
     *
     * @dataProvider titleprovider
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
        $feed = $this->checkFromTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * Based on a test from old bug 18
     *
     * @dataProvider titleprovider
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
        $feed = $this->checkFromTemplate($data, $title);
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
        $feed = $this->checkFromTemplate($data, $content);
        $item = $feed->get_item();
        $this->assertSame($content, ($item ? $item->get_content() : null));
    }
}

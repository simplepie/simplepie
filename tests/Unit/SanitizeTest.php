<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Misc;
use SimplePie\Registry;
use SimplePie\Sanitize;

class SanitizeTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie\Sanitize'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Sanitize'));
    }

    public function testSanitize(): void
    {
        $sanitize = new Sanitize();

        self::assertSame(
            <<<HTML
&lt;head&gt; &amp; &lt;body&gt; /\ ' === ' &amp; " === ". Sbohem bez šátečku! Тут был Лёха.
HTML
            ,
            $sanitize->sanitize(
                <<<HTML
&#60;head&#62; &amp; &lt;body&gt; /\ ' === &apos; &#38; " === &quot;. Sbohem bez šátečku! Тут был Лёха.<script>alert('XSS')</script>
HTML
                ,
                SIMPLEPIE_CONSTRUCT_MAYBE_HTML
            ),
            'XML input (with corresponding xml entities) should be cleaned and converted to utf-8 escaped HTML'
        );
    }

    /**
     * @return array<array{string, string}>
     */
    public static function sanitizeURLDataProvider(): array
    {
        return [
            'simple absolute valid a href, resolved' => [
                '<a href="/path/to/doc">link</a>',
                '<a href="http://example.com/path/to/doc">link</a>'
            ],
            'image valid fully qualified src, no change expected' => [
                '<img src="http://2.example.com/image.jpg">',
                '<img src="http://2.example.com/image.jpg">'
            ],
            'image valid relative src, resolved' => [
                '<img src="image.jpg">',
                '<img src="http://example.com/image.jpg">'
            ],
            'image valid absolute src, resolved' => [
                '<img src="/image.jpg">',
                '<img src="http://example.com/image.jpg">'
            ],
            'audio relative src, resolved, fixed' => [
                '<audio src="a.mp3" />',
                '<audio src="http://example.com/a.mp3" preload="none"></audio>'
            ],
            'audio absolute source src path, resolved, fixed' => [
                '<audio><source src="/a/b.wav" /></audio>',
                '<audio preload="none"><source src="http://example.com/a/b.wav"></audio>'
            ],
            'audio with alternative source src absolute paths, resolved, fixed' => [
                '<audio><source src="a/b.wav" /><source src="/c/d.mp3" /></audio>',
                '<audio preload="none"><source src="http://example.com/a/b.wav"><source src="http://example.com/c/d.mp3"></audio>'
            ],
            'video src relative, resolved, fixed' => [
                '<video src="./b.mpeg" />',
                '<video src="http://example.com/b.mpeg" preload="none"></video>'
            ],
            'video with alternative source src, resolved, fixed' => [
                '<video><source src="a/b.mpeg" /><source src="/c/../d.mov"></video>',
                '<video preload="none"><source src="http://example.com/a/b.mpeg"><source src="http://example.com/d.mov"></video>'
            ],
        ];
    }

    /**
     * @dataProvider sanitizeURLDataProvider
     */
    public function testSanitizeURLResolution(string $given, string $expected): void
    {
        $sanitize = new Sanitize();

        $registry = new Registry();
        $sanitize->set_registry($registry);

        $base = 'http://example.com/';

        $actual = $sanitize->sanitize($given, SIMPLEPIE_CONSTRUCT_HTML, $base);

        // Remove newlines for PHP 7.2 compatibility
        $expected = str_replace(["\n", "\r"], '', $expected);
        $actual = str_replace(["\n", "\r"], '', $actual);

        self::assertSame($expected, $actual);
    }

    /**
     * @return array<array{string}>
     */
    public static function rawTextElementDataProvider(): array
    {
        return [
            'noembed' => ['noembed'],
            'noframes' => ['noframes'],
            'textarea' => ['textarea'],
            'xmp' => ['xmp'],
        ];
    }

    /**
     * Browsers read the content of e.g. `<xmp>` as text ending at the first `</xmp>`,
     * while libxml2 builds child elements there, and writes `<!--...-->` and `&{...}`
     * found in their attribute values without escaping `<` and `>`.
     *
     * @dataProvider rawTextElementDataProvider
     */
    public function testMarkupInRawTextElementKeepsOnlyText(string $tag): void
    {
        $sanitize = new Sanitize();
        $sanitize->set_registry(new Registry());
        $base = 'http://example.com/';

        foreach (['<!--%s-->', '&amp;{%s}'] as $unescapedByLibxml) {
            $title = sprintf($unescapedByLibxml, '</' . $tag . '><form method=post>');
            $actual = $sanitize->sanitize(
                '<' . $tag . '><a title="' . $title . '">Hello</a> <b>world</b></' . $tag . '>',
                SIMPLEPIE_CONSTRUCT_HTML,
                $base
            );

            // The attribute value must not end the raw text element early in a browser and become live markup
            self::assertStringNotContainsString('<form', $actual);
            // Only the text may remain in a raw text element
            self::assertStringContainsString('Hello', $actual);
            self::assertStringContainsString('world', $actual);
            // Whatever a consumer ingests when re-parsing the output must not be executable either
            self::assertNoExecutableMarkupIngested($actual);
        }
    }

    /**
     * Same as testMarkupInRawTextElementKeepsOnlyText(), but with an element the default
     * strip list removes (`<iframe>`), provided nothing is stripped at all.
     *
     * Regardless of what libxml2 makes of the payload — attribute glue on older
     * versions, live markup beyond an early-terminated raw text element on newer
     * ones — the sanitized output must not ingest anything executable.
     */
    public function testMarkupInRawTextElementKeepsOnlyTextWhenNothingIsStripped(): void
    {
        $sanitize = new Sanitize();
        $sanitize->set_registry(new Registry());
        $sanitize->strip_htmltags(false);
        $base = 'http://example.com/';

        $title = sprintf('<!--%s-->', '</iframe><img src=x onerror=alert(1)>');
        $actual = $sanitize->sanitize(
            '<iframe><a title="' . $title . '">Hello</a></iframe>',
            SIMPLEPIE_CONSTRUCT_HTML,
            $base
        );

        // Event handlers must not survive anywhere in the output
        self::assertStringNotContainsString('onerror', $actual);
        // The regular text of the raw text element must remain
        self::assertStringContainsString('Hello', $actual);
        // What a consumer ingests when re-parsing the output must not be executable either
        self::assertNoExecutableMarkupIngested($actual);
    }

    /**
     * Asserts that re-parsing the HTML ingests no executable markup:
     * no script elements and no event-handler attributes, and no markup
     * characters embedded in attribute values, which older libxml2 would
     * write unescaped into the serialized output.
     */
    private static function assertNoExecutableMarkupIngested(string $html): void
    {
        $doc = new \DOMDocument();
        $previous = \libxml_use_internal_errors(true);
        if ($doc->loadHTML($html) === false) {
            \libxml_use_internal_errors($previous);
            self::fail('Could not re-parse the sanitized output');
        }
        \libxml_use_internal_errors($previous);
        $xpath = new \DOMXPath($doc);
        $handlers = $xpath->query('//@*[starts-with(name(), "on")]');
        $scripts = $xpath->query('//script');
        $markupInAttributes = $xpath->query('//@*[contains(., "<")]');
        self::assertNotFalse($handlers);
        self::assertNotFalse($scripts);
        self::assertNotFalse($markupInAttributes);
        self::assertCount(0, $handlers);
        self::assertCount(0, $scripts);
        self::assertCount(0, $markupInAttributes);
    }
}

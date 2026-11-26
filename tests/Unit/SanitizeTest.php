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
            'title' => ['title'],
            'xmp' => ['xmp'],
        ];
    }

    /**
     * Browsers read the content of e.g. `<xmp>` as text ending at the first `</xmp>`,
     * while the legacy libxml2 parser builds child elements there, and serializes
     * `<!--...-->` and `&{...}` found in attribute values without escaping `<` and `>`.
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

            // The attribute value must not terminate the raw text element early and become live markup
            self::assertStringNotContainsString('<form', $actual);
            self::assertStringContainsString('Hello', $actual);
            self::assertStringContainsString('world', $actual);
            self::assertNoExecutableMarkupIngested($actual);
        }
    }

    /**
     * @return array<array{string}>
     */
    public static function rawTextElementNothingStrippedProvider(): array
    {
        return [
            'iframe' => ['iframe'],
            'noscript' => ['noscript'],
        ];
    }

    /**
     * Same as testMarkupInRawTextElementKeepsOnlyText(), but with elements beyond
     * the reach of the default strip list: nothing is stripped at all. `<noscript>`
     * is included because, although browsers read its content as text when scripting
     * is enabled, the legacy libxml2 parser parses it like any other element.
     *
     * Regardless of what libxml2 makes of the payload — attribute glue on older
     * versions, live markup beyond an early-terminated raw text element on newer
     * ones — the sanitized output must not ingest anything executable.
     *
     * @dataProvider rawTextElementNothingStrippedProvider
     */
    public function testMarkupInRawTextElementKeepsOnlyTextWhenNothingIsStripped(string $tag): void
    {
        $sanitize = new Sanitize();
        $sanitize->set_registry(new Registry());
        $sanitize->strip_htmltags(false);
        $base = 'http://example.com/';

        $title = sprintf('<!--%s-->', '</' . $tag . '><img src=x onerror=alert(1)>');
        $actual = $sanitize->sanitize(
            '<' . $tag . '><a title="' . $title . '">Hello</a></' . $tag . '>',
            SIMPLEPIE_CONSTRUCT_HTML,
            $base
        );

        self::assertStringNotContainsString('onerror', $actual);
        self::assertStringContainsString('Hello', $actual);
        self::assertNoExecutableMarkupIngested($actual);
    }

    /**
     * Same as testMarkupInRawTextElementKeepsOnlyText(), but with `<plaintext>`: per
     * HTML5 it swallows everything after its start tag as text until the end of the
     * document, never recognizing `</plaintext>`. The legacy libxml2 parser builds
     * child elements in it, which the sanitizer flattens to text, but inert markup
     * may remain visible in the output — hence no `<form` assertion here, unlike
     * the other raw text element tests.
     */
    public function testMarkupInRawTextElementKeepsOnlyTextInPlaintext(): void
    {
        $sanitize = new Sanitize();
        $sanitize->set_registry(new Registry());
        $base = 'http://example.com/';

        $title = sprintf('<!--%s-->', '</plaintext><form method=post>');
        $actual = $sanitize->sanitize(
            '<plaintext><a title="' . $title . '">Hello</a> <b>world</b></plaintext>',
            SIMPLEPIE_CONSTRUCT_HTML,
            $base
        );

        self::assertStringContainsString('Hello', $actual);
        self::assertStringContainsString('world', $actual);
        self::assertNoExecutableMarkupIngested($actual);
    }

    /**
     * Asserts that re-parsing the HTML ingests no executable markup: no script
     * elements, no event-handler attributes, and no markup characters embedded
     * in attribute values, which older libxml2 would write unescaped.
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

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

        self::assertSame($expected, $sanitize->sanitize($given, SIMPLEPIE_CONSTRUCT_HTML, $base));
    }
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-FileCopyrightText: 2015 Lex Vjatkin
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class SanitizeTest extends TestCase
{
    public function testSanitize(): void
    {
        $sanitize = new SimplePie_Sanitize();

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

        $sanitize_whitelist = new SimplePie_Sanitize();
        $sanitize_whitelist->allowed_html_attributes([
            'title', 'role',
        ]);
        $sanitize_whitelist->allowed_html_elements_with_attributes([
            'details' => ['open'],
            'summary' => [],
            'p' => [],
        ]);
        self::assertSame(
            <<<HTML
<details open title="Click to expand"><summary data-xyz="123" aria-hidden="false">Details</summary><p>...</p></details>
HTML
            ,
            trim(preg_replace('/\R\s+/', '', $sanitize_whitelist->sanitize(
                <<<HTML
<details open title="Click to expand" onmouseover="alert(1)" xyz="1">
    <summary data-xyz="123" aria-hidden="false">Details</summary>
    <x-custom>
        <p>...</p>
    </x-custom>
</details>
<iframe src="https://example.net"></iframe>
HTML
                ,
                SIMPLEPIE_CONSTRUCT_HTML
            )) ?? ''),
            'Non-whitelisted tags and attributes should be cleaned'
        );
    }

    /**
     * @return array<array{string, string}>
     */
    public static function sanitizeURLProvider(): array
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
            ]
        ];
    }

    /**
     * @dataProvider sanitizeURLProvider
     */
    public function testSanitizeURLResolution(string $given, string $expected): void
    {
        $sanitize = new SimplePie_Sanitize();

        $registry = new SimplePie_Registry();
        $sanitize->set_registry($registry);

        $base = 'http://example.com/';

        self::assertSame($expected, $sanitize->sanitize($given, SIMPLEPIE_CONSTRUCT_HTML, $base));
    }
}

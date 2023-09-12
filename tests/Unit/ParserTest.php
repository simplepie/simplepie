<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Parser;
use SimplePie\Registry;

class ParserTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\Parser'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_Parser'));
    }

    /**
     * @return iterable<array{string, string, array<string, mixed>}>
     */
    public function feedProvider(): iterable
    {
        yield [
            <<<HTML
<!-- SPDX-FileCopyrightText: 2018 Aaron Parecki -->
<!-- SPDX-License-Identifier: CC0-1.0 -->
<!-- SPDX-ArtifactOfProjectName: php-mf2 -->
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <div class="h-feed">
            <a href="/author" class="p-author h-card">Author Name</a>
            <ul>
                <li class="h-entry">
                    <a href="/1" class="u-url p-name">One</a>
                </li>
                <li class="h-entry">
                    <a href="/2" class="u-url p-name">Two</a>
                </li>
                <li class="h-entry">
                    <a href="/3" class="u-url p-name">Three</a>
                </li>
                <li class="h-entry">
                    <a href="/4" class="u-url p-name">Four</a>
                </li>
            </ul>
        </div>
    </body>
</html>
HTML
            ,
            'https://example.com',
            [
                'child' => [
                    '' => [
                        'rss' => [
                            [
                                'attribs' => [
                                    '' => [
                                        'version' => '2.0',
                                    ],
                                ],
                                'child' => [
                                    '' => [
                                        'channel' => [
                                            [
                                                'child' => [
                                                    '' => [
                                                        'link' => [
                                                            [
                                                                'data' => 'https://example.com',
                                                            ],
                                                        ],
                                                        'image' => '',
                                                        'title' => [
                                                            [
                                                                'data' => 'Test',
                                                            ],
                                                        ],
                                                        'item' => [
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/1',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'One',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/2',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'Two',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/3',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'Three',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/4',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'Four',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        yield [
            <<<HTML
<!-- SPDX-FileCopyrightText: 2018 Aaron Parecki -->
<!-- SPDX-License-Identifier: CC0-1.0 -->
<!-- SPDX-ArtifactOfProjectName: php-mf2 -->
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <div class="h-feed">
            <a href="/author" class="p-author h-card">Author Name</a>
            <ul>
                <li class="h-entry">
                    <a href="/1" class="u-url p-name">One</a>
                </li>
                <li class="h-entry">
                    <a href="/2" class="u-url p-name">Two</a>
                    <ul>
                        <li class="p-comment h-entry"><a href="/a" class="u-url p-name">Comment A</a></li>
                        <li class="p-comment h-entry"><a href="/b" class="u-url p-name">Comment B</a></li>
                    </ul>
                </li>
                <li class="h-entry">
                    <a href="/3" class="u-url p-name">Three</a>
                    <ul>
                        <li class="h-entry"><a href="/c" class="u-url p-name">Comment C</a></li>
                        <li class="h-entry"><a href="/d" class="u-url p-name">Comment D</a></li>
                    </ul>
                </li>
                <li class="h-entry">
                    <a href="/4" class="u-url p-name">Four</a>
                </li>
            </ul>
        </div>
    </body>
</html>
HTML
            ,
            'https://example.com',
            [
                'child' => [
                    '' => [
                        'rss' => [
                            [
                                'attribs' => [
                                    '' => [
                                        'version' => '2.0',
                                    ],
                                ],
                                'child' => [
                                    '' => [
                                        'channel' => [
                                            [
                                                'child' => [
                                                    '' => [
                                                        'link' => [
                                                            [
                                                                'data' => 'https://example.com',
                                                            ],
                                                        ],
                                                        'image' => '',
                                                        'title' => [
                                                            [
                                                                'data' => 'Test',
                                                            ],
                                                        ],
                                                        'item' => [
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/1',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'One',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/2',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'Two',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/3',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'Three',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            [
                                                                'child' => [
                                                                    '' => [
                                                                        'link' => [
                                                                            [
                                                                                'data' => 'https://example.com/4',
                                                                            ],
                                                                        ],
                                                                        'title' => [
                                                                            [
                                                                                'data' => 'Four',
                                                                            ],
                                                                        ],
                                                                        'author' => [
                                                                            [
                                                                                'data' => '<a class="h-card" href="https://example.com/author">Author Name</a>',
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider feedProvider
     *
     * @param array<string, mixed> $parsedData
     */
    public function test_get_title(string $feed, string $base, array $parsedData): void
    {
        if (!function_exists('Mf2\parse')) {
            $this->markTestSkipped('Test requires Mf2 library.');
        }

        $parser = new Parser();

        $registry = new Registry();
        $parser->set_registry($registry);

        $result = $parser->parse($feed, 'UTF-8', $base);

        $this->assertTrue($result);
        $this->assertSame($parser->get_error_code(), null);
        $this->assertSame($parser->get_error_string(), null);
        $this->assertSame($parser->get_data(), $parsedData);
    }
}

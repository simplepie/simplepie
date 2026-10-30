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
        self::assertTrue(class_exists('SimplePie\Parser'));
    }

    public function testClassExists(): void
    {
        self::assertTrue(class_exists('SimplePie_Parser'));
    }

    /**
     * @return iterable<array{string, string, array<string, mixed>}>
     */
    public static function feedProvider(): iterable
    {
        yield [
            file_get_contents(dirname(__FILE__, 2) . '/data/microformats/h-feed-simple.html') ?: 'file not found',
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
            file_get_contents(dirname(__FILE__, 2) . '/data/microformats/h-feed-with-comments.html') ?: 'file not found',
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
    public function test_parse(string $feed, string $base, array $parsedData): void
    {
        if (!function_exists('Mf2\parse')) {
            $this->markTestSkipped('Test requires Mf2 library.');
        }

        $parser = new Parser();

        $registry = new Registry();
        $parser->set_registry($registry);

        $result = $parser->parse($feed, 'UTF-8', $base);

        self::assertTrue($result);
        self::assertSame($parser->get_error_code(), null);
        self::assertSame($parser->get_error_string(), null);
        self::assertSame($parser->get_data(), $parsedData);
    }
}

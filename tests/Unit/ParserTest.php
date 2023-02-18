<?php

declare(strict_types=1);
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Parser;
use SimplePie\Registry;

class ParserTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\Parser'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_Parser'));
    }

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
     */
    public function test_get_title(string $feed, string $base, array $parsedData): void
    {
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

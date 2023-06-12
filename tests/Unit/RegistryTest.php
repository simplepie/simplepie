<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Cache;
use SimplePie\File;
use SimplePie\Registry;
use SimplePie\Tests\Fixtures\Cache\NewCacheMock;
use SimplePie\Tests\Fixtures\FileMock;

class RegistryTest extends TestCase
{
    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists(Registry::class));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_Registry'));
    }

    /**
     * @dataProvider getDefaultClassDataProvider
     *
     * @param string $type
     * @param class-string $expected
     */
    public function testGetClassReturnsCorrectClassname(string $type, string $expected): void
    {
        $registry = new Registry();

        $this->assertSame($expected, $registry->get_class($type));
    }

    /**
     * @return array<array{string, class-string}>
     */
    public function getDefaultClassDataProvider(): array
    {
        return [
            ['SimplePie\Cache', 'SimplePie\Cache'],
            ['SimplePie\Locator', 'SimplePie\Locator'],
            ['SimplePie\Parser', 'SimplePie\Parser'],
            ['SimplePie\File', 'SimplePie\File'],
            ['SimplePie\Sanitize', 'SimplePie\Sanitize'],
            ['SimplePie\Item', 'SimplePie\Item'],
            ['SimplePie\Author', 'SimplePie\Author'],
            ['SimplePie\Category', 'SimplePie\Category'],
            ['SimplePie\Enclosure', 'SimplePie\Enclosure'],
            ['SimplePie\Caption', 'SimplePie\Caption'],
            ['SimplePie\Copyright', 'SimplePie\Copyright'],
            ['SimplePie\Credit', 'SimplePie\Credit'],
            ['SimplePie\Rating', 'SimplePie\Rating'],
            ['SimplePie\Restriction', 'SimplePie\Restriction'],
            ['SimplePie\Content\Type\Sniffer', 'SimplePie\Content\Type\Sniffer'],
            ['SimplePie\Source', 'SimplePie\Source'],
            ['SimplePie\Misc', 'SimplePie\Misc'],
            ['SimplePie\XML\Declaration\Parser', 'SimplePie\XML\Declaration\Parser'],
            ['SimplePie\Parse\Date', 'SimplePie\Parse\Date'],
            // Legacy type names
            ['Cache', 'SimplePie\Cache'],
            ['Locator', 'SimplePie\Locator'],
            ['Parser', 'SimplePie\Parser'],
            ['File', 'SimplePie\File'],
            ['Sanitize', 'SimplePie\Sanitize'],
            ['Item', 'SimplePie\Item'],
            ['Author', 'SimplePie\Author'],
            ['Category', 'SimplePie\Category'],
            ['Enclosure', 'SimplePie\Enclosure'],
            ['Caption', 'SimplePie\Caption'],
            ['Copyright', 'SimplePie\Copyright'],
            ['Credit', 'SimplePie\Credit'],
            ['Rating', 'SimplePie\Rating'],
            ['Restriction', 'SimplePie\Restriction'],
            ['Content_Type_Sniffer', 'SimplePie\Content\Type\Sniffer'],
            ['Source', 'SimplePie\Source'],
            ['Misc', 'SimplePie\Misc'],
            ['XML_Declaration_Parser', 'SimplePie\XML\Declaration\Parser'],
            ['Parse_Date', 'SimplePie\Parse\Date'],
        ];
    }

    /**
     * Test register() and get_class() with old and new type names
     *
     * @dataProvider getOverridingClassDataProvider
     */
    public function testRegisterAllowsOverridingTheDefaultClassname(string $registeredType, string $requestedType, string $classname): void
    {
        $registry = new Registry();

        $registry->register($registeredType, $classname);

        $this->assertSame($classname, $registry->get_class($requestedType));
    }

    /**
     * @return array<array{string, string, string}>
     */
    public function getOverridingClassDataProvider(): array
    {
        return [
            ['File',       'File',       FileMock::class],
            [File::class,  'File',       FileMock::class],
            ['File',       File::class,  FileMock::class],
            [File::class,  File::class,  FileMock::class],
            ['Cache',      'Cache',      NewCacheMock::class],
            [Cache::class, 'Cache',      NewCacheMock::class],
            ['Cache',      Cache::class, NewCacheMock::class],
            [Cache::class, Cache::class, NewCacheMock::class],
        ];
    }
}

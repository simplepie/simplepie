<?php

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
 * @package SimplePie
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SimplePie\Cache;
use SimplePie\File;
use SimplePie\Registry;
use SimplePie\Tests\Fixtures\Cache\NewCacheMock;
use SimplePie\Tests\Fixtures\FileMock;

class RegistryTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists(Registry::class));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_Registry'));
    }

    /**
     * @dataProvider getDefaultClassDataProvider
     */
    public function testGetClassReturnsCorrectClassname(string $type, string $expected)
    {
        $registry = new Registry();

        $this->assertSame($expected, $registry->get_class($type));
    }

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
    public function testRegisterAllowsOverridingTheDefaultClassname(string $registeredType, string $requestedType, string $classname)
    {
        $registry = new Registry();

        $registry->register($registeredType, $classname);

        $this->assertSame($classname, $registry->get_class($requestedType));
    }

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

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
use SimplePie\Enclosure;
use SimplePie\SimplePie;

class EnclosureTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\Enclosure'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_Enclosure'));
    }

    /**
     * @dataProvider getLinkProvider
     */
    public function test_get_link($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        $enclosure = $item->get_enclosure(0);

        $this->assertInstanceOf(Enclosure::class, $enclosure);
        $this->assertSame($expected, $enclosure->get_link());
    }

    public function getLinkProvider()
    {
        return [
            'Test enclosure get_link urlencoded' => [
<<<EOT
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>Test enclosure link 1</title>
        <description>Test enclosure link 1</description>
        <link>http://example.net/tests/</link>
        <item>
            <title>Test enclosure link 1.1</title>
            <description>Test enclosure link 1.1</description>
            <guid>http://example.net/tests/#1.1</guid>
            <link>http://example.net/tests/#1.1</link>
            <media:content url="http://example.net/link?a=%22b%22&amp;c=%3Cd%3E" medium="image">
            </media:content>
        </item>
    </channel>
</rss>
EOT,
                'http://example.net/link?a=%22b%22&amp;c=%3Cd%3E',
            ],
            'Test enclosure get_link urldecoded' => [
<<<EOT
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>Test enclosure link 2</title>
        <description>Test enclosure link 2</description>
        <link>http://example.net/tests/</link>
        <item>
            <title>Test enclosure link 2.1</title>
            <description>Test enclosure link 2.1</description>
            <guid>http://example.net/tests/#2.1</guid>
            <link>http://example.net/tests/#2.1</link>
            <media:content url="http://example.net/link?a=&quot;b&quot;&amp;c=&lt;d&gt;" medium="image">
            </media:content>
        </item>
    </channel>
</rss>
EOT,
                'http://example.net/link?a=%22b%22&amp;c=%3Cd%3E',
            ],
        ];
    }
}

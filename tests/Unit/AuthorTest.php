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
use SimplePie\Author;
use SimplePie\Item;
use SimplePie\SimplePie;

class AuthorTest extends TestCase
{
    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\Author'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie_Author'));
    }

    /**
     * @return array<array{string, ?string}>
     */
    public function getAuthorNameDataProvider(): array
    {
        return [
            'Test Atom 0.3 DC 1.0 Creator' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Test Atom 0.3 DC 1.1 Creator' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Atom 0.3 Inheritance Feed Name' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Test Atom 0.3 Name' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<author>
			<name>Item Author</name>
		</author>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Test Atom 1.0 DC 1.0 Creator' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Test Atom 1.0 DC 1.1 Creator' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<entry>
		<dc:creator>Item Author</dc:creator>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Atom 1.0 Inheritance Feed Name' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Test Atom 1.0 Name' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<author>
			<name>Item Author</name>
		</author>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Atom 1.0 Inheritance Source Name' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<source>
			<author>
				<name>Item Author</name>
			</author>
		</source>
	</entry>
</feed>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.90 Atom 0.3 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.90 Atom 1.0 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.90 DC 1.0 Creator' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.90 DC 1.1 Creator' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Name' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Name' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Creator' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Creator' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Name' => [
<<<EOT
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Name' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland DC 1.0 Creator' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.91-Userland DC 1.1 Creator' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.92 Atom 0.3 Name' => [
<<<EOT
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.92 Atom 1.0 Name' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.92 DC 1.0 Creator' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 0.92 DC 1.1 Creator' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 1.0 Atom 0.3 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 1.0 Atom 1.0 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:author>
			<a:name>Item Author</a:name>
		</a:author>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 1.0 DC 1.0 Creator' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 1.0 DC 1.1 Creator' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<item>
		<dc:creator>Item Author</dc:creator>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 2.0 Atom 0.3 Name' => [
<<<EOT
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 2.0 Atom 1.0 Name' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:author>
				<a:name>Item Author</a:name>
			</a:author>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 2.0 Author' => [
<<<EOT
<rss version="2.0">
	<channel>
		<item>
			<author>example@example.com (Item Author)</author>
		</item>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 2.0 DC 1.0 Creator' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
            'Test RSS 2.0 DC 1.1 Creator' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<item>
			<dc:creator>Item Author</dc:creator>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Author',
            ],
        ];
    }

    /**
     * @dataProvider getAuthorNameDataProvider
     */
    public function test_get_name_from_author(string $data, ?string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        $this->assertInstanceOf(Item::class, $item);

        $author = $item->get_author();
        $this->assertInstanceOf(Author::class, $author);

        $this->assertSame($expected, $author->get_name());
    }

    /**
     * @return array<array{string, string}>
     */
    public function getContributorNameDataProvider(): array
    {
        return [
            'Test Atom 0.3 Name' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<entry>
		<contributor>
			<name>Item Contributor</name>
		</contributor>
	</entry>
</feed>
EOT
                ,
                'Item Contributor',
            ],
            'Test Atom 1.0 Name' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<entry>
		<contributor>
			<name>Item Contributor</name>
		</contributor>
	</entry>
</feed>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.90 Atom 0.3 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.90 Atom 1.0 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Name' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Name' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Name' => [
<<<EOT
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Name' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.92 Atom 0.3 Name' => [
<<<EOT
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 0.92 Atom 1.0 Name' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 1.0 Atom 0.3 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 1.0 Atom 1.0 Name' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<item>
		<a:contributor>
			<a:name>Item Contributor</a:name>
		</a:contributor>
	</item>
</rdf:RDF>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 2.0 Atom 0.3 Name' => [
<<<EOT
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
            'Test RSS 2.0 Atom 1.0 Name' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<item>
			<a:contributor>
				<a:name>Item Contributor</a:name>
			</a:contributor>
		</item>
	</channel>
</rss>
EOT
                ,
                'Item Contributor',
            ],
        ];
    }

    /**
     * @dataProvider getContributorNameDataProvider
     */
    public function test_get_name_from_contributor(string $data, string $expected): void
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $item = $feed->get_item(0);
        $this->assertInstanceOf(Item::class, $item);

        $author = $item->get_contributor();
        $this->assertInstanceOf(Author::class, $author);

        $this->assertSame($expected, $author->get_name());
    }
}

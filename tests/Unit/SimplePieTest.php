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
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\FileWithRedirectMock;
use Yoast\PHPUnitPolyfills\Polyfills\ExpectPHPException;

class SimplePieTest extends TestCase
{
    use ExpectPHPException;

    public function testNamespacedClassExists()
    {
        $this->assertTrue(class_exists('SimplePie\SimplePie'));
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('SimplePie'));
    }

    /**
     * Run a test using a sprintf template and data
     *
     * @param string $template
     */
    private function createFeedWithTemplate($template, $data)
    {
        if (!is_array($data)) {
            $data = [$data];
        }
        $xml = vsprintf($template, $data);
        $feed = new SimplePie();
        $feed->set_raw_data($xml);
        $feed->enable_cache(false);
        $feed->init();

        return $feed;
    }

    public static function titleDataProvider()
    {
        return [
            ['Feed Title', 'Feed Title'],

            // RSS Profile tests
            ['AT&amp;T', 'AT&amp;T'],
            ['AT&#x26;T', 'AT&amp;T'],
            ["Bill &amp; Ted's Excellent Adventure", "Bill &amp; Ted's Excellent Adventure"],
            ["Bill &#x26; Ted's Excellent Adventure", "Bill &amp; Ted's Excellent Adventure"],
            ['The &amp; entity', 'The &amp; entity'],
            ['The &#x26; entity', 'The &amp; entity'],
            ['The &amp;amp; entity', 'The &amp;amp; entity'],
            ['The &#x26;amp; entity', 'The &amp;amp; entity'],
            ['I &lt;3 Phil Ringnalda', 'I &lt;3 Phil Ringnalda'],
            ['I &#x3C;3 Phil Ringnalda', 'I &lt;3 Phil Ringnalda'],
            ['A &lt; B', 'A &lt; B'],
            ['A &#x3C; B', 'A &lt; B'],
            ['A&lt;B', 'A&lt;B'],
            ['A&#x3C;B', 'A&lt;B'],
            ["Nice &lt;gorilla&gt; what's he weigh?", "Nice &lt;gorilla&gt; what's he weigh?"],
            ["Nice &#x3C;gorilla&gt; what's he weigh?", "Nice &lt;gorilla&gt; what's he weigh?"],
        ];
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20($title, $expected)
    {
        $data =
'<rss version="2.0">
	<channel>
		<title>%s</title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithDC10($title, $expected)
    {
        $data =
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>%s</dc:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithDC11($title, $expected)
    {
        $data =
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>%s</dc:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithAtom03($title, $expected)
    {
        $data =
'<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>%s</a:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithAtom10($title, $expected)
    {
        $data =
'<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>%s</a:title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * Based on a test from old bug 18
     *
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithImageTitle($title, $expected)
    {
        $data =
'<rss version="2.0">
	<channel>
		<title>%s</title>
		<image>
			<title>Image title</title>
		</image>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    /**
     * Based on a test from old bug 18
     *
     * @dataProvider titleDataProvider
     */
    public function testTitleRSS20WithImageTitleReversed($title, $expected)
    {
        $data =
'<rss version="2.0">
	<channel>
		<image>
			<title>Image title</title>
		</image>
		<title>%s</title>
	</channel>
</rss>';
        $feed = $this->createFeedWithTemplate($data, $title);
        $this->assertSame($expected, $feed->get_title());
    }

    public function testItemWithEmptyContent()
    {
        $data =
'<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<item>
			<description>%s</description>
			<content:encoded><![CDATA[ <script> ]]></content:encoded>
		</item>
	</channel>
</rss>';
        $content = 'item description';
        $feed = $this->createFeedWithTemplate($data, $content);
        $item = $feed->get_item();
        $this->assertSame($content, $item->get_content());
    }

    public function testLegacyCallOfSetCacheClass()
    {
        if (version_compare(PHP_VERSION, '8.0', '<')) {
            $this->expectException('SimplePie\Tests\Fixtures\Exception\SuccessException');
        } else {
            // PHP 8.0 will throw a `TypeError` for trying to call a non-static method statically.
            // This is no longer supported in PHP, so there is just no way to continue to provide BC
            // for the old non-static cache methods.
            $this->expectError();
        }

        $feed = new SimplePie();
        $feed->set_cache_class('SimplePie\Tests\Fixtures\Cache\LegacyCacheMock');
        $feed->get_registry()->register('File', 'SimplePie\Tests\Fixtures\FileMock');
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }

    public function testDirectOverrideNew()
    {
        $this->expectException('SimplePie\Tests\Fixtures\Exception\SuccessException');

        $feed = new SimplePie();
        $feed->get_registry()->register('Cache', 'SimplePie\Tests\Fixtures\Cache\NewCacheMock');
        $feed->get_registry()->register('File', 'SimplePie\Tests\Fixtures\FileMock');
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();
    }

    public function testDirectOverrideLegacy()
    {
        $feed = new SimplePie();
        $feed->get_registry()->register('File', FileWithRedirectMock::class);
        $feed->enable_cache(false);
        $feed->set_feed_url('http://example.com/feed/');

        $feed->init();

        $this->assertSame('https://example.com/feed/2019-10-07', $feed->subscribe_url());
        $this->assertSame('https://example.com/feed/', $feed->subscribe_url(true));
    }

    public function getCopyrightDataProvider()
    {
        return [
            'Test Atom 0.3 DC 1.0' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test Atom 0.3 DC 1.1' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test Atom 1.0 DC 1.0' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test Atom 1.0 DC 1.1' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:rights>Example Copyright Information</dc:rights>
</feed>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test Atom 1.0 Rights' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<rights>Example Copyright Information</rights>
</feed>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.90 Atom 1.0 Rights' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rdf:RDF>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.90 DC 1.0 Rights' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.90 DC 1.1 Rights' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Rights' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Rights' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Rights' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Netscape Copyright' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Rights' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland DC 1.0 Rights' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland DC 1.0 Rights' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.91-Userland Copyright' => [
<<<EOT
<rss version="0.91">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 Atom 1.0 Rights' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 DC 1.0 Rights' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 DC 1.1 Rights' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 0.92 Copyright' => [
<<<EOT
<rss version="0.92">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 1.0 Atom 1.0 Rights' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rdf:RDF>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 1.0 DC 1.0 Rights' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 1.0 DC 1.1 Rights' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rdf:RDF>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 Atom 1.0 Rights' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:rights>Example Copyright Information</a:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 DC 1.0 Rights' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 DC 1.1 Rights' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:rights>Example Copyright Information</dc:rights>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
            'Test RSS 2.0 Copyright' => [
<<<EOT
<rss version="2.0">
	<channel>
		<copyright>Example Copyright Information</copyright>
	</channel>
</rss>
EOT
                ,
                'Example Copyright Information',
            ],
        ];
    }

    /**
     * @dataProvider getCopyrightDataProvider
     */
    public function test_get_copyright($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_copyright());
    }

    public function getDescriptionDataProvider()
    {
        return [
            'Test Atom 0.3 DC 1.0 Description' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:description>Feed Description</dc:description>
</feed>
EOT
                ,
                'Feed Description',
            ],
            'Test Atom 0.3 DC 1.1 Description' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:description>Feed Description</dc:description>
</feed>
EOT
                ,
                'Feed Description',
            ],
            'Test Atom 0.3 Tagline' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<tagline>Feed Description</tagline>
</feed>
EOT
                ,
                'Feed Description',
            ],
            'Test Atom 1.0 DC 1.0 Description' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:description>Feed Description</dc:description>
</feed>
EOT
                ,
                'Feed Description',
            ],
            'Test Atom 1.0 DC 1.1 Description' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:description>Feed Description</dc:description>
</feed>
EOT
                ,
                'Feed Description',
            ],
            'Test Atom 1.0 Subtitle' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<subtitle>Feed Description</subtitle>
</feed>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 Atom 0.3 Tagline' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 Atom 1.0 Subtitle' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 DC 1.0 Description' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 DC 1.1 Description' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.90 Description' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<description>Feed Description</description>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Tagline' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Subtitle' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Description' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Description' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Netscape Description' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Tagline' => [
<<<EOT
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Subtitle' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland DC 1.0 Description' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland DC 1.1 Description' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.91-Userland Description' => [
<<<EOT
<rss version="0.91">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 Atom 0.3 Tagline' => [
<<<EOT
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 Atom 1.0 Subtitle' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 DC 1.0 Description' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 DC 1.1 Description' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 0.92 Description' => [
<<<EOT
<rss version="0.92">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 Atom 0.3 Tagline' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 Atom 1.0 Subtitle' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 DC 1.0 Description' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 DC 1.1 Description' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 1.0 Description' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<description>Feed Description</description>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 20 Atom 0.3 Tagline' => [
<<<EOT
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:tagline>Feed Description</a:tagline>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 20 Atom 1.0 Subtitle' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:subtitle>Feed Description</a:subtitle>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 20 DC 1.0 Description' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 20 DC 1.1 Description' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:description>Feed Description</dc:description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
            'Test RSS 20 Description' => [
<<<EOT
<rss version="2.0">
	<channel>
		<description>Feed Description</description>
	</channel>
</rss>
EOT
                ,
                'Feed Description',
            ],
        ];
    }

    /**
     * @dataProvider getDescriptionDataProvider
     */
    public function test_get_description($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_description());
    }

    public function getImageHeightDataProvider()
    {
        return [
            'Test Atom 1.0 Icon Default' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>'
EOT				,
                null,
            ],
            'Test Atom 1.0 Logo Default' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>'
EOT				,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Icon Default' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>'
EOT				,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Logo Default' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>'
EOT				,
                null,
            ],
            'Test RSS 0.90 URL Default' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>'
EOT				,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Icon Default' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Logo Default' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Height' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 0.91-Netscape URL Default' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                31.0,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Icon Default' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Logo Default' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Userland Height' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 0.91-Userland URL Default' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                31.0,
            ],
            'Test RSS 0.92 Atom 1.0 Icon Default' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.92 Atom 1.0 Logo Default' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.92 Height' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 0.92 URL Default' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                31.0,
            ],
            'Test RSS 1.0 Atom 1.0 Icon Default' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 1.0 Atom 1.0 Logo Default' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 1.0 URL Default' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Icon Default' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Logo Default' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 2.0 Height' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<height>100</height>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 2.0 URL Default' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                31.0,
            ],
        ];
    }

    /**
     * @dataProvider getImageHeightDataProvider
     */
    public function test_get_image_height($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_height());
    }

    public function getImageLinkDataProvider()
    {
        return [
            'Test RSS 0.90 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<link>http://example.com/</link>
	</image>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Link' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Link' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Link' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<link>http://example.com/</link>
	</image>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Link' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<link>http://example.com/</link>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
        ];
    }

    /**
     * @dataProvider getImageLinkDataProvider
     */
    public function test_get_image_link($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_link());
    }

    public function getImageTitleDataProvider()
    {
        return [
            'Test RSS 0.90 DC 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.90 DC 1.1 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.90 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<title>Image Title</title>
	</image>
</rdf:RDF>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Netscape Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Userland DC 1.0 Title' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Userland DC 1.1 Title' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.91-Userland Title' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.92 DC 1.0 Title' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.92 DC 1.1 Title' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 0.92 Title' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 1.0 DC 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 1.0 DC 1.1 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<image>
		<dc:title>Image Title</dc:title>
	</image>
</rdf:RDF>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<title>Image Title</title>
	</image>
</rdf:RDF>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 2.0 DC 1.0 Title' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 2.0 DC 1.1 Title' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<image>
			<dc:title>Image Title</dc:title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
            'Test RSS 2.0 Title' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<title>Image Title</title>
		</image>
	</channel>
</rss>
EOT
                ,
                'Image Title',
            ],
        ];
    }

    /**
     * @dataProvider getImageTitleDataProvider
     */
    public function test_get_image_title($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_title());
    }

    public function getImageUrlDataProvider()
    {
        return [
            'Test Atom 1.0 Icon' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Logo' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 1.0 Icon' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 1.0 Logo' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 URL' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Icon' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Logo' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape URL' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Icon' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Logo' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland URL' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 1.0 Icon' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 1.0 Logo' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 URL' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 1.0 Icon' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 1.0 Logo' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 URL' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 1.0 Icon' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 1.0 Logo' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 URL' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
        ];
    }

    /**
     * @dataProvider getImageUrlDataProvider
     */
    public function test_get_image_url($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_url());
    }

    public function getImageWidthDataProvider()
    {
        return [
            'Test Atom 1.0 Icon Default' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<icon>http://example.com/</icon>
</feed>
EOT
                ,
                null,
            ],
            'Test Atom 1.0 Logo Default' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<logo>http://example.com/</logo>
</feed>
EOT
                ,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Icon' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 0.90 Atom 1.0 Logo' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 0.90' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Icon' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Logo' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Netscape' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                88.0,
            ],
            'Test RSS 0.91-Netscape Width' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Icon' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Userland Atom 1.0 Logo' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.91-Userland' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                88.0,
            ],
            'Test RSS 0.91-Userland Width' => [
<<<EOT
<rss version="0.91">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 0.92 Atom 1.0 Icon' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.92 Atom 1.0 Logo' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 0.92' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                88.0,
            ],
            'Test RSS 0.92 Width' => [
<<<EOT
<rss version="0.92">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
            'Test RSS 1.0 Atom 1.0 Icon' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 1.0 Atom 1.0 Logo' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 1.0' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<image>
		<url>http://example.com/</url>
	</image>
</rdf:RDF>
EOT
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Icon' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:icon>http://example.com/</a:icon>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 2.0 Atom 1.0 Logo' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:logo>http://example.com/</a:logo>
	</channel>
</rss>
EOT
                ,
                null,
            ],
            'Test RSS 2.0' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<url>http://example.com/</url>
		</image>
	</channel>
</rss>
EOT
                ,
                88.0,
            ],
            'Test RSS 2.0 Width' => [
<<<EOT
<rss version="2.0">
	<channel>
		<image>
			<width>100</width>
		</image>
	</channel>
</rss>
EOT
                ,
                100.0,
            ],
        ];
    }

    /**
     * @dataProvider getImageWidthDataProvider
     */
    public function test_get_image_width($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_image_width());
    }

    public function getLanguageDataProvider()
    {
        return [
            'Test Atom 0.3 DC 1.0 Language' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:language>en-GB</dc:language>
</feed>
EOT
                ,
                'en-GB',
            ],
            'Test Atom 0.3 DC 1.1 Language' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:language>en-GB</dc:language>
</feed>
EOT
                ,
                'en-GB',
            ],
            'Test Atom 0.3 xmllang' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xml:lang="en-GB">
	<title>Feed Title</title>
</feed>
EOT
                ,
                'en-GB',
            ],
            'Test Atom 1.0 DC 1.0 Language' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:language>en-GB</dc:language>
</feed>
EOT
                ,
                'en-GB',
            ],
            'Test Atom 1.0 DC 1.1 Language' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:language>en-GB</dc:language>
</feed>
EOT
                ,
                'en-GB',
            ],
            'Test Atom 1.0 xmllang' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-GB">
	<title>Feed Title</title>
</feed>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.90 DC 1.0 Language' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.90 DC 1.1 Language' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Language' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Language' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Netscape Language' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Userland DC 1.0 Language' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Userland DC 1.1 Language' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.91-Userland Language' => [
<<<EOT
<rss version="0.91">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.92 DC 1.0 Language' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.92 DC 1.1 Language' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 0.92 Language' => [
<<<EOT
<rss version="0.92">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 1.0 DC 1.0 Language' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 1.0 DC 1.1 Language' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rdf:RDF>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 2.0 DC 1.0 Language' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 2.0 DC 1.1 Language' => [
<<<EOT
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:language>en-GB</dc:language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
            'Test RSS 2.0 Language' => [
<<<EOT
<rss version="2.0">
	<channel>
		<language>en-GB</language>
	</channel>
</rss>
EOT
                ,
                'en-GB',
            ],
        ];
    }

    /**
     * @dataProvider getLanguageDataProvider
     */
    public function test_get_language($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_language());
    }

    public function getLinkDataProvider()
    {
        return [
            'Test Atom 0.3 Link' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<link href="http://example.com/"/>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test Atom 0.3 Link Alternate' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<link href="http://example.com/" rel="alternate"/>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Link' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/"/>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Link Absolute IRI' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/" rel="http://www.iana.org/assignments/relation/alternate"/>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test Atom 1.0 Link Relative IRI' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<link href="http://example.com/" rel="alternate"/>
</feed>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 0.3 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Atom 1.0 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.90 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Link' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Link' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Netscape Link' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Link' => [
<<<EOT
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Link' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.91-Userland Link' => [
<<<EOT
<rss version="0.91">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 0.3 Link' => [
<<<EOT
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Atom 1.0 Link' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 0.92 Link' => [
<<<EOT
<rss version="0.92">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 0.3 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Atom 1.0 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 1.0 Link' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rdf:RDF>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 0.3 Link' => [
<<<EOT
<rss version="2.0" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Atom 1.0 Link' => [
<<<EOT
<rss version="2.0" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:link href="http://example.com/"/>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
            'Test RSS 2.0 Link' => [
<<<EOT
<rss version="2.0">
	<channel>
		<link>http://example.com/</link>
	</channel>
</rss>
EOT
                ,
                'http://example.com/',
            ],
        ];
    }

    /**
     * @dataProvider getLinkDataProvider
     */
    public function test_get_link($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_link());
    }

    public function getTitleDataProvider()
    {
        return [
            'Test Atom 0.3 DC 1.0 Title' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:title>Feed Title</dc:title>
</feed>
EOT
                ,
                'Feed Title',
            ],
            'Test Atom 0.3 DC 1.1 Title' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:title>Feed Title</dc:title>
</feed>
EOT
                ,
                'Feed Title',
            ],
            'Test Atom 0.3 Title' => [
<<<EOT
<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<title>Feed Title</title>
</feed>
EOT
                ,
                'Feed Title',
            ],
            'Test Atom 1.0 DC 1.0 Title' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<dc:title>Feed Title</dc:title>
</feed>
EOT
                ,
                'Feed Title',
            ],
            'Test Atom 1.0 DC 1.1 Title' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<dc:title>Feed Title</dc:title>
</feed>
EOT
                ,
                'Feed Title',
            ],
            'Test Atom 1.0 Title' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Feed Title</title>
</feed>
EOT
                ,
                'Feed Title',
            ],
            'Test Bug 16 Test 0' => [
<<<EOT
<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN"
"http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<title>Feed with DOCTYPE</title>
	</channel>
</rss>
EOT
                ,
                'Feed with DOCTYPE',
            ],
            'Test Bug 174 Test 0' => [
<<<EOT
<?xml version = "1.0" encoding = "UTF-8" ?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Spaces in prolog</title>
</feed>
EOT
                ,
                'Spaces in prolog',
            ],
            'Test Bug 20 Test 0' => [
<<<EOT
<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title>Non-default namespace</a:title>
</a:feed>
EOT
                ,
                'Non-default namespace',
            ],
            'Test Bug 20 Test 1' => [
<<<EOT
<a:feed xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://www.w3.org/1999/xhtml">
	<a:title type="xhtml"><div>Non-default namespace</div></a:title>
</a:feed>
EOT
                ,
                'Non-default namespace',
            ],
            'Test Bug 20 Test 2' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:h="http://www.w3.org/1999/xhtml">
	<title type="xhtml"><h:div>Non-default namespace</h:div></title>
</feed>
EOT
                ,
                'Non-default namespace',
            ],
            'Test Bug 272 Test 0' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Ampersand: <![CDATA[&]]></title>
</feed>
EOT
                ,
                'Ampersand: &amp;',
            ],
            'Test Bug 272 Test 1' => [
<<<EOT
<feed xmlns="http://www.w3.org/2005/Atom">
	<title><![CDATA[&]]>: Ampersand</title>
</feed>
EOT
                ,
                '&amp;: Ampersand',
            ],
            'Test RSS 0.90 Atom 0.3 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 Atom 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 DC 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 DC 1.1 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.90 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://my.netscape.com/rdf/simple/0.9/">
	<channel>
		<title>Feed Title</title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape Atom 0.3 Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape Atom 1.0 Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape DC 1.0 Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape DC 1.1 Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Netscape Title' => [
<<<EOT
<!DOCTYPE rss SYSTEM "http://my.netscape.com/publish/formats/rss-0.91.dtd">
<rss version="0.91">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland Atom 0.3 Title' => [
<<<EOT
<rss version="0.91" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland Atom 1.0 Title' => [
<<<EOT
<rss version="0.91" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland DC 1.0 Title' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland DC 1.1 Title' => [
<<<EOT
<rss version="0.91" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.91-Userland Title' => [
<<<EOT
<rss version="0.91">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 Atom 0.3 Title' => [
<<<EOT
<rss version="0.92" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 Atom 1.0 Title' => [
<<<EOT
<rss version="0.92" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 DC 1.0 Title' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 DC 1.1 Title' => [
<<<EOT
<rss version="0.92" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 0.92 Title' => [
<<<EOT
<rss version="0.92">
	<channel>
		<title>Feed Title</title>
	</channel>
</rss>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 Atom 0.3 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://purl.org/atom/ns#">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 Atom 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:a="http://www.w3.org/2005/Atom">
	<channel>
		<a:title>Feed Title</a:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 DC 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.0/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 DC 1.1 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<dc:title>Feed Title</dc:title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
            'Test RSS 1.0 Title' => [
<<<EOT
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
	<channel>
		<title>Feed Title</title>
	</channel>
</rdf:RDF>
EOT
                ,
                'Feed Title',
            ],
        ];
    }

    /**
     * @dataProvider getTitleDataProvider
     */
    public function test_get_title($data, $expected)
    {
        $feed = new SimplePie();
        $feed->set_raw_data($data);
        $feed->enable_cache(false);
        $feed->init();

        $this->assertSame($expected, $feed->get_title());
    }
}

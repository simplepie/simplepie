<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit;

use DOMDocument;
use DOMXPath;
use PHPUnit\Framework\TestCase;
use SimplePie\File;
use SimplePie\Locator;
use SimplePie\Registry;
use SimplePie\SimplePie;
use SimplePie\Tests\Fixtures\FileMock;
use Yoast\PHPUnitPolyfills\Polyfills\ExpectPHPException;

class LocatorTest extends TestCase
{
    use ExpectPHPException;

    public function testNamespacedClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie\Locator'));
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists('SimplePie_Locator'));
    }

    /**
     * @return array<array{string}>
     */
    public function feedmimetypes(): array
    {
        return [
            ['application/rss+xml'],
            ['application/rdf+xml'],
            ['text/rdf'],
            ['application/atom+xml'],
            ['text/xml'],
            ['application/xml'],
        ];
    }
    /**
     * @dataProvider feedmimetypes
     */
    public function testAutodiscoverOnFeed(string $mime): void
    {
        $data = new FileMock('http://example.com/feed.xml');
        $data->headers['content-type'] = $mime;

        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);
        $this->assertSame($data, $feed);
    }

    public function testInvalidMIMEType(): void
    {
        $data = new FileMock('http://example.com/feed.xml');
        $data->headers['content-type'] = 'application/pdf';

        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);
        $this->assertSame(null, $feed);
    }

    public function testDirectNoDOM(): void
    {
        $data = new FileMock('http://example.com/feed.xml');

        $registry = new Registry();
        $locator = new Locator($data, 0, null, -1);
        $locator->dom = null;
        $locator->set_registry($registry);

        $this->assertTrue($locator->is_feed($data));
        $this->assertSame($data, $locator->find(SimplePie::LOCATOR_ALL, $found));
    }

    public function testFailDiscoveryNoDOM(): void
    {
        $this->expectException(\SimplePie\Exception::class);

        $data = new FileMock('http://example.com/feed.xml');
        $data->headers['content-type'] = 'text/html';
        $data->body = '<!DOCTYPE html><html><body>Hi!</body></html>';

        $registry = new Registry();
        $locator = new Locator($data, 0, null, -1);
        $locator->dom = null;
        $locator->set_registry($registry);

        $this->assertFalse($locator->is_feed($data));
        $this->assertFalse($locator->find(SimplePie::LOCATOR_ALL, $found));
    }

    /**
     * Tests from Firefox
     *
     * Tests are used under the LGPL license, see file for license
     * information
     *
     * @return iterable<array{File}>
     */
    public function firefoxTestDataProvider(): iterable
    {
        $data = new File(dirname(__DIR__) . '/data/fftests.html');
        $data->headers = ['content-type' => 'text/html'];
        $data->method = SimplePie::FILE_SOURCE_REMOTE;
        $data->url = 'http://example.com/';

        yield [$data];
    }

    /**
     * @dataProvider firefoxTestDataProvider
     */
    public function test_from_file(File $data): void
    {
        $locator = new Locator($data, 0, null, -1);

        $registry = new Registry();
        $registry->register(File::class, FileMock::class);
        $locator->set_registry($registry);

        $expected = [];
        $document = new DOMDocument();
        $document->loadHTML($data->body);
        $xpath = new DOMXPath($document);
        foreach ($xpath->query('//link') as $element) {
            /** @var \DOMElement $element */
            $expected[] = 'http://example.com' . $element->getAttribute('href');
        }
        //$expected = SimplePie_Misc::get_element('link', $data->body);

        $feed = $locator->find(SimplePie::LOCATOR_ALL, $all);
        $this->assertFalse($locator->is_feed($data), 'HTML document not be a feed itself');
        $this->assertInstanceOf(FileMock::class, $feed);
        $success = array_filter($expected, [get_class($this), 'filter_success']);

        $found = array_map([get_class($this), 'map_url_file'], $all);
        $this->assertSame($success, $found);
    }

    protected function filter_success(string $url): bool
    {
        return (stripos($url, 'bogus') === false);
    }

    protected function map_url_file(File $file): string
    {
        return $file->url;
    }
}

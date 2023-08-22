<?php

// SPDX-FileCopyrightText: 2008-2016 Sam Sneddon
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

use Yoast\PHPUnitPolyfills\Polyfills\ExpectPHPException;

/**
 * IRI test cases
 */
class IRITest extends PHPUnit\Framework\TestCase
{
    use ExpectPHPException;

    /**
     * @return array<array{string, string}>
     */
    public static function rfc3986_tests(): array
    {
        return [
            // Normal
            ['g:h', 'g:h'],
            ['g', 'http://a/b/c/g'],
            ['./g', 'http://a/b/c/g'],
            ['g/', 'http://a/b/c/g/'],
            ['/g', 'http://a/g'],
            ['//g', 'http://g/'],
            ['?y', 'http://a/b/c/d;p?y'],
            ['g?y', 'http://a/b/c/g?y'],
            ['#s', 'http://a/b/c/d;p?q#s'],
            ['g#s', 'http://a/b/c/g#s'],
            ['g?y#s', 'http://a/b/c/g?y#s'],
            [';x', 'http://a/b/c/;x'],
            ['g;x', 'http://a/b/c/g;x'],
            ['g;x?y#s', 'http://a/b/c/g;x?y#s'],
            ['', 'http://a/b/c/d;p?q'],
            ['.', 'http://a/b/c/'],
            ['./', 'http://a/b/c/'],
            ['..', 'http://a/b/'],
            ['../', 'http://a/b/'],
            ['../g', 'http://a/b/g'],
            ['../..', 'http://a/'],
            ['../../', 'http://a/'],
            ['../../g', 'http://a/g'],
            // Abnormal
            ['../../../g', 'http://a/g'],
            ['../../../../g', 'http://a/g'],
            ['/./g', 'http://a/g'],
            ['/../g', 'http://a/g'],
            ['g.', 'http://a/b/c/g.'],
            ['.g', 'http://a/b/c/.g'],
            ['g..', 'http://a/b/c/g..'],
            ['..g', 'http://a/b/c/..g'],
            ['./../g', 'http://a/b/g'],
            ['./g/.', 'http://a/b/c/g/'],
            ['g/./h', 'http://a/b/c/g/h'],
            ['g/../h', 'http://a/b/c/h'],
            ['g;x=1/./y', 'http://a/b/c/g;x=1/y'],
            ['g;x=1/../y', 'http://a/b/c/y'],
            ['g?y/./x', 'http://a/b/c/g?y/./x'],
            ['g?y/../x', 'http://a/b/c/g?y/../x'],
            ['g#s/./x', 'http://a/b/c/g#s/./x'],
            ['g#s/../x', 'http://a/b/c/g#s/../x'],
            ['http:g', 'http:g'],
        ];
    }

    /**
     * @dataProvider rfc3986_tests
     */
    public function testStringRFC3986(string $relative, string $expected): void
    {
        $base = new SimplePie_IRI('http://a/b/c/d;p?q');
        $this->assertSame($expected, SimplePie_IRI::absolutize($base, $relative)->get_iri());
    }

    /**
     * @dataProvider rfc3986_tests
     */
    public function testObjectRFC3986(string $relative, string $expected): void
    {
        $base = new SimplePie_IRI('http://a/b/c/d;p?q');
        $expected = new SimplePie_IRI($expected);
        $this->assertEquals($expected, SimplePie_IRI::absolutize($base, $relative));
    }

    /**
     * @dataProvider rfc3986_tests
     */
    public function testBothStringRFC3986(string $relative, string $expected): void
    {
        $base = 'http://a/b/c/d;p?q';
        $this->assertSame($expected, SimplePie_IRI::absolutize($base, $relative)->get_iri());
        $this->assertSame($expected, (string) SimplePie_IRI::absolutize($base, $relative));
    }

    /**
     * @return array<array{string, string, string}>
     */
    public static function sp_tests(): array
    {
        return [
            ['http://a/b/c/d', 'f%0o', 'http://a/b/c/f%250o'],
            ['http://a/b/', 'c', 'http://a/b/c'],
            ['http://a/', 'b', 'http://a/b'],
            ['http://a/', '/b', 'http://a/b'],
            ['http://a/b', 'c', 'http://a/c'],
            ['http://a/b/', "c\x0Ad", 'http://a/b/c%0Ad'],
            ['http://a/b/', "c\x0A\x0B", 'http://a/b/c%0A%0B'],
            ['http://a/b/c', '//0', 'http://0/'],
            ['http://a/b/c', '0', 'http://a/b/0'],
            ['http://a/b/c', '?0', 'http://a/b/c?0'],
            ['http://a/b/c', '#0', 'http://a/b/c#0'],
            ['http://0/b/c', 'd', 'http://0/b/d'],
            ['http://a/b/c?0', 'd', 'http://a/b/d'],
            ['http://a/b/c#0', 'd', 'http://a/b/d'],
            ['http://example.com', '//example.net', 'http://example.net/'],
            ['http:g', 'a', 'http:a'],
        ];
    }

    /**
     * @dataProvider sp_tests
     */
    public function testStringSP(string $base, string $relative, string $expected): void
    {
        $base = new SimplePie_IRI($base);
        $this->assertSame($expected, SimplePie_IRI::absolutize($base, $relative)->get_iri());
    }

    /**
     * @dataProvider sp_tests
     */
    public function testObjectSP(string $base, string $relative, string $expected): void
    {
        $base = new SimplePie_IRI($base);
        $expected = new SimplePie_IRI($expected);
        $this->assertEquals($expected, SimplePie_IRI::absolutize($base, $relative));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function query_tests(): array
    {
        return [
            ['a=b&c=d', 'http://example.com/?a=b&c=d'],
            ['a=b%26c=d', 'http://example.com/?a=b%26c=d'],
            ['url=http%3A%2F%2Fexample.com%3Fa%3Db', 'http://example.com/?url=http%3A%2F%2Fexample.com%3Fa%3Db'],
            ['url=http%3A%2F%2Fexample.com%3Fa%3Db%26c%3Dd', 'http://example.com/?url=http%3A%2F%2Fexample.com%3Fa%3Db%26c%3Dd'],
        ];
    }

    /**
     * @dataProvider query_tests
     */
    public function testStringQuery(string $query, string $expected): void
    {
        $base = new SimplePie_IRI('http://example.com/');
        $base->set_query($query);
        $this->assertSame($expected, $base->get_iri());
    }

    /**
     * @dataProvider query_tests
     */
    public function testObjectQuery(string $query, string $expected): void
    {
        $base = new SimplePie_IRI('http://example.com/');
        $base->set_query($query);
        $expected = new SimplePie_IRI($expected);
        $this->assertEquals($expected, $base);
    }

    /**
     * @return array<array{string, string, string}>
     */
    public static function absolutize_tests(): array
    {
        return [
            ['http://example.com/', 'foo/111:bar', 'http://example.com/foo/111:bar'],
            ['http://example.com/#foo', '', 'http://example.com/'],
        ];
    }

    /**
     * @dataProvider absolutize_tests
     */
    public function testAbsolutizeString(string $base, string $relative, string $expected): void
    {
        $base = new SimplePie_IRI($base);
        $this->assertSame($expected, SimplePie_IRI::absolutize($base, $relative)->get_iri());
    }

    /**
     * @dataProvider absolutize_tests
     */
    public function testAbsolutizeObject(string $base, string $relative, string $expected): void
    {
        $base = new SimplePie_IRI($base);
        $expected = new SimplePie_IRI($expected);
        $this->assertEquals($expected, SimplePie_IRI::absolutize($base, $relative));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function normalization_tests(): array
    {
        return [
            ['example://a/b/c/%7Bfoo%7D', 'example://a/b/c/%7Bfoo%7D'],
            ['eXAMPLE://a/./b/../b/%63/%7bfoo%7d', 'example://a/b/c/%7Bfoo%7D'],
            ['example://%61/', 'example://a/'],
            ['example://%41/', 'example://a/'],
            ['example://A/', 'example://a/'],
            ['example://a/', 'example://a/'],
            ['example://%25A/', 'example://%25a/'],
            ['HTTP://EXAMPLE.com/', 'http://example.com/'],
            ['http://example.com/', 'http://example.com/'],
            ['http://example.com:', 'http://example.com/'],
            ['http://example.com:80', 'http://example.com/'],
            ['http://@example.com', 'http://@example.com/'],
            ['http://', 'http://'],
            ['http://example.com?', 'http://example.com/?'],
            ['http://example.com#', 'http://example.com/#'],
            ['https://example.com/', 'https://example.com/'],
            ['https://example.com:', 'https://example.com/'],
            ['https://@example.com', 'https://@example.com/'],
            ['https://example.com?', 'https://example.com/?'],
            ['https://example.com#', 'https://example.com/#'],
            ['file://localhost/foobar', 'file:/foobar'],
            ['http://[0:0:0:0:0:0:0:1]', 'http://[::1]/'],
            ['http://[2001:db8:85a3:0000:0000:8a2e:370:7334]', 'http://[2001:db8:85a3::8a2e:370:7334]/'],
            ['http://[0:0:0:0:0:ffff:c0a8:a01]', 'http://[::ffff:c0a8:a01]/'],
            ['http://[ffff:0:0:0:0:0:0:0]', 'http://[ffff::]/'],
            ['http://[::ffff:192.0.2.128]', 'http://[::ffff:192.0.2.128]/'],
            ['http://[invalid]', 'http:'],
            ['http://[0:0:0:0:0:0:0:1]:', 'http://[::1]/'],
            ['http://[0:0:0:0:0:0:0:1]:80', 'http://[::1]/'],
            ['http://[0:0:0:0:0:0:0:1]:1234', 'http://[::1]:1234/'],
            // Punycode decoding helps with normalisation of IRIs, but is not
            // needed for URIs, so we don't really care about it here
            //array('http://xn--tdali-d8a8w.lv', 'http://tūdaliņ.lv'),
            //array('http://t%C5%ABdali%C5%86.lv', 'http://tūdaliņ.lv'),
            ['http://Aa@example.com', 'http://Aa@example.com/'],
            ['http://example.com?Aa', 'http://example.com/?Aa'],
            ['http://example.com/Aa', 'http://example.com/Aa'],
            ['http://example.com#Aa', 'http://example.com/#Aa'],
            ['http://[0:0:0:0:0:0:0:0]', 'http://[::]/'],
            ['http:.', 'http:'],
            ['http:..', 'http:'],
            ['http:./', 'http:'],
            ['http:../', 'http:'],
            ['http://example.com/%3A', 'http://example.com/%3A'],
            ['http://example.com/:', 'http://example.com/:'],
            ['http://example.com/%C2', 'http://example.com/%C2'],
            ['http://example.com/%C2a', 'http://example.com/%C2a'],
            ['http://example.com/%C2%00', 'http://example.com/%C2%00'],
            ['http://example.com/%C3%A9', 'http://example.com/é'],
            ['http://example.com/%C3%A9%00', 'http://example.com/é%00'],
            ['http://example.com/%C3%A9cole', 'http://example.com/école'],
            ['http://example.com/%FF', 'http://example.com/%FF'],
            ["http://example.com/\xF3\xB0\x80\x80", 'http://example.com/%F3%B0%80%80'],
            ["http://example.com/\xF3\xB0\x80\x80%00", 'http://example.com/%F3%B0%80%80%00'],
            ["http://example.com/\xF3\xB0\x80\x80a", 'http://example.com/%F3%B0%80%80a'],
            ["http://example.com?\xF3\xB0\x80\x80", "http://example.com/?\xF3\xB0\x80\x80"],
            ["http://example.com?\xF3\xB0\x80\x80%00", "http://example.com/?\xF3\xB0\x80\x80%00"],
            ["http://example.com?\xF3\xB0\x80\x80a", "http://example.com/?\xF3\xB0\x80\x80a"],
            ["http://example.com/\xEE\x80\x80", 'http://example.com/%EE%80%80'],
            ["http://example.com/\xEE\x80\x80%00", 'http://example.com/%EE%80%80%00'],
            ["http://example.com/\xEE\x80\x80a", 'http://example.com/%EE%80%80a'],
            ["http://example.com?\xEE\x80\x80", "http://example.com/?\xEE\x80\x80"],
            ["http://example.com?\xEE\x80\x80%00", "http://example.com/?\xEE\x80\x80%00"],
            ["http://example.com?\xEE\x80\x80a", "http://example.com/?\xEE\x80\x80a"],
            ["http://example.com/\xC2", 'http://example.com/%C2'],
            ["http://example.com/\xC2a", 'http://example.com/%C2a'],
            ["http://example.com/\xC2\x00", 'http://example.com/%C2%00'],
            ["http://example.com/\xC3\xA9", 'http://example.com/é'],
            ["http://example.com/\xC3\xA9\x00", 'http://example.com/é%00'],
            ["http://example.com/\xC3\xA9cole", 'http://example.com/école'],
            ["http://example.com/\xFF", 'http://example.com/%FF'],
            ["http://example.com/\xFF%00", 'http://example.com/%FF%00'],
            ["http://example.com/\xFFa", 'http://example.com/%FFa'],
            ['http://example.com/%61', 'http://example.com/a'],
            ['http://example.com?%26', 'http://example.com/?%26'],
            ['http://example.com?%61', 'http://example.com/?a'],
            ['///', '///'],
        ];
    }

    /**
     * @dataProvider normalization_tests
     */
    public function testStringNormalization(string $input, string $output): void
    {
        $input = new SimplePie_IRI($input);
        $this->assertSame($output, $input->get_iri());
    }

    /**
     * @dataProvider normalization_tests
     */
    public function testObjectNormalization(string $input, string $output): void
    {
        $input = new SimplePie_IRI($input);
        $output = new SimplePie_IRI($output);
        $this->assertEquals($output, $input);
    }

    /**
     * @return array<array{string, string}>
     */
    public static function uri_tests(): array
    {
        return [
            ['http://example.com/%C3%A9cole', 'http://example.com/%C3%A9cole'],
            ['http://example.com/école', 'http://example.com/%C3%A9cole'],
            ["http://example.com/\xC3\xA9cole", 'http://example.com/%C3%A9cole'],
        ];
    }

    /**
     * @dataProvider uri_tests
     */
    public function testURIConversion(string $input, string $output): void
    {
        $input = new SimplePie_IRI($input);
        $this->assertSame($output, $input->get_uri());
    }

    /**
     * @return array<array{string, string}>
     */
    public static function equivalence_tests(): array
    {
        return [
            ['http://É.com', 'http://%C3%89.com'],
        ];
    }

    /**
     * @dataProvider equivalence_tests
     */
    public function testObjectEquivalence(string $input, string $output): void
    {
        $input = new SimplePie_IRI($input);
        $output = new SimplePie_IRI($output);
        $this->assertEquals($output, $input);
    }

    /**
     * @return array<array{string, string}>
     */
    public static function not_equivalence_tests(): array
    {
        return [
            ['http://example.com/foo/bar', 'http://example.com/foo%2Fbar'],
        ];
    }

    /**
     * @dataProvider not_equivalence_tests
     */
    public function testObjectNotEquivalence(string $input, string $output): void
    {
        $input = new SimplePie_IRI($input);
        $output = new SimplePie_IRI($output);
        $this->assertNotEquals($output, $input);
    }

    public function testInvalidAbsolutizeBase()
    {
        $this->assertFalse(SimplePie_IRI::absolutize('://not a URL', '../'));
    }

    public function testInvalidPathNoHost()
    {
        $iri = new SimplePie_IRI();
        $iri->scheme = 'http';
        $iri->path = '//test';
        $this->assertFalse($iri->is_valid());
    }

    public function testInvalidRelativePathContainsColon()
    {
        $iri = new SimplePie_IRI();
        $iri->path = '/test:/';
        $this->assertFalse($iri->is_valid());
    }

    public function testValidRelativePathContainsColon()
    {
        $iri = new SimplePie_IRI();
        $iri->path = '/test/:';
        $this->assertTrue($iri->is_valid());
    }

    public function testFullGamut()
    {
        $iri = new SimplePie_IRI();
        $iri->scheme = 'http';
        $iri->userinfo = 'user:password';
        $iri->host = 'example.com';
        $iri->path = '/test/';
        $iri->fragment = 'test';

        $this->assertSame('http', $iri->scheme);
        $this->assertSame('user:password', $iri->userinfo);
        $this->assertSame('example.com', $iri->host);
        $this->assertSame(80, $iri->port);
        $this->assertSame('/test/', $iri->path);
        $this->assertSame('test', $iri->fragment);
    }

    public function testReadAliased()
    {
        $iri = new SimplePie_IRI();
        $iri->scheme = 'http';
        $iri->userinfo = 'user:password';
        $iri->host = 'example.com';
        $iri->path = '/test/';
        $iri->fragment = 'test';

        $this->assertSame('http', $iri->scheme);
        $this->assertSame('user:password', $iri->userinfo);
        $this->assertSame('example.com', $iri->host);
        $this->assertSame(80, $iri->port);
        $this->assertSame('/test/', $iri->path);
        $this->assertSame('test', $iri->fragment);
    }

    public function testWriteAliased()
    {
        $iri = new SimplePie_IRI();
        $iri->scheme = 'http';
        $iri->userinfo = 'user:password';
        $iri->host = 'example.com';
        $iri->path = '/test/';
        $iri->fragment = 'test';

        $this->assertSame('http', $iri->scheme);
        $this->assertSame('user:password', $iri->userinfo);
        $this->assertSame('example.com', $iri->host);
        $this->assertSame(80, $iri->port);
        $this->assertSame('/test/', $iri->path);
        $this->assertSame('test', $iri->fragment);
    }

    public function testNonexistantProperty()
    {
        $this->expectNotice();

        $iri = new SimplePie_IRI();
        $this->assertFalse(isset($iri->nonexistant_prop));
        $should_fail = $iri->nonexistant_prop;
    }

    public function testBlankHost()
    {
        $iri = new SimplePie_IRI('http://example.com/a/?b=c#d');
        $iri->host = null;

        $this->assertSame(null, $iri->host);
        $this->assertSame('http:/a/?b=c#d', (string) $iri);
    }

    public function testBadPort()
    {
        $iri = new SimplePie_IRI();
        $iri->port = 'example';

        $this->assertSame(null, $iri->port);
    }
}

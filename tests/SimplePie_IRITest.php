<?php
/**
 * SimplePie 1.2 PHPUnit Testsuite
 *
 * PHP Version 5.2
 *
 * @license <http://www.spdx.org/licenses/LGPL-2.1+> GNU Lesser General Public License v2.1 or later
 * @copyright Copyright © 2007, Geoffrey Sneddon
 * @copyright Copyright © 2012, hakre <http://hakre.wordpress.com/>
 */

require_once('SimplePie_TestCase.php');

class  SimplePie_Iri_Test extends SimplePie_TestCase
{
	public function testConstructor()
	{
		$obj = new SimplePie_Iri('');
		$this->assertInstanceOf('SimplePie_Iri', $obj);
	}

	/**
	 * @dataProvider absolutizeProvider
	 *
	 * @param string $relative
	 * @param string $expected
	 */
	public function testAbsolutize($base, $relative, $expected)
	{
		$iri = SimplePie_IRI::absolutize(new SimplePie_IRI($base), $relative);
		$actual = $iri->get_iri();
		$this->assertSame($expected, $actual);
	}

	public function absolutizeProvider()
	{
		
		return array(
			// RFC3986.5.4/...
			// The tests enclosed within come from RFC 3986 section 5.4 and all share the same base URL
			array('http://a/b/c/d;p?q', '../../../g', 'http://a/g'), // abnormal/1.php
			array('http://a/b/c/d;p?q', './g/.', 'http://a/b/c/g/'), // abnormal/10.php
			array('http://a/b/c/d;p?q', 'g/./h', 'http://a/b/c/g/h'), // abnormal/11.php
			array('http://a/b/c/d;p?q', 'g/../h', 'http://a/b/c/h'), // abnormal/12.php
			array('http://a/b/c/d;p?q', 'g;x=1/./y', 'http://a/b/c/g;x=1/y'), // abnormal/13.php
			array('http://a/b/c/d;p?q', 'g;x=1/../y', 'http://a/b/c/y'), // abnormal/14.php
			array('http://a/b/c/d;p?q', 'g?y/./x', 'http://a/b/c/g?y/./x'), // abnormal/15.php
			array('http://a/b/c/d;p?q', 'g?y/../x', 'http://a/b/c/g?y/../x'), // abnormal/16.php
			array('http://a/b/c/d;p?q', 'g#s/./x', 'http://a/b/c/g#s/./x'), // abnormal/17.php
			array('http://a/b/c/d;p?q', 'g#s/../x', 'http://a/b/c/g#s/../x'), // abnormal/18.php
			array('http://a/b/c/d;p?q', 'http:g', 'http:g'), // abnormal/19.php
			array('http://a/b/c/d;p?q', '../../../../g', 'http://a/g'), // abnormal/2.php
			array('http://a/b/c/d;p?q', '/./g', 'http://a/g'), // abnormal/3.php
			array('http://a/b/c/d;p?q', '/../g', 'http://a/g'), // abnormal/4.php
			array('http://a/b/c/d;p?q', 'g.', 'http://a/b/c/g.'), // abnormal/5.php
			array('http://a/b/c/d;p?q', '.g', 'http://a/b/c/.g'), // abnormal/6.php
			array('http://a/b/c/d;p?q', 'g..', 'http://a/b/c/g..'), // abnormal/7.php
			array('http://a/b/c/d;p?q', '..g', 'http://a/b/c/..g'), // abnormal/8.php
			array('http://a/b/c/d;p?q', './../g', 'http://a/b/g'), // abnormal/9.php
			array('http://a/b/c/d;p?q', 'g:h', 'g:h'), // normal/1.php
			array('http://a/b/c/d;p?q', 'g#s', 'http://a/b/c/g#s'), // normal/10.php
			array('http://a/b/c/d;p?q', 'g?y#s', 'http://a/b/c/g?y#s'), // normal/11.php
			array('http://a/b/c/d;p?q', ';x', 'http://a/b/c/;x'), // normal/12.php
			array('http://a/b/c/d;p?q', 'g;x', 'http://a/b/c/g;x'), // normal/13.php
			array('http://a/b/c/d;p?q', 'g;x?y#s', 'http://a/b/c/g;x?y#s'), // normal/14.php
			array('http://a/b/c/d;p?q', '', 'http://a/b/c/d;p?q'), // normal/15.php
			array('http://a/b/c/d;p?q', '.', 'http://a/b/c/'), // normal/16.php
			array('http://a/b/c/d;p?q', './', 'http://a/b/c/'), // normal/17.php
			array('http://a/b/c/d;p?q', '..', 'http://a/b/'), // normal/18.php
			array('http://a/b/c/d;p?q', '../', 'http://a/b/'), // normal/19.php
			array('http://a/b/c/d;p?q', 'g', 'http://a/b/c/g'), // normal/2.php
			array('http://a/b/c/d;p?q', '../g', 'http://a/b/g'), // normal/20.php
			array('http://a/b/c/d;p?q', '../..', 'http://a/'), // normal/21.php
			array('http://a/b/c/d;p?q', '../../', 'http://a/'), // normal/22.php
			array('http://a/b/c/d;p?q', '../../g', 'http://a/g'), // normal/23.php
			array('http://a/b/c/d;p?q', './g', 'http://a/b/c/g'), // normal/3.php
			array('http://a/b/c/d;p?q', 'g/', 'http://a/b/c/g/'), // normal/4.php
			array('http://a/b/c/d;p?q', '/g', 'http://a/g'), // normal/5.php
			array('http://a/b/c/d;p?q', '//g', 'http://g'), // normal/6.php
			array('http://a/b/c/d;p?q', '?y', 'http://a/b/c/d;p?y'), // normal/7.php
			array('http://a/b/c/d;p?q', 'g?y', 'http://a/b/c/g?y'), // normal/8.php
			array('http://a/b/c/d;p?q', '#s', 'http://a/b/c/d;p?q#s'), // normal/9.php
			// SPtests/...
			array('http://example.com', '//example.net', 'http://example.net'), // bugs/1091.0.1.php
			array('http:g', 'a', 'http:a'), // bugs/1091.0.php
			array('http://a/b/', 'c', 'http://a/b/c'), // bugs/274.0.php
			array('http://a/', 'b', 'http://a/b'), // bugs/274.1.php
			array('http://a/', '/b', 'http://a/b'), // bugs/274.2.php
			array('http://a/b', 'c', 'http://a/c'), // bugs/274.3.php
			array('http://a/b/', "b\x0Ac", 'http://a/b/b%0Ac'), // bugs/579.0.php
			array('http://a/b/c', 'zero://a/b/c', 'zero://a/b/c'), // bugs/691.0.php
			array('http://a/b/c', '//0', 'http://0'), // bugs/691.1.php
			array('http://a/b/c', '0', 'http://a/b/0'), // bugs/691.2.php
			array('http://a/b/c', '?0', 'http://a/b/c?0'), // bugs/691.3.php
			array('http://a/b/c', '#0', 'http://a/b/c#0'), // bugs/691.4.php
			array('zero://a/b/c', 'd', 'zero://a/b/d'), // bugs/691.5.php
			array('http://0/b/c', 'd', 'http://0/b/d'), // bugs/691.6.php
			array('http://a/b/c?0', 'd', 'http://a/b/d'), // bugs/691.7.php
			array('http://a/b/c#0', 'd', 'http://a/b/d'), // bugs/691.8.php
			array('http://a/b/c/d', 'f%0o', 'http://a/b/c/f%250o'), // bugs/pct_encoding_invalid_second_char.php
		);
	}
}
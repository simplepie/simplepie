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

class  SimplePie_Parse_Date_Test extends SimplePie_TestCase
{
	public function testConstructor()
	{
		$obj = new SimplePie_Parse_Date;
		$this->assertInstanceOf('SimplePie_Parse_Date', $obj);
	}

	/**
	 * @dataProvider parseProvider
	 *
	 * @param string $dateTimeString
	 * @param string $expected
	 */
	public function testParse($dateTimeString, $expected)
	{
		$parser = new SimplePie_Parse_Date();
		$actual = $parser->parse($dateTimeString);
		$this->assertSame($expected, $actual);
	}

	public function parseProvider() {
		return array(
			// Date/...
			// The tests enclosed within come from RFC 3339 section 5.8
			array('1985-04-12T23:20:50.52Z', 482196051), // RFC3339\1.php
			array('1996-12-19T16:39:57-08:00', 851042397), // RFC3339\2.php
			array('1996-12-20T00:39:57Z', 851042397), // RFC3339\3.php
			array('meep', false), // SPtests\bugs\157.0.php
			array('1994-11-05T08:15:30-0500', 784041330), // SPtests\bugs\259.0.php
			array('Fri, 05 Nov 1994 13:15:30 GMT', 784041330), // SPtests\RFC2822\invalid\four_digit_year.php
			array('Friday, 05 Nov 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\invalid\full_name_of_day.php
			array('Vendredi, 05 Nov 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\invalid\invalid_day.php
			array('Fri, 05 Nov 94 13:15:30 UTC', 784041330), // SPtests\RFC2822\invalid\invalid_timezone.php
			array('Mon, 05 Nov 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\invalid\mismatch_name_of_day.php
			array('Fri, 05 Nov 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\valid\1.php
			array('Fri, 05 Nov 94 06:15:30 MST', 784041330), // SPtests\RFC2822\valid\10.php
			array('Fri, 05 Nov 94 07:15:30 MDT', 784041330), // SPtests\RFC2822\valid\11.php
			array('Fri, 05 Nov 94 05:15:30 PST', 784041330), // SPtests\RFC2822\valid\12.php
			array('Fri, 05 Nov 94 06:15:30 PDT', 784041330), // SPtests\RFC2822\valid\13.php
			array('Fri, 05 Nov 94 13:15:30 A', 784041330), // SPtests\RFC2822\valid\14.php
			array('Fri, 05 Nov 94 13:15:30 B', 784041330), // SPtests\RFC2822\valid\15.php
			array('Fri, 05 Nov 94 13:15:30 C', 784041330), // SPtests\RFC2822\valid\16.php
			array('Fri, 05 Nov 94 13:15:30 D', 784041330), // SPtests\RFC2822\valid\17.php
			array('Fri, 05 Nov 94 13:15:30 E', 784041330), // SPtests\RFC2822\valid\18.php
			array('Fri, 05 Nov 94 13:15:30 F', 784041330), // SPtests\RFC2822\valid\19.php
			array('05 Nov 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\valid\2.php
			array('Fri, 05 Nov 94 13:15:30 G', 784041330), // SPtests\RFC2822\valid\20.php
			array('Fri, 05 Nov 94 13:15:30 H', 784041330), // SPtests\RFC2822\valid\21.php
			array('Fri, 05 Nov 94 13:15:30 I', 784041330), // SPtests\RFC2822\valid\22.php
			array('Fri, 05 Nov 94 13:15:30 K', 784041330), // SPtests\RFC2822\valid\23.php
			array('Fri, 05 Nov 94 13:15:30 L', 784041330), // SPtests\RFC2822\valid\24.php
			array('Fri, 05 Nov 94 13:15:30 M', 784041330), // SPtests\RFC2822\valid\25.php
			array('Fri, 05 Nov 94 13:15:30 N', 784041330), // SPtests\RFC2822\valid\26.php
			array('Fri, 05 Nov 94 13:15:30 O', 784041330), // SPtests\RFC2822\valid\27.php
			array('Fri, 05 Nov 94 13:15:30 P', 784041330), // SPtests\RFC2822\valid\28.php
			array('Fri, 05 Nov 94 13:15:30 Q', 784041330), // SPtests\RFC2822\valid\29.php
			array('Fri, 5 Nov 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\valid\3.php
			array('Fri, 05 Nov 94 13:15:30 R', 784041330), // SPtests\RFC2822\valid\30.php
			array('Fri, 05 Nov 94 13:15:30 S', 784041330), // SPtests\RFC2822\valid\31.php
			array('Fri, 05 Nov 94 13:15:30 T', 784041330), // SPtests\RFC2822\valid\32.php
			array('Fri, 05 Nov 94 13:15:30 U', 784041330), // SPtests\RFC2822\valid\33.php
			array('Fri, 05 Nov 94 13:15:30 V', 784041330), // SPtests\RFC2822\valid\34.php
			array('Fri, 05 Nov 94 13:15:30 W', 784041330), // SPtests\RFC2822\valid\35.php
			array('Fri, 05 Nov 94 13:15:30 X', 784041330), // SPtests\RFC2822\valid\36.php
			array('Fri, 05 Nov 94 13:15:30 Y', 784041330), // SPtests\RFC2822\valid\37.php
			array('Fri, 05 Nov 94 13:15:30 Z', 784041330), // SPtests\RFC2822\valid\38.php
			array('Fri, 05 Nov 94 13:15:30 +0000', 784041330), // SPtests\RFC2822\valid\39.php
			array('Fri, 05 Nov 94 13:15 GMT', 784041300), // SPtests\RFC2822\valid\4.php
			array('Fri, 05 Nov 94 13:15:30 -0000', 784041330), // SPtests\RFC2822\valid\40.php
			array('Fri, 05 Nov 94 14:15:30 +0100', 784041330), // SPtests\RFC2822\valid\41.php
			array('Fri, 05 Nov 94 12:15:30 -0100', 784041330), // SPtests\RFC2822\valid\42.php
			array('Fri(day), 05 Nov(ember) 94 13:15:30 GMT', 784041330), // SPtests\RFC2822\valid\43.php
			array('Fri(day), 05 Nov(ember) 94 13:15:30 A', 784041330), // SPtests\RFC2822\valid\44.php
			array('Fri, 05 Nov 94 13:15:30 UT', 784041330), // SPtests\RFC2822\valid\5.php
			array('Fri, 05 Nov 94 08:15:30 EST', 784041330), // SPtests\RFC2822\valid\6.php
			array('Fri, 05 Nov 94 09:15:30 EDT', 784041330), // SPtests\RFC2822\valid\7.php
			array('Fri, 05 Nov 94 07:15:30 CST', 784041330), // SPtests\RFC2822\valid\8.php
			array('Fri, 05 Nov 94 08:15:30 CDT', 784041330), // SPtests\RFC2822\valid\9.php
			// The tests enclosed within come from the W3C Date and Time Formats note
			array('1994-11-05T08:15:30-05:00', 784041330), // W3CDTF\1.php
			array('1994-11-05T13:15:30Z', 784041330), // W3CDTF\2.php
		);
	}
}
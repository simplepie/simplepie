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

class  SimplePie_EnclosureTest extends SimplePie_TestCase
{

	/**
	 * @param string $rawData
	 * @param int $index (optional)
	 * @return \SimplePie_Restriction
	 */
	private function getNewRestriction($rawData, $index = 0)
	{
		$feed = new SimplePie();
		$feed->set_raw_data($rawData);
		$feed->enable_cache(false);
		$feed->init();
		$item = $feed->get_item($index);
		$enclosure = $item->get_enclosure();
		$restriction = $enclosure->get_restriction();
		return $restriction;
	}

	public function testConstructor()
	{
		$obj = new SimplePie_Enclosure;
		$this->assertInstanceOf('SimplePie_Enclosure', $obj);
	}

	/**
	 * @dataProvider get_relationshipProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_relationship($rawData, $expected)
	{
		$restriction = $this->getNewRestriction($rawData);
		$this->assertInstanceOf('SimplePie_Restriction', $restriction);
		$actual = $restriction->get_relationship();
		$this->assertSame($expected, $actual);
	}

	public function get_relationshipProvider()
	{
		return $this->includeProvider('itunes_rss.php');
	}

}
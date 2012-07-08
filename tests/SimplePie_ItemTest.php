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

/**
 * Integration test for the parser
 */
class  SimplePie_ItemTest extends SimplePie_TestCase
{
	/**
	 * @param string $rawData
	 * @param int $index (optional)
	 * @return \SimplePie_Item
	 */
	private function getNewItem($rawData, $index = 0)
	{
		$feed = new SimplePie();
		$feed->set_raw_data($rawData);
		$feed->enable_cache(false);
		$feed->init();
		$item = $feed->get_item($index);
		return $item;
	}

	public function testConstructor()
	{
		$obj = new SimplePie_Item('', '');
		$this->assertInstanceOf('SimplePie_Item', $obj);
	}

	/**
	 * @dataProvider get_nameProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_author($rawData, $expected)
	{
		$author = $this->getNewItem($rawData)->get_author();
		$this->assertInstanceOf('SimplePie_Author', $author);
		$actual = $author->get_name();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_labelProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_category($rawData, $expected)
	{
		$category = $this->getNewItem($rawData)->get_category();
		$this->assertInstanceOf('SimplePie_Category', $category);
		$actual = $category->get_label();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_contentProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_content($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_content();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_contributor_get_nameProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_contributor($rawData, $expected)
	{
		$contributor = $this->getNewItem($rawData)->get_contributor();
		$this->assertInstanceOf('SimplePie_Author', $contributor);
		$actual = $contributor->get_name();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_dateProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_date($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_date('U');
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_descriptionProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_description($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_description();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_idProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_id($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_id();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_latitudeProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_latitude($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_latitude();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_longitudeProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_longitude($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_longitude();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_permalinkProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_permalink($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_permalink();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_titleProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_title($rawData, $expected)
	{
		$actual = $this->getNewItem($rawData)->get_title();
		$this->assertSame($expected, $actual);
	}


	/**
	 * @dataProvider who_knows_a_title_from_a_hole_in_the_groundProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_title2($rawData, $expected)
	{
		$this->testGet_title($rawData, $expected);
	}

	public function get_nameProvider()
	{
		return $this->includeProvider('first_item_author_name.php');
	}

	public function get_labelProvider()
	{
		return $this->includeProvider('first_item_category_label.php');
	}

	public function get_contentProvider()
	{
		return $this->includeProvider('first_item_content.php');
	}

	public function get_contributor_get_nameProvider()
	{
		return $this->includeProvider('first_item_contributor_name.php');
	}

	public function get_dateProvider()
	{
		return $this->includeProvider('first_item_date.php');
	}

	public function get_descriptionProvider()
	{
		return $this->includeProvider('first_item_description.php');
	}

	public function get_idProvider()
	{
		return $this->includeProvider('first_item_id.php');
	}

	public function get_latitudeProvider()
	{
		return $this->includeProvider('first_item_latitude.php');
	}

	public function get_longitudeProvider()
	{
		return $this->includeProvider('first_item_longitude.php');
	}

	public function get_permalinkProvider()
	{
		return $this->includeProvider('first_item_permalink.php');
	}

	public function get_titleProvider()
	{
		return $this->includeProvider('first_item_title.php');
	}

	public function who_knows_a_title_from_a_hole_in_the_groundProvider()
	{
		return $this->includeProvider('who_knows_a_title_from_a_hole_in_the_ground.php');
	}
}
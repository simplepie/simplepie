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
class SimplePie_Test extends SimplePie_TestCase
{
	/**
	 * @param string $rawData
	 * @return SimplePie
	 */
	private function getNewFeed($rawData)
	{
		$feed = new SimplePie();
		$feed->set_raw_data($rawData);
		$feed->enable_cache(false);
		$feed->init();
		return $feed;
	}

	public function testConstructor()
	{
		$obj = new SimplePie;
		$this->assertInstanceOf('SimplePie', $obj);
	}

	/**
	 * @dataProvider get_categoryProvider
	 *
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_category($rawData, $expected)
	{
		$feed = $this->getNewFeed($rawData);

		$category = $feed->get_category();
		$this->assertInstanceOf('SimplePie_Category', $category);
		$actual = $category->get_label();
		$this->assertInternalType('string', $actual);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_copyrightProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_copyright($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_copyright();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_descriptionProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_description($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_description();
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider get_image_heightProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_image_height($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_image_height();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_image_linkProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_image_link($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_image_link();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_image_titleProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_image_title($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_image_title();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_image_urlProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_image_url($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_image_url();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_image_widthProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_image_width($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_image_width();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_languageProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_language($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_language();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_linkProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_link($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_link();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_titleProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_title($rawData, $expected)
	{
		$actual = $this->getNewFeed($rawData)->get_title();
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider get_itemProvider
	 * @param string $rawData
	 * @param string $expected
	 */
	public function testGet_item($rawData, $expected)
	{
		$feed = $this->getNewFeed($rawData);
		$item = $feed->get_item(0);
		$this->assertInstanceOf('SimplePie_Item', $item);
	}

	public function get_categoryProvider()
	{
		return $this->includeProvider('feed_category_label.php');
	}

	public function get_copyrightProvider()
	{
		return $this->includeProvider('feed_copyright.php');
	}

	public function get_descriptionProvider()
	{
		return $this->includeProvider('feed_description.php');
	}

	public function get_image_heightProvider()
	{
		return $this->includeProvider('feed_image_height.php');
	}

	public function get_image_linkProvider()
	{
		return $this->includeProvider('feed_image_link.php');
	}

	public function get_image_titleProvider()
	{
		return $this->includeProvider('feed_image_title.php');
	}

	public function get_image_urlProvider()
	{
		return $this->includeProvider('feed_image_url.php');
	}

	public function get_image_widthProvider()
	{
		return $this->includeProvider('feed_image_width.php');
	}

	public function get_languageProvider()
	{
		return $this->includeProvider('feed_language.php');
	}

	public function get_linkProvider()
	{
		return $this->includeProvider('feed_link.php');
	}

	public function get_titleProvider()
	{
		return $this->includeProvider('feed_title.php');
	}

	public function get_itemProvider()
	{
		return $this->includeProvider('first_item_author_name.php');
	}
}
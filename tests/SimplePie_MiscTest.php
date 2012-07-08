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

class  SimplePie_Misc_Test extends SimplePie_TestCase
{
	public function testConstructor()
	{
		$obj = new SimplePie_Misc;
		$this->assertInstanceOf('SimplePie_Misc', $obj);
	}
}
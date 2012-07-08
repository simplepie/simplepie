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

require_once('PHPUnit/Autoload.php');

require_once(dirname(__FILE__) . '/../simplepie.inc');

/**
 * abstract, base test-case class.
 */
abstract class SimplePie_TestCase extends PHPUnit_Framework_TestCase
{
	public function includeProvider($file)
	{
		$path = dirname(__FILE__) . '/data/' . $file;
		return require($path);
	}
}
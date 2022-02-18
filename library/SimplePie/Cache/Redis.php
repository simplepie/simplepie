<?php

/**
 * SimplePie Redis Cache Extension
 *
 * @package SimplePie
 * @author Jan Kozak <galvani78@gmail.com>
 * @link http://galvani.cz/
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version 0.2.9
 */

use SimplePie\Cache\Redis;

class_exists('SimplePie\Cache\Redis');

// @trigger_error(sprintf('Using the "SimplePie_Cache_Redis" class is deprecated since SimplePie version 1.x, use "SimplePie\Cache\Redis" instead.'), \E_USER_DEPRECATED);

if (\false) {
	/** @deprecated since SimplePie 1.x, use "SimplePie\Cache\Redis" instead */
	class SimplePie_Cache_Redis extends Redis
	{
	}
}

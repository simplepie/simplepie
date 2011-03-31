<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2009, Ryan Parman, Geoffrey Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @version 1.3-dev
 * @copyright 2004-2010 Ryan Parman, Geoffrey Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */


class SimplePie_Cache
{
	/**
	 * Cache handler classes
	 *
	 * These receive 3 parameters to their constructor, as documented in
	 * {@see register()}
	 * @var array
	 */
	protected static $handlers = array('mysql' => 'SimplePie_Cache_MySQL');

	/**
	 * Don't call the constructor. Please.
	 */
	private function __construct() { }

	/**
	 * Create a new SimplePie_Cache object
	 */
	public static function create($location, $filename, $extension)
	{
		$type = explode(':', $location, 2);
		$type = $type[0];
		if (!empty(self::$handlers[$type]))
		{
			$class = self::$handlers[$type];
			return new $class($location, $filename, $extension);
		}

		return new SimplePie_Cache_File($location, $filename, $extension);
	}

	/**
	 * Register a handler
	 *
	 * @param string $type DSN type to register for
	 * @param string $class Name of handler class. Must implement SimplePie_Cache_Base
	 */
	public static function register($type, $class)
	{
		self::$handlers[$type] = $class;
	}

	/**
	 * Parse a DSN into an array
	 *
	 * @param string $dsn
	 * @return array
	 */
	public static function parse_DSN($dsn)
	{
		$params = array();
		list($params['type'], $options) = explode(':', $dsn, 2);
		$options = explode(';', $options);
		// We need a for loop, so that we can splice
		for ($i = 0; $i < count($options); $i++)
		{
			$option = $options[$i];
			// If this string ends with a backslash...
			while (strpos($option, '\\') === (strlen($option) - 1))
			{
				// Remove the backslash
				$option = substr($option, 0, strlen($option) - 1);
				// Remove the next item from the array and reindex
				$next = array_splice($options, $i + 1, 1);
				// Then append the next one, with the semicolon between
				$option .= ';' . $next[0];
			}
			list($name, $value) = explode('=', $option, 2);
			$params[$name] = $value;
		}
		return $params;
	}
}

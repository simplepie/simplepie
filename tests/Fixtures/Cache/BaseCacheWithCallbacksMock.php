<?php

declare(strict_types=1);
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
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
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Tests\Fixtures\Cache;

use Closure;
use SimplePie\Cache\Base;
use SimplePie\SimplePie;

/**
 * Mock for Base cache objects
 */
class BaseCacheWithCallbacksMock implements Base
{
    /** @var Closure|null */
    private static $constructCallback = null;

    /** @var Closure|null */
    private static $saveCallback = null;

    /** @var Closure|null */
    private static $loadCallback = null;

    /** @var Closure|null */
    private static $mtimeCallback = null;

    /** @var Closure|null */
    private static $touchCallback = null;

    /** @var Closure|null */
    private static $unlinkCallback = null;

    public static function setConstructCallback(Closure $cb)
    {
        static::$constructCallback = $cb;
    }

    public static function setSaveCallback(Closure $cb)
    {
        static::$saveCallback = $cb;
    }

    public static function setLoadCallback(Closure $cb)
    {
        static::$loadCallback = $cb;
    }

    public static function setMtimeCallback(Closure $cb)
    {
        static::$mtimeCallback = $cb;
    }

    public static function setTouchCallback(Closure $cb)
    {
        static::$touchCallback = $cb;
    }

    public static function setUnlinkCallback(Closure $cb)
    {
        static::$unlinkCallback = $cb;
    }

    /**
     * Call this after tests to reset all callbacks
     */
    public static function resetAllCallbacks()
    {
        static::$constructCallback = null;
        static::$saveCallback = null;
        static::$loadCallback = null;
        static::$mtimeCallback = null;
        static::$touchCallback = null;
        static::$unlinkCallback = null;
    }

    /**
     * Create a new cache object
     *
     * @param string $location Location string (from SimplePie::$cache_location)
     * @param string $name Unique ID for the cache
     * @param Base::TYPE_FEED|Base::TYPE_IMAGE $type Either TYPE_FEED for SimplePie data, or TYPE_IMAGE for image data
     */
    public function __construct(string $location, string $name, $type)
    {
        if (static::$constructCallback !== null) {
            $callback = static::$constructCallback;
            $callback($location, $name, $type);
        }
    }

    /**
     * Save data to the cache
     *
     * @param array|SimplePie $data Data to store in the cache. If passed a SimplePie object, only cache the $data property
     * @return bool Successfulness
     */
    public function save($data)
    {
        $return = true;

        if (static::$saveCallback instanceof Closure) {
            $callback = static::$saveCallback;
            $return = $callback($data);
        }

        return $return;
    }

    /**
     * Retrieve the data saved to the cache
     *
     * @return array Data for SimplePie::$data
     */
    public function load()
    {
        $return = [];

        if (static::$loadCallback instanceof Closure) {
            $callback = static::$loadCallback;
            $return = $callback();
        }

        return $return;
    }

    /**
     * Retrieve the last modified time for the cache
     *
     * @return int Timestamp
     */
    public function mtime()
    {
        $return = 0;

        if (static::$mtimeCallback instanceof Closure) {
            $callback = static::$mtimeCallback;
            $return = $callback();
        }

        return $return;
    }

    /**
     * Set the last modified time to the current time
     *
     * @return bool Success status
     */
    public function touch()
    {
        $return = true;

        if (static::$touchCallback instanceof Closure) {
            $callback = static::$touchCallback;
            $return = $callback();
        }

        return $return;
    }

    /**
     * Remove the cache
     *
     * @return bool Success status
     */
    public function unlink()
    {
        $return = true;

        if (static::$unlinkCallback instanceof Closure) {
            $callback = static::$unlinkCallback;
            $return = $callback();
        }

        return $return;
    }
}

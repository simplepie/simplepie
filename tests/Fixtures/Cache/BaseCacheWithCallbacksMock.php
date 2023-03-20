<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

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

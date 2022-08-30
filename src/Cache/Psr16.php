<?php
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
 * @package SimplePie
 * @copyright 2004-2016 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Cache;

use Exception;
use Psr\SimpleCache\CacheException;
use Psr\SimpleCache\CacheInterface;
use SimplePie\SimplePie as SimplePieInstance;

/**
 * Caches data to the PSR-16 cache implementation
 *
 * @package SimplePie
 * @subpackage Caching
 */
class Psr16 implements Base
{
    /**
     * stored PSR-16 cache implemtentation
     *
     * @var CacheInterface
     */
    private static $psr16storage = null;

    /**
     * stored a globally PSR-16 cache implemtentation
     *
     * @param CacheInterface $psr16cache
     */
    public static function store_psr16_cache(CacheInterface $psr16cache)
    {
        static::$psr16storage = $psr16cache;
    }

    /**
     * PSR-16 cache implemtentation
     *
     * @var CacheInterface
     */
    private $psr16cache;

    /**
     * PSR-16 cache key
     *
     * @var string
     */
    private $cacheKey;

    /**
     * cache time to live
     *
     * @var int
     */
    private $ttl = 3600;

    /**
     * Create a new cache object
     *
     * @param string $location Location string (from SimplePie::$cache_location)
     * @param string $name Unique ID for the cache
     * @param string $type Either TYPE_FEED for SimplePie data, or TYPE_IMAGE for image data
     */
    public function __construct($location, $name, $type)
    {
        if (static::$psr16storage === null) {
            throw new Exception(sprintf(
                'You must set an implementation of `%s` via `%s::set_psr16_cache()` first.',
                CacheInterface::class,
                SimplePieInstance::class
            ), \E_USER_ERROR);
        }

        $this->psr16cache = static::$psr16storage;

        // BC: hashAlgo sha256 support was added in PHP 7.1
        $hashAlgo = in_array('sha256', hash_algos()) ? 'sha256' : 'sha1';
        $this->cacheKey = hash($hashAlgo, "$location/$name.$type");
    }

    /**
     * Save data to the cache
     *
     * @param array|SimplePieInstance $data Data to store in the cache. If passed a SimplePie object, only cache the $data property
     * @return bool Successfulness
     */
    public function save($data)
    {
        if ($data instanceof SimplePieInstance) {
            $data = $data->data;
        }

        try {
            $this->psr16cache->set($this->cacheKey, $data, $this->ttl);
            $this->psr16cache->set($this->cacheKey . '_mtime', time(), $this->ttl);
        } catch (CacheException $e) {
            return false;
        }

        return true;
    }

    /**
     * Retrieve the data saved to the cache
     *
     * @return array Data for SimplePie::$data
     */
    public function load()
    {
        try {
            $data = $this->psr16cache->get($this->cacheKey, $this);

            if ($data === $this) {
                return false;
            }
        } catch (CacheException $th) {
            return false;
        }

        return $data;
    }

    /**
     * Retrieve the last modified time for the cache
     *
     * @return int Timestamp
     */
    public function mtime()
    {
        try {
            $data = $this->psr16cache->get($this->cacheKey . '_mtime', $this);
        } catch (CacheException $th) {
            return 0;
        }

        if ($data === $this || ! is_int($data)) {
            return 0;
        }

        return $data;
    }

    /**
     * Set the last modified time to the current time
     *
     * @return bool Success status
     */
    public function touch()
    {
        try {
            $data = $this->psr16cache->get($this->cacheKey, $this);

            if ($data === $this) {
                return false;
            }

            $this->psr16cache->set($this->cacheKey, $data, $this->ttl);
            $this->psr16cache->set($this->cacheKey . '_mtime', time(), $this->ttl);
        } catch (CacheException $th) {
            return false;
        }

        return true;
    }

    /**
     * Remove the cache
     *
     * @return bool Success status
     */
    public function unlink()
    {
        try {
            return $this->psr16cache->delete($this->cacheKey);
            return $this->psr16cache->delete($this->cacheKey . '_mtime');
        } catch (CacheException $th) {
            return false;
        }
    }
}
<?php

namespace SimplePie\Tests\Fixtures\Exception;

use Exception;
use Psr\SimpleCache\CacheException;

/**
 * BC: This can be an anonymous class in PHP 7+.
 */
class Psr16CacheException extends Exception implements CacheException
{
}

<?php

namespace SimplePie\Tests\Fixtures\Cache;

use Exception;
use SimplePie\Cache;
use SimplePie\Tests\Fixtures\Exception\SuccessException;

class NewCacheMock extends Cache
{
	public static function get_handler($location, $filename, $extension)
	{
		throw new SuccessException('Correct function called');
	}

	public function create($location, $filename, $extension)
	{
		throw new Exception('New cache class should not have create() called');
	}
}

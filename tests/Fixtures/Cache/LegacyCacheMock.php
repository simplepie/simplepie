<?php

namespace SimplePie\Tests\Fixtures\Cache;

use Exception;
use SimplePie\Cache;
use SimplePie\Tests\Fixtures\Exception\SuccessException;

class LegacyCacheMock extends Cache
{
	public static function get_handler($location, $filename, $extension)
	{
		throw new Exception('Legacy cache class should not have get_handler() called');
	}

	public function create($location, $filename, $extension)
	{
		throw new SuccessException('Correct function called');
	}
}

<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

use Exception;
use SimplePie\File;

/**
 * Make sure that File is never called
 */
class FileConstructorThrowsExceptionMock extends File
{
    public function __construct($url)
    {
        throw new Exception(sprintf(
            '"%s()" has been called with $url "%s"',
            __METHOD__,
            $url
        ), 1);
    }
}

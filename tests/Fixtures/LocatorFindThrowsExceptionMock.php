<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

use SimplePie\Exception;
use SimplePie\Locator;

class LocatorFindThrowsExceptionMock extends Locator
{
    public function find(int $type = \SimplePie\SimplePie::LOCATOR_ALL, ?array &$working = null)
    {
        throw new Exception('DOMDocument not found, unable to use locator');
    }
}

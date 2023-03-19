<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

use SimplePie\Misc;

class MiscWithPublicStaticMethodsMock extends Misc
{
    public static function __callStatic($name, $args)
    {
        return call_user_func_array([Misc::class, $name], $args);
    }
}

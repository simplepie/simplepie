<?php

namespace SimplePie\Tests\Fixtures;

use SimplePie\Misc;

class MiscWithPublicStaticMethodsMock extends Misc
{
	public static function __callStatic($name, $args)
	{
		return call_user_func_array(array('SimplePie\Misc', $name), $args);
	}
}

<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

use SimplePie\Misc;

class MiscChangeEncodingFailsMock extends Misc
{
    /**
     * @return false
     */
    public static function change_encoding(string $data, string $input, string $output)
    {
        return false;
    }
}

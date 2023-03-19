<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

use SimplePie\Misc;

class MiscWithPublicStaticMethodsMock extends Misc
{
    public static function change_encoding_mbstring($data, $input, $output)
    {
        return parent::change_encoding_mbstring($data, $input, $output);
    }

    public static function change_encoding_iconv($data, $input, $output)
    {
        return parent::change_encoding_iconv($data, $input, $output);
    }

    public static function change_encoding_uconverter(string $data, string $input, string $output)
    {
        return parent::change_encoding_uconverter($data, $input, $output);
    }
}

<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

use SimplePie\Misc;

class MiscWithPublicStaticMethodsMock extends Misc
{
    /**
     * @return string|false
     */
    public static function change_encoding_mbstring(string $data, string $input, string $output)
    {
        return parent::change_encoding_mbstring($data, $input, $output);
    }

    /**
     * @return string|false
     */
    public static function change_encoding_iconv(string $data, string $input, string $output)
    {
        return parent::change_encoding_iconv($data, $input, $output);
    }

    /**
     * @return string|false
     */
    public static function change_encoding_uconverter(string $data, string $input, string $output)
    {
        return parent::change_encoding_uconverter($data, $input, $output);
    }
}

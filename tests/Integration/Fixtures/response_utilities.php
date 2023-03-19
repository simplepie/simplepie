<?php

declare(strict_types=1);

namespace SimplePie\Tests\Integration\Fixtures;

function redirect(string $location, int $status): void
{
    http_response_code($status);
    header("Location: $location");
}

function output(string $text, int $status = 200): void
{
    http_response_code($status);
    echo $text;
}

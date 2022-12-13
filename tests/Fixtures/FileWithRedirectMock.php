<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

/**
 * Acts as a fake feed request that simulates first a permanent redirect from http:// URLs to https://,
 * and then appends a date non-permanently.
 */
class FileWithRedirectMock extends FileMock
{
    public function __construct($url)
    {
        parent::__construct($url);
        $this->permanent_url = str_replace('http://', 'https://', $url); // simulate 301
        $this->url = $this->permanent_url . '2019-10-07'; // simulate 302
    }
}

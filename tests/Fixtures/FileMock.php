<?php

namespace SimplePie\Tests\Fixtures;

use SimplePie\File;
use SimplePie\SimplePie;

/**
 * Acts as a fake feed request
 */
class FileMock extends File
{
    public function __construct($url)
    {
        $this->url = $url;
        $this->permanent_url = $url;
        $this->headers = [
            'content-type' => 'application/atom+xml'
        ];
        $this->method = SimplePie::FILE_SOURCE_REMOTE;
        $this->body = '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />';
        $this->status_code = 200;
    }
}

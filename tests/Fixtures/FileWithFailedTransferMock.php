<?php

declare(strict_types=1);

namespace SimplePie\Tests\Fixtures;

/**
 * Acts as a feed request whose transfer failed after the response headers arrived
 */
class FileWithFailedTransferMock extends FileMock
{
    public function __construct($url)
    {
        parent::__construct($url);
        $this->body = null;
        $this->success = false;
        $this->error = 'cURL error 28: Operation timed out';
    }
}

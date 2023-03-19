<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-FileCopyrightText: 2023 Jan Tojnar
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Integration\Fixtures;

use Exception;

final class HttpServer
{
    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var int
     */
    private $port = 0;

    /**
     * @var string
     */
    private $routerPath;

    /**
     * @var resource|false
     */
    private $process = false;

    /**
     * @var resource|null
     */
    private $outputFd = null;

    public function __construct(string $routerPath)
    {
        $this->routerPath = $routerPath;
    }

    public function start(): void
    {
        if ($this->process !== false) {
            throw new Exception('Development server is already running.');
        }

        // PHP 8.0 supports auto-choosing port with `-S localhost:`
        // but until we drop PHP 7 support, we need to choose a port ourselves.
        $this->port = $this->findAvailablePort();

        $command = $this->buildCommand();
        // Capture stderr and stdout to custom file to avoid polluting the console output.
        // If the pipes were connected to the default STDOUT/STDERR descriptors,
        // even PHP’s output buffering would not able to capture the output of the child process.
        $this->outputFd = fopen('php://temp', 'w+');
        $descriptor_spec = [
            1 => $this->outputFd,
            2 => $this->outputFd,
        ];
        $this->process = proc_open($command, $descriptor_spec, $pipes);

        if ($this->process === false) {
            throw new Exception('Failed to start development server.');
        }

        $this->waitForServerToSettle();

        register_shutdown_function(function (): void {
            $this->terminate();
        });
    }

    public function terminate(): void
    {
        if ($this->process === false) {
            return;
        }

        fclose($this->outputFd);

        proc_terminate($this->process);
        proc_close($this->process);
        $this->process = false;
        $this->outputFd = null;
    }

    public function getBaseUri(): string
    {
        if ($this->process === false) {
            throw new Exception('Development server is not running.');
        }

        return "http://{$this->host}:{$this->port}";
    }

    public function getConsoleOutput(): string
    {
        if ($this->process === false) {
            throw new Exception('Development server is not running.');
        }

        rewind($this->outputFd);
        $contents = stream_get_contents($this->outputFd);
        return $contents === false ? '' : $contents;
    }

    private function findAvailablePort(): int
    {
        try {
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

            // Try to bind the socket to any open ephemeral port, see bind(2).
            if (!socket_bind($socket, $this->host, 0)) {
                throw new Exception('Could not bind to address');
            }

            socket_getsockname($socket, $checkAddress, $checkPort);
        } finally {
            socket_close($socket);
        }

        if ($checkPort > 0) {
            return $checkPort;
        }

        throw new Exception('Failed to find an open port.');
    }

    private function buildCommand(): string
    {
        return implode(' ', [
            'php',
            '-S',
            escapeshellarg("{$this->host}:{$this->port}"),
            escapeshellarg($this->routerPath),
        ]);
    }

    private function waitForServerToSettle(): void
    {
        // Wait up to 5 seconds.
        for ($i = 0; $i <= 50; $i++) {
            usleep(100000); // 100 ms

            $socket = @fsockopen($this->host, $this->port);
            if ($socket !== false) {
                fclose($socket);
                return;
            }
        }

        throw new Exception('Unable to connect to development server.');
    }
}

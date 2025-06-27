<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\HTTP;

/**
 * HTTP Response for rax text
 *
 * This interface must be interoperable with Psr\Http\Message\ResponseInterface
 * @see https://www.php-fig.org/psr/psr-7/#33-psrhttpmessageresponseinterface
 *
 * @internal
 */
final class RawTextResponse implements Response
{
    /**
     * @var string
     */
    private $raw_text;

    /**
     * @var string
     */
    private $permanent_url;

    /**
     * @var string
     */
    private $requested_url;

    public function __construct(string $raw_text, string $filepath)
    {
        $this->raw_text = $raw_text;
        $this->permanent_url = $filepath;
        $this->requested_url = $filepath;
    }

    public function get_permanent_uri(): string
    {
        return $this->permanent_url;
    }

    public function get_final_requested_uri(): string
    {
        return $this->requested_url;
    }

    public function get_status_code(): int
    {
        return 200;
    }

    public function get_headers(): array
    {
        return [];
    }

    public function has_header(string $name): bool
    {
        return false;
    }

    public function get_header(string $name): array
    {
        return [];
    }

    public function get_header_line(string $name): string
    {
        return '';
    }

    public function get_body_content(): string
    {
        return $this->raw_text;
    }
}

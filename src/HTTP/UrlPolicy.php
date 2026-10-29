<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\HTTP;

use SimplePie\Misc;

/**
 * Decides whether a URI may be fetched.
 *
 * @internal
 */
final class UrlPolicy
{
    /** @var bool */
    private $allow_local_files = false;

    /** Opt-in for the legacy local-file feature (primary URL only). */
    public function set_allow_local_files(bool $allow): void
    {
        $this->allow_local_files = $allow;
    }

    public function get_allow_local_files(): bool
    {
        return $this->allow_local_files;
    }

    /**
     * @param bool $discovered true for URLs derived from remote content
     *   (locator candidates, redirect targets) - these are always http(s)-only.
     */
    public function is_allowed(string $url, bool $discovered = false): bool
    {
        if (Misc::is_remote_uri($url)) {
            return true; // Phase 2: add private-IP/loopback checks here.
        }

        return !$discovered && $this->allow_local_files;
    }
}

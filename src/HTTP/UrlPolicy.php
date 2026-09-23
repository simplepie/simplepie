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
    private $allowLocalFiles = false;

    /** Opt-in for the legacy local-file feature (primary URL only). */
    public function setAllowLocalFiles(bool $allow): void
    {
        $this->allowLocalFiles = $allow;
    }

    public function getAllowLocalFiles(): bool
    {
        return $this->allowLocalFiles;
    }

    /**
     * @param bool $discovered true for URLs derived from remote content
     *   (locator candidates, redirect targets) - these are always http(s)-only.
     */
    public function isAllowed(string $url, bool $discovered = false): bool
    {
        if (Misc::is_remote_uri($url)) {
            return true; // Phase 2: add private-IP/loopback checks here.
        }

        return !$discovered && $this->allowLocalFiles;
    }
}

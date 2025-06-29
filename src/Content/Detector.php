<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Content;

use SimplePie\HTTP\Response;
use SimplePie\SimplePie;

/**
 * Helper for feed auto-discovery and type sniffing
 *
 *
 * This interface replaces
 * - \SimplePie\Locator and
 * - \SimplePie\Content\Type\Sniffer
 */
interface Detector
{
    /**
     * Discover possible feed urls from HTML response
     *
     * @see https://simplepie.org/wiki/reference/simplepie/set_autodiscovery_level
     *
     * Inspired by the Ultra-liberal RSS locator from Mark Pilgrim
     * @link http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator
     *
     * @param SimplePie::LOCATOR_* $discovery_level
     *
     * @return string[] Array of possible feed urls. The urls are not requested or checked for containing a feed
     */
    public function discover_possible_feed_urls(Response $response, int $discovery_level = SimplePie::LOCATOR_ALL): array;

    /**
     * Check if the response contains a feed
     *
     * @return bool
     */
    public function contains_feed(Response $response): bool;

    /**
     * Get the IANA Media-Type of the provided response
     *
     * @link https://www.iana.org/assignments/media-types/media-types.xhtml
     *
     * @return string Actual Media-Type
     */
    public function detect_media_type(Response $response): string;
}

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Content;

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
     * Discover possible feed urls from HTML body
     *
     * @see https://simplepie.org/wiki/reference/simplepie/set_autodiscovery_level
     *
     * Inspired by the Ultra-liberal RSS locator from Mark Pilgrim
     * @link http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator
     *
     * @param string $body The HTTP response body
     * @param string[] $headers The HTTP response headers
     * @param string $requested_uri The uri or filepath of the response body
     * @param SimplePie::LOCATOR_* $discovery_level
     *
     * @return string[] Array of possible feed urls. The urls are not requested or checked for containing a feed
     */
    public function discover_possible_feed_urls(string $body, array $headers, string $requested_uri, int $discovery_level = SimplePie::LOCATOR_ALL): array;

    /**
     * Check if the response body contains a feed
     *
     * @param string $body The HTTP response body
     * @param string[] $headers The HTTP response headers
     *
     * @return bool
     */
    public function contains_feed(string $body, array $headers): bool;

    /**
     * Get the IANA Media-Type of the provided response body
     *
     * @link https://www.iana.org/assignments/media-types/media-types.xhtml
     *
     * @param string $body The HTTP response body
     * @param string[] $headers The HTTP response headers
     *
     * @return string Actual Media-Type
     */
    public function detect_media_type(string $body, array $headers): string;
}

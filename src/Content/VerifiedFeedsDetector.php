<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\Content;

use SimplePie\Content\Type\Sniffer;
use SimplePie\File;
use SimplePie\Locator;
use SimplePie\Registry;
use SimplePie\SimplePie;

/**
 * Helper for feed auto-discovery and type sniffing
 *
 *
 * This class uses
 * - \SimplePie\Locator and
 * - \SimplePie\Content\Type\Sniffer
 *
 * @package SimplePie
 */
class VerifiedFeedsDetector implements Detector
{
    /**
     * @var Registry $registry
     */
    private $registry;

    public function set_registry(Registry $registry)
    {
        $this->registry = $registry;
    }

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
    public function discover_possible_feed_urls(string $body, array $headers, string $requested_uri, int $discovery_level = SimplePie::LOCATOR_ALL): array
    {
        $file = new class () extends File {
            public function __construct() {}
        };

        $file->headers = $headers;
        $file->body = $body;
        $file->permanent_url = $requested_uri;

        /** @see \SimplePie\File::__construct() */
        if (preg_match('/^http(s)?:\/\//i', $requested_uri)) {
            $file->method = SimplePie::FILE_SOURCE_REMOTE;
        } else {
            $file->method = SimplePie::FILE_SOURCE_LOCAL;
        }

        /** @var Locator */
        $locator = $this->registry->create(
            'Locator',
            [$file, 10, null, 10, false, []]
        );

        /** @var File|null */
        $result = $locator->find($file, $discovery_level);

        if (is_object($result) && $result instanceof File) {
            return [$result->permanent_url];
        }

        return [];
    }

    /**
     * Check if the response body contains a feed
     *
     * @param string $body The HTTP response body
     * @param string[] $headers The HTTP response headers
     *
     * @return bool
     */
    public function contains_feed(string $body, array $headers): bool
    {
        $file = new class () extends File {
            public function __construct() {}
        };

        $file->headers = $headers;
        $file->body = $body;
        $file->method = SimplePie::FILE_SOURCE_REMOTE;

        /** @var Locator */
        $locator = $this->registry->create(
            'Locator',
            [$file, 10, null, 10, false, []]
        );

        return (bool) $locator->is_feed($file, false);
    }

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
    public function detect_media_type(string $body, array $headers): string
    {
        $file = new class () extends File {
            public function __construct() {}
        };

        $file->headers = $headers;
        $file->body = $body;

        /** @var Sniffer */
        $sniffer = $this->registry->create(
            'Content_Type_Sniffer',
            [$file]
        );

        return (string) $sniffer->get_type();
    }
}

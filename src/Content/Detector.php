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

use SimplePie\HTTP\Response;

/**
 * Helper for feed auto-discovery and type sniffing
 *
 *
 * This class replaces
 * - \SimplePie\Locator and
 * - \SimplePie\Content\Type\Sniffer
 *
 * @package SimplePie
 * @internal
 */
final class Detector
{
    /**
     * Check if the response contains a feed
     *
     * @param Response $response
     *
     * @return bool
     */
    public function contains_feed(Response $response)
    {
        return in_array(
            $this->detect_type($response),
            [
                'application/rss+xml',
                'application/rdf+xml',
                'text/rdf',
                'application/atom+xml',
                'text/xml',
                'application/xml',
                'application/x-rss+xml'
            ]
        );
    }

    /**
     * Get the Content-Type of the provided response
     */
    public function detect_type(Response $response)
    {
        if (! $response->has_header('content-type')) {
            return $this->sniff_for_unknown_content($response->get_body_content());
        }

        $content_type = $response->get_header_line('content-type');

        if (! $response->has_header('content-encoding')
            && ($content_type === 'text/plain'
                || $content_type === 'text/plain; charset=ISO-8859-1'
                || $content_type === 'text/plain; charset=iso-8859-1'
                || $content_type === 'text/plain; charset=UTF-8')) {
            return $this->sniff_for_text_or_binary_content($response->get_body_content());
        }

        if (($pos = strpos($content_type, ';')) !== false) {
            $official = substr($content_type, 0, $pos);
        } else {
            $official = $content_type;
        }
        $official = trim(strtolower($official));

        if ($official === 'unknown/unknown'
            || $official === 'application/unknown') {
            return $this->sniff_for_unknown_content($response->get_body_content());
        } elseif (substr($official, -4) === '+xml'
            || $official === 'text/xml'
            || $official === 'application/xml') {
            return $official;
        } elseif (substr($official, 0, 6) === 'image/') {
            if ($return = $this->sniff_for_image_content($response->get_body_content())) {
                return $return;
            }

            return $official;
        } elseif ($official === 'text/html') {
            return $this->sniff_for_feed_or_html_content($response->get_body_content());
        }

        return $official;
    }

    /**
     * Sniff text or binary
     *
     * @param string $body
     *
     * @return string Actual Content-Type
     */
    private function sniff_for_text_or_binary_content($body)
    {
        if (substr($body, 0, 2) === "\xFE\xFF"
            || substr($body, 0, 2) === "\xFF\xFE"
            || substr($body, 0, 4) === "\x00\x00\xFE\xFF"
            || substr($body, 0, 3) === "\xEF\xBB\xBF") {
            return 'text/plain';
        } elseif (preg_match('/[\x00-\x08\x0E-\x1A\x1C-\x1F]/', $body)) {
            return 'application/octet-stream';
        }

        return 'text/plain';
    }

    /**
     * Sniff unknown
     *
     * @param string $body
     *
     * @return string Actual Content-Type
     */
    private function sniff_for_unknown_content($body)
    {
        $ws = strspn($body, "\x09\x0A\x0B\x0C\x0D\x20");
        if (strtolower(substr($body, $ws, 14)) === '<!doctype html'
            || strtolower(substr($body, $ws, 5)) === '<html'
            || strtolower(substr($body, $ws, 7)) === '<script') {
            return 'text/html';
        } elseif (substr($body, 0, 5) === '%PDF-') {
            return 'application/pdf';
        } elseif (substr($body, 0, 11) === '%!PS-Adobe-') {
            return 'application/postscript';
        }

        if ($return = $this->sniff_for_image_content($body)) {
            return $return;
        }

        return $this->sniff_for_text_or_binary_content($body);
    }

    /**
     * Sniff images
     *
     * @param string $body
     *
     * @return string|false Actual Content-Type or false
     */
    private function sniff_for_image_content($body)
    {
        if (substr($body, 0, 6) === 'GIF87a'
            || substr($body, 0, 6) === 'GIF89a') {
            return 'image/gif';
        } elseif (substr($body, 0, 8) === "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A") {
            return 'image/png';
        } elseif (substr($body, 0, 3) === "\xFF\xD8\xFF") {
            return 'image/jpeg';
        } elseif (substr($body, 0, 2) === "\x42\x4D") {
            return 'image/bmp';
        } elseif (substr($body, 0, 4) === "\x00\x00\x01\x00") {
            return 'image/vnd.microsoft.icon';
        }

        return false;
    }

    /**
     * Sniff HTML
     *
     * @param string $body
     *
     * @return string Actual Content-Type
     */
    private function sniff_for_feed_or_html_content($body)
    {
        $len = strlen($body);
        $pos = strspn($body, "\x09\x0A\x0D\x20\xEF\xBB\xBF");

        while ($pos < $len) {
            switch ($body[$pos]) {
                case "\x09":
                case "\x0A":
                case "\x0D":
                case "\x20":
                    $pos += strspn($body, "\x09\x0A\x0D\x20", $pos);
                    continue 2;

                case '<':
                    $pos++;
                    break;

                default:
                    return 'text/html';
            }

            if (substr($body, $pos, 3) === '!--') {
                $pos += 3;
                if ($pos < $len && ($pos = strpos($body, '-->', $pos)) !== false) {
                    $pos += 3;
                } else {
                    return 'text/html';
                }
            } elseif (substr($body, $pos, 1) === '!') {
                if ($pos < $len && ($pos = strpos($body, '>', $pos)) !== false) {
                    $pos++;
                } else {
                    return 'text/html';
                }
            } elseif (substr($body, $pos, 1) === '?') {
                if ($pos < $len && ($pos = strpos($body, '?>', $pos)) !== false) {
                    $pos += 2;
                } else {
                    return 'text/html';
                }
            } elseif (substr($body, $pos, 3) === 'rss'
                || substr($body, $pos, 7) === 'rdf:RDF') {
                return 'application/rss+xml';
            } elseif (substr($body, $pos, 4) === 'feed') {
                return 'application/atom+xml';
            } else {
                return 'text/html';
            }
        }

        return 'text/html';
    }
}

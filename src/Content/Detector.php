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

use DOMDocument;
use DOMElement;
use SimplePie\Exception;
use SimplePie\HTTP\Response;
use SimplePie\Registry;
use SimplePie\SimplePie;
use Throwable;

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
     * @var Registry
     */
    private $registry;

    /**
     * @var array
     */
    private $local = [];

    /**
     * @var array
     */
    private $elsewhere = [];

    /**
     * @var string
     */
    private $http_base;

    /**
     * @var string
     */
    private $base;

    /**
     * @var int
     */
    private $base_location = 0;

    /**
     * @var DOMDocument|null
     */
    private $dom = null;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Discover possible feed urls from HTML response
     *
     * @see https://simplepie.org/wiki/reference/simplepie/set_autodiscovery_level
     *
     * Inspired by the Ultra-liberal RSS locator from Mark Pilgrim
     * @link http://web.archive.org/web/20110607232437/http://diveintomark.org/archives/2002/08/15/ultraliberal_rss_locator
     *
     * @return array
     */
    public function discover_possible_feed_urls(Response $response, int $type = SimplePie::LOCATOR_ALL): array
    {
        $this->reset();

        // If Locator is disabled
        if ($type === SimplePie::LOCATOR_NONE) {
            return [];
        }

        // If response contains no HTML
        if ($this->detect_type($response) !== 'text/html') {
            return [];
        }

        try {
            $dom = new DOMDocument();
            $html_loaded = $dom->loadHTML($response->get_body_content());
        } catch (Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode(), $th);
        }

        if ($html_loaded === false) {
            throw new Exception('DOMDocument was unable to load the HTML.');
        }

        $this->dom = $dom;

        $this->get_base($response);
        $discovered = [];

        // All Feed Autodiscovery (points 1-6)
        if ($type & SimplePie::LOCATOR_AUTODISCOVERY) {
            $discovered = $this->autodiscovery($discovered);
        }

        if ($type & (SimplePie::LOCATOR_LOCAL_EXTENSION | SimplePie::LOCATOR_LOCAL_BODY | SimplePie::LOCATOR_REMOTE_EXTENSION | SimplePie::LOCATOR_REMOTE_BODY)) {
            if (! $this->discover_links()) {
                return $discovered;
            }

            if ($type & SimplePie::LOCATOR_LOCAL_EXTENSION) {
                return $this->extension($this->local);
            }

            if ($type & SimplePie::LOCATOR_LOCAL_BODY) {
                return $this->body($this->local);
            }

            if ($type & SimplePie::LOCATOR_REMOTE_EXTENSION) {
                return $this->extension($this->elsewhere);
            }

            if ($type & SimplePie::LOCATOR_REMOTE_BODY) {
                return $this->body($this->elsewhere);
            }
        }

        return $discovered;
    }

    /**
     * Check if the response contains a feed
     *
     * @param Response $response
     *
     * @return bool
     */
    public function contains_feed(Response $response): bool
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
     *
     * @param Response $response
     *
     * @return string Actual Content-Type
     */
    public function detect_type(Response $response): string
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
    private function sniff_for_text_or_binary_content(string $body): string
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
    private function sniff_for_unknown_content(string $body): string
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
    private function sniff_for_image_content(string $body)
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
    private function sniff_for_feed_or_html_content(string $body): string
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

    private function get_base(Response $response): void
    {
        $this->http_base = $response->get_requested_uri();
        $this->base = $this->http_base;

        foreach ($this->dom->getElementsByTagName('base') as $element) {
            if (! $element instanceof DOMElement) {
                continue;
            }

            if ($element->hasAttribute('href')) {

                $base = $this->registry->call('Misc', 'absolutize_url', [
                    trim($element->getAttribute('href')),
                    $this->http_base
                ]);


                if ($base === false) {
                    continue;
                }

                $this->base = $base;
                $this->base_location = method_exists($element, 'getLineNo') ? $element->getLineNo() : 0;

                break;
            }
        }
    }

    private function autodiscovery(array $feeds): array
    {
        $feeds = $this->search_elements_by_tag('link', $feeds);
        $feeds = $this->search_elements_by_tag('a', $feeds);
        $feeds = $this->search_elements_by_tag('area', $feeds);

        return $feeds;
    }

    private function search_elements_by_tag(string $name, array $feeds): array
    {
        $links = $this->dom->getElementsByTagName($name);
        foreach ($links as $link) {
            if (! $link instanceof DOMElement) {
                continue;
            }

            if (! $link->hasAttribute('href') || ! $link->hasAttribute('rel')) {
                continue;
            }

            $rel = array_unique($this->registry->call(
                'Misc',
                'space_separated_tokens',
                [strtolower($link->getAttribute('rel'))]
            ));
            $line = $link->getLineNo();

            if ($this->base_location < $line) {
                $href = $this->registry->call(
                    'Misc',
                    'absolutize_url',
                    [trim($link->getAttribute('href')), $this->base]
                );
            } else {
                $href = $this->registry->call(
                    'Misc',
                    'absolutize_url',
                    [trim($link->getAttribute('href')), $this->http_base]
                );
            }

            if ($href === false) {
                continue;
            }

            if (in_array($href, $feeds)) {
                continue;
            }

            if (
                in_array('feed', $rel)
                || (
                    in_array('alternate', $rel)
                    && !in_array('stylesheet', $rel)
                    && $link->hasAttribute('type')
                    && in_array(strtolower($this->registry->call('Misc', 'parse_mime', [$link->getAttribute('type')])), [
                        'text/html',
                        'application/rss+xml',
                        'application/atom+xml',
                    ])
                )
            ) {
                $feeds[] = $href;
            }
        }

        return $feeds;
    }

    private function discover_links(): bool
    {
        $links = $this->dom->getElementsByTagName('a');

        foreach ($links as $link) {
            if (! $link->hasAttribute('href')) {
                continue;
            }

            $href = trim($link->getAttribute('href'));
            $parsed = $this->registry->call('Misc', 'parse_url', [$href]);

            if ($parsed['scheme'] === '' || preg_match('/^(https?|feed)?$/i', $parsed['scheme'])) {
                if (method_exists($link, 'getLineNo') && $this->base_location < $link->getLineNo()) {
                    $href = $this->registry->call('Misc', 'absolutize_url', [trim($link->getAttribute('href')), $this->base]);
                } else {
                    $href = $this->registry->call('Misc', 'absolutize_url', [trim($link->getAttribute('href')), $this->http_base]);
                }
                if ($href === false) {
                    continue;
                }

                $current = $this->registry->call('Misc', 'parse_url', [$this->file->url]);

                if ($parsed['authority'] === '' || $parsed['authority'] === $current['authority']) {
                    $this->local[] = $href;
                } else {
                    $this->elsewhere[] = $href;
                }
            }
        }
        $this->local = array_unique($this->local);
        $this->elsewhere = array_unique($this->elsewhere);

        return (! empty($this->local) || ! empty($this->elsewhere));
    }

    private function extension(array $array): array
    {
        $feeds = [];

        foreach ($array as $value) {
            if (in_array(strtolower(strrchr($value, '.')), ['.rss', '.rdf', '.atom', '.xml'])) {
                $feeds[] = $value;

                // $headers = [
                //     'Accept' => 'application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1',
                // ];
                // $feed = $this->registry->create('File', [$value, $this->timeout, 5, $headers, $this->useragent, $this->force_fsockopen, $this->curl_options]);
                // if ($feed->success && ($feed->method & SimplePie::FILE_SOURCE_REMOTE === 0 || ($feed->status_code === 200 || $feed->status_code > 206 && $feed->status_code < 300)) && $this->is_feed($feed)) {
                //     return [$feed];
                // } else {
                //     unset($array[$key]);
                // }
            }
        }
        return $feeds;
    }

    private function body(array $array): array
    {
        $feeds = [];

        foreach ($array as $key => $value) {
            if (preg_match('/(feed|rss|rdf|atom|xml)/i', $value)) {
                $feeds[] = $value;

                // $headers = [
                //     'Accept' => 'application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1',
                // ];
                // $feed = $this->registry->create('File', [$value, $this->timeout, 5, null, $this->useragent, $this->force_fsockopen, $this->curl_options]);
                // if ($feed->success && ($feed->method & SimplePie::FILE_SOURCE_REMOTE === 0 || ($feed->status_code === 200 || $feed->status_code > 206 && $feed->status_code < 300)) && $this->is_feed($feed)) {
                //     return [$feed];
                // } else {
                //     unset($array[$key]);
                // }
            }
        }

        return $feeds;
    }

    private function reset(): void
    {
        $this->local = [];
        $this->elsewhere = [];
        $this->http_base;
        $this->base;
        $this->base_location = 0;
        $this->dom = null;
    }
}

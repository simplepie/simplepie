<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie;

use SimplePie\XML\Declaration\Parser as DeclarationParser;
use XMLParser;

/**
 * Parses XML into something sane
 *
 *
 * This class can be overloaded with {@see \SimplePie\SimplePie::set_parser_class()}
 */
class Parser implements RegistryAware
{
    /** @var int */
    public $error_code;
    /** @var string */
    public $error_string;
    /** @var int */
    public $current_line;
    /** @var int */
    public $current_column;
    /** @var int */
    public $current_byte;
    /** @var string */
    public $separator = ' ';
    /** @var string[] */
    public $namespace = [''];
    /** @var string[] */
    public $element = [''];
    /** @var string[] */
    public $xml_base = [''];
    /** @var bool[] */
    public $xml_base_explicit = [false];
    /** @var string[] */
    public $xml_lang = [''];
    /** @var array<string, mixed> */
    public $data = [];
    /** @var array<array<string, mixed>> */
    public $datas = [[]];
    /** @var int */
    public $current_xhtml_construct = -1;
    /** @var string */
    public $encoding;
    /** @var Registry */
    protected $registry;

    /**
     * @return void
     */
    public function set_registry(\SimplePie\Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return bool
     */
    public function parse(string &$data, string $encoding, string $url = '')
    {
        if (class_exists('DOMXpath') && function_exists('Mf2\parse')) {
            $doc = new \DOMDocument();
            @$doc->loadHTML($data);
            $xpath = new \DOMXpath($doc);
            // Check for both h-feed and h-entry, as both a feed with no entries
            // and a list of entries without an h-feed wrapper are both valid.
            $query = '//*[contains(concat(" ", @class, " "), " h-feed ") or '.
                'contains(concat(" ", @class, " "), " h-entry ")]';
            $result = $xpath->query($query);
            if ($result->length !== 0) {
                return $this->parse_microformats($data, $url);
            }
        }

        // Use UTF-8 if we get passed US-ASCII, as every US-ASCII character is a UTF-8 character
        if (strtoupper($encoding) === 'US-ASCII') {
            $this->encoding = 'UTF-8';
        } else {
            $this->encoding = $encoding;
        }

        // Strip BOM:
        // UTF-32 Big Endian BOM
        if (substr($data, 0, 4) === "\x00\x00\xFE\xFF") {
            $data = substr($data, 4);
        }
        // UTF-32 Little Endian BOM
        elseif (substr($data, 0, 4) === "\xFF\xFE\x00\x00") {
            $data = substr($data, 4);
        }
        // UTF-16 Big Endian BOM
        elseif (substr($data, 0, 2) === "\xFE\xFF") {
            $data = substr($data, 2);
        }
        // UTF-16 Little Endian BOM
        elseif (substr($data, 0, 2) === "\xFF\xFE") {
            $data = substr($data, 2);
        }
        // UTF-8 BOM
        elseif (substr($data, 0, 3) === "\xEF\xBB\xBF") {
            $data = substr($data, 3);
        }

        if (substr($data, 0, 5) === '<?xml' && strspn(substr($data, 5, 1), "\x09\x0A\x0D\x20") && ($pos = strpos($data, '?>')) !== false) {
            $declaration = $this->registry->create(DeclarationParser::class, [substr($data, 5, $pos - 5)]);
            if ($declaration->parse()) {
                $data = substr($data, $pos + 2);
                $data = '<?xml version="' . $declaration->version . '" encoding="' . $encoding . '" standalone="' . (($declaration->standalone) ? 'yes' : 'no') . '"?>' . "\n" . $data;
            } else {
                $this->error_string = 'SimplePie bug! Please report this!';
                return false;
            }
        }

        $return = true;

        static $xml_is_sane = null;
        if ($xml_is_sane === null) {
            $parser_check = xml_parser_create();
            xml_parse_into_struct($parser_check, '<foo>&amp;</foo>', $values);
            xml_parser_free($parser_check);
            $xml_is_sane = isset($values[0]['value']);
        }

        // Create the parser
        if ($xml_is_sane) {
            $xml = xml_parser_create_ns($this->encoding, $this->separator);
            xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1);
            xml_parser_set_option($xml, XML_OPTION_CASE_FOLDING, 0);
            xml_set_character_data_handler($xml, [$this, 'cdata']);
            xml_set_element_handler($xml, [$this, 'tag_open'], [$this, 'tag_close']);

            // Parse!
            $wrapper = @is_writable(sys_get_temp_dir()) ? 'php://temp' : 'php://memory';
            if (($stream = fopen($wrapper, 'r+')) &&
                fwrite($stream, $data) &&
                rewind($stream)) {
                //Parse by chunks not to use too much memory
                do {
                    $stream_data = fread($stream, 1048576);
                    // NB: At some point between PHP 7.3 and 7.4, the signature for `fread()` has changed
                    // from returning `string` to returning `string|false`, hence the falsy check:
                    if (!xml_parse($xml, $stream_data == false ? '' : $stream_data, feof($stream))) {
                        $this->error_code = xml_get_error_code($xml);
                        $this->error_string = xml_error_string($this->error_code);
                        $return = false;
                        break;
                    }
                } while (!feof($stream));
                fclose($stream);
            } else {
                $return = false;
            }

            $this->current_line = xml_get_current_line_number($xml);
            $this->current_column = xml_get_current_column_number($xml);
            $this->current_byte = xml_get_current_byte_index($xml);
            xml_parser_free($xml);
            return $return;
        }

        libxml_clear_errors();
        $xml = new \XMLReader();
        $xml->xml($data);
        while (@$xml->read()) {
            switch ($xml->nodeType) {
                case constant('XMLReader::END_ELEMENT'):
                    if ($xml->namespaceURI !== '') {
                        $tagName = $xml->namespaceURI . $this->separator . $xml->localName;
                    } else {
                        $tagName = $xml->localName;
                    }
                    $this->tag_close(null, $tagName);
                    break;
                case constant('XMLReader::ELEMENT'):
                    $empty = $xml->isEmptyElement;
                    if ($xml->namespaceURI !== '') {
                        $tagName = $xml->namespaceURI . $this->separator . $xml->localName;
                    } else {
                        $tagName = $xml->localName;
                    }
                    $attributes = [];
                    while ($xml->moveToNextAttribute()) {
                        if ($xml->namespaceURI !== '') {
                            $attrName = $xml->namespaceURI . $this->separator . $xml->localName;
                        } else {
                            $attrName = $xml->localName;
                        }
                        $attributes[$attrName] = $xml->value;
                    }
                    $this->tag_open(null, $tagName, $attributes);
                    if ($empty) {
                        $this->tag_close(null, $tagName);
                    }
                    break;
                case constant('XMLReader::TEXT'):

                case constant('XMLReader::CDATA'):
                    $this->cdata(null, $xml->value);
                    break;
            }
        }
        if ($error = libxml_get_last_error()) {
            $this->error_code = $error->code;
            $this->error_string = $error->message;
            $this->current_line = $error->line;
            $this->current_column = $error->column;
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    public function get_error_code()
    {
        return $this->error_code;
    }

    /**
     * @return string
     */
    public function get_error_string()
    {
        return $this->error_string;
    }

    /**
     * @return int
     */
    public function get_current_line()
    {
        return $this->current_line;
    }

    /**
     * @return int
     */
    public function get_current_column()
    {
        return $this->current_column;
    }

    /**
     * @return int
     */
    public function get_current_byte()
    {
        return $this->current_byte;
    }

    /**
     * @return array<string, mixed>
     */
    public function get_data()
    {
        return $this->data;
    }

    /**
     * @param XMLParser|resource|null $parser
     * @param array<string, string> $attributes
     * @return void
     */
    public function tag_open($parser, string $tag, array $attributes)
    {
        [$this->namespace[], $this->element[]] = $this->split_ns($tag);

        $attribs = [];
        foreach ($attributes as $name => $value) {
            [$attrib_namespace, $attribute] = $this->split_ns($name);
            $attribs[$attrib_namespace][$attribute] = $value;
        }

        if (isset($attribs[\SimplePie\SimplePie::NAMESPACE_XML]['base'])) {
            $base = $this->registry->call(Misc::class, 'absolutize_url', [$attribs[\SimplePie\SimplePie::NAMESPACE_XML]['base'], end($this->xml_base)]);
            if ($base !== false) {
                $this->xml_base[] = $base;
                $this->xml_base_explicit[] = true;
            }
        } else {
            $this->xml_base[] = end($this->xml_base);
            $this->xml_base_explicit[] = end($this->xml_base_explicit);
        }

        if (isset($attribs[\SimplePie\SimplePie::NAMESPACE_XML]['lang'])) {
            $this->xml_lang[] = $attribs[\SimplePie\SimplePie::NAMESPACE_XML]['lang'];
        } else {
            $this->xml_lang[] = end($this->xml_lang);
        }

        if ($this->current_xhtml_construct >= 0) {
            $this->current_xhtml_construct++;
            if (end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_XHTML) {
                $this->data['data'] .= '<' . end($this->element);
                if (isset($attribs[''])) {
                    foreach ($attribs[''] as $name => $value) {
                        $this->data['data'] .= ' ' . $name . '="' . htmlspecialchars($value, ENT_COMPAT, $this->encoding) . '"';
                    }
                }
                $this->data['data'] .= '>';
            }
        } else {
            $this->datas[] = &$this->data;
            $this->data = &$this->data['child'][end($this->namespace)][end($this->element)][];
            $this->data = ['data' => '', 'attribs' => $attribs, 'xml_base' => end($this->xml_base), 'xml_base_explicit' => end($this->xml_base_explicit), 'xml_lang' => end($this->xml_lang)];
            if ((end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_ATOM_03 && in_array(end($this->element), ['title', 'tagline', 'copyright', 'info', 'summary', 'content']) && isset($attribs['']['mode']) && $attribs['']['mode'] === 'xml')
            || (end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_ATOM_10 && in_array(end($this->element), ['rights', 'subtitle', 'summary', 'info', 'title', 'content']) && isset($attribs['']['type']) && $attribs['']['type'] === 'xhtml')
            || (end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_RSS_20 && in_array(end($this->element), ['title']))
            || (end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_RSS_090 && in_array(end($this->element), ['title']))
            || (end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_RSS_10 && in_array(end($this->element), ['title']))) {
                $this->current_xhtml_construct = 0;
            }
        }
    }

    /**
     * @param XMLParser|resource|null $parser
     * @return void
     */
    public function cdata($parser, string $cdata)
    {
        if ($this->current_xhtml_construct >= 0) {
            $this->data['data'] .= htmlspecialchars($cdata, ENT_QUOTES, $this->encoding);
        } else {
            $this->data['data'] .= $cdata;
        }
    }

    /**
     * @param XMLParser|resource|null $parser
     * @return void
     */
    public function tag_close($parser, string $tag)
    {
        if ($this->current_xhtml_construct >= 0) {
            $this->current_xhtml_construct--;
            if (end($this->namespace) === \SimplePie\SimplePie::NAMESPACE_XHTML && !in_array(end($this->element), ['area', 'base', 'basefont', 'br', 'col', 'frame', 'hr', 'img', 'input', 'isindex', 'link', 'meta', 'param'])) {
                $this->data['data'] .= '</' . end($this->element) . '>';
            }
        }
        if ($this->current_xhtml_construct === -1) {
            $this->data = &$this->datas[count($this->datas) - 1];
            array_pop($this->datas);
        }

        array_pop($this->element);
        array_pop($this->namespace);
        array_pop($this->xml_base);
        array_pop($this->xml_base_explicit);
        array_pop($this->xml_lang);
    }

    /**
     * @return array{string, string}
     */
    public function split_ns(string $string)
    {
        static $cache = [];
        if (!isset($cache[$string])) {
            if ($pos = strpos($string, $this->separator)) {
                static $separator_length;
                if (!$separator_length) {
                    $separator_length = strlen($this->separator);
                }
                $namespace = substr($string, 0, $pos);
                $local_name = substr($string, $pos + $separator_length);
                if (strtolower($namespace) === \SimplePie\SimplePie::NAMESPACE_ITUNES) {
                    $namespace = \SimplePie\SimplePie::NAMESPACE_ITUNES;
                }

                // Normalize the Media RSS namespaces
                if ($namespace === \SimplePie\SimplePie::NAMESPACE_MEDIARSS_WRONG ||
                    $namespace === \SimplePie\SimplePie::NAMESPACE_MEDIARSS_WRONG2 ||
                    $namespace === \SimplePie\SimplePie::NAMESPACE_MEDIARSS_WRONG3 ||
                    $namespace === \SimplePie\SimplePie::NAMESPACE_MEDIARSS_WRONG4 ||
                    $namespace === \SimplePie\SimplePie::NAMESPACE_MEDIARSS_WRONG5) {
                    $namespace = \SimplePie\SimplePie::NAMESPACE_MEDIARSS;
                }
                $cache[$string] = [$namespace, $local_name];
            } else {
                $cache[$string] = ['', $string];
            }
        }
        return $cache[$string];
    }

    /**
     * @param array<string, mixed> $data
     */
    private function parse_hcard(array $data, bool $category = false): string
    {
        $name = '';
        $link = '';
        // Check if h-card is set and pass that information on in the link.
        if (isset($data['type']) && in_array('h-card', $data['type'])) {
            if (isset($data['properties']['name'][0])) {
                $name = $data['properties']['name'][0];
            }
            if (isset($data['properties']['url'][0])) {
                $link = $data['properties']['url'][0];
                if ($name === '') {
                    $name = $link;
                } else {
                    // can't have commas in categories.
                    $name = str_replace(',', '', $name);
                }
                $person_tag = $category ? '<span class="person-tag"></span>' : '';
                return '<a class="h-card" href="'.$link.'">'.$person_tag.$name.'</a>';
            }
        }
        return $data['value'] ?? '';
    }

    /**
     * @return true
     */
    private function parse_microformats(string &$data, string $url): bool
    {
        $feed_title = '';
        $feed_author = null;
        $author_cache = [];
        $items = [];
        $entries = [];
        $mf = \Mf2\parse($data, $url);
        // First look for an h-feed.
        $h_feed = [];
        foreach ($mf['items'] as $mf_item) {
            if (in_array('h-feed', $mf_item['type'])) {
                $h_feed = $mf_item;
                break;
            }
            // Also look for h-feed or h-entry in the children of each top level item.
            if (!isset($mf_item['children'][0]['type'])) {
                continue;
            }
            if (in_array('h-feed', $mf_item['children'][0]['type'])) {
                $h_feed = $mf_item['children'][0];
                // In this case the parent of the h-feed may be an h-card, so use it as
                // the feed_author.
                if (in_array('h-card', $mf_item['type'])) {
                    $feed_author = $mf_item;
                }
                break;
            } elseif (in_array('h-entry', $mf_item['children'][0]['type'])) {
                $entries = $mf_item['children'];
                // In this case the parent of the h-entry list may be an h-card, so use
                // it as the feed_author.
                if (in_array('h-card', $mf_item['type'])) {
                    $feed_author = $mf_item;
                }
                break;
            }
        }
        if (isset($h_feed['children'])) {
            $entries = $h_feed['children'];
            // Also set the feed title and store author from the h-feed if available.
            if (isset($mf['items'][0]['properties']['name'][0])) {
                $feed_title = $mf['items'][0]['properties']['name'][0];
            }
            if (isset($mf['items'][0]['properties']['author'][0])) {
                $feed_author = $mf['items'][0]['properties']['author'][0];
            }
        } elseif (count($entries) === 0) {
            $entries = $mf['items'];
        }
        for ($i = 0; $i < count($entries); $i++) {
            $entry = $entries[$i];
            if (in_array('h-entry', $entry['type'])) {
                $item = [];
                $title = '';
                $description = '';
                if (isset($entry['properties']['url'][0])) {
                    $link = $entry['properties']['url'][0];
                    if (isset($link['value'])) {
                        $link = $link['value'];
                    }
                    $item['link'] = [['data' => $link]];
                }
                if (isset($entry['properties']['uid'][0])) {
                    $guid = $entry['properties']['uid'][0];
                    if (isset($guid['value'])) {
                        $guid = $guid['value'];
                    }
                    $item['guid'] = [['data' => $guid]];
                }
                if (isset($entry['properties']['name'][0])) {
                    $title = $entry['properties']['name'][0];
                    if (isset($title['value'])) {
                        $title = $title['value'];
                    }
                    $item['title'] = [['data' => $title]];
                }
                if (isset($entry['properties']['author'][0]) || isset($feed_author)) {
                    // author is a special case, it can be plain text or an h-card array.
                    // If it's plain text it can also be a url that should be followed to
                    // get the actual h-card.
                    $author = $entry['properties']['author'][0] ?? $feed_author;
                    if (!is_string($author)) {
                        $author = $this->parse_hcard($author);
                    } elseif (strpos($author, 'http') === 0) {
                        if (isset($author_cache[$author])) {
                            $author = $author_cache[$author];
                        } else {
                            $mf = \Mf2\fetch($author);
                            foreach ($mf['items'] as $hcard) {
                                // Only interested in an h-card by itself in this case.
                                if (!in_array('h-card', $hcard['type'])) {
                                    continue;
                                }
                                // It must have a url property matching what we fetched.
                                if (!isset($hcard['properties']['url']) ||
                                        !(in_array($author, $hcard['properties']['url']))) {
                                    continue;
                                }
                                // Save parse_hcard the trouble of finding the correct url.
                                $hcard['properties']['url'][0] = $author;
                                // Cache this h-card for the next h-entry to check.
                                $author_cache[$author] = $this->parse_hcard($hcard);
                                $author = $author_cache[$author];
                                break;
                            }
                        }
                    }
                    $item['author'] = [['data' => $author]];
                }
                if (isset($entry['properties']['photo'][0])) {
                    // If a photo is also in content, don't need to add it again here.
                    $content = '';
                    if (isset($entry['properties']['content'][0]['html'])) {
                        $content = $entry['properties']['content'][0]['html'];
                    }
                    $photo_list = [];
                    for ($j = 0; $j < count($entry['properties']['photo']); $j++) {
                        $photo = $entry['properties']['photo'][$j];
                        if (!empty($photo) && strpos($content, $photo) === false) {
                            $photo_list[] = $photo;
                        }
                    }
                    // When there's more than one photo show the first and use a lightbox.
                    // Need a permanent, unique name for the image set, but don't have
                    // anything unique except for the content itself, so use that.
                    $count = count($photo_list);
                    if ($count > 1) {
                        $image_set_id = preg_replace('/[[:^alnum:]]/', '', $photo_list[0]);
                        $description = '<p>';
                        for ($j = 0; $j < $count; $j++) {
                            $hidden = $j === 0 ? '' : 'class="hidden" ';
                            $description .= '<a href="'.$photo_list[$j].'" '.$hidden.
                                'data-lightbox="image-set-'.$image_set_id.'">'.
                                '<img src="'.$photo_list[$j].'"></a>';
                        }
                        $description .= '<br><b>'.$count.' photos</b></p>';
                    } elseif ($count == 1) {
                        $description = '<p><img src="'.$photo_list[0].'"></p>';
                    }
                }
                if (isset($entry['properties']['content'][0]['html'])) {
                    // e-content['value'] is the same as p-name when they are on the same
                    // element. Use this to replace title with a strip_tags version so
                    // that alt text from images is not included in the title.
                    if ($entry['properties']['content'][0]['value'] === $title) {
                        $title = strip_tags($entry['properties']['content'][0]['html']);
                        $item['title'] = [['data' => $title]];
                    }
                    $description .= $entry['properties']['content'][0]['html'];
                    if (isset($entry['properties']['in-reply-to'][0])) {
                        $in_reply_to = '';
                        if (is_string($entry['properties']['in-reply-to'][0])) {
                            $in_reply_to = $entry['properties']['in-reply-to'][0];
                        } elseif (isset($entry['properties']['in-reply-to'][0]['value'])) {
                            $in_reply_to = $entry['properties']['in-reply-to'][0]['value'];
                        }
                        if ($in_reply_to !== '') {
                            $description .= '<p><span class="in-reply-to"></span> '.
                                '<a href="'.$in_reply_to.'">'.$in_reply_to.'</a><p>';
                        }
                    }
                    $item['description'] = [['data' => $description]];
                }
                if (isset($entry['properties']['category'])) {
                    $category_csv = '';
                    // Categories can also contain h-cards.
                    foreach ($entry['properties']['category'] as $category) {
                        if ($category_csv !== '') {
                            $category_csv .= ', ';
                        }
                        if (is_string($category)) {
                            // Can't have commas in categories.
                            $category_csv .= str_replace(',', '', $category);
                        } else {
                            $category_csv .= $this->parse_hcard($category, true);
                        }
                    }
                    $item['category'] = [['data' => $category_csv]];
                }
                if (isset($entry['properties']['published'][0])) {
                    $timestamp = strtotime($entry['properties']['published'][0]);
                    $pub_date = date('F j Y g:ia', $timestamp).' GMT';
                    $item['pubDate'] = [['data' => $pub_date]];
                }
                // The title and description are set to the empty string to represent
                // a deleted item (which also makes it an invalid rss item).
                if (isset($entry['properties']['deleted'][0])) {
                    $item['title'] = [['data' => '']];
                    $item['description'] = [['data' => '']];
                }
                $items[] = ['child' => ['' => $item]];
            }
        }
        // Mimic RSS data format when storing microformats.
        $link = [['data' => $url]];
        $image = '';
        if (!is_string($feed_author) &&
                isset($feed_author['properties']['photo'][0])) {
            $image = [['child' => ['' => ['url' =>
                [['data' => $feed_author['properties']['photo'][0]]]]]]];
        }
        // Use the name given for the h-feed, or get the title from the html.
        if ($feed_title !== '') {
            $feed_title = [['data' => htmlspecialchars($feed_title)]];
        } elseif ($position = strpos($data, '<title>')) {
            $start = $position < 200 ? 0 : $position - 200;
            $check = substr($data, $start, 400);
            $matches = [];
            if (preg_match('/<title>(.+)<\/title>/', $check, $matches)) {
                $feed_title = [['data' => htmlspecialchars($matches[1])]];
            }
        }
        $channel = ['channel' => [['child' => ['' =>
            ['link' => $link, 'image' => $image, 'title' => $feed_title,
                  'item' => $items]]]]];
        $rss = [['attribs' => ['' => ['version' => '2.0']],
                           'child' => ['' => $channel]]];
        $this->data = ['child' => ['' => ['rss' => $rss]]];
        return true;
    }
}

class_alias('SimplePie\Parser', 'SimplePie_Parser');

<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie;

/**
 * Handles `<psc:chapter>` as defined in Podlove Simple Chapters
 *
 * Used by {@see \SimplePie\Item::get_chapters()}
 */
class Chapter
{
    /**
     * Start time as written in the feed
     *
     * @var string
     * @see get_start()
     */
    public $start;

    /**
     * Chapter title
     *
     * @var ?string
     * @see get_title()
     */
    public $title;

    /**
     * Chapter link
     *
     * @var ?string
     * @see get_href()
     */
    public $href;

    /**
     * Chapter image
     *
     * @var ?string
     * @see get_image()
     */
    public $image;

    /**
     * Constructor, used to input the data
     *
     * For documentation on all the parameters, see the corresponding
     * properties and their accessors
     */
    public function __construct(
        string $start,
        ?string $title = null,
        ?string $href = null,
        ?string $image = null
    ) {
        $this->start = $start;
        $this->title = $title;
        $this->href = $href;
        $this->image = $image;
    }

    /**
     * String-ified version
     *
     * @return string
     */
    public function __toString()
    {
        // There is no $this->data here
        return md5(serialize($this));
    }

    /**
     * Get the start time as written in the feed
     */
    public function get_start(): string
    {
        return $this->start;
    }

    /**
     * Get the start time in seconds
     *
     * Accepts the Normal Play Time formats `HH:MM:SS(.mmm)`, `MM:SS(.mmm)` and `SS(.mmm)`
     */
    public function get_start_seconds(): ?float
    {
        if (!preg_match('/^(?:(?:(\d+):)?(\d+):)?(\d+)(\.\d+)?$/', $this->start, $match)) {
            return null;
        }

        return (int) $match[1] * 3600 + (int) $match[2] * 60 + (int) $match[3] + (float) ($match[4] ?? 0);
    }

    /**
     * Get the chapter title
     */
    public function get_title(): ?string
    {
        return $this->title;
    }

    /**
     * Get the chapter link
     */
    public function get_href(): ?string
    {
        return $this->href;
    }

    /**
     * Get the chapter image
     */
    public function get_image(): ?string
    {
        return $this->image;
    }
}

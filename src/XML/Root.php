<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\XML;

/**
 * Models XML root.
 * @internal
 */
final class Root
{
    private string $name;
    private string $ns;
    private Element $element;

    // private ?string $xml_base = null;

    // private bool $xml_base_explicit = false;

    // private ?string $xml_lang = null;

    // private string $text = '';

    public function __construct(string $name, Element $element, string $ns = '')
    {
        $this->name = $name;
        $this->ns = $ns;
        $this->element = $element;
    }

    /**
     * @return array<mixed>
     */
    public function get_legacy_representation(): array
    {
        return [
            'child' => [$this->ns => [$this->name => $this->element->get_legacy_representation(),],],
        ];
    }
}

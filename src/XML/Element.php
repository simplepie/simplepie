<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\XML;

/**
 * Models XML element data in a form ready for lookups.
 * @internal
 */
final class Element
{
    /** @var array<string, array<string, string>> attributes grouped by namespace */
    private array $attrs = ['' => []];

    /** @var array<string, array<string, Element>> children grouped by namespace */
    private array $children = [];

    private ?string $xml_base = null;

    private bool $xml_base_explicit = false;

    private ?string $xml_lang = null;

    private string $text = '';

    /**
     * @return array<mixed>
     */
    public function get_legacy_representation(): array
    {
        return [
            'child' => array_map($this->children, fn ($children) => array_map($children, fn ($child) => $child->get_legacy_representation())),
            'attrs' => $this->attrs,
            'data' => htmlspecialchars($this->text),
        ];
    }

    // TODO: docs
    public function withText(string $text): static {
        $element = (clone) $this;
        $element->text = $text;

        return $element;
    }

    public function withAttr(string $name, string $value, string $ns = ''): static {
        $element = (clone) $this;
        $element->attrs[$ns][$name][] = $value;

        return $element;
    }

    public function withChild(string $name, Element $child, string $ns = ''): static {
        $element = (clone) $this;
        $element->children[$ns][$name][] = $child;

        return $element;
    }

    // TODO: getters
}

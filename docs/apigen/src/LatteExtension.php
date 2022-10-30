<?php

declare(strict_types = 1);

namespace SimplePie\ApiGen;

use ApiGen;
use Latte\Runtime\FilterInfo;

/**
 * Define extra Latte filters for use in our overridden theme templates.
 */
final class LatteExtension extends ApiGen\Renderer\Latte\LatteExtension
{
    public function getFilters(): array
    {
        return array_merge(parent::getFilters(), [
            'markdownSafe' => $this->markdownSafe(...),
        ]);
    }

    /**
     * To use a consistent layout between API docs and the rest of the website,
     * we are outputting the HTML produced by ApiGen into Markdown files.
     * The HTML output is indented, though and Zola will interpret indented lines
     * following a blank line in a Markdown document as a start of a code block,
     * ruining the page content.
     *
     * This filter removes blank lines to prevent this from happening.
     */
    private function markdownSafe(FilterInfo $info, $s): string {
        return preg_replace('/([\t ]*\n)+/', "\n", $s);
    }
}

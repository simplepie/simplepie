<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Content;

use SimplePie\Content\Type\Sniffer;
use SimplePie\File;
use SimplePie\HTTP\Response;
use SimplePie\Locator;
use SimplePie\Registry;
use SimplePie\RegistryAware;
use SimplePie\SimplePie;

/**
 * BC helper for feed auto-discovery and type sniffing
 *
 * This class internally uses
 * - \SimplePie\Locator and
 * - \SimplePie\Content\Type\Sniffer
 *
 * @internal
 */
final class VerifiedFeedsDetector implements Detector, RegistryAware
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
     * @inheritDoc
     *
     * @return string[] Always returns an array with a single URI that was verified for containing feed.
     */
    public function discover_possible_feed_urls(Response $response, int $discovery_level = SimplePie::LOCATOR_ALL): array
    {
        /** @var Locator */
        $locator = $this->registry->create(
            Locator::class,
            [
                (! $response instanceof File) ? File::fromResponse($response) : $response,
                10,
                null,
                10,
                false,
                []
            ]
        );

        $all_discovered_feeds = [];

        /** @var File|null */
        $result = $locator->find($discovery_level, $all_discovered_feeds);

        if (is_object($result) && $result instanceof Response) {
            return [$result->get_permanent_uri()];
        }

        return [];
    }

    public function contains_feed(Response $response): bool
    {
        /** @var Locator */
        $locator = $this->registry->create(
            Locator::class,
            [
                (! $response instanceof File) ? File::fromResponse($response) : $response,
                10,
                null,
                10,
                false,
                []
            ]
        );

        return (bool) $locator->is_feed($response, false);
    }

    public function detect_media_type(Response $response): string
    {
        /** @var Sniffer */
        $sniffer = $this->registry->create(
            Sniffer::class,
            [$response]
        );

        return (string) $sniffer->get_type();
    }
}

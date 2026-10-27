<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use SimplePie\HTTP\UrlPolicy;

final class UrlPolicyTest extends TestCase
{
    public function testAllowsHttpUrisByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertTrue($policy->is_allowed('http://example.com/feed.xml'));
        self::assertTrue($policy->is_allowed('https://example.com/feed.xml'));
    }

    public function testAllowsHttpUrisForDiscoveredUrls(): void
    {
        $policy = new UrlPolicy();

        self::assertTrue($policy->is_allowed('http://example.com/feed.xml', true));
        self::assertTrue($policy->is_allowed('https://example.com/feed.xml', true));
    }

    public function testRejectsLocalFilesByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertFalse($policy->is_allowed('file:///etc/passwd'));
        self::assertFalse($policy->is_allowed('/etc/passwd'));
    }

    public function testRejectsStreamWrapperUrisByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertFalse($policy->is_allowed('php://filter/resource=/etc/passwd'));
    }

    public function testGetAllowLocalFilesIsDisabledByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertFalse($policy->get_allow_local_files());
    }

    public function testAllowsLocalFilesAfterOptIn(): void
    {
        $policy = new UrlPolicy();
        $policy->set_allow_local_files(true);

        self::assertTrue($policy->get_allow_local_files());
        self::assertTrue($policy->is_allowed('/etc/passwd'));
        self::assertTrue($policy->is_allowed('file:///etc/passwd'));
    }

    public function testDiscoveredUrlsAreAlwaysRestrictedToHttp(): void
    {
        $policy = new UrlPolicy();
        $policy->set_allow_local_files(true);

        self::assertTrue($policy->get_allow_local_files());
        self::assertFalse($policy->is_allowed('file:///etc/passwd', true));
        self::assertFalse($policy->is_allowed('/etc/passwd', true));
        self::assertTrue($policy->is_allowed('https://example.com/feed.xml', true));
    }
}

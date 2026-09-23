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

        self::assertTrue($policy->isAllowed('http://example.com/feed.xml'));
        self::assertTrue($policy->isAllowed('https://example.com/feed.xml'));
    }

    public function testAllowsHttpUrisForDiscoveredUrls(): void
    {
        $policy = new UrlPolicy();

        self::assertTrue($policy->isAllowed('http://example.com/feed.xml', true));
        self::assertTrue($policy->isAllowed('https://example.com/feed.xml', true));
    }

    public function testRejectsLocalFilesByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertFalse($policy->isAllowed('file:///etc/passwd'));
        self::assertFalse($policy->isAllowed('/etc/passwd'));
    }

    public function testRejectsStreamWrapperUrisByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertFalse($policy->isAllowed('php://filter/resource=/etc/passwd'));
    }

    public function testGetAllowLocalFilesIsDisabledByDefault(): void
    {
        $policy = new UrlPolicy();

        self::assertFalse($policy->getAllowLocalFiles());
    }

    public function testAllowsLocalFilesAfterOptIn(): void
    {
        $policy = new UrlPolicy();
        $policy->setAllowLocalFiles(true);

        self::assertTrue($policy->getAllowLocalFiles());
        self::assertTrue($policy->isAllowed('/etc/passwd'));
        self::assertTrue($policy->isAllowed('file:///etc/passwd'));
    }

    public function testDiscoveredUrlsAreAlwaysRestrictedToHttp(): void
    {
        $policy = new UrlPolicy();
        $policy->setAllowLocalFiles(true);

        self::assertTrue($policy->getAllowLocalFiles());
        self::assertFalse($policy->isAllowed('file:///etc/passwd', true));
        self::assertFalse($policy->isAllowed('/etc/passwd', true));
        self::assertTrue($policy->isAllowed('https://example.com/feed.xml', true));
    }
}

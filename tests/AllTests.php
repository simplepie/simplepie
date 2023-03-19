<?php

// SPDX-FileCopyrightText: 2004-2023 Ryan Parman, Sam Sneddon, Ryan McCue
// SPDX-License-Identifier: BSD-3-Clause

declare(strict_types=1);

require_once dirname(__FILE__) . '/EncodingTest.php';
require_once dirname(__FILE__) . '/IRITest.php';
require_once dirname(__FILE__) . '/LocatorTest.php';
require_once dirname(__FILE__) . '/ItemTest.php';

class AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit\Framework\TestSuite();
        $suite->setName('SimplePie');

        $suite->addTestSuite('CacheTest');
        $suite->addTestSuite('EncodingTest');
        $suite->addTestSuite('IRITest');
        $suite->addTestSuite('LocatorTest');
        $suite->addTestSuite('HTTPParserTest');
        $suite->addTestSuite('ItemTest');
        $suite->addTestSuite('OldTest');
        $suite->addTestSuite('SubscribeUrlTest');

        return $suite;
    }
}

<?php

date_default_timezone_set('UTC');
error_reporting(E_ALL | E_STRICT);

require_once dirname(__FILE__) . '/oldtests/compat_test_harness.php';
require_once dirname(__FILE__) . '/oldtests/functions.php';

class OldTest extends PHPUnit\Framework\TestCase
{
    public function getTests()
    {
        $master = new Unit_Test2_Group('SimplePie Test Suite');

        $test_group = new SimplePie_Unit_Test2_Group('Who knows a <title> from a hole in the ground?');
        $master->add($test_group);

        $tests = array();
        return $tests;
    }

    /**
     * @dataProvider getTests
     */
    public function testOld($test)
    {
        $test->run();
        $this->assertSame($test->expected, $test->result);
    }
}

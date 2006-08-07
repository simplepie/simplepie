<?php

// This tests that references are resoloved properly. Tests come from RFC3986 (URI Generic Syntax) section 5.4.

require_once '../simplepie.inc';
require_once 'functions.php';

if (php_sapi_name() != 'cli') {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<title>SimplePie Test</title>
<style type="text/css">
body {
background-color: #000;
color: #fff;
font-family: Monaco, courier, monospace;
font-size: 10px;
}
</style>
<p>
<?php
	ob_start('callable_nl2br');
}

$GLOBALS['passed'] = 0;
$GLOBALS['unsupported'] = 0;
$GLOBALS['failed'] = 0;
$GLOBALS['testnum'] = 0;

// Set Base
$base = 'http://a/b/c/d;p?q';

// Normal
do_relative_absolutize_test('g:h', $base, 'g:h');
do_relative_absolutize_test('g', $base, 'http://a/b/c/g');
do_relative_absolutize_test('./g', $base, 'http://a/b/c/g');
do_relative_absolutize_test('g/', $base, 'http://a/b/c/g/');
do_relative_absolutize_test('/g', $base, 'http://a/g');
do_relative_absolutize_test('//g', $base, 'http://g');
do_relative_absolutize_test('?y', $base, 'http://a/b/c/d;p?y');
do_relative_absolutize_test('g?y', $base, 'http://a/b/c/g?y');
do_relative_absolutize_test('#s', $base, 'http://a/b/c/d;p?q#s');
do_relative_absolutize_test('g#s', $base, 'http://a/b/c/g#s');
do_relative_absolutize_test('g?y#s', $base, 'http://a/b/c/g?y#s');
do_relative_absolutize_test(';x', $base, 'http://a/b/c/;x');
do_relative_absolutize_test('g;x', $base, 'http://a/b/c/g;x');
do_relative_absolutize_test('g;x?y#s', $base, 'http://a/b/c/g;x?y#s');
do_relative_absolutize_test('', $base, 'http://a/b/c/d;p?q');
do_relative_absolutize_test('.', $base, 'http://a/b/c/');
do_relative_absolutize_test('./', $base, 'http://a/b/c/');
do_relative_absolutize_test('..', $base, 'http://a/b/');
do_relative_absolutize_test('../', $base, 'http://a/b/');
do_relative_absolutize_test('../g', $base, 'http://a/b/g');
do_relative_absolutize_test('../..', $base, 'http://a/');
do_relative_absolutize_test('../../', $base, 'http://a/');
do_relative_absolutize_test('../../g', $base, 'http://a/g');

// Abnormal
do_relative_absolutize_test('../../../g', $base, 'http://a/g');
do_relative_absolutize_test('../../../../g', $base, 'http://a/g');
do_relative_absolutize_test('/./g', $base, 'http://a/g');
do_relative_absolutize_test('/../g', $base, 'http://a/g');
do_relative_absolutize_test('g.', $base, 'http://a/b/c/g.');
do_relative_absolutize_test('.g', $base, 'http://a/b/c/.g');
do_relative_absolutize_test('g..', $base, 'http://a/b/c/g..');
do_relative_absolutize_test('..g', $base, 'http://a/b/c/..g');
do_relative_absolutize_test('./../g', $base, 'http://a/b/g');
do_relative_absolutize_test('./g/.', $base, 'http://a/b/c/g/');
do_relative_absolutize_test('g/./h', $base, 'http://a/b/c/g/h');
do_relative_absolutize_test('g/../h', $base, 'http://a/b/c/h');
do_relative_absolutize_test('g;x=1/./y', $base, 'http://a/b/c/g;x=1/y');
do_relative_absolutize_test('g;x=1/../y', $base, 'http://a/b/c/y');
do_relative_absolutize_test('g?y/./x', $base, 'http://a/b/c/g?y/./x');
do_relative_absolutize_test('g?y/../x', $base, 'http://a/b/c/g?y/../x');
do_relative_absolutize_test('g#s/./x', $base, 'http://a/b/c/g#s/./x');
do_relative_absolutize_test('g#s/../x', $base, 'http://a/b/c/g#s/../x');
do_relative_absolutize_test('http:g', $base, 'http:g');




// Totals
$pass_percent = round($GLOBALS['passed'] / $GLOBALS['testnum'] * 100, 1);
$unsupported_percent = round($GLOBALS['unsupported'] / $GLOBALS['testnum'] * 100, 1);
$fail_percent = round($GLOBALS['failed'] / $GLOBALS['testnum'] * 100, 1);
echo "\n\n$GLOBALS[testnum] tests, $GLOBALS[passed] passed ($pass_percent%), $GLOBALS[unsupported] unsupported ($unsupported_percent%), $GLOBALS[failed] failed ($fail_percent%).\n\n";

?>
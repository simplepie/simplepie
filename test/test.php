<?php

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

// Section 1: Well Formed: Ampersand
do_first_item_title_test('tests/wellformed/amp/amp01.xml', '&#38;');
do_first_item_title_test('tests/wellformed/amp/amp02.xml', '&#x26;');
do_first_item_title_test('tests/wellformed/amp/amp03.xml', '&');
do_first_item_title_test('tests/wellformed/amp/amp04.xml', '&amp;');
do_first_item_title_test('tests/wellformed/amp/amp05.xml', '&#38;');
do_first_item_title_test('tests/wellformed/amp/amp06.xml', '&#x26;');
do_first_item_title_test('tests/wellformed/amp/amp07.xml', '&');
do_first_item_title_test('tests/wellformed/amp/amp08.xml', '&amp;');
do_first_item_title_test('tests/wellformed/amp/amp09.xml', '&#38;');
do_first_item_title_test('tests/wellformed/amp/amp10.xml', '&#x26;');
do_first_item_title_test('tests/wellformed/amp/amp11.xml', '&');
do_first_item_title_test('tests/wellformed/amp/amp12.xml', '&amp;');
do_first_item_title_test('tests/wellformed/amp/amp13.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp14.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp15.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp16.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp17.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp18.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp19.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp20.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp21.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp22.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp23.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp24.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp25.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp26.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp27.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp28.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp29.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp30.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp31.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp32.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp33.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp34.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp35.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp36.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp37.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp38.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp39.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp40.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp41.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp42.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp43.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp44.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp45.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp46.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp47.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp48.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp49.xml', '&#38;');
do_first_item_title_test('tests/wellformed/amp/amp50.xml', '&#x26;');
do_first_item_title_test('tests/wellformed/amp/amp51.xml', '&');
do_first_item_title_test('tests/wellformed/amp/amp52.xml', '&amp;');
do_first_item_title_test('tests/wellformed/amp/amp53.xml', '<b>&#38;</b>');
do_first_item_title_test('tests/wellformed/amp/amp54.xml', '<b>&#x26;</b>');
do_first_item_title_test('tests/wellformed/amp/amp55.xml', '<b>&amp;</b>');
do_first_item_title_test('tests/wellformed/amp/amp56.xml', '<strong>&#38;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp57.xml', '<strong>&#x26;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp58.xml', '<strong>&amp;</strong>');
do_first_item_title_test('tests/wellformed/amp/amp59.xml', '<div><b>&amp;</b></div>');
do_first_item_title_test('tests/wellformed/amp/amp60.xml', '<div><b>&amp;</b></div>');
do_first_item_title_test('tests/wellformed/amp/amp61.xml', '<div><b>&amp;</b></div>');
do_first_item_title_test('tests/wellformed/amp/amp62.xml', '<div><strong>&amp;</strong></div>');
do_first_item_title_test('tests/wellformed/amp/amp63.xml', '<div><strong>&amp;</strong></div>');
do_first_item_title_test('tests/wellformed/amp/amp64.xml', '<div><strong>&amp;</strong></div>');

echo "\n";

// Section 1: Well Formed: Atom
do_feed_title_test('tests/wellformed/atom/atom_namespace_1.xml', 'Example Atom');
do_feed_title_test('tests/wellformed/atom/atom_namespace_2.xml', 'Example Atom');
do_feed_title_test('tests/wellformed/atom/atom_namespace_3.xml', 'Example Atom');
do_feed_title_test('tests/wellformed/atom/atom_namespace_4.xml', 'Example Atom');
do_feed_title_test('tests/wellformed/atom/atom_namespace_5.xml', 'Example Atom');
test_output('tests/wellformed/atom/entry_author_email.xml', 'unsupported', 'me@example.com');
test_output('tests/wellformed/atom/entry_author_homepage.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_author_map_author.xml', 'unsupported', 'Example author (me@example.com)');
test_output('tests/wellformed/atom/entry_author_map_author_2.xml', 'unsupported', 'Example author');
do_first_item_author_name_test('tests/wellformed/atom/entry_author_name.xml', 'Example author');
test_output('tests/wellformed/atom/entry_author_uri.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_author_url.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_content_mode_base64.xml', 'unsupported', '1');
test_output('tests/wellformed/atom/entry_content_mode_escaped.xml', 'unsupported', '1');
test_output('tests/wellformed/atom/entry_content_type_text_plain.xml', 'unsupported', 'text/plain');
test_output('tests/wellformed/atom/entry_content_type.xml', 'unsupported', 'text/plain');
do_first_item_content_test('tests/wellformed/atom/entry_content_value.xml', 'Example Atom');
test_output('tests/wellformed/atom/entry_contributor_email.xml', 'unsupported', 'me@example.com');
test_output('tests/wellformed/atom/entry_contributor_homepage.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_contributor_multiple.xml', 'unsupported', 'Array()');
test_output('tests/wellformed/atom/entry_contributor_name.xml', 'unsupported', 'Example contributor');
test_output('tests/wellformed/atom/entry_contributor_uri.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_contributor_url.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_id_map_guid.xml', 'unsupported', 'http://example.com/');
test_output('tests/wellformed/atom/entry_id.xml', 'unsupported', 'http://example.com/');
do_first_item_link_test('tests/wellformed/atom/entry_link_alternate_map_link_2.xml', 'http://www.example.com/');
do_first_item_link_test('tests/wellformed/atom/entry_link_alternate_map_link.xml', 'http://www.example.com/');
do_first_item_link_test('tests/wellformed/atom/entry_link_href.xml', 'http://www.example.com/');
test_output('tests/wellformed/atom/entry_link_multiple.xml', 'unsupported', 'Array()');
test_output('tests/wellformed/atom/entry_link_rel.xml', 'unsupported', 'alternate');
test_output('tests/wellformed/atom/entry_link_title.xml', 'unsupported', 'Example title');
test_output('tests/wellformed/atom/entry_link_type.xml', 'unsupported', 'text/html');
do_first_item_content_test('tests/wellformed/atom/entry_summary_base64_2.xml', '<p>History of the &lt;blink&gt; tag</p>');
do_first_item_content_test('tests/wellformed/atom/entry_summary_base64.xml', 'Example <b>Atom</b>');
test_output('tests/wellformed/atom/entry_summary_content_mode_base64.xml', 'unsupported', '1');
test_output('tests/wellformed/atom/entry_summary_content_mode_escaped.xml', 'unsupported', '1');
test_output('tests/wellformed/atom/entry_summary_content_type_text_plain.xml', 'unsupported', 'text/plain');
test_output('tests/wellformed/atom/entry_summary_content_type.xml', 'unsupported', 'text/plain');
do_first_item_content_test('tests/wellformed/atom/entry_summary_content_value.xml', 'Example Atom');
do_first_item_content_test('tests/wellformed/atom/entry_summary_escaped_markup.xml', 'Example <b>Atom</b>');
do_first_item_content_test('tests/wellformed/atom/entry_summary_inline_markup_2.xml', '<div>History of the &lt;blink&gt; tag</div>');
do_first_item_content_test('tests/wellformed/atom/entry_summary_inline_markup.xml', '<div>Example <b>Atom</b></div>');
do_first_item_content_test('tests/wellformed/atom/entry_summary_text_plain.xml', 'Example Atom');
do_first_item_content_test('tests/wellformed/atom/entry_summary.xml', 'Example Atom');
do_first_item_title_test('tests/wellformed/atom/entry_title_base64_2.xml', '<p>History of the &lt;blink&gt; tag</p>');
do_first_item_title_test('tests/wellformed/atom/entry_title_base64.xml', 'Example <b>Atom</b>');
test_output('tests/wellformed/atom/entry_title_content_mode_base64.xml', 'unsupported', '1');
test_output('tests/wellformed/atom/entry_title_content_mode_escaped.xml', 'unsupported', '1');
test_output('tests/wellformed/atom/entry_title_content_type_text_plain.xml', 'unsupported', 'text/plain');
test_output('tests/wellformed/atom/entry_title_content_type.xml', 'unsupported', 'text/plain');
do_first_item_title_test('tests/wellformed/atom/entry_title_content_value.xml', 'Example Atom');
do_first_item_title_test('tests/wellformed/atom/entry_title_escaped_markup.xml', 'Example <b>Atom</b>');
do_first_item_title_test('tests/wellformed/atom/entry_title_inline_markup_2.xml', '<div>History of the &lt;blink&gt; tag</div>');



// Totals
$pass_percent = round($GLOBALS['passed'] / $GLOBALS['testnum'] * 100, 1);
$unsupported_percent = round($GLOBALS['unsupported'] / $GLOBALS['testnum'] * 100, 1);
$fail_percent = round($GLOBALS['failed'] / $GLOBALS['testnum'] * 100, 1);
echo "\n\n$GLOBALS[testnum] tests, $GLOBALS[passed] passed ($pass_percent%), $GLOBALS[unsupported] unsupported ($unsupported_percent%), $GLOBALS[failed] failed ($fail_percent%).\n\n";

?>
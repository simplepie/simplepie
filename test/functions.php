<?php

require_once 'Color.php';

function test_output($file, $result, $expected) {
	$GLOBALS['testnum']++;
	echo "$GLOBALS[testnum]: ";
	if ($result == $expected) {
		if (php_sapi_name() == 'cli') {
			echo Console_Color::convert('%GPASS%n');
		} else {
			echo '<span style="color: #0f0; font-weight: bold;">PASS</span>';
		}
		$GLOBALS['passed']++;
	} else {
		if (php_sapi_name() == 'cli') {
			if ($result == 'unsupported') {
				echo Console_Color::convert('%YFAIL%n');
			} else {
				echo Console_Color::convert('%RFAIL%n');
			}
			echo " (got '$result' but expected '$expected')";
		} else {
			if ($result == 'unsupported') {
				echo '<span style="color: #ff0; font-weight: bold;">FAIL</span>';
			} else {
				echo '<span style="color: #f00; font-weight: bold;">FAIL</span>';
			}
			echo htmlspecialchars(" (got '$result' but expected '$expected')");
		}
		if ($result == 'unsupported') {
			$GLOBALS['unsupported']++;
		} else {
			$GLOBALS['failed']++;
		}
	}
	echo " ($file)\n";
}

function do_feed_title_test($file, $expected) {
	$feed = new SimplePie();
	$feed->set_feed_url($file);
	$feed->remove_div(false);
	$feed->init();
	test_output($file, $feed->get_feed_title(), $expected);
}

function do_first_item_title_test($file, $expected) {
	$feed = new SimplePie();
	$feed->set_feed_url($file);
	$feed->remove_div(false);
	$feed->init();
	$item = $feed->get_item(0);
	test_output($file, $item->get_title(), $expected);
}

function do_first_item_author_name_test($file, $expected) {
	$feed = new SimplePie();
	$feed->set_feed_url($file);
	$feed->remove_div(false);
	$feed->init();
	$item = $feed->get_item(0);
	$author = $item->get_author(0);
	test_output($file, $author->get_name(), $expected);
}

function do_first_item_content_test($file, $expected) {
	$feed = new SimplePie();
	$feed->set_feed_url($file);
	$feed->remove_div(false);
	$feed->init();
	$item = $feed->get_item(0);
	test_output($file, $item->get_description(), $expected);
}

function do_first_item_link_test($file, $expected) {
	$feed = new SimplePie();
	$feed->set_feed_url($file);
	$feed->remove_div(false);
	$feed->init();
	$item = $feed->get_item(0);
	test_output($file, $item->get_permalink(), $expected);
}

function do_relative_absolutize_test($url, $base, $expected)
{
	test_output($url, SimplePie_Misc::absolutize_url($url, $base), $expected);
}

function callable_nl2br($string) {
	return nl2br($string);
}

?>
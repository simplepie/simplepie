<?php

$html = "<p>In the <i>world of the <b class=fishsticks>web www</b></i>, <a href=\"http://simplepie.org/blog/2006/07/01/followup-user-experience-customer-service/\">SimplePie wrote about it</a>. abc. And here is an image: <img src=\"http://simplepie.org/images/128/desktop-mac.png\" alt=\"Mac Desktop\" title=\"Mac Desktop\" border=\"0\" /></p>";

echo shortdesc($html, 50);

function shortdesc($string, $length='1000000', $line_ending='...') {
	// Need to port line-ending logic from SPL

	return balance_html_tags(html_substr($string, $length));
	//return html_substr($string, $length);
}

// By Jay
// Returns a substring without breaking words or entities.
// http://us3.php.net/manual/en/function.substr.php#53852
function word_substr($string, $length) {
	for ( $iter = 0; $iter < strlen($string); $iter++ ) {
		$o = ($length+$iter >= strlen($string) ? $string : ($string{$length+$iter} == " " ? substr($string, 0, $length+$iter) : ""));
		if ( $o != "" ) { return $o; }
	}
}

// By fanfatal at fanfatal dot pl
// Executes a substring grab while ignoring and therefore maintaining HTML tags.
// http://us3.php.net/manual/en/function.substr.php#52893
//
// Has a bug where if the first word in a link label is also part of the URL, 
// this will cut off the text mid-URL.  Contacted the author about a fix.  
// Awaiting a response.
//
function html_substr($string, $length=false) {
	$pattern = '/(\[\w+[^\]]*?\]|\[\/\w+\]|<\w+[^>]*?>|<\/\w+>)/i';
	$clean = preg_replace($pattern, chr(1), $string);

	if (!$length) {
		$str = word_substr($clean);
		//$str = substr($clean);
	}
	else {
		$str = word_substr($clean, $length);
		$str = word_substr($clean, $length + substr_count($str, chr(1)));
		//$str = substr($clean, 0, $length);
		//$str = substr($clean, 0, $length + substr_count($str, chr(1)));
	}

	$pattern = str_replace(chr(1), '(.*?)', preg_quote($str));
	$pattern = str_replace('/', '\/', $pattern);
	if (preg_match('/'.$pattern.'/is', $string, $matched)) {
		return $matched[0];
	}

	return $string;
}

// By Scott Reilly, implemented into Wordpress 1.5
// Closes any opened XHTML/HTML tags in a string.
// http://www.coffee2code.com/archives/2004/08/03/fixing-balancetags/
function balance_html_tags($text) {
	$tagstack = array(); $stacksize = 0; $tagqueue = ''; $newtext = '';

	// WP bug fix for comments - in case you REALLY meant to type '< !--'
	$text = str_replace('< !--', '<    !--', $text);
	// WP bug fix for LOVE <3 (and other situations with '<' before a number)
	$text = preg_replace('#<([0-9]{1})#', '&lt;$1', $text);

	while (preg_match("/<(\/?\w*)\s*([^>]*)>/",$text,$regex)) {
		$newtext .= $tagqueue;

		$i = strpos($text,$regex[0]);
		$l = strlen($regex[0]);

		// clear the shifter
		$tagqueue = '';

		// Pop or Push
		if ($regex[1][0] == "/") { // End Tag
			$tag = strtolower(substr($regex[1],1));

			// if too many closing tags
			if ($stacksize <= 0) {
				$tag = ''; //or close to be safe $tag = '/' . $tag;
			}

			// if stacktop value = tag close value then pop
			else if ($tagstack[$stacksize - 1] == $tag) { // found closing tag
				$tag = '</' . $tag . '>'; // Close Tag

				// Pop
				array_pop ($tagstack);
				$stacksize--;
			}

			// closing tag not at top, search for it
			else {
				for ($j=$stacksize-1;$j>=0;$j--) {
					if ($tagstack[$j] == $tag) {

						// add tag to tagqueue
						for ($k=$stacksize-1;$k>=$j;$k--){
							$tagqueue .= '</' . array_pop ($tagstack) . '>';
							$stacksize--;
						}
						break;
					}
				}
				$tag = '';
			}
		}

		// Begin Tag
		else {
			$tag = strtolower($regex[1]);

			// If self-closing or '', don't do anything.
			if((substr($regex[2],-1) == '/') || ($tag == '')) {}

			// ElseIf it's a known single-entity tag but it doesn't close itself, do so
			else if ($tag == 'br' || $tag == 'img' || $tag == 'hr' || $tag == 'input') {
				$regex[2] .= '/';
			}
			else {    // Push the tag onto the stack
				// If the top of the stack is the same as the tag we want to push, close previous tag
				if (($stacksize > 0) && ($tag != 'div') && ($tagstack[$stacksize - 1] == $tag)) {
					$tagqueue = '</' . array_pop ($tagstack) . '>';
					$stacksize--;
				}
				$stacksize = array_push ($tagstack, $tag);
			}

			// Attributes
			$attributes = $regex[2];
			if ($attributes) $attributes = ' '.$attributes;
			$tag = '<'.$tag.$attributes.'>';

			//If already queuing a close tag, then put this tag on, too
			if ($tagqueue) {
				$tagqueue .= $tag;
				$tag = '';
			}
		}
		$newtext .= substr($text,0,$i) . $tag;
		$text = substr($text,$i+$l);
	}

	// Clear Tag Queue
	$newtext .= $tagqueue;

	// Add Remaining text
	$newtext .= $text;

	// Empty Stack
	while($x = array_pop($tagstack)) {
		$newtext .= '</' . $x . '>'; // Add remaining tags to close      
	}

	// WP fix for the bug with HTML comments
	$newtext = str_replace("< !--","<!--",$newtext);
	$newtext = str_replace("<    !--","< !--",$newtext);

	return $newtext;
}



?>

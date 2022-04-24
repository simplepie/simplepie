<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2016, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2016 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

use SimplePie\Misc;

class_exists('SimplePie\Misc');

// @trigger_error(sprintf('Using the "SimplePie_Misc" class is deprecated since SimplePie 1.7, use "SimplePie\Misc" instead.'), \E_USER_DEPRECATED);

/**
 * Miscellanous utilities
 *
 * @package SimplePie
 */
class SimplePie_Misc
{
	public static function time_hms($seconds)
	{
		return Misc::time_hms($seconds);
	}

	public static function absolutize_url($relative, $base)
	{
		return Misc::absolutize_url($relative, $base);
	}

	/**
	 * Get a HTML/XML element from a HTML string
	 *
	 * @deprecated Use DOMDocument instead (parsing HTML with regex is bad!)
	 * @param string $realname Element name (including namespace prefix if applicable)
	 * @param string $string HTML document
	 * @return array
	 */
	public static function get_element($realname, $string)
	{
		$return = array();
		$name = preg_quote($realname, '/');
		if (preg_match_all("/<($name)" . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . "(>(.*)<\/$name>|(\/)?>)/siU", $string, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE))
		{
			for ($i = 0, $total_matches = count($matches); $i < $total_matches; $i++)
			{
				$return[$i]['tag'] = $realname;
				$return[$i]['full'] = $matches[$i][0][0];
				$return[$i]['offset'] = $matches[$i][0][1];
				if (strlen($matches[$i][3][0]) <= 2)
				{
					$return[$i]['self_closing'] = true;
				}
				else
				{
					$return[$i]['self_closing'] = false;
					$return[$i]['content'] = $matches[$i][4][0];
				}
				$return[$i]['attribs'] = array();
				if (isset($matches[$i][2][0]) && preg_match_all('/[\x09\x0A\x0B\x0C\x0D\x20]+([^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3D\x3E]*)(?:[\x09\x0A\x0B\x0C\x0D\x20]*=[\x09\x0A\x0B\x0C\x0D\x20]*(?:"([^"]*)"|\'([^\']*)\'|([^\x09\x0A\x0B\x0C\x0D\x20\x22\x27\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x3E]*)?))?/', ' ' . $matches[$i][2][0] . ' ', $attribs, PREG_SET_ORDER))
				{
					for ($j = 0, $total_attribs = count($attribs); $j < $total_attribs; $j++)
					{
						if (count($attribs[$j]) === 2)
						{
							$attribs[$j][2] = $attribs[$j][1];
						}
						$return[$i]['attribs'][strtolower($attribs[$j][1])]['data'] = SimplePie_Misc::entities_decode(end($attribs[$j]));
					}
				}
			}
		}
		return $return;
	}

	public static function element_implode($element)
	{
		return Misc::element_implode($element);
	}

	public static function error($message, $level, $file, $line)
	{
		return Misc::error($message, $level, $file, $line);
	}

	public static function fix_protocol($url, $http = 1)
	{
		return Misc::fix_protocol($url, $http);
	}

	public static function array_merge_recursive($array1, $array2)
	{
		return Misc::array_merge_recursive($array1, $array2);
	}

	public static function parse_url($url)
	{
		return Misc::parse_url($url);
	}

	public static function compress_parse_url($scheme = '', $authority = '', $path = '', $query = '', $fragment = '')
	{
		return Misc::compress_parse_url($scheme, $authority, $path, $query, $fragment);
	}

	public static function normalize_url($url)
	{
		return Misc::normalize_url($url);
	}

	public static function percent_encoding_normalization($match)
	{
		return Misc::percent_encoding_normalization($match);
	}

	/**
	 * Converts a Windows-1252 encoded string to a UTF-8 encoded string
	 *
	 * @static
	 * @param string $string Windows-1252 encoded string
	 * @return string UTF-8 encoded string
	 */
	public static function windows_1252_to_utf8($string)
	{
		return Misc::windows_1252_to_utf8($string);
	}

	/**
	 * Change a string from one encoding to another
	 *
	 * @param string $data Raw data in $input encoding
	 * @param string $input Encoding of $data
	 * @param string $output Encoding you want
	 * @return string|boolean False if we can't convert it
	 */
	public static function change_encoding($data, $input, $output)
	{
		return Misc::change_encoding($data, $input, $output);
	}

	protected static function change_encoding_mbstring($data, $input, $output)
	{
		if ($input === 'windows-949')
		{
			$input = 'EUC-KR';
		}
		if ($output === 'windows-949')
		{
			$output = 'EUC-KR';
		}
		if ($input === 'Windows-31J')
		{
			$input = 'SJIS';
		}
		if ($output === 'Windows-31J')
		{
			$output = 'SJIS';
		}

		// Check that the encoding is supported
		if (!in_array($input, mb_list_encodings()))
		{
			return false;
		}

		if (@mb_convert_encoding("\x80", 'UTF-16BE', $input) === "\x00\x80")
		{
			return false;
		}

		// Let's do some conversion
		if ($return = @mb_convert_encoding($data, $output, $input))
		{
			return $return;
		}

		return false;
	}

	protected static function change_encoding_iconv($data, $input, $output)
	{
		return @iconv($input, $output, $data);
	}

	/**
	 * @param string $data
	 * @param string $input
	 * @param string $output
	 * @return string|false
	 */
	protected static function change_encoding_uconverter($data, $input, $output)
	{
		return @\UConverter::transcode($data, $output, $input);
	}

	/**
	 * Normalize an encoding name
	 *
	 * This is automatically generated by create.php
	 *
	 * To generate it, run `php create.php` on the command line, and copy the
	 * output to replace this function.
	 *
	 * @param string $charset Character set to standardise
	 * @return string Standardised name
	 */
	public static function encoding($charset)
	{
		return Misc::encoding($charset);
	}

	public static function get_curl_version()
	{
		return Misc::get_curl_version();
	}

	/**
	 * Strip HTML comments
	 *
	 * @param string $data Data to strip comments from
	 * @return string Comment stripped string
	 */
	public static function strip_comments($data)
	{
		return Misc::strip_comments($data);
	}

	public static function parse_date($dt)
	{
		return Misc::parse_date($dt);
	}

	/**
	 * Decode HTML entities
	 *
	 * @deprecated Use DOMDocument instead
	 * @param string $data Input data
	 * @return string Output data
	 */
	public static function entities_decode($data)
	{
		$decoder = new SimplePie_Decode_HTML_Entities($data);
		return $decoder->parse();
	}

	/**
	 * Remove RFC822 comments
	 *
	 * @param string $data Data to strip comments from
	 * @return string Comment stripped string
	 */
	public static function uncomment_rfc822($string)
	{
		return Misc::uncomment_rfc822($string);
	}

	public static function parse_mime($mime)
	{
		return Misc::parse_mime($mime);
	}

	public static function atom_03_construct_type($attribs)
	{
		return Misc::atom_03_construct_type($attribs);
	}

	public static function atom_10_construct_type($attribs)
	{
		return Misc::atom_10_construct_type($attribs);
	}

	public static function atom_10_content_construct_type($attribs)
	{
		return Misc::atom_10_content_construct_type($attribs);
	}

	public static function is_isegment_nz_nc($string)
	{
		return Misc::is_isegment_nz_nc($string);
	}

	public static function space_separated_tokens($string)
	{
		return Misc::space_separated_tokens($string);
	}

	/**
	 * Converts a unicode codepoint to a UTF-8 character
	 *
	 * @static
	 * @param int $codepoint Unicode codepoint
	 * @return string UTF-8 character
	 */
	public static function codepoint_to_utf8($codepoint)
	{
		return Misc::codepoint_to_utf8($codepoint);
	}

	/**
	 * Similar to parse_str()
	 *
	 * Returns an associative array of name/value pairs, where the value is an
	 * array of values that have used the same name
	 *
	 * @static
	 * @param string $str The input string.
	 * @return array
	 */
	public static function parse_str($str)
	{
		return Misc::parse_str($str);
	}

	/**
	 * Detect XML encoding, as per XML 1.0 Appendix F.1
	 *
	 * @todo Add support for EBCDIC
	 * @param string $data XML data
	 * @param SimplePie_Registry $registry Class registry
	 * @return array Possible encodings
	 */
	public static function xml_encoding($data, $registry)
	{
		return Misc::xml_encoding($data, $registry);
	}

	public static function output_javascript()
	{
		Misc::output_javascript();
	}

	/**
	 * Get the SimplePie build timestamp
	 *
	 * Uses the git index if it exists, otherwise uses the modification time
	 * of the newest file.
	 */
	public static function get_build()
	{
		return Misc::get_build();
	}

	/**
	 * Format debugging information
	 */
	public static function debug(&$sp)
	{
		return Misc::debug($sp);
	}

	public static function silence_errors($num, $str)
	{
		Misc::silence_errors($num, $str);
	}

	/**
	 * Sanitize a URL by removing HTTP credentials.
	 * @param string $url the URL to sanitize.
	 * @return string the same URL without HTTP credentials.
	 */
	public static function url_remove_credentials($url)
	{
		return Misc::url_remove_credentials($url);
	}
}

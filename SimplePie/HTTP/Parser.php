<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2009, Ryan Parman, Geoffrey Sneddon, Ryan McCue, and contributors
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
 * @version 1.3-dev
 * @copyright 2004-2010 Ryan Parman, Geoffrey Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */


/**
 * HTTP Response Parser
 *
 * @package SimplePie
 */
class SimplePie_HTTP_Parser
{
	/**
	 * HTTP Version
	 *
	 * @access public
	 * @var float
	 */
	var $http_version = 0.0;

	/**
	 * Status code
	 *
	 * @access public
	 * @var int
	 */
	var $status_code = 0;

	/**
	 * Reason phrase
	 *
	 * @access public
	 * @var string
	 */
	var $reason = '';

	/**
	 * Key/value pairs of the headers
	 *
	 * @access public
	 * @var array
	 */
	var $headers = array();

	/**
	 * Body of the response
	 *
	 * @access public
	 * @var string
	 */
	var $body = '';

	/**
	 * Current state of the state machine
	 *
	 * @access private
	 * @var string
	 */
	var $state = 'http_version';

	/**
	 * Input data
	 *
	 * @access private
	 * @var string
	 */
	var $data = '';

	/**
	 * Input data length (to avoid calling strlen() everytime this is needed)
	 *
	 * @access private
	 * @var int
	 */
	var $data_length = 0;

	/**
	 * Current position of the pointer
	 *
	 * @var int
	 * @access private
	 */
	var $position = 0;

	/**
	 * Name of the hedaer currently being parsed
	 *
	 * @access private
	 * @var string
	 */
	var $name = '';

	/**
	 * Value of the hedaer currently being parsed
	 *
	 * @access private
	 * @var string
	 */
	var $value = '';

	/**
	 * Create an instance of the class with the input data
	 *
	 * @access public
	 * @param string $data Input data
	 */
	public function __construct($data)
	{
		$this->data = $data;
		$this->data_length = strlen($this->data);
	}

	/**
	 * Parse the input data
	 *
	 * @access public
	 * @return bool true on success, false on failure
	 */
	public function parse()
	{
		while ($this->state && $this->state !== 'emit' && $this->has_data())
		{
			$state = $this->state;
			$this->$state();
		}
		$this->data = '';
		if ($this->state === 'emit' || $this->state === 'body')
		{
			return true;
		}
		else
		{
			$this->http_version = '';
			$this->status_code = '';
			$this->reason = '';
			$this->headers = array();
			$this->body = '';
			return false;
		}
	}

	/**
	 * Check whether there is data beyond the pointer
	 *
	 * @access private
	 * @return bool true if there is further data, false if not
	 */
	public function has_data()
	{
		return (bool) ($this->position < $this->data_length);
	}

	/**
	 * See if the next character is LWS
	 *
	 * @access private
	 * @return bool true if the next character is LWS, false if not
	 */
	public function is_linear_whitespace()
	{
		return (bool) ($this->data[$this->position] === "\x09"
			|| $this->data[$this->position] === "\x20"
			|| ($this->data[$this->position] === "\x0A"
				&& isset($this->data[$this->position + 1])
				&& ($this->data[$this->position + 1] === "\x09" || $this->data[$this->position + 1] === "\x20")));
	}

	/**
	 * Parse the HTTP version
	 *
	 * @access private
	 */
	public function http_version()
	{
		if (strpos($this->data, "\x0A") !== false && strtoupper(substr($this->data, 0, 5)) === 'HTTP/')
		{
			$len = strspn($this->data, '0123456789.', 5);
			$this->http_version = substr($this->data, 5, $len);
			$this->position += 5 + $len;
			if (substr_count($this->http_version, '.') <= 1)
			{
				$this->http_version = (float) $this->http_version;
				$this->position += strspn($this->data, "\x09\x20", $this->position);
				$this->state = 'status';
			}
			else
			{
				$this->state = false;
			}
		}
		else
		{
			$this->state = false;
		}
	}

	/**
	 * Parse the status code
	 *
	 * @access private
	 */
	public function status()
	{
		if ($len = strspn($this->data, '0123456789', $this->position))
		{
			$this->status_code = (int) substr($this->data, $this->position, $len);
			$this->position += $len;
			$this->state = 'reason';
		}
		else
		{
			$this->state = false;
		}
	}

	/**
	 * Parse the reason phrase
	 *
	 * @access private
	 */
	public function reason()
	{
		$len = strcspn($this->data, "\x0A", $this->position);
		$this->reason = trim(substr($this->data, $this->position, $len), "\x09\x0D\x20");
		$this->position += $len + 1;
		$this->state = 'new_line';
	}

	/**
	 * Deal with a new line, shifting data around as needed
	 *
	 * @access private
	 */
	public function new_line()
	{
		$this->value = trim($this->value, "\x0D\x20");
		if ($this->name !== '' && $this->value !== '')
		{
			$this->name = strtolower($this->name);
			// We should only use the last Content-Type header. c.f. issue #1
			if (isset($this->headers[$this->name]) && $this->name !== 'content-type')
			{
				$this->headers[$this->name] .= ', ' . $this->value;
			}
			else
			{
				$this->headers[$this->name] = $this->value;
			}
		}
		$this->name = '';
		$this->value = '';
		if (substr($this->data[$this->position], 0, 2) === "\x0D\x0A")
		{
			$this->position += 2;
			$this->state = 'body';
		}
		elseif ($this->data[$this->position] === "\x0A")
		{
			$this->position++;
			$this->state = 'body';
		}
		else
		{
			$this->state = 'name';
		}
	}

	/**
	 * Parse a header name
	 *
	 * @access private
	 */
	public function name()
	{
		$len = strcspn($this->data, "\x0A:", $this->position);
		if (isset($this->data[$this->position + $len]))
		{
			if ($this->data[$this->position + $len] === "\x0A")
			{
				$this->position += $len;
				$this->state = 'new_line';
			}
			else
			{
				$this->name = substr($this->data, $this->position, $len);
				$this->position += $len + 1;
				$this->state = 'value';
			}
		}
		else
		{
			$this->state = false;
		}
	}

	/**
	 * Parse LWS, replacing consecutive LWS characters with a single space
	 *
	 * @access private
	 */
	public function linear_whitespace()
	{
		do
		{
			if (substr($this->data, $this->position, 2) === "\x0D\x0A")
			{
				$this->position += 2;
			}
			elseif ($this->data[$this->position] === "\x0A")
			{
				$this->position++;
			}
			$this->position += strspn($this->data, "\x09\x20", $this->position);
		} while ($this->has_data() && $this->is_linear_whitespace());
		$this->value .= "\x20";
	}

	/**
	 * See what state to move to while within non-quoted header values
	 *
	 * @access private
	 */
	public function value()
	{
		if ($this->is_linear_whitespace())
		{
			$this->linear_whitespace();
		}
		else
		{
			switch ($this->data[$this->position])
			{
				case '"':
					// Workaround for ETags: we have to include the quotes as
					// part of the tag.
					if (strtolower($this->name) === 'etag')
					{
						$this->value .= '"';
						$this->position++;
						$this->state = 'value_char';
						break;
					}
					$this->position++;
					$this->state = 'quote';
					break;

				case "\x0A":
					$this->position++;
					$this->state = 'new_line';
					break;

				default:
					$this->state = 'value_char';
					break;
			}
		}
	}

	/**
	 * Parse a header value while outside quotes
	 *
	 * @access private
	 */
	public function value_char()
	{
		$len = strcspn($this->data, "\x09\x20\x0A\"", $this->position);
		$this->value .= substr($this->data, $this->position, $len);
		$this->position += $len;
		$this->state = 'value';
	}

	/**
	 * See what state to move to while within quoted header values
	 *
	 * @access private
	 */
	public function quote()
	{
		if ($this->is_linear_whitespace())
		{
			$this->linear_whitespace();
		}
		else
		{
			switch ($this->data[$this->position])
			{
				case '"':
					$this->position++;
					$this->state = 'value';
					break;

				case "\x0A":
					$this->position++;
					$this->state = 'new_line';
					break;

				case '\\':
					$this->position++;
					$this->state = 'quote_escaped';
					break;

				default:
					$this->state = 'quote_char';
					break;
			}
		}
	}

	/**
	 * Parse a header value while within quotes
	 *
	 * @access private
	 */
	public function quote_char()
	{
		$len = strcspn($this->data, "\x09\x20\x0A\"\\", $this->position);
		$this->value .= substr($this->data, $this->position, $len);
		$this->position += $len;
		$this->state = 'value';
	}

	/**
	 * Parse an escaped character within quotes
	 *
	 * @access private
	 */
	public function quote_escaped()
	{
		$this->value .= $this->data[$this->position];
		$this->position++;
		$this->state = 'quote';
	}

	/**
	 * Parse the body
	 *
	 * @access private
	 */
	public function body()
	{
		$this->body = substr($this->data, $this->position);
		$this->state = 'emit';
	}
}

<?php

/**
 * @todo Move to properly supporting RFC2616 (HTTP/1.1)
 */
class SimplePie_File
{
	var $url;
	var $useragent;
	var $success = true;
	var $headers = array();
	var $body;
	var $status_code;
	var $redirects = 0;
	var $error;
	var $method = SIMPLEPIE_FILE_SOURCE_NONE;

	public function __construct($url, $timeout = 10, $redirects = 5, $headers = null, $useragent = null, $force_fsockopen = false)
	{
		if (class_exists('idna_convert'))
		{
			$idn = new idna_convert();
			$parsed = SimplePie_Misc::parse_url($url);
			$url = SimplePie_Misc::compress_parse_url($parsed['scheme'], $idn->encode($parsed['authority']), $parsed['path'], $parsed['query'], $parsed['fragment']);
		}
		$this->url = $url;
		$this->useragent = $useragent;
		if (preg_match('/^http(s)?:\/\//i', $url))
		{
			if ($useragent === null)
			{
				$useragent = ini_get('user_agent');
				$this->useragent = $useragent;
			}
			if (!is_array($headers))
			{
				$headers = array();
			}
			if (!$force_fsockopen && function_exists('curl_exec'))
			{
				$this->method = SIMPLEPIE_FILE_SOURCE_REMOTE | SIMPLEPIE_FILE_SOURCE_CURL;
				$fp = curl_init();
				$headers2 = array();
				foreach ($headers as $key => $value)
				{
					$headers2[] = "$key: $value";
				}
				if (version_compare(SimplePie_Misc::get_curl_version(), '7.10.5', '>='))
				{
					curl_setopt($fp, CURLOPT_ENCODING, '');
				}
				curl_setopt($fp, CURLOPT_URL, $url);
				curl_setopt($fp, CURLOPT_HEADER, 1);
				curl_setopt($fp, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($fp, CURLOPT_TIMEOUT, $timeout);
				curl_setopt($fp, CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt($fp, CURLOPT_REFERER, $url);
				curl_setopt($fp, CURLOPT_USERAGENT, $useragent);
				curl_setopt($fp, CURLOPT_HTTPHEADER, $headers2);
				if (!ini_get('open_basedir') && !ini_get('safe_mode') && version_compare(SimplePie_Misc::get_curl_version(), '7.15.2', '>='))
				{
					curl_setopt($fp, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($fp, CURLOPT_MAXREDIRS, $redirects);
				}

				$this->headers = curl_exec($fp);
				if (curl_errno($fp) === 23 || curl_errno($fp) === 61)
				{
					curl_setopt($fp, CURLOPT_ENCODING, 'none');
					$this->headers = curl_exec($fp);
				}
				if (curl_errno($fp))
				{
					$this->error = 'cURL error ' . curl_errno($fp) . ': ' . curl_error($fp);
					$this->success = false;
				}
				else
				{
					$info = curl_getinfo($fp);
					curl_close($fp);
					$this->headers = explode("\r\n\r\n", $this->headers, $info['redirect_count'] + 1);
					$this->headers = array_pop($this->headers);
					$parser = new SimplePie_HTTP_Parser($this->headers);
					if ($parser->parse())
					{
						$this->headers = $parser->headers;
						$this->body = $parser->body;
						$this->status_code = $parser->status_code;
						if ((in_array($this->status_code, array(300, 301, 302, 303, 307)) || $this->status_code > 307 && $this->status_code < 400) && isset($this->headers['location']) && $this->redirects < $redirects)
						{
							$this->redirects++;
							$location = SimplePie_Misc::absolutize_url($this->headers['location'], $url);
							return $this->__construct($location, $timeout, $redirects, $headers, $useragent, $force_fsockopen);
						}
					}
				}
			}
			else
			{
				$this->method = SIMPLEPIE_FILE_SOURCE_REMOTE | SIMPLEPIE_FILE_SOURCE_FSOCKOPEN;
				$url_parts = parse_url($url);
				if (isset($url_parts['scheme']) && strtolower($url_parts['scheme']) === 'https')
				{
					$url_parts['host'] = "ssl://$url_parts[host]";
					$url_parts['port'] = 443;
				}
				if (!isset($url_parts['port']))
				{
					$url_parts['port'] = 80;
				}
				$fp = @fsockopen($url_parts['host'], $url_parts['port'], $errno, $errstr, $timeout);
				if (!$fp)
				{
					$this->error = 'fsockopen error: ' . $errstr;
					$this->success = false;
				}
				else
				{
					stream_set_timeout($fp, $timeout);
					if (isset($url_parts['path']))
					{
						if (isset($url_parts['query']))
						{
							$get = "$url_parts[path]?$url_parts[query]";
						}
						else
						{
							$get = $url_parts['path'];
						}
					}
					else
					{
						$get = '/';
					}
					$out = "GET $get HTTP/1.0\r\n";
					$out .= "Host: $url_parts[host]\r\n";
					$out .= "User-Agent: $useragent\r\n";
					if (extension_loaded('zlib'))
					{
						$out .= "Accept-Encoding: x-gzip,gzip,deflate\r\n";
					}

					if (isset($url_parts['user']) && isset($url_parts['pass']))
					{
						$out .= "Authorization: Basic " . base64_encode("$url_parts[user]:$url_parts[pass]") . "\r\n";
					}
					foreach ($headers as $key => $value)
					{
						$out .= "$key: $value\r\n";
					}
					$out .= "Connection: Close\r\n\r\n";
					fwrite($fp, $out);

					$info = stream_get_meta_data($fp);

					$this->headers = '';
					while (!$info['eof'] && !$info['timed_out'])
					{
						$this->headers .= fread($fp, 1160);
						$info = stream_get_meta_data($fp);
					}
					if (!$info['timed_out'])
					{
						$parser = new SimplePie_HTTP_Parser($this->headers);
						if ($parser->parse())
						{
							$this->headers = $parser->headers;
							$this->body = $parser->body;
							$this->status_code = $parser->status_code;
							if ((in_array($this->status_code, array(300, 301, 302, 303, 307)) || $this->status_code > 307 && $this->status_code < 400) && isset($this->headers['location']) && $this->redirects < $redirects)
							{
								$this->redirects++;
								$location = SimplePie_Misc::absolutize_url($this->headers['location'], $url);
								return $this->__construct($location, $timeout, $redirects, $headers, $useragent, $force_fsockopen);
							}
							if (isset($this->headers['content-encoding']))
							{
								// Hey, we act dumb elsewhere, so let's do that here too
								switch (strtolower(trim($this->headers['content-encoding'], "\x09\x0A\x0D\x20")))
								{
									case 'gzip':
									case 'x-gzip':
										$decoder = new SimplePie_gzdecode($this->body);
										if (!$decoder->parse())
										{
											$this->error = 'Unable to decode HTTP "gzip" stream';
											$this->success = false;
										}
										else
										{
											$this->body = $decoder->data;
										}
										break;

									case 'deflate':
										if (($body = gzuncompress($this->body)) === false)
										{
											if (($body = gzinflate($this->body)) === false)
											{
												$this->error = 'Unable to decode HTTP "deflate" stream';
												$this->success = false;
											}
										}
										$this->body = $body;
										break;

									default:
										$this->error = 'Unknown content coding';
										$this->success = false;
								}
							}
						}
					}
					else
					{
						$this->error = 'fsocket timed out';
						$this->success = false;
					}
					fclose($fp);
				}
			}
		}
		else
		{
			$this->method = SIMPLEPIE_FILE_SOURCE_LOCAL | SIMPLEPIE_FILE_SOURCE_FILE_GET_CONTENTS;
			if (!$this->body = file_get_contents($url))
			{
				$this->error = 'file_get_contents could not read the file';
				$this->success = false;
			}
		}
	}
}

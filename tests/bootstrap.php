<?php

require_once dirname(dirname(__FILE__)) . '/autoloader.php';

/**
 * Acts as a fake feed request
 */
class MockSimplePie_File extends SimplePie_File
{
	public function __construct($url)
	{
		$this->url = $url;
		$this->permanent_url = $url;
		$this->headers = array(
			'content-type' => 'application/atom+xml'
		);
		$this->method = SIMPLEPIE_FILE_SOURCE_REMOTE;
		$this->body = '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />';
		$this->status_code = 200;
	}
}

/**
 * Acts as a fake feed request that simulates first a permanent redirect from http:// URLs to https://,
 * and then appends a date non-permanently.
 */
class MockSimplePie_RedirectingFile extends MockSimplePie_File
{
	public function __construct($url)
	{
		parent::__construct($url);
		$this->permanent_url = str_replace('http://', 'https://', $url); // simulate 301
		$this->url = $this->permanent_url . '2019-10-07'; // simulate 302
	}
}

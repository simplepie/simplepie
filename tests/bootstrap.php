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
		$this->headers = array(
			'content-type' => 'application/atom+xml'
		);
		$this->method = SIMPLEPIE_FILE_SOURCE_REMOTE;
		$this->body = '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" />';
		$this->status_code = 200;
	}
}

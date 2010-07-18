<?php

class SimplePie_Caption
{
	var $type;
	var $lang;
	var $startTime;
	var $endTime;
	var $text;

	// Constructor, used to input the data
	public function __construct($type = null, $lang = null, $startTime = null, $endTime = null, $text = null)
	{
		$this->type = $type;
		$this->lang = $lang;
		$this->startTime = $startTime;
		$this->endTime = $endTime;
		$this->text = $text;
	}

	public function __toString()
	{
		// There is no $this->data here
		return md5(serialize($this));
	}

	public function get_endtime()
	{
		if ($this->endTime !== null)
		{
			return $this->endTime;
		}
		else
		{
			return null;
		}
	}

	public function get_language()
	{
		if ($this->lang !== null)
		{
			return $this->lang;
		}
		else
		{
			return null;
		}
	}

	public function get_starttime()
	{
		if ($this->startTime !== null)
		{
			return $this->startTime;
		}
		else
		{
			return null;
		}
	}

	public function get_text()
	{
		if ($this->text !== null)
		{
			return $this->text;
		}
		else
		{
			return null;
		}
	}

	public function get_type()
	{
		if ($this->type !== null)
		{
			return $this->type;
		}
		else
		{
			return null;
		}
	}
}


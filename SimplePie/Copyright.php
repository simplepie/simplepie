<?php

class SimplePie_Copyright
{
	var $url;
	var $label;

	// Constructor, used to input the data
	public function __construct($url = null, $label = null)
	{
		$this->url = $url;
		$this->label = $label;
	}

	public function __toString()
	{
		// There is no $this->data here
		return md5(serialize($this));
	}

	public function get_url()
	{
		if ($this->url !== null)
		{
			return $this->url;
		}
		else
		{
			return null;
		}
	}

	public function get_attribution()
	{
		if ($this->label !== null)
		{
			return $this->label;
		}
		else
		{
			return null;
		}
	}
}


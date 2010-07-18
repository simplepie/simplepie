<?php

class SimplePie_Cache_File
{
	var $location;
	var $filename;
	var $extension;
	var $name;

	public function __construct($location, $filename, $extension)
	{
		$this->location = $location;
		$this->filename = $filename;
		$this->extension = $extension;
		$this->name = "$this->location/$this->filename.$this->extension";
	}

	public function save($data)
	{
		if (file_exists($this->name) && is_writeable($this->name) || file_exists($this->location) && is_writeable($this->location))
		{
			if (is_a($data, 'SimplePie'))
			{
				$data = $data->data;
			}

			$data = serialize($data);
			return (bool) file_put_contents($this->name, $data);
		}
		return false;
	}

	public function load()
	{
		if (file_exists($this->name) && is_readable($this->name))
		{
			return unserialize(file_get_contents($this->name));
		}
		return false;
	}

	public function mtime()
	{
		if (file_exists($this->name))
		{
			return filemtime($this->name);
		}
		return false;
	}

	public function touch()
	{
		if (file_exists($this->name))
		{
			return touch($this->name);
		}
		return false;
	}

	public function unlink()
	{
		if (file_exists($this->name))
		{
			return unlink($this->name);
		}
		return false;
	}
}

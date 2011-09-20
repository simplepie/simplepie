<?php

class SimplePie_Cache_Memcache implements SimplePie_Cache_Base
{
	var $cache;
	var $options;
	var $name;
	
	public function __construct($url, $filename, $extension)
	{
		$this->options = array(
			'timeout' => 3600, // one hour
			'prefix' => 'simplepie_',
			'host' => '127.0.0.1',
			'port' => 11211,
		);
		$this->options = array_merge($this->options, SimplePie_Cache::parse_URL($url));
		$this->name = $this->options['prefix'].md5("$filename:$extension");
		
		$this->cache = new Memcache();
		$this->cache->addServer($this->options['host'], (int) $this->options['port']);
	}

	public function save($data)
	{
		if (is_a($data, 'SimplePie'))
		{
			$data = $data->data;
		}
		return $this->cache->set($this->name, serialize($data), MEMCACHE_COMPRESSED, (int) $this->options['timeout']);
	}

	public function load()
	{
		$data = $this->cache->get($this->name);
		
		if (False !== $data) return unserialize($data);
		return False;
	}

	public function mtime()
	{
		$data = $this->cache->get($this->name);
		
		if (False !== $data)
			return time(); // essentially ignore the mtime because Memcache expires on it's own
		
		return False;
	}

	public function touch()
	{
		$data = $this->cache->get($this->name);
		
		if (False !== $data)
			return $this->cache->set($this->name, $data, MEMCACHE_COMPRESSED, (int) $this->duration);
		
		return False;
	}

	public function unlink()
	{
		return $this->cache->delete($this->name);
	}
}

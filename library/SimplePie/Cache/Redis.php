<?php

/**
 * SimplePie Redis Cache Extension
 *
 * @package SimplePie
 * @author Jan Kozak <galvani78@gmail.com>
 * @link http://galvani.cz/
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

/**
 * Caches data to redis
 *
 * Registered for URLs with the "redis" protocol
 *
 * For example, `redis://localhost:6379/?timeout=3600&prefix=sp_&dbIndex=0` will
 * connect to redis on `localhost` on port 6379. All tables will be
 * prefixed with `sp_` and data will expire after 3600 seconds
 *
 * @package SimplePie
 * @subpackage Caching
 * @uses Redis
 */
class SimplePie_Cache_Redis implements SimplePie_Cache_Base {

  /**
	 * Redis instance
	 *
	 * @var Redis
	 */
	protected $cache;

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * Cache name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Cache Data
	 *
	 * @var type
	 */
	protected $data;

	/**
	 * Create a new cache object
	 *
	 * @param string $location Location string (from SimplePie::$cache_location)
	 * @param string $name Unique ID for the cache
	 * @param string $type Either TYPE_FEED for SimplePie data, or TYPE_IMAGE for image data
	 */
	public function __construct($location, $name, $type) {
		$this->options = array(
			'host' => '127.0.0.1',
			'port' => 6379,
			'extras' => array(
				'timeout' => 3600, // one hour
				'prefix' => 'simplepie_',
				'dbIndex' => 0
			),
		);
		$this->options = SimplePie_Misc::array_merge_recursive($this->options, SimplePie_Cache::parse_URL($location));

		$this->name = $this->options['extras']['prefix'] . md5("$name:$type");

		$this->cache = new Redis($this->options['host'], (int) $this->options['port']);
		$this->cache->select_db($this->options['extras']['dbIndex']);
	}

	/**
	 * Save data to the cache
	 *
	 * @param array|SimplePie $data Data to store in the cache. If passed a SimplePie object, only cache the $data property
	 * @return bool Successfulness
	 */
	public function save($data) {
		if ($data instanceof SimplePie) {
			$data = $data->data;
		}
		$response = $this->cache->set($this->name, serialize($data));
		$this->cache->expire($this->name, $this->options['extras']['timeout']);
		return $response;
	}

	/**
	 * Retrieve the data saved to the cache
	 *
	 * @return array Data for SimplePie::$data
	 */
	public function load() {

		$data = $this->cache->get($this->name);

		if ($data !== false) {
			return unserialize($data);
		}
		return false;
	}

	/**
	 * Retrieve the last modified time for the cache
	 *
	 * @return int Timestamp
	 */
	public function mtime() {

		$data = $this->cache->get($this->name);

		if ($data !== false) {
			// essentially ignore the mtime because Memcache expires on its own
			return time();
		}

		return false;
	}

	/**
	 * Set the last modified time to the current time
	 *
	 * @return bool Success status
	 */
	public function touch() {

		$data = $this->cache->get($this->name);

		if ($data !== false) {
			return $this->cache->set($this->name, $data);
		}

		return false;
	}

	/**
	 * Remove the cache
	 *
	 * @return bool Success status
	 */
	public function unlink() {
		return $this->cache->delete($this->name, 0);
	}

}

SimplePie_Cache::register('redis', '\SimplePie_Cache_Redis');

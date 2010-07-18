<?php

class SimplePie_Cache
{
	/**
	 * Don't call the constructor. Please.
	 *
	 * @access private
	 */
	private function __construct()
	{
		trigger_error('Please call SimplePie_Cache::create() instead of the constructor', E_USER_ERROR);
	}

	/**
	 * Create a new SimplePie_Cache object
	 *
	 * @static
	 * @access public
	 */
	public static function create($location, $filename, $extension)
	{
		$location_iri = new SimplePie_IRI($location);
		switch ($location_iri->get_scheme())
		{
			case 'mysql':
				if (extension_loaded('mysql'))
				{
					return new SimplePie_Cache_MySQL($location_iri, $filename, $extension);
				}
				break;

			default:
				return new SimplePie_Cache_File($location, $filename, $extension);
		}
	}
}


<?php

namespace Phaker\Generator;

/**
 * Address generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Address extends \Phaker {

	protected $_aliases = array(
		'province'    => 'state',
		'zip'         => 'zip_code',
		'postcode'    => 'zip_code',
		'postal_code' => 'zip_code',
	);

	protected $_flexible_key = 'address';

	/**
	 * @return  string
	 */
	public function city()
	{
		return static::parse('address.city');
	}

	/**
	 * @return  string
	 */
	public function street_name()
	{
		return static::parse('address.street_name');
	}

	/**
	 * @return  string
	 */
	public function street_address($include_secondary = FALSE)
	{
		$address = static::numerify(static::parse('address.street_address'));

		if ($include_secondary)
		{
			$address .= ' '.$this->secondary_address;
		}

		return $address;
	}

	/**
	 * @return  string
	 */
	public function secondary_address()
	{
		return static::numerify(static::fetch('address.secondary_address'));
	}

	/**
	 * @return  string
	 */
	public function zip_code()
	{
		return static::bothify(static::fetch('address.postcode'));
	}

	/**
	 * @return  string
	 */
	public function street_suffix()
	{
		return static::fetch('address.street_suffix');
	}

	/**
	 * @return  string
	 */
	public function city_suffix()
	{
		return static::fetch('address.city_suffix');
	}

	/**
	 * @return  string
	 */
	public function city_prefix()
	{
		return static::fetch('address.city_prefix');
	}

	/**
	 * @return  string
	 */
	public function state_abbr()
	{
		return static::fetch('address.state_abbr');
	}

	/**
	 * @return  string
	 */
	public function state()
	{
		return static::fetch('address.state');
	}

	/**
	 * @return  string
	 */
	public function country()
	{
		return static::fetch('address.country');
	}

	/**
	 * Generate a random latitude coordinate between (+/-)90°.
	 *
	 * @return  string
	 */
	public function latitude()
	{
		return (string) ((static::rand(0,1) * 180) - 90);
	}

	/**
	 * Generate a random longitude coordinate between (+/-)180°.
	 *
	 * @return  string
	 */
	public function longitude()
	{
		return (string) ((static::rand(0,1) * 360) - 180);
	}

} // End Address
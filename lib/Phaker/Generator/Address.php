<?php

namespace Phaker\Generator;

/**
 *
 * @package  Phaker
 */
class Address extends \Phaker {

	protected $_aliases = array(
		'zip'         => 'zip_code',
		'postcode'    => 'zip_code',
		'postal_code' => 'zip_code',
	);

	protected $_flexible_key = 'address';

	public function city()
	{
		return static::parse('address.city');
	}

	public function street_name()
	{
		return static::parse('address.street_name');
	}

	public function street_address($include_secondary = FALSE)
	{
		$address = static::numerify(static::parse('address.street_address'));

		if ($include_secondary)
		{
			$address .= ' '.$this->secondary_address;
		}

		return $address;
	}

	public function secondary_address()
	{
		return static::numerify(static::fetch('address.secondary_address'));
	}

	public function zip_code()
	{
		return static::bothify(static::fetch('address.postcode'));
	}

	public function street_suffix()
	{
		return static::fetch('address.street_suffix');
	}

	public function city_suffix()
	{
		return static::fetch('address.city_suffix');
	}

	public function city_prefix()
	{
		return static::fetch('address.city_prefix');
	}

	public function state_abbr()
	{
		return static::fetch('address.state_abbr');
	}

	public function state()
	{
		return static::fetch('address.state');
	}

	public function country()
	{
		return static::fetch('address.country');
	}

	public function latitude()
	{
		return (string) ((static::rand(0,1) * 180) - 90);
	}

	public function longitude()
	{
		return (string) ((static::rand(0,1) * 360) - 180);
	}

} // End Address
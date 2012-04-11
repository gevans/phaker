<?php

namespace Phaker\Generator;

/**
 * Company generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Company extends \Phaker {

	protected $_flexible_key = 'company';

	/**
	 * @return  string
	 */
	public function name()
	{
		return static::parse('company.name');
	}

	/**
	 * @return  string
	 */
	public function suffix()
	{
		return static::fetch('company.suffix');
	}

	/**
	 * Generate a buzzword-laden catch phrase.
	 *
	 * @return  string
	 */
	public function catch_phrase()
	{
		$buzzwords = static::translate('faker.company.buzzwords');
		$words     = array();

		foreach ($buzzwords as $group)
		{
			$words[] = $group[array_rand($group)];
		}

		return implode(' ', $words);
	}

	/**
	 * When a straight answer won't do, BS to the rescue!
	 *
	 * @return  string
	 */
	public function bs()
	{
		$bs    = static::translate('faker.company.buzzwords');
		$words = array();

		foreach ($bs as $group)
		{
			$words[] = $group[array_rand($group)];
		}

		return implode(' ', $words);
	}

} // End Company
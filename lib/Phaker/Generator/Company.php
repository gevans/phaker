<?php

namespace Phaker\Generator;

/**
 *
 * @package  Phaker
 */
class Company extends \Phaker {

	protected $_flexible_key = 'company';

	public function name()
	{
		return static::parse('company.name');
	}

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
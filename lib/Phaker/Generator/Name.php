<?php

namespace Phaker\Generator;

/**
 * Name generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Name extends \Phaker {

	protected $_flexible_key = 'name';

	/**
	 * @return  string
	 */
	public function name()
	{
		return static::parse('name.name');
	}

	/**
	 * @return  string
	 */
	public function first_name()
	{
		return static::fetch('name.first_name');
	}

	/**
	 * @return  string
	 */
	public function last_name()
	{
		return static::fetch('name.last_name');
	}

	/**
	 * @return  string
	 */
	public function prefix()
	{
		return static::fetch('name.prefix');
	}

	/**
	 * @return  string
	 */
	public function suffix()
	{
		return static::fetch('name.suffix');
	}

	/**
	 * Generate a buzzword-laden job title.
	 *
	 * Wordlist from http://www.bullshitjob.com/title/
	 *
	 * @return  string
	 */
	public function title()
	{
		return static::fetch('name.title.descriptor').' '.
		       static::fetch('name.title.level').' '.
		       static::fetch('name.title.job');
	}

} // End Name
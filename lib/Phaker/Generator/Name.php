<?php

namespace Phaker\Generator;

/**
 *
 * @package  Phaker
 */
class Name extends \Phaker {

	protected $_flexible_key = 'name';

	public function name()
	{
		return static::parse('name.name');
	}

	public function first_name()
	{
		return static::fetch('name.first_name');
	}

	public function last_name()
	{
		return static::fetch('name.last_name');
	}

	public function prefix()
	{
		return static::fetch('name.prefix');
	}

	public function suffix()
	{
		return static::fetch('name.suffix');
	}

	/**
	 * Generate a buzzword-laden job title.
	 *
	 * Wordlist from http://www.bullshitjob.com/title/
	 *
	 * @return [type]
	 */
	public function title()
	{
		return static::fetch('name.title.descriptor').' '.
		       static::fetch('name.title.level').' '.
		       static::fetch('name.title.job');
	}

} // End Name
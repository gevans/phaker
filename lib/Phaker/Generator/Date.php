<?php

namespace Phaker\Generator;

/**
 * Date and time generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Date extends \Phaker {

	/**
	 * @param   integer  $after   Earliest timestamp (defaults to January 1, 1970)
	 * @param   integer  $before  Latest timestamp (defaults to now)
	 * @return  integer  Unix timestamp
	 */
	public function unix_timestamp($after = NULL, $before = NULL)
	{
		if ( ! $after)
		{
			$after = 0;
		}

		if ( ! $before)
		{
			$before = time();
		}

		return mt_rand($after, $before);
	}

	/**
	 * @param   integer  $after   Earliest timestamp (defaults to January 1, 1970)
	 * @param   integer  $before  Latest timestamp (defaults to now)
	 * @return  object   `DateTime`
	 */
	public function datetime($after = NULL, $before = NULL)
	{
		return \DateTime::createFromFormat('U', (string) $this->unix_timestamp($after, $before));
	}

	/**
	 * @param   integer  $after   Earliest timestamp (defaults to January 1, 1970)
	 * @param   integer  $before  Latest timestamp (defaults to now)
	 * @return  string
	 */
	public function iso_date($after = NULL, $before = NULL)
	{
		return $this->date('Y-m-d H:i:s', $after, $before);
	}

	/**
	 * @param   string   $format  Date string format
	 * @param   integer  $after   Earliest timestamp (defaults to January 1, 1970)
	 * @param   integer  $before  Latest timestamp (defaults to now)
	 * @return  string
	 */
	public function date($format = 'Y-m-d', $after = NULL, $before = NULL)
	{
		return $this->datetime($after, $before)->format($format);
	}

	/**
	 * @param   string   $format  Date string format
	 * @param   integer  $after   Earliest timestamp (defaults to January 1, 1970)
	 * @param   integer  $before  Latest timestamp (defaults to now)
	 * @return  string
	 */
	public function time($format = 'H:i:s', $after = NULL, $before = NULL)
	{
		return $this->date($format, $after, $before);
	}

} // End Date
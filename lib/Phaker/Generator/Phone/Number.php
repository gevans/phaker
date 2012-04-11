<?php

namespace Phaker\Generator;

/**
 * Phone number generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Phone_Number extends \Phaker {

	/**
	 * @return  string
	 */
	public function phone_number()
	{
		return static::numerify(static::fetch('phone_number.formats'));
	}

	/**
	 * @return  string
	 */
	public function cell_number()
	{
		$translation = static::translate('faker.cell_phone');

		if ($translation AND is_array($translation))
		{
			return static::numerify($translation['formats'][array_rand($translation['formats'])]);
		}
		else
		{
			return static::numerify(static::fetch('phone_number.formats'));
		}
	}

} // End Phone_Number